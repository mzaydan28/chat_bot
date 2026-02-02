<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . "/../config/koneksi.php";

if (!isset($_POST['pesan'])) {
    die("Error: Pesan tidak diterima");
}

$pesan = $_POST['pesan'];
$pesan_lower = strtolower($pesan);
$user_ip = $_SERVER['REMOTE_ADDR'];
$session_id = session_id() ?: md5(uniqid() . $user_ip);

$query = mysqli_query($koneksi, "SELECT * FROM chatbot");
if (!$query) {
    die("Error Query: " . mysqli_error($koneksi));
}
$ketemu = false;
$matched_keyword = '';
$jawaban = '';

while ($data = mysqli_fetch_assoc($query)) {
    if (strpos($pesan_lower, strtolower($data['keyword'])) !== false) {
        $jawaban = $data['jawaban'];
        echo $jawaban;
        $ketemu = true;
        $matched_keyword = $data['keyword'];
        break;
    }
}

if (!$ketemu) {
    echo "Maaf, saya belum mengerti pertanyaan itu.";
    
    // Simpan pertanyaan yang tidak terjawab ke database
    $insert_query = "INSERT INTO unanswered_questions (pertanyaan, user_ip, status) VALUES (?, ?, 'pending')";
    if ($stmt = mysqli_prepare($koneksi, $insert_query)) {
        mysqli_stmt_bind_param($stmt, "ss", $pesan, $user_ip);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Simpan riwayat chat ke database
$insert_history = "INSERT INTO chat_history (session_id, user_question, bot_answer, matched_keyword, is_answered, user_ip) VALUES (?, ?, ?, ?, ?, ?)";
if ($stmt = mysqli_prepare($koneksi, $insert_history)) {
    $is_answered = $ketemu ? 1 : 0;
    mysqli_stmt_bind_param($stmt, "ssssii", $session_id, $pesan, $jawaban, $matched_keyword, $is_answered, $user_ip);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>


