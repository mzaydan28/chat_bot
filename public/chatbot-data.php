<?php
/**
 * Data untuk tabel chatbot - Format PHP Array
 * Berisi semua jawaban untuk pertanyaan di "Lihat Semua Pertanyaan"
 * 
 * Cara penggunaan:
 * 1. Include file ini ke proses.php
 * 2. Atau gunakan untuk insert manual ke database
 * 3. Atau untuk fallback data jika Supabase error
 */

$chatbot_database = [
    // === INFORMASI TENTANG BADAN PUBLIK ===
    ['category' => 'Informasi Badan Publik', 'keyword' => 'alamat,kantor,lokasi,dimana,jalan', 'question' => 'Di mana alamat lengkap kantor Dinas Perindustrian dan Perdagangan Jawa Tengah?', 'answer' => 'Alamat lengkap kantor Dinas Perindustrian dan Perdagangan Jawa Tengah: Jl. Pahlawan No.4, Pleburan, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50241. Telepon: (024) 3549477. Jam operasional: Senin-Kamis 08.00-16.00 WIB, Jumat 08.00-16.30 WIB.'],
    
    ['category' => 'Informasi Badan Publik', 'keyword' => 'visi,misi,disperindag,jateng,tujuan', 'question' => 'Apa visi dan misi Dinas Perindustrian dan Perdagangan Jawa Tengah?', 'answer' => 'Visi Disperindag Jateng: "Terwujudnya perindustrian dan perdagangan yang berdaya saing untuk kesejahteraan masyarakat Jawa Tengah". Misi: Mengembangkan industri yang inovatif dan berkelanjutan, serta memperkuat perdagangan yang adil dan berkeadilan.'],
    
    ['category' => 'Informasi Badan Publik', 'keyword' => 'struktur,organisasi,kepemimpinan,bagan', 'question' => 'Bagaimana struktur organisasi Dinas Perindustrian dan Perdagangan?', 'answer' => 'Struktur organisasi Disperindag Jateng dipimpin oleh Kepala Dinas dengan Sekretariat dan 4 Bidang utama: Bidang Industri Agro, Bidang Industri Non-Agro, Bidang Perdagangan Dalam Negeri, dan Bidang Perdagangan Luar Negeri. Info lengkap di website resmi.'],
    
    ['category' => 'Informasi Badan Publik', 'keyword' => 'kepala,dinas,pejabat,struktural,pimpinan', 'question' => 'Siapa Kepala Dinas dan pejabat struktural saat ini?', 'answer' => 'Untuk informasi Kepala Dinas dan pejabat struktural terkini, silakan hubungi kantor Disperindag Jateng di (024) 3549477 atau kunjungi website resmi: https://disperindag.jatengprov.go.id'],
    
    ['category' => 'Informasi Badan Publik', 'keyword' => 'tugas,fungsi,disperindag,kewenangan', 'question' => 'Apa tugas dan fungsi Dinas Perindustrian dan Perdagangan?', 'answer' => 'Tugas pokok Disperindag Jateng: melaksanakan urusan pemerintahan di bidang perindustrian dan perdagangan. Fungsi: perumusan kebijakan, pelaksanaan kebijakan, evaluasi, dan pelaporan serta pembinaan teknis administratif.'],
    
    ['category' => 'Informasi Badan Publik', 'keyword' => 'anggaran,dpa,dipa,budget,keuangan', 'question' => 'Berapa anggaran Dinas tahun berjalan (DPA/DIPA)?', 'answer' => 'Untuk informasi anggaran Dinas (DPA/DIPA) tahun berjalan, silakan ajukan permohonan informasi publik ke PPID Disperindag Jateng atau hubungi (024) 3549477. Data anggaran tersedia sesuai ketentuan transparansi publik.'],
    
    ['category' => 'Informasi Badan Publik', 'keyword' => 'balai,upt,profil,unit', 'question' => 'Bagaimana profil balai dan UPT yang ada?', 'answer' => 'Disperindag Jateng memiliki beberapa UPT: Balai Industri Produk Tekstil dan Alas Kaki, Balai Industri Kreatif Digital dan Kemasan, Balai Sertifikasi Mutu Barang. Setiap balai memiliki tugas spesifik dalam pembinaan industri.'],
    
    ['category' => 'Informasi Badan Publik', 'keyword' => 'maklumat,pelayanan,komitmen,janji', 'question' => 'Apa maklumat pelayanan Dinas?', 'answer' => 'Maklumat pelayanan Disperindag Jateng: "Dengan ini kami berkomitmen memberikan pelayanan terbaik, profesional, transparan, dan akuntabel sesuai standar pelayanan publik untuk kepuasan masyarakat."'],
    
    // === INFORMASI PELAYANAN ===
    ['category' => 'Informasi Pelayanan', 'keyword' => 'layanan,perizinan,izin,usaha,oss,iui,siup,tdp', 'question' => 'Apa saja layanan perizinan yang tersedia?', 'answer' => 'Layanan perizinan Disperindag Jateng meliputi: Izin Usaha Industri (IUI), Izin Usaha Perdagangan (SIUP), Tanda Daftar Perusahaan (TDP), dan berbagai izin teknis lainnya. Proses dapat dilakukan online melalui OSS (Online Single Submission).'],
    
    ['category' => 'Informasi Pelayanan', 'keyword' => 'skpd,profil,sekretariat,bidang,operasional', 'question' => 'Bagaimana profil SKPD dan Balai?', 'answer' => 'SKPD Disperindag Jateng terdiri dari Sekretariat, 4 Bidang operasional, dan 3 Balai/UPT. Setiap unit memiliki tugas spesifik dalam mendukung pengembangan industri dan perdagangan di Jawa Tengah.'],
    
    ['category' => 'Informasi Pelayanan', 'keyword' => 'agenda,pimpinan,kepala,skpd,jadwal,acara', 'question' => 'Apa agenda pimpinan SKPD saat ini?', 'answer' => 'Agenda pimpinan SKPD dapat diakses melalui website resmi atau dengan mengajukan permohonan informasi publik ke PPID. Informasi agenda terbuka untuk publik sesuai ketentuan keterbukaan informasi publik.'],
    
    ['category' => 'Informasi Pelayanan', 'keyword' => 'rko,rencana,kerja,operasional,berjalan,tahun', 'question' => 'Bagaimana agenda berjalan/RKO Dinas?', 'answer' => 'Agenda berjalan/RKO (Rencana Kerja Operasional) Dinas memuat target dan capaian program kegiatan tahun berjalan. Dokumen dapat diakses melalui permohonan informasi publik atau website resmi Disperindag Jateng.'],
    
    ['category' => 'Informasi Pelayanan', 'keyword' => 'sk,keputusan,surat,penetapan,pejabat,terbaru', 'question' => 'Apa saja Surat Keputusan (SK) terbaru?', 'answer' => 'Surat Keputusan (SK) terbaru Disperindag Jateng dapat diakses melalui website resmi atau dengan mengajukan permohonan informasi publik. SK meliputi penetapan kebijakan, pengangkatan pejabat, dan keputusan teknis lainnya.'],
    
    ['category' => 'Informasi Pelayanan', 'keyword' => 'renstra,renja,perencanaan,strategis,lima,tahun', 'question' => 'Bagaimana rencana strategis (RENSTRA) dan rencana kerja (RENJA)?', 'answer' => 'RENSTRA (Rencana Strategis) dan RENJA (Rencana Kerja) Disperindag Jateng memuat visi, misi, tujuan, sasaran, dan strategi pembangunan industri perdagangan 5 tahun ke depan. Dokumen tersedia untuk publik.'],
    
    ['category' => 'Informasi Pelayanan', 'keyword' => 'inovasi,digital,portal,aplikasi,mobile,discha', 'question' => 'Apa inovasi layanan informasi publik yang ada?', 'answer' => 'Inovasi layanan informasi publik Disperindag Jateng: portal digital, aplikasi mobile, layanan online 24/7, sistem antrian elektronik, dan chatbot DISCHA untuk kemudahan akses informasi oleh masyarakat.'],
    
    // === RINGKASAN PROGRAM DAN KEGIATAN ===
    ['category' => 'Program dan Kegiatan', 'keyword' => 'nama,daftar,jenis,program,kegiatan,manajemen,daya,saing', 'question' => 'Apa saja nama program dan kegiatan Dinas?', 'answer' => 'Program Disperindag Jateng: Program Dukungan Manajemen, Program Peningkatan Daya Saing Industri, Program Peningkatan Perdagangan Dalam Negeri, Program Facilitas Perdagangan Ekspor. Setiap program memiliki kegiatan spesifik.'],
    
    ['category' => 'Program dan Kegiatan', 'keyword' => 'penanggung,jawab,koordinator,kepala,bidang', 'question' => 'Siapa penanggung jawab program dan kegiatan?', 'answer' => 'Penanggung jawab program: Kepala Bidang masing-masing sesuai tugas pokok dan fungsi. Bidang Industri Agro, Bidang Industri Non-Agro, Bidang Perdagangan Dalam Negeri, dan Bidang Perdagangan Luar Negeri.'],
    
    ['category' => 'Program dan Kegiatan', 'keyword' => 'target,capaian,evaluasi,iku,indikator,kinerja', 'question' => 'Bagaimana target dan capaian program kegiatan (RKO)?', 'answer' => 'Target dan capaian program kegiatan (RKO) dievaluasi secara berkala. Capaian meliputi indikator kinerja utama (IKU), output, dan outcome setiap program. Laporan capaian tersedia untuk publik.'],
    
    ['category' => 'Program dan Kegiatan', 'keyword' => 'jadwal,waktu,pelaksanaan,kalender,bulanan,triwulan', 'question' => 'Kapan jadwal pelaksanaan program kegiatan?', 'answer' => 'Jadwal pelaksanaan program kegiatan mengikuti kalender pemerintahan dan tahun anggaran. Kegiatan rutin bulanan, triwulan, dan tahunan. Info jadwal detail dapat diperoleh melalui kontak Dinas.'],
    
    ['category' => 'Program dan Kegiatan', 'keyword' => 'anggaran,nilai,dana,dpa,dipa,biaya,rupiah', 'question' => 'Berapa nilai anggaran per program (DPA/DIPA)?', 'answer' => 'Nilai anggaran per program (DPA/DIPA) berbeda-beda sesuai skala dan kompleksitas kegiatan. Informasi detail anggaran dapat diakses melalui permohonan informasi publik sesuai ketentuan transparansi.'],
    
    // === BANTUAN KEUANGAN DAN SOSIAL ===
    ['category' => 'Bantuan Keuangan', 'keyword' => 'jenis,macam,tersedia,bantuan,modal,umkm,hibah,pelatihan', 'question' => 'Bantuan keuangan dan sosial apa saja yang tersedia?', 'answer' => 'Bantuan keuangan/sosial Disperindag Jateng: bantuan modal UMKM, hibah pelatihan, bantuan sarana prasarana industri, dan fasilitas promosi produk. Bantuan disesuaikan dengan kebutuhan dan kriteria penerima.'],
    
    ['category' => 'Bantuan Keuangan', 'keyword' => 'transparansi,publikasi,daftar,penerima,besaran,terbuka', 'question' => 'Bagaimana transparansi bantuan keuangan dan sosial?', 'answer' => 'Transparansi bantuan keuangan/sosial dijamin melalui publikasi daftar penerima, besaran bantuan, dan kriteria seleksi. Informasi dapat diakses publik sesuai prinsip transparansi pemerintahan.'],
    
    ['category' => 'Bantuan Keuangan', 'keyword' => 'berhak,memenuhi,kriteria,syarat,umkm,koperasi,pengrajin', 'question' => 'Siapa yang berhak mendapatkan bantuan keuangan?', 'answer' => 'Yang berhak mendapat bantuan keuangan: pelaku UMKM yang memenuhi kriteria, koperasi aktif, kelompok industri rumahan, dan pengrajin yang terdaftar. Kriteria mencakup legalitas usaha dan kelayakan program.'],
    
    ['category' => 'Bantuan Keuangan', 'keyword' => 'cara,mengajukan,daftar,prosedur,formulir,permohonan,seleksi', 'question' => 'Bagaimana cara mengajukan bantuan keuangan dan sosial?', 'answer' => 'Cara mengajukan bantuan keuangan/sosial: 1) Daftar ke Dinas dengan membawa persyaratan lengkap, 2) Mengisi formulir permohonan, 3) Mengikuti seleksi, 4) Menandatangani pakta integritas jika diterima.'],
    
    // === AKSES INFORMASI PUBLIK ===
    ['category' => 'Informasi Publik', 'keyword' => 'cara,mengajukan,permohonan,ppid,formulir,identitas,hari,kerja', 'question' => 'Bagaimana cara mengajukan permohonan informasi publik?', 'answer' => 'Cara mengajukan permohonan informasi publik: 1) Datang ke kantor PPID, 2) Isi formulir permohonan, 3) Lampirkan identitas, 4) Tunggu proses maksimal 10 hari kerja, 5) Terima informasi atau pemberitahuan penolakan.'],
    
    ['category' => 'Informasi Publik', 'keyword' => 'hak,tata,cara,memperoleh,undang,14,2008,akurat', 'question' => 'Apa hak dan tata cara memperoleh informasi publik?', 'answer' => 'Hak memperoleh informasi publik dijamin UU No.14/2008. Setiap orang berhak mendapat informasi yang akurat, benar, dan tidak menyesatkan. Tata cara diatur dalam SOP PPID yang transparan dan mudah diakses.'],
    
    ['category' => 'Informasi Publik', 'keyword' => 'pengaduan,penyalahgunaan,wewenang,komplain,laporan,bukti', 'question' => 'Bagaimana prosedur pengaduan dan penyalahgunaan wewenang?', 'answer' => 'Prosedur pengaduan dan penyalahgunaan wewenang: 1) Sampaikan pengaduan tertulis/lisan ke PPID, 2) Sertakan bukti pendukung, 3) Tunggu proses verifikasi, 4) Terima tindak lanjut sesuai ketentuan.'],
    
    ['category' => 'Informasi Publik', 'keyword' => 'kecepatan,waktu,layanan,berkala,serta,merta,24,jam', 'question' => 'Bagaimana kecepatan layanan informasi publik?', 'answer' => 'Kecepatan layanan informasi publik: informasi berkala (tersedia setiap saat), informasi serta merta (maksimal 1x24 jam), informasi setiap saat (maksimal 10 hari kerja). Standar waktu sesuai UU Keterbukaan Informasi Publik.'],
    
    ['category' => 'Informasi Publik', 'keyword' => 'keberatan,banding,menolak,tertulis,30,hari,dokumen', 'question' => 'Bagaimana cara mengajukan keberatan informasi publik?', 'answer' => 'Cara mengajukan keberatan informasi publik: 1) Ajukan keberatan tertulis dalam 30 hari, 2) Lampirkan alasan keberatan, 3) Sertakan dokumen pendukung, 4) Tunggu tanggapan dalam 30 hari kerja.'],
    
    ['category' => 'Informasi Publik', 'keyword' => 'formulir,unduh,download,website,permohonan,keberatan,pengaduan', 'question' => 'Formulir layanan informasi apa saja yang tersedia?', 'answer' => 'Formulir layanan informasi tersedia: formulir permohonan informasi publik, formulir keberatan, formulir pengaduan, formulir pendaftaran UMKM. Semua formulir dapat diunduh di website atau diambil langsung di kantor.'],
    
    // === LAYANAN UMUM TAMBAHAN ===
    ['category' => 'Layanan Umum', 'keyword' => 'jam,buka,tutup,operasional,senin,kamis,jumat,istirahat', 'question' => 'Jam operasional kantor Dinas?', 'answer' => 'Jam operasional kantor Disperindag Jateng: Senin-Kamis 08.00-16.00 WIB, Jumat 08.00-16.30 WIB (istirahat 11.30-13.00). Pelayanan online 24 jam melalui website dan aplikasi mobile.'],
    
    ['category' => 'Layanan Umum', 'keyword' => 'kontak,telepon,email,hubungi,024,3549477,instagram,facebook', 'question' => 'Bagaimana menghubungi Dinas (kontak, telepon, email)?', 'answer' => 'Kontak Disperindag Jateng: Telepon (024) 3549477, Email: disperdagjateng@jatengprov.go.id, Website: https://disperindag.jatengprov.go.id. Media sosial: Instagram @disperindag_jateng dan Facebook Disperindag Jawa Tengah.'],
    
    ['category' => 'Layanan Umum', 'keyword' => 'umkm,usaha,kecil,menengah,bergulir,pelatihan,pendampingan,promosi', 'question' => 'Bagaimana program bantuan UMKM?', 'answer' => 'Program bantuan UMKM Disperindag Jateng: bantuan modal bergulir, pelatihan manajemen usaha, pendampingan teknis, fasilitas promosi produk, dan akses pasar. Daftar melalui kantor Dinas dengan persyaratan lengkap.'],
    
    ['category' => 'Layanan Umum', 'keyword' => 'sertifikasi,halal,mui,audit,fasilitator,dokumen,balai', 'question' => 'Bagaimana prosedur sertifikasi halal?', 'answer' => 'Prosedur sertifikasi halal: 1) Konsultasi ke Balai Sertifikasi, 2) Persiapan dokumen, 3) Audit fasilitator halal, 4) Perbaikan jika perlu, 5) Pengajuan ke MUI, 6) Sertifikat halal. Disperindag memfasilitasi seluruh proses.'],
    
    // === GREETING & BASIC RESPONSES ===
    ['category' => 'Greeting', 'keyword' => 'halo,hai,hello,hi,selamat,pagi,siang,sore,malam,hei', 'question' => 'Salam / Greeting', 'answer' => 'Halo! Selamat datang di layanan DISCHA (Disperindag Assistant) 😊 Saya siap membantu dengan informasi seputar Dinas Perindustrian dan Perdagangan Jawa Tengah. Ada yang bisa saya bantu?'],
    
    ['category' => 'Greeting', 'keyword' => 'terima,kasih,thanks,makasih,thank,you', 'question' => 'Ucapan terima kasih', 'answer' => 'Sama-sama! Senang bisa membantu. Jika ada pertanyaan lain terkait layanan Disperindag Jateng, jangan ragu untuk bertanya ya! 😊'],
    
    ['category' => 'Greeting', 'keyword' => 'selamat,tinggal,bye,sampai,jumpa,dadah', 'question' => 'Perpisahan', 'answer' => 'Terima kasih sudah menggunakan layanan DISCHA. Sampai jumpa dan semoga informasi yang diberikan bermanfaat! 🙏']
];

// Function untuk insert ke Supabase (jika diperlukan)
function insertChatbotData() {
    global $chatbot_database;
    
    require_once __DIR__ . '/../config/koneksi.php';
    
    $success_count = 0;
    $error_count = 0;
    
    foreach ($chatbot_database as $data) {
        $result = supabase_request('POST', 'chatbot', $data);
        
        if (isset($result['error'])) {
            $error_count++;
            error_log('Failed to insert: ' . $data['keyword'] . ' - ' . json_encode($result));
        } else {
            $success_count++;
        }
    }
    
    return [
        'success' => $success_count,
        'error' => $error_count,
        'total' => count($chatbot_database)
    ];
}

// Export untuk digunakan di file lain
return $chatbot_database;
?>