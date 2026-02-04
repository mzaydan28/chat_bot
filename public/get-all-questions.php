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

        // Map ke pertanyaan natural (lebih banyak pola)
        $mapping = [
            'jam' => 'Jam berapa kantor Disperindag buka?',
            'jam buka tutup' => 'Jam berapa kantor Disperindag buka?',
            'jam operasional' => 'Jam berapa jam operasional Disperindag?',
            'buka tutup' => 'Jam berapa kantor Disperindag buka?',
            'alamat' => 'Di mana lokasi kantor Disperindag?',
            'lokasi' => 'Di mana lokasi kantor Disperindag?',
            'umkm' => 'Apa itu UMKM?',
            'perizinan' => 'Bagaimana cara mengurus perizinan di Disperindag?',
            'izin perizinan' => 'Bagaimana cara mengurus perizinan di Disperindag?',
            'izin usaha' => 'Bagaimana cara mengurus izin usaha?',
            'izin' => 'Bagaimana cara mengurus izin usaha?',
            'program' => 'Apa saja program yang ditawarkan Disperindag?',
            'layanan' => 'Apa saja layanan yang tersedia di Disperindag?',
            'pelayanan' => 'Apa saja layanan yang tersedia di Disperindag?',
            'disperindag melayani apa' => 'Apa saja yang dilayani oleh Disperindag?',
            'bisa ngapain' => 'Apa yang bisa saya lakukan di Disperindag?',
            'kamu bisa apa' => 'Apa yang bisa kamu bantu?',
            'kontak' => 'Bagaimana cara menghubungi Disperindag?',
            'hubungi' => 'Bagaimana cara menghubungi Disperindag?',
            'pengaduan' => 'Bagaimana cara menyampaikan pengaduan?',
        ];

        if (isset($mapping[$keyword_lower])) {
            return $mapping[$keyword_lower];
        }

        // Pola otomatis natural
        if (preg_match('/^harga( |$)/', $keyword_lower)) {
            return 'Berapa ' . $keyword_lower . '?';
        }
        if (preg_match('/^alamat( |$)/', $keyword_lower)) {
            return 'Di mana ' . $keyword_lower . '?';
        }
        if (preg_match('/^(siapa|apa|bagaimana|kapan|dimana|di mana|mengapa|kenapa)/', $keyword_lower)) {
            return ucfirst($keyword_lower) . '?';
        }
        if (strpos($keyword_lower, 'jadwal') !== false) {
            return 'Bagaimana jadwal ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'syarat') !== false) {
            return 'Apa saja syarat ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'prosedur') !== false) {
            return 'Bagaimana prosedur ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'kontak') !== false) {
            return 'Bagaimana cara menghubungi ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'email') !== false) {
            return 'Berapa alamat email ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'telepon') !== false || strpos($keyword_lower, 'nomor') !== false) {
            return 'Berapa nomor telepon ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'website') !== false) {
            return 'Apa alamat website ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'sertifikasi') !== false) {
            return 'Bagaimana cara mendapatkan sertifikasi ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'laporan') !== false) {
            return 'Bagaimana cara melihat laporan ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'pengaduan') !== false) {
            return 'Bagaimana cara menyampaikan pengaduan ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'pelatihan') !== false) {
            return 'Bagaimana cara mengikuti pelatihan ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'pendaftaran') !== false) {
            return 'Bagaimana cara pendaftaran ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'program') !== false) {
            return 'Apa saja program ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'struktur') !== false) {
            return 'Bagaimana struktur ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'visi') !== false) {
            return 'Apa visi ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'misi') !== false) {
            return 'Apa misi ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'tugas') !== false) {
            return 'Apa tugas ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'fungsi') !== false) {
            return 'Apa fungsi ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'profil') !== false) {
            return 'Apa profil ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'sejarah') !== false) {
            return 'Bagaimana sejarah ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'dasar hukum') !== false) {
            return 'Apa dasar hukum ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'peraturan') !== false) {
            return 'Apa peraturan ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'biaya') !== false) {
            return 'Berapa biaya ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'waktu') !== false) {
            return 'Berapa lama waktu ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'hari') !== false) {
            return 'Hari apa saja ' . $keyword_lower . '?';
        }
        if (strpos($keyword_lower, 'jadwal') !== false) {
            return 'Bagaimana jadwal ' . $keyword_lower . '?';
        }
        // Fallback
        return 'Apa yang dimaksud dengan ' . $keyword_lower . '?';
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

