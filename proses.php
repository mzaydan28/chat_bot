<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Pastikan koneksi ke Supabase sudah benar di file ini
include __DIR__ . "/koneksi.php";

if (!isset($_POST['pesan'])) {
    die("Error: Pesan tidak diterima");
}

$pesan = strtolower($_POST['pesan']);

// 1. Ambil semua data chatbot dari Supabase melalui API
// Path: chatbot?select=*
$data_chatbot = supabase_request('GET', 'chatbot?select=*');

if (!$data_chatbot) {
    die("Error: Gagal mengambil data dari Supabase atau tabel kosong.");
}

$ketemu = false;

// 2. Lakukan perulangan yang sama dengan logika lama kamu
foreach ($data_chatbot as $data) {
    // Mengecek apakah keyword ada di dalam pesan user
    if (strpos($pesan, strtolower($data['keyword'])) !== false) {
        echo $data['jawaban'];
        $ketemu = true;
        break;
    }
}

if (!$ketemu) {
    echo "Maaf, saya belum mengerti pertanyaan itu.";
}
?>