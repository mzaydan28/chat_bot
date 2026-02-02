<?php
header('Content-Type: application/json');
require_once '../config/koneksi.php';

try {
    // Get all unique keywords from database
    $query = "SELECT DISTINCT keyword FROM chatbot ORDER BY keyword ASC";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        throw new Exception("Database error: " . mysqli_error($koneksi));
    }

    // Map keywords to questions
    $questions_map = array(
        'jam' => 'Jam berapa kantor Disperindag buka?',
        'jam operasional' => 'Jam berapa jam operasional Disperindag?',
        'alamat' => 'Dimana lokasi kantor Disperindag?',
        'lokasi' => 'Dimana lokasi kantor Disperindag?',
        'umkm' => 'Apa itu UMKM?',
        'perizinan' => 'Bagaimana cara mengurus perizinan?',
        'izin usaha' => 'Bagaimana cara mengurus izin usaha?',
        'program' => 'Apa saja program Disperindag?',
        'layanan' => 'Apa saja layanan Disperindag?',
        'kontak' => 'Bagaimana cara menghubungi Disperindag?',
        'informasi' => 'Informasi apa yang bisa dibantu?',
        'bantuan' => 'Bantuan apa yang dibutuhkan?',
        'produk' => 'Apa saja produk unggulan Disperindag?',
        'ekspor' => 'Bagaimana cara melakukan ekspor?',
        'izin' => 'Bagaimana cara mengurus izin usaha?',
        'daftar umkm' => 'Bagaimana cara mendaftarkan UMKM?',
        'bantuan umkm' => 'Apakah ada bantuan untuk UMKM?',
        'pelatihan' => 'Apakah Disperindag menyediakan pelatihan UMKM?',
        'pendampingan' => 'Apakah tersedia pendampingan usaha?',
        'pengaduan' => 'Bagaimana cara menyampaikan pengaduan?',
        'lapor' => 'Bagaimana cara melaporkan permasalahan?',
        'pengaduan online' => 'Apakah pengaduan bisa dilakukan secara online?',
        'status pengaduan' => 'Bagaimana cara mengecek status pengaduan?',
        'website' => 'Dimana website resmi Disperindag?',
        'email' => 'Apa alamat email resmi Disperindag?',
        'form online' => 'Apakah tersedia formulir online?',
        'syarat izin' => 'Apa saja syarat untuk mengurus izin usaha?',
        'daftar izin' => 'Bagaimana cara mendaftarkan izin usaha?',
        'oss' => 'Apa itu sistem OSS untuk perizinan?',
        'izin ditolak' => 'Apa yang harus dilakukan jika izin ditolak?',
        'pendaftaran umkm' => 'Bagaimana cara mendaftar sebagai UMKM?',
        'pelatihan umkm' => 'Dimana saya bisa mendapatkan informasi pelatihan UMKM?',
    );

    // Keywords to exclude (greeting casual, dll)
    $excluded_keywords = array(
        'halo', 'hai', 'pagi', 'siang', 'sore', 'malam',
        'dadah', 'bye', 'dada', 'dadah',
        'terima kasih', 'thanks', 'makasih',
        'nama kamu siapa', 'kamu siapa', 'siapa nama kamu', 'kamu bisa apa',
        'apa', 'apasaja', 'ok', 'oke', 'baik'
    );

    $all_questions = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $keyword = trim($row['keyword']);
        
        // Skip excluded keywords
        if (in_array(strtolower($keyword), $excluded_keywords)) {
            continue;
        }
        
        // Check if keyword has a mapped question
        if (isset($questions_map[$keyword])) {
            $question = $questions_map[$keyword];
        } else {
            // Skip keywords that are not mapped (to avoid showing casual words)
            continue;
        }
        
        // Add to list if not already added
        if (!in_array($question, $all_questions)) {
            $all_questions[] = $question;
        }
    }

    // Sort alphabetically
    sort($all_questions);

    echo json_encode($all_questions);
    
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

mysqli_close($koneksi);
?>
