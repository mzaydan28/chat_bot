<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../config/ai-config.php';
require_once __DIR__ . '/../config/knowledge-base.php';
require_once __DIR__ . '/../config/ppid-knowledge.php';
// require_once __DIR__ . '/../monitor-api-usage.php'; // REMOVED - file deleted

/**
 * Simple API Call Logger
 */
function logAPICall($type, $tokens, $description) {
    $log_entry = sprintf(
        "[%s] %s - Tokens: %d - %s",
        date('Y-m-d H:i:s'),
        strtoupper($type),
        $tokens,
        $description
    );
    error_log($log_entry);
}

/**
 * Get questions from database as context for AI (IMPROVED CONTEXT)
 */
function getQuestionsContext() {
    // Ambil lebih banyak context untuk AI yang lebih pintar
    $questions = supabase_request('GET', 'knowledge_base?select=question,answer&limit=30');
    
    if (isset($questions['error']) || empty($questions)) {
        error_log('Failed to get questions from knowledge_base: ' . json_encode($questions));
        return "";
    }
    
    $context = "\n\nReferensi FAQ (gunakan jika relevan):\n";
    foreach ($questions as $idx => $q) {
        // Jawaban lebih lengkap untuk konteks yang lebih baik
        $short_answer = substr($q['answer'], 0, 300) . (strlen($q['answer']) > 300 ? '...' : '');
        $context .= ($idx + 1) . ". " . $q['question'] . " → " . $short_answer . "\n";
    }
    
    return $context;
}

/**
 * Check if question needs AI or can be answered simply
 */
function needsAI($question) {
    $simple_patterns = [
        'halo', 'hai', 'hello', 'hi', 
        'terima kasih', 'thanks', 'makasih',
        'oke', 'ok', 'baik', 'sip'
    ];
    
    $question_lower = strtolower(trim($question));
    
    // Pertanyaan sangat pendek tidak perlu AI
    if (strlen($question_lower) < 5) {
        return false;
    }
    
    foreach ($simple_patterns as $pattern) {
        if (strpos($question_lower, $pattern) !== false && strlen($question_lower) < 20) {
            return false;
        }
    }
    
    return true;
}

/**
 * Validate if answer matches the question using AI
 * OPTIMIZED: With caching to reduce API calls
 * Returns true if answer is relevant, false if not
 */
