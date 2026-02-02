<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = mysqli_connect("localhost", "root", "", "chatbot_db");

if (!$koneksi) {
    die("❌ KONEKSI DATABASE GAGAL: " . mysqli_connect_error() . "\n\n" . 
        "Pastikan:\n" .
        "1. MySQL/XAMPP sudah running\n" .
        "2. Database 'chatbot_db' sudah dibuat\n" .
        "3. Username: root | Password: kosong");
}

// Set charset to utf8mb4 untuk support emoji dan karakter spesial
mysqli_set_charset($koneksi, "utf8mb4");
?>
