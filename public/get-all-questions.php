<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/koneksi.php';

try {
    // Ambil keyword unik dari Supabase
    $data = supabase_request(
        'GET',
        'chatbot?select=keyword&order=keyword.asc'
    );

    if (isset($data['error'])) {
        throw new Exception('Supabase error');
    }

    // Map keyword ke pertanyaan
    $questions_map = [
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
        'pengaduan' => 'Bagaimana cara menyampaikan pengaduan?',
        'bantuan umkm' => 'Apakah ada bantuan untuk UMKM?',
        'pelatihan umkm' => 'Apakah tersedia pelatihan UMKM?',
    ];

    $excluded = [
        'halo','hai','pagi','siang','sore','malam',
        'dadah','bye','ok','oke','terima kasih'
    ];

    $questions = [];

    foreach ($data as $row) {
        $keyword = strtolower(trim($row['keyword']));

        if (in_array($keyword, $excluded)) continue;
        if (!isset($questions_map[$keyword])) continue;

        $questions[] = $questions_map[$keyword];
    }

    $questions = array_values(array_unique($questions));
    sort($questions);

    echo json_encode($questions, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
