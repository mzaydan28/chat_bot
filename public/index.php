<?php
// Redirect ke landing page
header('Location: landing.php');
exit;
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DISA - Chatbot Layanan Disperindag</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@400;500;600;700&family=Fraunces:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cabinet Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
            letter-spacing: -0.3px;
            background: #ffffff;
            color: #1a202c;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 16px 24px;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-family: 'Fraunces', serif;
            font-size: 16px;
            font-weight: 700;
            color: #1a202c;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-logo:hover {
            transform: translateY(-2px);
        }

        .nav-logo-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
            border: 2px solid rgba(102, 126, 234, 0.1);
        }

        .nav-logo-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-logo-main {
            font-size: 18px;
            font-weight: 800;
            color: #667eea;
            letter-spacing: -0.5px;
        }

        .nav-logo-sub {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            font-family: 'Cabinet Grotesk', sans-serif;
            letter-spacing: 0.8px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-links a {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .nav-cta {
            padding: 10px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Hero Section */
        .hero {
            padding: 120px 24px 80px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
            text-align: center;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-block;
            padding: 8px 16px;
            background: rgba(102, 126, 234, 0.12);
            border: 1px solid rgba(102, 126, 234, 0.3);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-family: 'Fraunces', serif;
            font-size: 56px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 20px;
            line-height: 1.2;
            letter-spacing: -1.2px;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 40px;
            line-height: 1.7;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-image {
            width: 300px;
            height: 300px;
            margin: 0 auto 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.2);
            animation: float 3s ease-in-out infinite;
            overflow: hidden;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .hero-cta {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-bottom: 40px;
        }

        .btn-primary, .btn-secondary {
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-family: 'Cabinet Grotesk', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #f7fafc;
            transform: translateY(-3px);
        }

        /* Features Section */
        .features-section {
            padding: 80px 24px;
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-family: 'Fraunces', serif;
            font-size: 40px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 16px;
            letter-spacing: -0.8px;
        }

        .section-subtitle {
            font-size: 16px;
            color: #64748b;
            max-width: 500px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            padding: 32px;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f4f8 100%);
            border-radius: 16px;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            background: linear-gradient(135deg, #f0f4f8 0%, #e8f0f8 100%);
            border-color: rgba(102, 126, 234, 0.3);
            box-shadow: 0 12px 32px rgba(102, 126, 234, 0.15);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .feature-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        /* Tutorial Section */
        .tutorial-section {
            padding: 80px 24px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        }

        .tutorial-content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-top: 40px;
        }

        .step-card {
            background: white;
            padding: 28px;
            border-radius: 16px;
            border-left: 4px solid #667eea;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .step-number {
            font-family: 'Fraunces', serif;
            font-size: 32px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 12px;
        }

        .step-card h4 {
            font-size: 16px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .step-card p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        /* FAQ Section */
        .faq-section {
            padding: 80px 24px;
            background: white;
        }

        .faq-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 24px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 24px;
        }

        .faq-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .faq-question {
            font-weight: 600;
            color: #1a202c;
            font-size: 16px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .faq-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            flex-shrink: 0;
        }

        .faq-answer {
            font-size: 14px;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        /* CTA Banner */
        .cta-banner {
            padding: 80px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            text-align: center;
        }

        .cta-banner-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .cta-banner h2 {
            font-family: 'Fraunces', serif;
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
            letter-spacing: -0.8px;
        }

        .cta-banner p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 32px;
            line-height: 1.7;
        }

        .cta-banner .btn-primary {
            background: white;
            color: #667eea;
            display: inline-block;
        }

        .cta-banner .btn-primary:hover {
            background: #f7fafc;
        }

        /* Footer */
        footer {
            padding: 32px 24px;
            background: #1a202c;
            color: #cbd5e0;
            text-align: center;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav { padding: 12px 16px; }
            .nav-links { gap: 16px; }
            .nav-links a { display: none; }
            .hero { padding: 80px 20px 60px; }
            .hero h1 { font-size: 36px; }
            .hero-subtitle { font-size: 16px; }
            .hero-image { width: 220px; height: 220px; font-size: 80px; }
            .hero-cta { flex-direction: column; }
            .section-title { font-size: 32px; }
            .features-grid { gap: 20px; }
            .cta-banner h2 { font-size: 32px; }
        }

        @media (max-width: 480px) {
            .hero h1 { font-size: 28px; }
            .section-title { font-size: 24px; }
            .btn-primary, .btn-secondary { padding: 12px 20px; font-size: 13px; }
            .features-grid { grid-template-columns: 1fr; }
            .steps-grid { grid-template-columns: 1fr; }
            .cta-banner h2 { font-size: 24px; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-content">
            <div class="nav-logo">
                <img src="<?php echo $baseUrl; ?>/../../assets/images/Disperindag_Asisstant.png" alt="DISA" class="nav-logo-img">
                <div class="nav-logo-text">
                    <div class="nav-logo-main">DISA</div>
                    <div class="nav-logo-sub">Disperindag Assistant</div>
                </div>
            </div>
            <div class="nav-links">
                <a href="#fitur">Fitur</a>
                <a href="#tutorial">Tutorial</a>
                <a href="#faq">FAQ</a>
                <a href="<?php echo $baseUrl; ?>/start_chat.php" class="nav-cta">Mulai Chat</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">✨ Solusi Digital untuk Anda</div>
            <div class="hero-image">
                <img src="<?php echo $baseUrl; ?>/../../assets/images/Disperindag_Asisstant.png" alt="DISA Bot">
            </div>
            <h1>Selamat Datang di DISA</h1>
            <p class="hero-subtitle">Asisten digital cerdas yang siap membantu Anda 24/7 dengan informasi lengkap tentang layanan, program, dan perizinan Disperindag Jawa Tengah.</p>
            <div class="hero-cta">
                <a href="<?php echo $baseUrl; ?>/start_chat.php" class="btn-primary">Mulai Chat Sekarang →</a>
                <a href="#fitur" class="btn-secondary">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="fitur">
        <div class="section-header">
            <h2 class="section-title">Keunggulan DISA</h2>
            <p class="section-subtitle">Nikmati pengalaman berinteraksi dengan chatbot yang cerdas dan responsif</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Respon Instan</h3>
                <p>Dapatkan jawaban langsung tanpa perlu menunggu. DISA bekerja 24/7 untuk membantu Anda kapan saja.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3>Akurat & Terpercaya</h3>
                <p>Semua informasi diambil dari database resmi Disperindag Jawa Tengah untuk memastikan akurasi maksimal.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🌍</div>
                <h3>Mudah Digunakan</h3>
                <p>Interface yang intuitif dan user-friendly membuat siapa saja bisa menggunakan DISA dengan mudah.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Responsif</h3>
                <p>Akses DISA dari perangkat apa pun - laptop, tablet, atau smartphone Anda.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💡</div>
                <h3>Rekomendasi Cerdas</h3>
                <p>DISA memberikan saran pertanyaan yang relevan untuk membantu Anda menemukan informasi yang dicari.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Aman & Terjamin</h3>
                <p>Data Anda dilindungi dengan standar keamanan tinggi untuk privasi dan kenyamanan maksimal.</p>
            </div>
        </div>
    </section>

    <!-- Tutorial Section -->
    <section class="tutorial-section" id="tutorial">
        <div class="tutorial-content">
            <div class="section-header">
                <h2 class="section-title">Cara Menggunakan DISA</h2>
                <p class="section-subtitle">Ikuti langkah-langkah sederhana ini untuk mendapatkan informasi yang Anda butuhkan</p>
            </div>
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4>Mulai Chat</h4>
                    <p>Klik tombol "Mulai Chat Sekarang" untuk membuka jendela percakapan dengan DISA.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4>Pilih Pertanyaan</h4>
                    <p>Anda bisa memilih dari pertanyaan yang tersedia atau mengetik pertanyaan Anda sendiri.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4>Dapatkan Jawaban</h4>
                    <p>DISA akan segera memberikan jawaban yang akurat dan lengkap untuk pertanyaan Anda.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h4>Tanya Lebih Lanjut</h4>
                    <p>Anda dapat terus bertanya dengan topik berbeda atau meminta penjelasan lebih detail.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" id="faq">
        <div class="faq-content">
            <div class="section-header">
                <h2 class="section-title">Pertanyaan Umum</h2>
                <p class="section-subtitle">Temukan jawaban atas pertanyaan yang sering diajukan tentang DISA</p>
            </div>
            <div style="margin-top: 48px;">
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apa itu DISA?</span>
                    </div>
                    <p class="faq-answer">DISA adalah chatbot cerdas yang dikembangkan oleh Disperindag Jawa Tengah untuk memberikan informasi terkini tentang layanan, program UMKM, dan perizinan usaha. DISA tersedia 24/7 untuk membantu Anda.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apakah DISA benar-benar tersedia 24/7?</span>
                    </div>
                    <p class="faq-answer">Ya! DISA dapat diakses kapan saja, 24 jam sehari, 7 hari seminggu. Anda tidak perlu menunggu jam kerja kantor untuk mendapatkan informasi yang dibutuhkan.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Informasi apa yang bisa saya dapatkan dari DISA?</span>
                    </div>
                    <p class="faq-answer">DISA menyediakan informasi tentang jam operasional, lokasi kantor, program UMKM, proses perizinan usaha, layanan Disperindag, dan berbagai pertanyaan lain terkait dengan industri dan perdagangan.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Bagaimana jika saya tidak menemukan jawaban yang saya cari?</span>
                    </div>
                    <p class="faq-answer">Jika DISA tidak dapat menjawab pertanyaan Anda, coba rephrase pertanyaan dengan kata-kata yang berbeda atau kunjungi kantor Disperindag secara langsung untuk bantuan lebih lanjut.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apakah informasi dari NUSA akurat?</span>
                    </div>
                    <p class="faq-answer">Semua informasi yang diberikan NUSA bersumber dari database resmi Disperindag Jawa Tengah dan diperbarui secara berkala untuk memastikan akurasi dan relevansi.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apakah data saya aman?</span>
                    </div>
                    <p class="faq-answer">Ya, keamanan data Anda adalah prioritas utama kami. Semua interaksi dengan NUSA dilindungi dengan standar keamanan tinggi untuk menjaga privasi Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="cta-banner">
        <div class="cta-banner-content">
            <h2>Siap Memulai?</h2>
            <p>Jangan ragu untuk menghubungi DISA sekarang dan dapatkan informasi yang Anda butuhkan dalam hitungan detik.</p>
            <a href="<?php echo $baseUrl; ?>/start_chat.php" class="btn-primary">Mulai Chat Sekarang →</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 DISA Chatbot - Dinas Perindustrian dan Perdagangan Jawa Tengah. Semua hak dilindungi.</p>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