function validateAnswerWithAI($question, $answer) {
    // Check cache first (HEMAT API)
    $cache_key = md5($question . '|' . substr($answer, 0, 100)); // Cache key based on Q+A
    $cache_file = __DIR__ . '/../cache/validation_' . $cache_key . '.txt';
    
    // Check if validation result is cached (valid for 24 hours)
    if (file_exists($cache_file) && (time() - filemtime($cache_file) < 86400)) {
        $cached_result = file_get_contents($cache_file);
        error_log("✅ VALIDATION CACHE HIT (no API call): " . ($cached_result === 'true' ? 'VALID' : 'INVALID'));
        return $cached_result === 'true';
    }
    
    // Check if API key exists
    if (empty(GROQ_API_KEY)) {
        // Fallback: Assume valid if API not available
        return true;
    }
    
    error_log("🔍 VALIDATION API CALL: Checking answer relevance...");
    
    // IMPROVED: More permissive validation prompt
    $validation_prompt = "Pertanyaan user: \"{$question}\"\n\nJawaban yang tersedia: \"{$answer}\"\n\nApakah jawaban ini RELEVAN dan bisa menjawab pertanyaan user (meski tidak persis sama)?\n\nJawab HANYA: YA atau TIDAK\n\nContoh:\n- Jika pertanyaan tentang alamat dan jawaban ada alamat → YA\n- Jika pertanyaan tentang visi dan jawaban ada visi/misi → YA\n- Jika pertanyaan dan jawaban topik sama → YA\n- Jika pertanyaan dan jawaban topik BEDA TOTAL → TIDAK";
    
    $url = GROQ_API_URL;
    $data = [
        'model' => GROQ_MODEL,
        'messages' => [
            ['role' => 'system', 'content' => 'Kamu validator yang PERMISSIVE. Jawab YA jika jawaban relevan dengan pertanyaan (tidak perlu persis sama). Jawab hanya: YA atau TIDAK.'],
            ['role' => 'user', 'content' => $validation_prompt]
        ],
        'temperature' => 0.3, // Slightly higher for more flexibility
        'max_tokens' => 10 // Only need "YA" or "TIDAK"
    ];
    
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . GROQ_API_KEY,
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_TIMEOUT => 10, // Quick validation
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // LOG API CALL for validation
    logAPICall('validation', 10, 'Validate answer relevance');
    
    if ($http_code !== 200) {
        // Fallback: Assume valid if API error
        error_log("❌ AI Validation failed: HTTP {$http_code}");
        return true;
    }
    
    $result = json_decode($response, true);
    $ai_response = trim(strtoupper($result['choices'][0]['message']['content'] ?? ''));
    
    // Check if AI says YES (YA/YES/SESUAI)
    $is_valid = (strpos($ai_response, 'YA') !== false || 
                 strpos($ai_response, 'YES') !== false || 
                 strpos($ai_response, 'SESUAI') !== false);
    
    // Save to cache for future use (HEMAT API)
    file_put_contents($cache_file, $is_valid ? 'true' : 'false');
    
    error_log("✅ VALIDATION RESULT: " . ($is_valid ? 'VALID' : 'INVALID') . " (cached for 24h)");
    
    return $is_valid;
}

/**
 * Check if question is related to Disperindag topics
 */
function isRelevantTopic($question) {
    $keywords = [
        // Core Disperindag
        'disperindag', 'umkm', 'usaha', 'perizinan', 'izin', 'perdagangan', 
        'industri', 'ekspor', 'impor', 'sertifikat', 'halal', 'metrologi',
        'koperasi', 'pasar', 'harga', 'kantor', 'jam', 'buka', 'tutup',
        'alamat', 'kontak', 'telepon', 'email', 'layanan', 'program',
        'bantuan', 'modal', 'pelatihan', 'daftar', 'jawa tengah', 'jateng',
        
        // PPID & Informasi Publik
        'ppid', 'informasi publik', 'keberatan', 'permohonan', 'sengketa',
        'keterbukaan', 'transparansi', 'akuntabilitas', 'pengaduan',
        'komplain', 'keluhan', 'aduan', 'lapor', 'masalah',
        
        // Organisasi & Profil
        'visi', 'misi', 'tugas', 'fungsi', 'struktur', 'organisasi',
        'kepala dinas', 'pejabat', 'kepegawaian', 'sdm', 'balai', 'upt',
        'profil', 'kedudukan', 'domisili', 'maklumat',
        
        // Kinerja & Laporan
        'lkjip', 'laporan', 'kinerja', 'capaian', 'target', 'evaluasi',
        'akuntabilitas', 'efisiensi', 'realisasi', 'rko',
        'lhkpn', 'lhkasn', 'lkpj', 'laporgub',
        
        // Perencanaan & Anggaran
        'anggaran', 'dpa', 'dipa', 'pad', 'keuangan', 'rka', 'pok',
        'renstra', 'renja', 'rencana strategis', 'rencana kerja',
        'kegiatan', 'penanggung jawab', 'jadwal', 'kak',
        
        // Peraturan & Kebijakan
        'peraturan', 'kebijakan', 'keputusan', 'sk', 'surat keputusan',
        'perda', 'pergub', 'berita acara', 'regulasi', 'sop',
        'standar', 'prosedur', 'perjanjian', 'pakta integritas',
        
        // Pengadaan
        'pengadaan', 'tender', 'lelang', 'barang', 'jasa', 'rup',
        'swakelola', 'penunjukan langsung', 'dokumen pengadaan',
        
        // Data & Statistik
        'data', 'statistik', 'open data', 'satu data', 'grafik',
        'agro', 'non agro', 'tekstil', 'alas kaki', 'kemasan',
        'sertifikasi', 'mutu', 'standardisasi', 'konsumen',
        
        // Layanan Online
        'formulir', 'download', 'unduh', 'akses', 'link', 'website',
        'online', 'fasilitasi', 'kemasan', 'iki', 'jawara'
    ];
    
    $question_lower = strtolower($question);
    foreach ($keywords as $keyword) {
        if (strpos($question_lower, $keyword) !== false) {
            return true;
        }
    }
    
    return false;
}

