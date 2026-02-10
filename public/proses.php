<?php
// public/proses.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session untuk rate limiting dengan validasi
// Validasi session ID jika ada dari cookie/query string
if (isset($_COOKIE['PHPSESSID']) || isset($_GET['PHPSESSID'])) {
    $provided_session_id = $_COOKIE['PHPSESSID'] ?? $_GET['PHPSESSID'];
    // Validasi: hanya A-Z, a-z, 0-9, -, dan ,
    if (!preg_match('/^[a-zA-Z0-9,-]+$/', $provided_session_id)) {
        // Session ID tidak valid, buat yang baru
        session_id(md5(uniqid(rand(), true)));
    }
}

@session_start(); // Suppress warning jika ada

// Pastikan path ke config benar
include __DIR__ . "/../config/koneksi.php";
include __DIR__ . "/ai-handler.php";
include __DIR__ . "/ai-cache.php"; // HEMAT TOKEN: Cache functions

if (!isset($_POST['pesan'])) {
    die("Error: Pesan tidak diterima");
}

$pesan = $_POST['pesan'];
$pesan_lower = strtolower($pesan);
$user_ip = $_SERVER['REMOTE_ADDR'];
// Session ID logic - gunakan session yang sudah ada atau buat baru
$session_id = session_id() ?: md5(uniqid(rand(), true) . $user_ip);

// Rate limiting per session (DIPERLONGGAR)
if (!isset($_SESSION['last_ai_time'])) {
    $_SESSION['last_ai_time'] = 0;
    $_SESSION['ai_call_count'] = 0;
}
$now = time();
if (($now - $_SESSION['last_ai_time']) < 5) { // minimum 5 detik antar AI call
    if ($_SESSION['ai_call_count'] >= 10) { // max 10 calls per 5 detik
        echo "Mohon tunggu sebentar sebelum bertanya lagi... 😊";
        exit;
    }
}

// --- 1. AMBIL DATA CHATBOT ---
// Database connection: SUPABASE (ACTIVE) ✅
// Fallback: chatbot-data.php (jika Supabase error)

$keywords_data = supabase_request('GET', 'chatbot?select=*');
if (isset($keywords_data['error']) || empty($keywords_data)) {
    error_log('Supabase error, menggunakan fallback data dari file');
    $keywords_data = include __DIR__ . '/chatbot-data.php';
}

// Legacy: Direct file (di-comment karena sudah pakai Supabase)
// $keywords_data = include __DIR__ . '/chatbot-data.php';

$ketemu = false;
$matched_keyword = '';
$jawaban = '';
$answer_source = 'none'; // 'database' or 'ai'

