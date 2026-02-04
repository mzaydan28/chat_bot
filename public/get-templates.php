<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/koneksi.php';

// Pertanyaan yang ingin ditampilkan (hardcoded untuk menghindari error query)
$questions = [
    'jam' => 'Jam berapa kantor Disperindag buka?',
    'alamat' => 'Dimana lokasi kantor Disperindag?',
    'umkm' => 'Apa itu UMKM?',
    'perizinan' => 'Bagaimana cara mengurus perizinan?',
    'izin' => 'Bagaimana cara mengurus izin usaha?',
    'program' => 'Apa saja program Disperindag?',
    'layanan' => 'Apa saja layanan Disperindag?',
    'kontak' => 'Bagaimana cara menghubungi Disperindag?',
    'pengaduan' => 'Bagaimana cara menyampaikan pengaduan?',
    'lapor' => 'Bagaimana cara melaporkan masalah?'
];

// Gunakan semua pertanyaan, shuffle, dan ambil yang diinginkan
$templates = [];
foreach ($questions as $keyword => $question) {
    $templates[] = [
        'keyword' => $keyword,
        'question' => $question
    ];
}

// Random order
shuffle($templates);
// Ambil max 10 pertanyaan
$templates = array_slice($templates, 0, 10);

echo json_encode($templates, JSON_UNESCAPED_UNICODE);
?>