/**
 * Query Groq AI with context
 */
function askGroq($question) {
    // HEMAT TOKEN: Cek apakah pertanyaan perlu AI
    if (!needsAI($question)) {
        return [
            'error' => false,
            'response' => 'Baik, ada yang bisa saya bantu lagi? 😊'
        ];
    }
    
    // Check if API key exists
    if (empty(GROQ_API_KEY)) {
        return [
            'error' => true,
            'message' => 'API key tidak ditemukan'
        ];
    }
    
    // HEMAT TOKEN: Context minimal
    $context = getQuestionsContext();
    
    // Tambahkan knowledge dari website
    $website_knowledge = getWebsiteKnowledge();
    
    // Tambahkan PPID knowledge (daftar informasi publik lengkap)
    $ppid_knowledge = getPPIDKnowledge();
    
    // HEMAT TOKEN: Simplified system prompt dengan instruksi informatif
    $short_prompt = 'Kamu DISCHA, asisten Disperindag Jateng. Jawab singkat, ramah, natural seperti chat WA. Pakai 😊📞✅ emoji. Kalau tidak tahu, arahkan ke (024) 3549477.

PENTING:
- Jika website hanya punya link (Drive/PDF/gambar/poster/video), JANGAN langsung kasih link mentah
- Berikan jawaban INFORMATIF dulu, jelaskan apa isinya, lalu kasih link dengan format: "Anda bisa akses informasi lengkapnya di: [link]"
- Contoh: "Untuk informasi detail tentang persyaratan izin usaha, sudah tersedia dalam bentuk dokumen PDF yang bisa Anda unduh. Silakan akses di: https://link.com"
- Lihat daftar PPID untuk informasi dokumen/laporan resmi yang tersedia

HANDLE USER INTENT:
- Jika user tanya tentang PENGADUAN/KOMPLAIN/KELUHAN: Langsung jelaskan mekanisme pengaduan (bukan tugas pokok!). Arahkan ke layanan pengaduan masyarakat atau formulir pengaduan di PPID.
- Jika user tanya tentang LAYANAN/IZIN/PERIZINAN: Jelaskan prosedur dan syarat, berikan link formulir jika ada.
- Jika user tanya tentang PRODUK/INDUSTRI tertentu: Berikan info relevan tentang pembinaan industri tersebut.
- Fokus pada APA YANG USER BUTUHKAN, bukan definisi umum.

MEKANISME PENGADUAN DISPERINDAG JATENG:
Untuk pengaduan terkait perindustrian & perdagangan (produk industri, usaha dagang, penyalahgunaan wewenang):
1. Layanan Aduan Masyarakat melalui website PPID
2. Formulir Pengaduan Permasalahan Usaha Dagang tersedia di PPID
3. Formulir Pengaduan Penyalahgunaan Wewenang tersedia di PPID
4. Kontak pengaduan: (024) 3549477 atau email dinperindag@jatengprov.go.id
Website: https://disperindag.jatengprov.go.id/v3/ppid
';
    
    // Build messages with context
    $messages = [
        [
            'role' => 'system',
            'content' => $short_prompt . $context . $website_knowledge . $ppid_knowledge
        ],
        [
            'role' => 'user',
            'content' => $question
        ]
    ];
    
    // AI parameters - lebih fleksibel untuk jawaban lengkap
    $payload = [
        'model' => GROQ_MODEL,
        'messages' => $messages,
        'temperature' => 0.7,
        'max_tokens' => 1000, // Ditingkatkan untuk jawaban informatif + link
        'top_p' => 0.8
    ];
    
    // Make API request
    $ch = curl_init(GROQ_API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . GROQ_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        return [
            'error' => true,
            'message' => 'Connection error: ' . $error
        ];
    }
    
    if ($httpCode !== 200) {
        return [
            'error' => true,
            'message' => 'API error: ' . $httpCode,
            'response' => $response
        ];
    }
    
    $data = json_decode($response, true);
    
    if (isset($data['choices'][0]['message']['content'])) {
        // LOG API CALL
        $tokens = isset($data['usage']['total_tokens']) ? $data['usage']['total_tokens'] : 1000;
        logAPICall('groq-ai-query', $tokens, "Full AI query");
        
        return [
            'error' => false,
            'answer' => trim($data['choices'][0]['message']['content'])
        ];
    }
    
    return [
        'error' => true,
        'message' => 'Invalid response format',
        'response' => $response
    ];
}

