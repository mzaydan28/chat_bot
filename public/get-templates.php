<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
header('Content-Type: application/json');
include __DIR__ . "/../config/koneksi.php";

try {
    // ===== EDIT DAFTAR PERTANYAAN TEMPLATE DI SINI =====
    // Ubah keywords di array ini untuk mengontrol pertanyaan yang muncul
    $template_keywords = array(
        'halo',
        'jam',
        'alamat',
        'umkm',
        'perizinan'
    );
    // ===== AKHIR EDIT =====
    
    // Convert array to SQL IN clause
    $keywords_sql = "'" . implode("','", array_map(function($k) use ($koneksi) {
        return mysqli_real_escape_string($koneksi, $k);
    }, $template_keywords)) . "'";
    
    // Get questions based on selected keywords
    $query = mysqli_query($koneksi, "
        SELECT keyword FROM chatbot 
        WHERE keyword IN ($keywords_sql)
        ORDER BY RAND() 
        LIMIT 5
    ");

    if (!$query) {
        throw new Exception("Database error: " . mysqli_error($koneksi));
    }

    $templates = array();
    
    // Map keywords to questions
    $questions = array(
        'halo' => 'Halo! Apa kabar?',
        'jam' => 'Jam berapa kantor Disperindag buka?',
        'jam operasional' => 'Jam operasional Disperindag?',
        'alamat' => 'Dimana lokasi kantor Disperindag?',
        'lokasi' => 'Lokasi kantor Disperindag?',
        'umkm' => 'Apa itu UMKM?',
        'perizinan' => 'Bagaimana cara mengurus perizinan?',
        'izin usaha' => 'Bagaimana cara mengurus izin usaha?',
        'program' => 'Apa saja program Disperindag?',
        'layanan' => 'Apa saja layanan Disperindag?',
        'kontak' => 'Bagaimana cara menghubungi Disperindag?',
        'informasi' => 'Informasi apa yang bisa dibantu?',
        'bantuan' => 'Bantuan apa yang dibutuhkan?',
        'produk' => 'Apa saja produk unggulan?',
        'ekspor' => 'Informasi tentang ekspor?',
        'izin' => 'Bagaimana cara mengurus izin?',
        'nama kamu siapa' => 'Siapa nama kamu?',
        'kamu bisa apa' => 'Apa yang bisa kamu lakukan?',
        'dadah' => 'Dadah, sampai jumpa!',
        'terima kasih' => 'Sama-sama, senang membantu!',
    );
    
    while ($row = mysqli_fetch_assoc($query)) {
        $keyword = trim($row['keyword']);
        $question = isset($questions[$keyword]) ? $questions[$keyword] : ucfirst($keyword) . '?';
        
        $templates[] = array(
            'question' => $question,
            'keyword' => $keyword
        );
    }
    
    echo json_encode($templates);

} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}
?>
