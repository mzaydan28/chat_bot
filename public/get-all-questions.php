<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/koneksi.php';

try {
    // Ambil SEMUA data dari Supabase dengan keyword + jawaban
    $data = supabase_request(
        'GET',
        'chatbot?select=keyword,jawaban&order=id.asc'
    );

    if (isset($data['error'])) {
        throw new Exception('Supabase error');
    }

    // Excluded greeting keywords
    $excluded = [
        'halo','hai','pagi','siang','sore','malam','malem',
        'dadah','bye','ok','oke','terima kasih','makasih',
        'apa kabar','lagi apa','kamu siapa','nama kamu siapa'
    ];

    // Function untuk transform keyword menjadi pertanyaan natural
    function keywordToQuestion($keyword) {
        // Normalize
        $keyword_lower = strtolower(trim($keyword, ',. '));
        
        // Map ke pertanyaan - check full keyword dulu
        $mapping = [
            // Full keyword match (exact)
            'jam' => 'Jam berapa kantor Disperindag buka?',
            'jam buka tutup' => 'Jam berapa kantor Disperindag buka?',
            'jam operasional' => 'Jam berapa jam operasional Disperindag?',
            'buka tutup' => 'Jam berapa kantor Disperindag buka?',
            'alamat' => 'Dimana lokasi kantor Disperindag?',
            'lokasi' => 'Dimana lokasi kantor Disperindag?',
            'umkm' => 'Apa itu UMKM?',
            'perizinan' => 'Bagaimana cara mengurus perizinan?',
            'izin perizinan' => 'Bagaimana cara mengurus perizinan?',
            'izin usaha' => 'Bagaimana cara mengurus izin usaha?',
            'izin' => 'Bagaimana cara mengurus izin usaha?',
            'program' => 'Apa saja program yang Disperindag tawarkan?',
            'layanan' => 'Apa saja layanan Disperindag?',
            'pelayanan' => 'Apa saja layanan Disperindag?',
            'disperindag melayani apa' => 'Apa saja yang Disperindag layani?',
            'bisa ngapain' => 'Apa yang bisa saya lakukan di Disperindag?',
            'kamu bisa apa' => 'Apa yang bisa kamu bantu?',
            'kontak' => 'Bagaimana cara menghubungi Disperindag?',
            'hubungi' => 'Bagaimana cara menghubungi Disperindag?',
            'pengaduan' => 'Bagaimana cara menyampaikan pengaduan?',
        ];

        if (isset($mapping[$keyword_lower])) {
            return $mapping[$keyword_lower];
        }

        // Jika tidak ada mapping, generate otomatis
        return ucfirst($keyword_lower) . '?';
    }

    // Proses data
    $questions = [];
    if (is_array($data)) {
        foreach ($data as $row) {
            $keyword = $row['keyword'] ?? '';
            if (!in_array(strtolower($keyword), $excluded)) {
                $questions[] = [
                    'keyword' => $keyword,
                    'question' => keywordToQuestion($keyword)
                ];
            }
        }
    }

    // Return hasil
    echo json_encode($questions, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>

