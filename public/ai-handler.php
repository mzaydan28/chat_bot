<?php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../config/ai-config.php';
require_once __DIR__ . '/../config/knowledge-base.php';

/**
 * Get all questions from database as context for AI
 */
function getQuestionsContext() {
    $questions = supabase_request('GET', 'tanya_jawab', [
        'select' => 'pertanyaan,jawaban',
        'limit' => 100
    ]);
    
    if (isset($questions['error']) || empty($questions)) {
        return '';
    }
    
    $context = "\n\nDaftar Pertanyaan & Jawaban yang tersedia:\n";
    foreach ($questions as $idx => $q) {
        $context .= ($idx + 1) . ". Q: " . $q['pertanyaan'] . "\n   A: " . $q['jawaban'] . "\n";
    }
    
    return $context;
}

/**
 * Check if question is related to Disperindag topics
 */
function isRelevantTopic($question) {
    $keywords = [
        'disperindag', 'umkm', 'usaha', 'perizinan', 'izin', 'perdagangan', 
        'industri', 'ekspor', 'impor', 'sertifikat', 'halal', 'metrologi',
        'koperasi', 'pasar', 'harga', 'kantor', 'jam', 'buka', 'tutup',
        'alamat', 'kontak', 'telepon', 'email', 'layanan', 'program',
        'bantuan', 'modal', 'pelatihan', 'daftar', 'jawa tengah', 'jateng'
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
    // Check if API key exists
    if (empty(GROQ_API_KEY)) {
        return [
            'error' => true,
            'message' => 'API key tidak ditemukan'
        ];
    }
    
    // Get context from database
    $context = getQuestionsContext();
    
    // Get additional knowledge from website (cached)
    $websiteKnowledge = getWebsiteKnowledge();
    
    // Build messages for Groq (OpenAI format)
    $messages = [
        [
            'role' => 'system',
            'content' => SYSTEM_PROMPT . $context . $websiteKnowledge
        ],
        [
            'role' => 'user',
            'content' => $question
        ]
    ];
    
    // Prepare request payload
    $payload = [
        'model' => GROQ_MODEL,
        'messages' => $messages,
        'temperature' => 0.9,
        'max_tokens' => 800,
        'top_p' => 0.9
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
 * Main AI handler function
 */
function handleAIQuery($question) {
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
