<?php
/**
 * PPID Knowledge Base - Daftar Informasi Publik
 * Sumber: https://disperindag.jatengprov.go.id/v3/ppid/post_baca/Y2FhMzBmZWQyYTE1MTRjYzEzYWVhODgzNDFjZDRmZThhZmU1NWUyMDQ0OTNiNzYxNmNkM2Y3ZWU4M2NmNDRk
 */

// URL Base untuk PPID
define('PPID_BASE_URL', 'https://disperindag.jatengprov.go.id/v3/ppid/post_baca/Y2FhMzBmZWQyYTE1MTRjYzEzYWVhODgzNDFjZDRmZThhZmU1NWUyMDQ0OTNiNzYxNmNkM2Y3ZWU4M2NmNDRk');

/**
 * Daftar Lengkap Informasi Publik yang Tersedia di Website PPID Disperindag Jateng
 */
$PPID_INFORMATION_CATEGORIES = [
    'Berkala' => [
        'Informasi Tentang Badan Publik' => [
            'Kedudukan Domisili dan Alamat Lengkap',
            'Visi Misi',
            'Tugas dan Fungsi Dinas',
            'Anggaran Tahun Berjalan - DPA / DIPA',
            'Struktur Organisasi',
            'Sumber Daya Manusia - Data Kepegawaian',
            'Profil Balai dan UPT',
            'Profil Singkat Kepala Dinas dan Pejabat Struktural',
            'LHKPN dan LHKASN',
            'Maklumat Pelayanan',
            'Rencana Kinerja Tahunan',
            'Perjanjian Kinerja',
            'Pakta Integritas',
        ],
        'Informasi Pelayanan' => [
            'Profil SKPD dan Balai',
            'Agenda Pimpinan SKPD',
            'Informasi Surat Menyurat Pimpinan',
            'Agenda Berjalan / RKO',
            'Surat Keputusan - SK',
            'Berita Acara - BA',
            'Rencana Strategis (RENSTRA) & Rencana Kerja (RENJA)',
            'Pengendalian Internal - SPIP',
            'Inovasi Layanan Informasi Publik',
            'Perizinan',
        ],
        'Ringkasan Program dan Kegiatan' => [
            'Nama Program dan Kegiatan',
            'Penanggung Jawab dan Pelaksanan Program',
            'Target dan Capaian Program Kegiatan - RKO',
            'Jadwal Pelaksanaan Program Kegiatan - RKO',
            'Nilai Anggaran Kegiatan per Program - DPA / DIPA',
        ],
        'Ringkasan Kinerja' => [
            'Laporan Kinerja Dinas Perindag Prov. Jateng - LKJIP',
            'Penilaian Kinerja Disperindag Tahun Sebelumnya',
            'Efisiensi yang Dicapai / LKJIP',
            'Laporan Evaluasi Kinerja Kegiatan Tahun Berjalan - Laporan POK',
            'Laporan umum dan ringkasan laporan keuangan / POK',
            'Informasi lain yang menggambarkan akuntabilitas program kegiatan / LKJIP',
            'Laporan Kinerja Lainnya',
            'Target dan penyerapan kegiatan / POK',
            'Kerangka Acuan Kegiatan - KAK',
            'Laporan Keterangan Pertanggungjawaban - LKPJ',
            'Ringkasan Kinerja Kegiatan',
            'Laporan Pelayanan Informasi Publik',
            'Laporan Operasional',
            'Laporan Perubahan Ekuitas',
            'Laporan Realisasi Pendapatan Asli Daerah - PAD',
            'Grafik Kinerja Keuangan',
            'DPA',
            'Rencana Kerja - RENJA',
            'Laporan Keuangan Lainnya',
            'RKA',
            'Laporan Keuangan - CALK',
            'IKI',
        ],
        'Informasi Tentang Bantuan Keuangan/Sosial' => [
            'Transparansi Bantuan Keuangan/Sosial',
        ],
        'Informasi Tentang Open Data / Satu Data' => [
            'Implementasi Open Data / Satu Data Jateng',
        ],
        'Informasi Tentang Laporan Akses Informasi Publik' => [
            'Laporan Akses Informasi Publik',
            'Kecepatan Layanan & Ringkasan Laporan Akses Informasi Publik',
            'Rekapitulasi Laporgub',
        ],
        'Informasi Tentang Hak dan Tata Cara Memperoleh Informasi Publik' => [
            'Informasi Tentang Hak dan Tata Cara Memperoleh Informasi Publik',
        ],
        'Informasi Tentang Tata Cara Pengaduan dan Penyalahangunaan Wewenang' => [
            'Informasi Layanan Aduan Masyarakat',
            'Laporan Pengaduan Masyarakat',
            'Laporan Benturan Kepentingan',
            'Formulir Pengaduan Permasalahan Usaha Dagang',
            'Formulir Pengaduan Penyalahgunaan Wewenang',
        ],
        'Informasi Tentang Peraturan Keputusan dan/atau Kebijakan Badan Publik' => [
            'Daftar Rencana Peraturan, Keputusan, Kebijakan yang akan ditetapkan',
            'Rancangan Peraturan, Keputusan atau Kebijakan yang dibentuk',
            'Peraturan Perencanaan',
            'Peraturan Komisi Informasi',
            'Peraturan Daerah Provinsi Jawa Tengah No 6 Tahun 2012 tentang Pelayanan Publik',
            'Peraturan Gubernur Jawa Tengah',
            'Peraturan tentang Keterbukaan Informasi Publik',
            'Informasi mengenai Regulasi SKPD',
        ],
        'Ringkasan Pelayanan Publik' => [
            'Daftar Register Permohonan Informasi Publik',
            'Rekapitulasi Permohonan Informasi Publik yang diterima',
            'Daftar Register Keberatan',
        ],
        'Informasi dan Data Statistik Sektor Industri dan Perdagangan' => [
            'Informasi Perdagangan Luar Negeri',
            'Informasi Perdagangan Dalam Negeri',
            'Informasi Standarisasi dan Perlindungan Konsumen',
            'Informasi tentang Industri Non Agro',
            'Informasi tentang Industri Agro',
            'Informasi Balai Industri Produk Tekstil dan Alas Kaki',
            'Informasi Balai Industri Kreatif Digital dan Kemasan',
            'Informasi Balai Pengajuan dan Sertifikasi Mutu Barang Semarang',
            'Informasi Balai Pengajuan dan Sertifikasi Mutu Barang Surakarta',
        ],
    ],
    'Serta Merta & Setiap Saat' => [
        'Informasi hak dan tata cara peroleh info publik pengajuan keberatan dan proses sengketa' => [
            'Informasi hak dan tata cara peroleh info publik pengajuan keberatan dan proses sengketa',
        ],
        'Daftar Standar dan Prosedur Operasional Pelayanan - SOP' => [
            'Daftar Standar dan Prosedur Operasional Pelayanan - SOP',
            'Standar Biaya Permintaan Informasi Disperindag Prov Jateng',
        ],
        'Informasi Prosedur Peringatan Dini dan Evakuasi Keadaan Darurat' => [
            'Informasi prosedur peringatan dini dan evakuasi keadaan darurat',
        ],
        'Informasi Tentang PPID Pelaksana Disperindag Jateng' => [
            'Profil Singkat, Struktur, Tugas PPID Pelaksana',
            'Dukungan Anggaran PPID',
            'SOP PPID Pelaksana',
            'Agenda Kegiatan PPID Pelaksana',
            'Laporan Tahunan PPID, Tanda Terima dan Laporan Register Layanan Informasi Publik',
            'SK PPID',
            'Tata Cara Permohonan Informasi. Keberatan dan sengketa Informasi',
            'Permohonan Informasi dan Pengajuan Keberatan Online',
            'Laporan PPID dan Laporan Register',
            'Aplikasi PPID Pelaksana',
            'Sarana dan Prasarana PPID Pelaksana',
            'Pelayanan Publik Disabilitas',
            'Formulir Layanan Informasi',
        ],
        'TAUTAN / LINK' => [
            'Formulir Fasilitas Produk Kemasan',
            'Info Harga Kebutuhan Pokok Masyarakat - Kepokmas',
            'Link Terkait',
        ],
        'Informasi Pengadaan Barang dan Jasa' => [
            'Informasi Pengadaan Barang dan Jasa - RUP',
            'Informasi Pengadaan Barang dan Jasa Tahun Berjalan Melalui Tender / Lelang',
            'Informasi Pengadaan Barang dan Jasa Tahun Berjalan Melalui Swakelola dan Penunjukan Langsung',
            'Dokumen pengadaan barang/jasa tahun 2021',
            'Dokumen pengadaan barang/jasa tahun 2022',
            'Dokumen pengadaan barang/jasa tahun 2023',
            'Dokumen pengadaan barang/jasa tahun 2024',
            'Tahap Barang Jasa',
        ],
    ],
];

