<?php
// Suppress all errors and warnings
error_reporting(0);
ini_set('display_errors', 0);

// Clean output buffer
if (ob_get_level()) ob_end_clean();
ob_start();

// Set JSON header
header('Content-Type: application/json; charset=utf-8');

// Include Supabase connection
require_once __DIR__ . '/../config/koneksi.php';

// Try to get data from Supabase first
$supabaseData = supabase_request('GET', 'chatbot?select=category,question');
$useSupabase = !isset($supabaseData['error']) && !empty($supabaseData);

if ($useSupabase) {
    // Format data from Supabase
    $categoriesMap = [];
    
    foreach ($supabaseData as $row) {
        $category = $row['category'] ?? 'Umum';
        $question = $row['question'] ?? '';
        
        if (!empty($question)) {
            if (!isset($categoriesMap[$category])) {
                $categoriesMap[$category] = [];
            }
            $categoriesMap[$category][] = $question;
        }
    }
    
    // Format output
    $output = [
        'status' => 'success',
        'source' => 'supabase',
        'categories' => []
    ];
    
    foreach ($categoriesMap as $category => $questions) {
        $output['categories'][] = [
            'name' => $category,
            'questions' => $questions,
            'count' => count($questions)
        ];
    }
    
    // Clean output and send
    ob_clean();
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// Fallback: Hardcoded data pertanyaan template
$questionTemplates = [
    'Informasi Tentang Badan Publik' => [
        'Di mana alamat lengkap kantor Dinas Perindustrian dan Perdagangan Jawa Tengah?',
        'Apa visi dan misi Dinas Perindustrian dan Perdagangan Jawa Tengah?',
        'Bagaimana struktur organisasi Dinas Perindustrian dan Perdagangan?',
        'Siapa Kepala Dinas dan pejabat struktural saat ini?',
        'Apa tugas dan fungsi Dinas Perindustrian dan Perdagangan?',
        'Berapa anggaran Dinas tahun berjalan (DPA/DIPA)?',
        'Bagaimana profil balai dan UPT yang ada?',
        'Apa maklumat pelayanan Dinas?'
    ],
    'Informasi Pelayanan' => [
        'Apa saja layanan perizinan yang tersedia?',
        'Bagaimana profil SKPD dan Balai?',
        'Apa agenda pimpinan SKPD saat ini?',
        'Bagaimana agenda berjalan/RKO Dinas?',
        'Apa saja Surat Keputusan (SK) terbaru?',
        'Bagaimana rencana strategis (RENSTRA) dan rencana kerja (RENJA)?',
        'Apa inovasi layanan informasi publik yang ada?'
    ],
    'Ringkasan Program dan Kegiatan' => [
        'Apa saja nama program dan kegiatan Dinas?',
        'Siapa penanggung jawab program dan kegiatan?',
        'Bagaimana target dan capaian program kegiatan (RKO)?',
        'Kapan jadwal pelaksanaan program kegiatan?',
        'Berapa nilai anggaran per program (DPA/DIPA)?'
    ],
    'Ringkasan Kinerja' => [
        'Bagaimana laporan kinerja Dinas Perindag (LKJIP)?',
        'Apa hasil penilaian kinerja Disperindag tahun sebelumnya?',
        'Bagaimana efisiensi yang dicapai?',
        'Bagaimana laporan evaluasi kinerja kegiatan tahun berjalan?',
        'Bagaimana target dan penyerapan kegiatan (POK)?',
        'Apa laporan keuangan dan realisasi PAD?',
        'Bagaimana grafik kinerja keuangan Dinas?'
    ],
    'Bantuan Keuangan dan Sosial' => [
        'Apa saja bantuan keuangan/sosial yang tersedia?',
        'Bagaimana transparansi bantuan keuangan/sosial?',
        'Siapa yang berhak mendapat bantuan keuangan?',
        'Bagaimana cara mengajukan bantuan keuangan/sosial?'
    ],
    'Akses Informasi Publik' => [
        'Bagaimana cara mengajukan permohonan informasi publik?',
        'Apa hak dan tata cara memperoleh informasi publik?',
        'Bagaimana prosedur pengaduan dan penyalahgunaan wewenang?',
        'Berapa kecepatan layanan informasi publik?',
        'Bagaimana cara mengajukan keberatan informasi publik?',
        'Apa saja formulir layanan informasi yang tersedia?'
    ],
    'Peraturan dan Kebijakan' => [
        'Apa saja rencana peraturan yang akan ditetapkan?',
        'Bagaimana rancangan peraturan atau kebijakan yang dibentuk?',
        'Apa saja Peraturan Gubernur Jawa Tengah terkait?',
        'Bagaimana peraturan tentang keterbukaan informasi publik?',
        'Apa regulasi SKPD terbaru?'
    ],
    'Data Statistik Industri dan Perdagangan' => [
        'Bagaimana informasi perdagangan luar negeri?',
        'Apa data perdagangan dalam negeri terkini?',
        'Bagaimana informasi standarisasi dan perlindungan konsumen?',
        'Apa informasi tentang industri non-agro?',
        'Bagaimana data industri agro?',
        'Apa layanan Balai Industri Produk Tekstil dan Alas Kaki?',
        'Bagaimana Balai Industri Kreatif Digital dan Kemasan?',
        'Apa informasi Balai Sertifikasi Mutu Barang?'
    ],
    'SOP dan Standar Layanan' => [
        'Apa saja Standar dan Prosedur Operasional Pelayanan (SOP)?',
        'Berapa standar biaya permintaan informasi?',
        'Bagaimana prosedur peringatan dini keadaan darurat?',
        'Apa SOP layanan publik untuk disabilitas?'
    ],
    'PPID Pelaksana' => [
        'Apa profil dan struktur PPID Pelaksana?',
        'Bagaimana dukungan anggaran PPID?',
        'Apa agenda kegiatan PPID Pelaksana?',
        'Bagaimana laporan tahunan PPID?',
        'Apa aplikasi dan sarana prasarana PPID?',
        'Bagaimana tata cara permohonan informasi online?'
    ],
    'Pengadaan Barang dan Jasa' => [
        'Bagaimana informasi pengadaan barang dan jasa (RUP)?',
        'Apa pengadaan barang dan jasa melalui tender/lelang?',
        'Bagaimana pengadaan melalui swakelola dan penunjukan langsung?',
        'Apa dokumen pengadaan barang/jasa tahun berjalan?',
        'Bagaimana tahapan pengadaan barang dan jasa?'
    ],
    'Link dan Layanan Digital' => [
        'Bagaimana formulir fasilitas produk kemasan?',
        'Apa info harga kebutuhan pokok masyarakat (Kepokmas)?',
        'Bagaimana implementasi Open Data/Satu Data Jateng?',
        'Apa link terkait layanan digital lainnya?'
    ]
];

// Format output dengan struktur kategori
$output = [
    'status' => 'success',
    'source' => 'fallback',
    'categories' => []
];

foreach ($questionTemplates as $category => $questions) {
    $output['categories'][] = [
        'name' => $category,
        'questions' => $questions,
        'count' => count($questions)
    ];
}

// Clean any remaining output
ob_clean();

// Output clean JSON
echo json_encode($output, JSON_UNESCAPED_UNICODE);
exit;
?>

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

