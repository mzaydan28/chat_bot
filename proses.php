<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . "/koneksi.php";

if (!isset($_POST['pesan'])) {
    die("Error: Pesan tidak diterima");
}

$pesan = strtolower($_POST['pesan']);

$query = mysqli_query($koneksi, "SELECT * FROM chatbot");
if (!$query) {
    die("Error Query: " . mysqli_error($koneksi));
}
$ketemu = false;

while ($data = mysqli_fetch_assoc($query)) {
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