/**
 * Generate PPID Knowledge Context untuk AI
 */
function getPPIDKnowledge() {
    global $PPID_INFORMATION_CATEGORIES;
    
    $knowledge = "\n\n=== DAFTAR INFORMASI PUBLIK DISPERINDAG JATENG (PPID) ===\n\n";
    $knowledge .= "Semua informasi lengkap tersedia di website PPID Disperindag Jateng.\n";
    $knowledge .= "URL: " . PPID_BASE_URL . "\n\n";
    
    foreach ($PPID_INFORMATION_CATEGORIES as $type => $categories) {
        $knowledge .= "📂 KATEGORI: {$type}\n";
        $knowledge .= str_repeat("-", 60) . "\n";
        
        foreach ($categories as $categoryName => $items) {
            $knowledge .= "\n🗂️  {$categoryName}:\n";
            foreach ($items as $item) {
                $knowledge .= "   • {$item}\n";
            }
        }
        $knowledge .= "\n";
    }
    
    $knowledge .= "\n💡 CARA MENJAWAB:\n";
    $knowledge .= "- Jika user tanya tentang informasi di atas, jelaskan APA itu secara singkat\n";
    $knowledge .= "- Lalu arahkan: 'Untuk informasi lengkap dan dokumen resmi, silakan akses website PPID kami di: " . PPID_BASE_URL . "'\n";
    $knowledge .= "- Jika berupa dokumen/PDF/file, katakan: 'Dokumen [nama] tersedia dalam format PDF dan bisa diunduh melalui website PPID kami'\n\n";
    
    return $knowledge;
}

