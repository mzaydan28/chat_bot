<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/koneksi.php';

// Template pertanyaan berdasarkan struktur asli PPID Disperindag Jateng
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
    'categories' => []
];

foreach ($questionTemplates as $category => $questions) {
    $output['categories'][] = [
        'name' => $category,
        'questions' => $questions,
        'count' => count($questions)
    ];
}

echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