/**
 * Check if message is a greeting
 */
function isGreeting($question) {
    $greetings = [
        'hai', 'halo', 'hello', 'hi', 'selamat pagi', 'selamat siang', 
        'selamat sore', 'selamat malam', 'assalamualaikum', 'salam',
        'met pagi', 'met siang', 'met sore', 'met malam', 'pagi',
        'siang', 'sore', 'malam', 'good morning', 'good afternoon',
        'good evening', 'hey', 'morning', 'afternoon', 'evening'
    ];
    
    $question_lower = strtolower(trim($question));
    foreach ($greetings as $greeting) {
        if ($question_lower === $greeting || 
            strpos($question_lower, $greeting) === 0 ||
            strpos($question_lower, $greeting . ' ') !== false) {
            return true;
        }
    }
    
    return false;
}

/**
 * Main AI handler function
 */
function handleAIQuery($question) {
    // Handle greetings first
    if (isGreeting($question)) {
        $greetingResponses = [
            "Halo! 😊 Saya DISCHA, asisten virtual Dinas Perindustrian dan Perdagangan Jawa Tengah. Senang bertemu dengan Anda! Ada yang bisa saya bantu terkait layanan UMKM, perizinan usaha, atau informasi Disperindag lainnya?",
            "Hai! 👋 Selamat datang! Saya DISCHA siap membantu Anda dengan informasi seputar layanan Disperindag Jateng. Mau tanya tentang apa hari ini?",
            "Selamat datang! 🎉 Saya DISCHA, chatbot ramah dari Disperindag Jawa Tengah. Silakan tanyakan apapun seputar UMKM, perdagangan, industri, atau layanan kami ya!",
            "Hello! 🌟 Saya DISCHA, asisten virtual yang siap membantu Anda dengan semua informasi tentang Dinas Perindustrian dan Perdagangan Jawa Tengah. Ada yang ingin ditanyakan?"
        ];
        return $greetingResponses[array_rand($greetingResponses)];
    }
    
    // Check if topic is relevant
    if (!isRelevantTopic($question)) {
        return "Maaf, saya hanya dapat membantu menjawab pertanyaan seputar Dinas Perindustrian dan Perdagangan Jawa Tengah. Silakan tanyakan hal lain terkait layanan, program UMKM, atau perizinan usaha.";
    }
    
    // Ask Groq
    $result = askGroq($question);
    
    if ($result['error']) {
        error_log('Groq AI Error: ' . json_encode($result));
        return "Maaf, saya mengalami kendala teknis. Silakan coba lagi atau hubungi kantor Disperindag Jawa Tengah untuk informasi lebih lanjut.";
    }
    
    return $result['answer'];
}
?>