// HEMAT TOKEN: Cek pertanyaan serupa dulu
$similar_answer = checkSimilarQuestions($pesan);
if ($similar_answer) {
    echo $similar_answer;
    $ketemu = true;
    $answer_source = 'similar';
    $matched_keyword = 'similar_question';
    $jawaban = $similar_answer;
} else {
    // HEMAT TOKEN: Cek cache AI hasil sebelumnya dulu
    $pesan_hash = md5($pesan_lower);
    $cached_answer = checkAICache($pesan_hash);
    if ($cached_answer) {
        echo $cached_answer;
        $ketemu = true;
        $answer_source = 'cache';
        $matched_keyword = 'cached_ai_response';
        $jawaban = $cached_answer;
    } else {
        // --- 2. LOGIKA PENCARIAN DATABASE (PRIORITAS: QUESTION SIMILARITY) ---
        if (!empty($keywords_data) && is_array($keywords_data)) {
            $best_match = null;
            $best_score = 0;
            $top_candidates = []; // Simpan top 3 untuk AI validation
            
            // DEBUG MODE: Enable untuk lihat score matching
            $debug_mode = true; // Set true untuk debug (ENABLED by default untuk troubleshooting)
            
            foreach ($keywords_data as $data) {
                $score = 0;
                $question_db = isset($data['question']) ? strtolower($data['question']) : '';
                
                // Skip jika tidak ada question
                if (empty($question_db)) {
                    continue;
                }
                
                // ===================================================
                // FASE 1: QUESTION SIMILARITY (PRIORITAS TERTINGGI)
                // ===================================================
                similar_text($pesan_lower, $question_db, $similarity);
                
                // Jika similarity sangat tinggi (>85%), langsung match!
                if ($similarity >= 85) {
                    $score = 1000 + $similarity; // Score super tinggi
                } 
                // Similarity tinggi (70-85%)
                else if ($similarity >= 70) {
                    $score = 500 + ($similarity * 2); // Base 500 + boost
                }
                // Similarity sedang (50-70%) 
                else if ($similarity >= 50) {
                    $score = 200 + $similarity; // Perlu boost dari keyword
                }
                // Similarity rendah (<50%)
                else {
                    $score = $similarity; // Sangat perlu keyword match
                }
                
                // ===================================================
                // FASE 2: KEYWORD BOOST (Untuk meningkatkan confidence)
                // ===================================================
                $keywords = explode(',', strtolower($data['keyword']));
                $keyword_match_count = 0;
                $keyword_boost = 0;
                
                foreach ($keywords as $keyword) {
                    $keyword = trim($keyword);
                    if (strlen($keyword) >= 3 && strpos($pesan_lower, $keyword) !== false) {
                        $keyword_boost += strlen($keyword) * 3; // Setiap keyword +3x panjang
                        $keyword_match_count++;
                    }
                }
                
                // Apply keyword boost berdasarkan level similarity
                if ($similarity >= 70) {
                    // Similarity sudah tinggi, keyword hanya sedikit boost
                    $score += $keyword_boost * 0.5;
                } else if ($similarity >= 50) {
                    // Similarity sedang, keyword boost penuh
                    $score += $keyword_boost * 1.5;
                } else if ($similarity >= 30) {
                    // Similarity rendah, keyword boost besar
                    $score += $keyword_boost * 2;
                    // Minimal harus ada keyword match
                    if ($keyword_match_count == 0) {
                        $score = 0; // Reject jika tidak ada keyword sama sekali
                    }
                } else {
                    // Similarity sangat rendah (<30%), buang!
                    $score = 0;
                }
                
                // Bonus untuk multiple keyword match
                if ($keyword_match_count >= 3) {
                    $score += 50; // Banyak keyword cocok = lebih yakin
                } else if ($keyword_match_count >= 2) {
                    $score += 20;
                }
                
                // DEBUG: Log scoring details
                if ($debug_mode && $score > 100) {
                    error_log("📊 CANDIDATE: [{$data['question']}] Score: {$score}, Sim: {$similarity}%, Keywords: {$keyword_match_count}");
                }
                
                // Simpan untuk top candidates
                if ($score > 0) {
                    $top_candidates[] = [
                        'data' => $data,
                        'score' => $score,
                        'similarity' => $similarity
                    ];
                }
            }
            
            // Sort candidates by score (descending)
            usort($top_candidates, function($a, $b) {
                return $b['score'] - $a['score'];
            });
            
            // DEBUG: Show top candidates
            if ($debug_mode && !empty($top_candidates)) {
                error_log("🏆 TOP 3 CANDIDATES:");
                for ($i = 0; $i < min(3, count($top_candidates)); $i++) {
                    $c = $top_candidates[$i];
                    error_log("  #" . ($i+1) . ": Score {$c['score']}, Sim {$c['similarity']}% - {$c['data']['question']}");
                }
            }
            
            // ===================================================
            // FASE 3: SMART VALIDATION (Hemat API Calls)
            // ===================================================
            // OPTIMASI: Hanya ambil TOP 1 kandidat untuk validasi AI
            // Ini reduce API calls dari max 3x menjadi max 1x
            $validated_match = null;
            
            if (!empty($top_candidates)) {
                $best_candidate = $top_candidates[0]; // TOP 1 only
                $data = $best_candidate['data'];
                $score = $best_candidate['score'];
                $similarity = $best_candidate['similarity'];
                
                // ===================================================
                // AUTO-ACCEPT TIERS (Prioritas: Similarity > Score)
                // ===================================================
                
                // TIER 1: Similarity sangat tinggi (>75%) - LANGSUNG ACCEPT!
                if ($similarity > 75) {
                    $validated_match = $data;
                    $best_score = $score;
                    error_log("✅ AUTO-ACCEPT (high similarity): score={$score}, similarity={$similarity}%");
                }
                // TIER 2: Score & similarity tinggi
                else if ($score > 700 && $similarity > 70) {
                    $validated_match = $data;
                    $best_score = $score;
                    error_log("✅ AUTO-ACCEPT (good match): score={$score}, similarity={$similarity}%");
                }
                // TIER 3: Score sangat tinggi (meski similarity medium)
                else if ($score > 900 && $similarity > 60) {
                    $validated_match = $data;
                    $best_score = $score;
                    error_log("✅ AUTO-ACCEPT (high score): score={$score}, similarity={$similarity}%");
                }
                // TIER 4: Score medium - perlu AI validation
                else if ($score >= 150 && $similarity >= 50) {
                    $answer = $data['answer'] ?? $data['jawaban'] ?? '';
                    
                    error_log("🔍 AI VALIDATION (1 API call): score={$score}, similarity={$similarity}%");
                    
                    // IMPROVED VALIDATION: Lebih permissive untuk similarity >60%
                    if ($similarity >= 60) {
                        // High similarity - assume valid, skip expensive AI call
                        $validated_match = $data;
                        $best_score = $score;
                        error_log("✅ AUTO-VALIDATED (sim≥60%): score={$score}, similarity={$similarity}%");
                    } else {
                        // Lower similarity - ask AI
                        $is_valid = validateAnswerWithAI($pesan, $answer);
                        
                        if ($is_valid) {
                            $validated_match = $data;
                            $best_score = $score;
                            error_log("✅ AI VALIDATED: {$pesan}");
                        } else {
                            error_log("❌ AI REJECTED: Will use Groq AI instead");
                        }
                    }
                }
                // TIER 5: Score terlalu rendah - langsung ke AI
                else {
                    error_log("⚠️  LOW SCORE ({$score}, {$similarity}%): Skip to Groq AI");
                }
            }
            
            // Gunakan jawaban yang sudah divalidasi AI
            if ($validated_match !== null) {
                $jawaban = $validated_match['answer'] ?? $validated_match['jawaban'] ?? 'Data tidak tersedia';
                echo $jawaban;
                $ketemu = true;
                $matched_keyword = $validated_match['keyword'];
                $answer_source = 'database_ai_validated';
            }
        }
    }
}