/**
 * Search informasi dalam kategori PPID
 */
function searchPPIDInfo($query) {
    global $PPID_INFORMATION_CATEGORIES;
    
    $query_lower = strtolower($query);
    $results = [];
    
    foreach ($PPID_INFORMATION_CATEGORIES as $type => $categories) {
        foreach ($categories as $categoryName => $items) {
            // Check category name
            if (strpos(strtolower($categoryName), $query_lower) !== false) {
                $results[] = [
                    'type' => $type,
                    'category' => $categoryName,
                    'items' => $items,
                    'match_type' => 'category'
                ];
            }
            
            // Check items
            foreach ($items as $item) {
                if (strpos(strtolower($item), $query_lower) !== false) {
                    $results[] = [
                        'type' => $type,
                        'category' => $categoryName,
                        'item' => $item,
                        'match_type' => 'item'
                    ];
                }
            }
        }
    }
    
    return $results;
}

/**
 * Generate informative response dengan link PPID
 */
function generatePPIDResponse($topic) {
    $results = searchPPIDInfo($topic);
    
    if (empty($results)) {
        return null; // Tidak ditemukan di PPID
    }
    
    $response = "📋 Informasi tentang **{$topic}** tersedia di website PPID Disperindag Jateng!\n\n";
    
    // Tampilkan hasil pencarian
    foreach (array_slice($results, 0, 3) as $result) {
        if ($result['match_type'] === 'category') {
            $response .= "🗂️ Kategori: {$result['category']}\n";
            $response .= "   Mencakup:\n";
            foreach (array_slice($result['items'], 0, 5) as $item) {
                $response .= "   • {$item}\n";
            }
        } else {
            $response .= "📄 {$result['item']}\n";
            $response .= "   (Kategori: {$result['category']})\n";
        }
        $response .= "\n";
    }
    
    $response .= "✅ Untuk mengakses dokumen lengkap, formulir, atau informasi detail lainnya, silakan kunjungi:\n";
    $response .= "🔗 " . PPID_BASE_URL . "\n\n";
    $response .= "Atau hubungi kami di:\n";
    $response .= "📞 (024) 3549477\n";
    $response .= "📧 dinperindag@jatengprov.go.id";
    
    return $response;
}
?>
