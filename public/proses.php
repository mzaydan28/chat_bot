<?php
// public/proses.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Pastikan path ke config benar
include __DIR__ . "/../config/koneksi.php";
include __DIR__ . "/ai-handler.php";

if (!isset($_POST['pesan'])) {
    die("Error: Pesan tidak diterima");
}

$pesan = $_POST['pesan'];
$pesan_lower = strtolower($pesan);
$user_ip = $_SERVER['REMOTE_ADDR'];
// Session ID logic tetap sama
$session_id = session_id() ?: md5(uniqid() . $user_ip);

// --- 1. AMBIL DATA KEYWORD DARI SUPABASE ---
// Menggantikan: SELECT * FROM chatbot
$keywords_data = supabase_request('GET', 'chatbot?select=*');

// Cek jika ada error koneksi
if (isset($keywords_data['error'])) {
    // Fallback error message (bisa disesuaikan)
    die("Error Database: " . print_r($keywords_data['error'], true));
}

$ketemu = false;
$matched_keyword = '';
$jawaban = '';
$answer_source = 'none'; // 'database' or 'ai'

// --- 2. LOGIKA PENCARIAN DATABASE (PHP SIDE) ---
// Loop data dari Supabase (Array) menggantikan while mysqli_fetch_assoc
if (!empty($keywords_data) && is_array($keywords_data)) {
    foreach ($keywords_data as $data) {
        // Cek apakah keyword ada di dalam pesan user
        if (strpos($pesan_lower, strtolower($data['keyword'])) !== false) {
            $jawaban = $data['jawaban'];
            echo $jawaban; // Kirim jawaban ke chat.php (AJAX)
            $ketemu = true;
            $matched_keyword = $data['keyword'];
            $answer_source = 'database';
            break; // Berhenti jika ketemu
        }
    }
}

// --- 3. JIKA TIDAK KETEMU DI DATABASE, TANYA AI ---
if (!$ketemu) {
    // Gunakan AI untuk menjawab
    $jawaban = handleAIQuery($pesan);
    echo $jawaban;
    $answer_source = 'ai';
    $ketemu = true; // Mark as answered by AI
    
    // Siapkan data untuk INSERT ke tabel unanswered_questions
    $data_unanswered = [
        'pertanyaan' => $pesan,
        'user_ip'    => $user_ip,
        'status'     => 'pending'
    ];

    // Eksekusi POST request (Insert)
    supabase_request('POST', 'unanswered_questions', $data_unanswered);
}

// --- 4. SIMPAN RIWAYAT CHAT (INSERT KE SUPABASE) ---
$is_answered = $ketemu ? 1 : 0;

$data_history = [
    'session_id'      => $session_id,
    'user_question'   => $pesan,
    'bot_answer'      => $jawaban,
    'matched_keyword' => $matched_keyword ?: null,
    'is_answered'     => $is_answered,
    'user_ip'         => $user_ip,
    'answer_source'   => $answer_source // Track if from database or AI
];

// Eksekusi POST request ke tabel chat_history
supabase_request('POST', 'chat_history', $data_history);
?>