// --- 3. JIKA TIDAK KETEMU DI DATABASE, TANYA AI ---
if (!$ketemu) {
    // Update rate limiting
    $_SESSION['last_ai_time'] = $now;
    $_SESSION['ai_call_count']++;
    
    // Hash untuk cache (declare ulang karena bisa tidak terbuat di similar check)
    if (!isset($pesan_hash)) {
        $pesan_hash = md5($pesan_lower);
    }
    
    // Gunakan AI untuk menjawab
    $jawaban = handleAIQuery($pesan);
    echo $jawaban;
    $answer_source = 'ai';
    $ketemu = true; // Mark as answered by AI
    
    // Simpan hasil AI ke cache
    saveAICache($pesan_hash, $jawaban);
    
    // Save unanswered question for admin review
    $data_unanswered = [
        'pertanyaan' => $pesan,
        'user_ip'    => $user_ip,
        'status'     => 'pending'
    ];
    
    // Save to database
    $result_unanswered = supabase_request('POST', 'unanswered_questions', $data_unanswered);
    if (isset($result_unanswered['error'])) {
        error_log('Failed to save unanswered question: ' . json_encode($result_unanswered));
    }
}

// --- 4. SIMPAN RIWAYAT CHAT ---
$is_answered = $ketemu ? 1 : 0;

$data_history = [
    'session_id'      => $session_id,
    'user_question'   => $pesan,
    'bot_answer'      => $jawaban,
    'matched_keyword' => $matched_keyword ?: null,
    'is_answered'     => $is_answered,
    'user_ip'         => $user_ip
];

// Save chat history  
$result_history = supabase_request('POST', 'chat_history', $data_history);
if (isset($result_history['error'])) {
    error_log('Failed to save chat history: ' . json_encode($result_history));
}
?>