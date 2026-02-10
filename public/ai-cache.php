<?php
// Fungsi untuk menghemat token AI dengan caching dan rate limiting

/**
 * Check if AI response is cached
 */
function checkAICache($question_hash) {
    $cache_file = __DIR__ . '/../cache/ai_' . $question_hash . '.txt';
    
    if (file_exists($cache_file)) {
        $cache_data = json_decode(file_get_contents($cache_file), true);
        $cache_time = $cache_data['time'] ?? 0;
        
        // Cache valid for 1 hour (3600 seconds)
        if ((time() - $cache_time) < 3600) {
            return $cache_data['answer'] ?? false;
        }
    }
    
    return false;
}

/**
 * Save AI response to cache
 */
function saveAICache($question_hash, $answer) {
    $cache_dir = __DIR__ . '/../cache';
    if (!is_dir($cache_dir)) {
        mkdir($cache_dir, 0755, true);
    }
    
    $cache_file = $cache_dir . '/ai_' . $question_hash . '.txt';
    $cache_data = [
        'time' => time(),
        'answer' => $answer,
        'hash' => $question_hash
    ];
    
    file_put_contents($cache_file, json_encode($cache_data));
}

/**
 * Check if question is similar to existing ones to avoid AI call
 */
function checkSimilarQuestions($pesan) {
    $common_questions = [
        'apa itu disperindag' => 'Disperindag adalah Dinas Perindustrian dan Perdagangan yang mengurus urusan industri dan perdagangan di Jawa Tengah.',
        'siapa kepala dinas' => 'Untuk informasi kepala dinas terbaru, silakan hubungi kantor kami di (024) 3549477.',
        'bagaimana cara' => 'Untuk cara dan prosedur, silakan datang langsung ke kantor atau hubungi kami untuk penjelasan lengkap.',
        'berapa biaya' => 'Untuk informasi biaya dan tarif, silakan hubungi kantor kami untuk penjelasan detail.',
        'dimana kantor' => 'Kantor Disperindag Jateng ada di Jl. Pahlawan No.4, Pleburan, Semarang Selatan.',
        'kapan buka' => 'Kantor kami buka Senin-Jumat jam 08:00-16:00 WIB.',
        'persyaratan apa' => 'Untuk persyaratan lengkap, silakan hubungi kantor atau kunjungi website resmi kami.'
    ];
    
    $pesan_lower = strtolower($pesan);
    foreach ($common_questions as $pattern => $answer) {
        if (strpos($pesan_lower, $pattern) !== false) {
            return $answer;
        }
    }
    
    return false;
}

/**
 * Clean old cache files to save storage
 */
function cleanOldCache() {
    $cache_dir = __DIR__ . '/../cache';
    if (!is_dir($cache_dir)) return;
    
    $files = glob($cache_dir . '/ai_*.txt');
    foreach ($files as $file) {
        if (filemtime($file) < (time() - 86400)) { // older than 24 hours
            unlink($file);
        }
    }
}

// Clean cache once per day
$last_clean_file = __DIR__ . '/../cache/.last_clean';
if (!file_exists($last_clean_file) || (time() - filemtime($last_clean_file)) > 86400) {
    cleanOldCache();
    touch($last_clean_file);
}
?>