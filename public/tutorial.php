<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . "/../config/koneksi.php";
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Panduan Penggunaan - DISCHA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        :root {
            --primary: #37517E;
            --primary-dark: #2d4166;
            --primary-light: #4a658f;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            background-attachment: fixed;
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.18);
            padding: 0 24px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-logo {
            width: 46px;
            height: 46px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(55, 81, 126, 0.3));
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-logo:hover {
            transform: scale(1.15) rotate(5deg);
            filter: drop-shadow(0 8px 24px rgba(55, 81, 126, 0.5));
        }

        .navbar-title {
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .navbar-subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: -2px;
        }

        .back-btn {
            padding: 9px 18px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #37517E;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 6px;
            letter-spacing: 0.01em;
        }

        .back-btn:hover {
            background: white;
            color: #2d4166;
            border-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .tutorial-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-logo {
            text-align: center;
            margin: 80px 0 40px 0;
            padding: 20px;
            position: relative;
        }

        .hero-logo-img {
            width: 250px;
            height: 250px;
            object-fit: contain;
            filter: drop-shadow(0 15px 35px rgba(55, 81, 126, 0.4));
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: float 3s ease-in-out infinite;
            cursor: pointer;
        }

        .hero-logo-img:hover {
            transform: scale(1.2) rotate(10deg);
            filter: drop-shadow(0 25px 50px rgba(55, 81, 126, 0.7));
            animation-play-state: paused;
        }

        .hero-logo-img:active {
            transform: scale(1.15) rotate(-5deg);
            filter: drop-shadow(0 20px 40px rgba(55, 81, 126, 0.8));
        }

        .speech-bubble {
            position: absolute;
            top: -80px;
            left: 60%;
            transform: translateX(-50%) translateY(-10px) scale(0);
            background: rgba(55, 81, 126, 0.25);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: #2d4166;
            padding: 15px 25px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 10px 30px rgba(55, 81, 126, 0.3);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            pointer-events: none;
            z-index: 1000;
        }

        .speech-bubble.show {
            transform: translateX(-50%) translateY(0) scale(1);
            opacity: 1;
        }

        .speech-bubble::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 30%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid rgba(55, 81, 126, 0.25);
        }

        @media (max-width: 900px) {
            .speech-bubble {
                right: auto;
                left: 50%;
                top: -80px;
                transform: translateX(-50%) translateY(-10px) scale(0);
            }
            
            .speech-bubble.show {
                transform: translateX(-50%) translateY(0) scale(1);
            }
            
            .speech-bubble::after {
                left: 50%;
                top: auto;
                bottom: -10px;
                transform: translateX(-50%);
                border-top: 10px solid rgba(55, 81, 126, 0.25);
                border-right: 10px solid transparent;
                border-bottom: none;
                border-left: 10px solid transparent;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .tutorial-section {
            margin-bottom: 40px;
        }

        .tutorial-section p {
            margin: 0 auto;
            max-width: 100%;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #37517E;
            margin-bottom: 20px;
        }

        .tutorial-steps {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .step-item {
            display: flex;
            gap: 16px;
            padding: 20px;
            background: var(--bg-secondary);
            border-radius: 12px;
            border-left: 4px solid #37517E;
            transition: all 0.3s;
        }

        .step-item:hover {
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(55, 81, 126, 0.2);
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .step-content h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-primary);
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .step-content p {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.6;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .tips-box {
            background: linear-gradient(135deg, rgba(55, 81, 126, 0.1) 0%, rgba(74, 101, 143, 0.1) 100%);
            padding: 24px;
            border-radius: 12px;
            border-left: 4px solid #37517E;
            margin-top: 20px;
        }

        .tips-box h4 {
            font-size: 18px;
            font-weight: 700;
            color: #37517E;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tips-box ul {
            list-style: none;
            padding: 0;
        }

        .tips-box li {
            padding: 8px 0 8px 24px;
            position: relative;
            color: var(--text-secondary);
            line-height: 1.6;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .tips-box li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #37517E;
            font-weight: bold;
        }

        .tutorial-footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
        }

        .tutorial-footer p {
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .start-btn {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(55, 81, 126, 0.4);
            transition: all 0.3s;
        }

        .start-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(55, 81, 126, 0.6);
        }


        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .navbar {
                padding: 0 16px;
                height: 60px;
            }

            .navbar-logo {
                width: 36px;
                height: 36px;
            }

            .navbar-title {
                font-size: 18px;
            }

            .navbar-subtitle {
                font-size: 10px;
            }

            .back-btn {
                padding: 7px 12px;
                font-size: 12px;
            }

            .tutorial-card {
                padding: 20px;
                border-radius: 16px;
            }

            .tutorial-section {
                margin-bottom: 30px;
            }

            .section-title {
                font-size: 20px;
                text-align: center;
            }

            .hero-logo {
                margin: 40px 0 30px 0;
                padding: 10px;
            }

            .hero-logo-img {
                width: 180px;
                height: 180px;
            }

            .step-item {
                flex-direction: column;
                padding: 16px;
            }

            .step-number {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }

            .step-content h3 {
                font-size: 16px;
            }

            .step-content p {
                font-size: 14px;
            }

            .tips-box {
                padding: 16px;
            }

            .tips-box h4 {
                font-size: 16px;
            }

            .tips-box li {
                font-size: 14px;
                padding: 6px 0 6px 20px;
            }

            .tutorial-footer {
                margin-top: 30px;
                padding-top: 20px;
            }

            .start-btn {
                padding: 12px 24px;
                font-size: 14px;
            }

            .speech-bubble {
                font-size: 14px;
                padding: 12px 20px;
                max-width: 80%;
                white-space: normal;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 8px;
            }

            .navbar {
                padding: 0 12px;
            }

            .navbar-brand {
                gap: 8px;
            }

            .tutorial-card {
                padding: 16px;
                margin: 10px 0;
            }

            .tutorial-section {
                margin-bottom: 25px;
            }

            .hero-logo {
                margin: 30px 0 20px 0;
            }

            .hero-logo-img {
                width: 150px;
                height: 150px;
            }

            .section-title {
                font-size: 18px;
            }

            .step-content h3 {
                font-size: 15px;
            }

            .step-content p {
                font-size: 13px;
            }

            .tips-box h4 {
                font-size: 15px;
            }

            .tips-box li {
                font-size: 13px;
            }

            .tutorial-footer p {
                font-size: 14px;
            }

            .start-btn {
                width: 100%;
                padding: 14px 20px;
            }

            .speech-bubble {
                font-size: 13px;
                padding: 10px 16px;
                max-width: 90%;
            }
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">
            <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA" class="navbar-logo">
            <div>
                <div class="navbar-title">DISCHA</div>
                <div class="navbar-subtitle">Disperindag Jateng Chat Assistant</div>
            </div>
        </div>
        <a href="<?php echo $baseUrl; ?>/landing.php" class="back-btn">← Kembali ke Chat</a>
    </div>

    <div class="container">
        <div class="tutorial-card">
            <div class="tutorial-section" style="text-align: center;">
                <h2 class="section-title" style="justify-content: center;">
                    Apa itu DISCHA?
                </h2>
                
                <div class="hero-logo">
                    <div class="speech-bubble" id="speechBubble">Halo! 👋</div>
                    <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA" class="hero-logo-img">
                </div>
                
                <p style="color: var(--text-secondary); line-height: 1.8; margin-bottom: 20px;">
                    DISCHA (Disperindag Jateng Chat Assistant) adalah chatbot pintar yang dirancang untuk membantu Anda mendapatkan informasi tentang layanan, perizinan, dan program Dinas Perindustrian dan Perdagangan Jawa Tengah dengan cepat dan mudah.
                </p>

                <div style="background: linear-gradient(135deg, rgba(55, 81, 126, 0.08) 0%, rgba(74, 101, 143, 0.08) 100%); padding: 20px; border-radius: 12px; border-left: 4px solid #37517E; margin-bottom: 20px;">
                    <h4 style="color: #37517E; margin-bottom: 10px; font-weight: 700;">� Akses dari Perangkat Apa Saja</h4>
                    <p style="color: var(--text-secondary); line-height: 1.7; font-size: 14px;">
                        DISCHA dapat digunakan di <strong>Desktop</strong>, <strong>Laptop</strong>, <strong>Tablet</strong>, dan <strong>Smartphone</strong>. Panduan ini akan menjelaskan cara penggunaan untuk masing-masing perangkat.
                    </p>
                </div>
            </div>


            <div class="tutorial-section">
                <h2 class="section-title">
                    Cara Menggunakan
                </h2>
                <div class="tutorial-steps">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Pilih Pertanyaan Praktis</h3>
                            <p><strong>Komputer/Laptop:</strong> Lihat panel sebelah kiri, klik kategori yang Anda inginkan untuk melihat daftar pertanyaan.</p>
                            <p style="margin-top: 8px;"><strong>HP/Tablet:</strong> Gunakan tombol <strong>"📋 Lihat Semua Pertanyaan"</strong> yang ada di bawah kolom chat untuk membuka daftar lengkap.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Ketik Pertanyaan Sendiri</h3>
                            <p>Atau ketik langsung pertanyaan di kolom chat, lalu tekan <strong>Enter</strong> (komputer) atau tombol <strong>➤</strong> (HP). Sistem akan memberi saran pertanyaan otomatis saat Anda mengetik.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Jelajahi Semua Pertanyaan</h3>
                            <p>Klik tombol <strong>"📋 Lihat Semua Pertanyaan"</strong> untuk membuka jendela popup berisi semua kategori dan pertanyaan. Lokasi: di bawah panel kiri (komputer) atau di bawah kolom chat (HP).</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h3>Akses Informasi Publik Lengkap</h3>
                            <p>Butuh informasi resmi lebih lengkap? Akses langsung ke halaman PPID:</p>
                            <ul style="margin-top: 8px; margin-left: 20px; line-height: 1.8;">
                                <li><strong>Komputer/Laptop:</strong> Klik tombol Berkala, Serta Merta, Setiap Saat, atau Dikecualikan di panel kiri bawah</li>
                                <li><strong>HP/Tablet:</strong> Klik tombol <strong>"📋 Info"</strong> di pojok kanan atas area chat (sejajar dengan tulisan "Online 24/7"), pilih kategori yang diinginkan</li>
                            </ul>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <h3>Dapatkan Jawaban Instant</h3>
                            <p>DISCHA akan segera memberikan jawaban yang akurat berdasarkan knowledge base Disperindag Jawa Tengah.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">6</div>
                        <div class="step-content">
                            <h3>Berikan Feedback</h3>
                            <p>Bantu kami berkembang! Klik tombol <strong>"Kritik & Saran"</strong> di pojok kanan atas (dekat tombol Panduan) untuk berbagi pengalaman Anda.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tutorial-section">
                <h2 class="section-title">
                    Tips & Trik
                </h2>
                <div class="tips-box">
                    <h4>Tips untuk Hasil Terbaik:</h4>
                    <ul>
                        <li>Gunakan pertanyaan yang jelas dan spesifik</li>
                        <li>Manfaatkan kategori pertanyaan untuk menemukan informasi lebih cepat</li>
                        <li>Jika jawaban kurang sesuai, coba ubah cara bertanya</li>
                        <li>Akses Informasi Publik (Berkala, Serta Merta, dll) untuk data resmi lengkap</li>
                        <li>Berikan feedback agar DISCHA makin pintar membantu Anda</li>
                        <li>Jelajahi berbagai kategori untuk tahu semua layanan yang tersedia</li>
                    </ul>
                </div>
            </div>

            <div class="tutorial-section">
                <h2 class="section-title">
                    Contoh Pertanyaan
                </h2>
                <div class="tips-box">
                    <h4>Contoh pertanyaan yang dapat Anda tanyakan:</h4>
                    <ul>
                        <li>"Di mana alamat lengkap kantor Dinas Perindustrian dan Perdagangan Jawa Tengah?"</li>
                        <li>"Apa visi dan misi Dinas Perindustrian dan Perdagangan Jawa Tengah?"</li>
                        <li>"Apa saja layanan perizinan yang tersedia?"</li>
                        <li>"Bagaimana cara mengajukan permohonan informasi publik?"</li>
                        <li>"Apa saja nama program dan kegiatan Dinas?"</li>
                        <li>"Bagaimana laporan kinerja Dinas Perindag (LKJIP)?"</li>
                        <li>"Apa saja bantuan keuangan/sosial yang tersedia?"</li>
                        <li>"Bagaimana informasi perdagangan luar negeri?"</li>
                        <li>"Apa saja Standar dan Prosedur Operasional Pelayanan (SOP)?"</li>
                        <li>"Bagaimana informasi pengadaan barang dan jasa (RUP)?"</li>
                    </ul>
                </div>
            </div>


            <div class="tutorial-section">
                <h2 class="section-title">
                    📍 Lokasi Fitur di Layar Anda
                </h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 20px;">
                    <div style="background: linear-gradient(135deg, rgba(55, 81, 126, 0.05) 0%, rgba(74, 101, 143, 0.05) 100%); padding: 20px; border-radius: 12px; border: 1px solid rgba(55, 81, 126, 0.2);">
                        <h4 style="color: #37517E; margin-bottom: 12px; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                            💻 Komputer/Laptop
                        </h4>
                        <ul style="line-height: 1.8; color: var(--text-secondary); font-size: 14px; margin-left: 20px;">
                            <li><strong>Panel Kiri:</strong> Daftar pertanyaan & Informasi Publik</li>
                            <li><strong>Tengah:</strong> Area percakapan chat</li>
                            <li><strong>Bawah:</strong> Kolom ketik pertanyaan</li>
                            <li><strong>Kanan Atas:</strong> Tombol Panduan & Kritik/Saran</li>
                        </ul>
                    </div>
                    <div style="background: linear-gradient(135deg, rgba(55, 81, 126, 0.05) 0%, rgba(74, 101, 143, 0.05) 100%); padding: 20px; border-radius: 12px; border: 1px solid rgba(55, 81, 126, 0.2);">
                        <h4 style="color: #37517E; margin-bottom: 12px; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                            📱 HP/Tablet
                        </h4>
                        <ul style="line-height: 1.8; color: var(--text-secondary); font-size: 14px; margin-left: 20px;">
                            <li><strong>Atas Kanan (Chat):</strong> Tombol "📋 Info" untuk Informasi Publik</li>
                            <li><strong>Tengah:</strong> Area percakapan chat (layar penuh)</li>
                            <li><strong>Bawah:</strong> Kolom ketik & tombol Lihat Semua Pertanyaan</li>
                            <li><strong>Atas (Navbar):</strong> Panduan & Kritik/Saran</li>
                        </ul>
                    </div>
                </div>
                <p style="margin-top: 16px; color: var(--text-secondary); font-size: 14px; text-align: center; font-style: italic;">
                    Semua fitur dapat diakses dengan mudah dari perangkat apapun
                </p>
            </div>


            <div class="tutorial-footer">
                <p>Siap untuk memulai? Kembali ke chat dan mulai bertanya!</p>
                <a href="<?php echo $baseUrl; ?>/landing.php" class="start-btn">
                    Mulai Bertanya Sekarang
                </a>
            </div>
        </div>
    </div>

    <script>
        // Interactive logo with greeting messages
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.querySelector('.hero-logo-img');
            const speechBubble = document.getElementById('speechBubble');
            let isShowing = false;
            
            const greetings = [
                'Halo! Saya DISCHA 👋',
                'Selamat datang! 😊',
                'Ada yang bisa saya bantu? 💬',
                'Siap membantu Anda! ✨',
                'Mari bertanya! 🚀',
                'Salam kenal! 😄',
                'Senang bertemu Anda! 🤗',
                'Siap melayani Anda! 💼',
                'Jangan ragu untuk bertanya! 💡',
                'Disperindag Jateng siap membantu! 🏛️'
            ];
            
            if (logo && speechBubble) {
                logo.addEventListener('click', function() {
                    if (!isShowing) {
                        // Show greeting
                        const randomGreeting = greetings[Math.floor(Math.random() * greetings.length)];
                        speechBubble.textContent = randomGreeting;
                        speechBubble.classList.add('show');
                        isShowing = true;
                        
                        // Hide after 3 seconds
                        setTimeout(() => {
                            speechBubble.classList.remove('show');
                            isShowing = false;
                        }, 3000);
                    }
                });
            }
        });
    </script>
</body>
</html>
