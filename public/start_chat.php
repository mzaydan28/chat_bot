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
    <title>Mulai Chat - DISA Chatbot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@400;500;600;700&family=Fraunces:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
        }

        body {
            font-family: 'Cabinet Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 580px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bot-avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        h1 {
            font-family: 'Fraunces', serif;
            font-size: 32px;
            font-weight: 700;
            color: #1a202c;
            text-align: center;
            margin-bottom: 16px;
        }

        .subtitle {
            font-size: 15px;
            color: #64748b;
            text-align: center;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 40px;
        }

        .feature {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .feature:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
            transform: translateX(4px);
        }

        .feature-icon {
            font-size: 20px;
            flex-shrink: 0;
        }

        .feature-text {
            font-size: 14px;
            color: #475569;
            line-height: 1.5;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cabinet Grotesk', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            border-color: #667eea;
            background: #f8fafc;
            transform: translateY(-2px);
        }

        .info-text {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }

        /* Tablet */
        @media (max-width: 768px) {
            .card {
                padding: 40px 32px;
            }

            h1 {
                font-size: 28px;
            }

            .bot-avatar {
                width: 90px;
                height: 90px;
            }
        }

        /* Mobile */
        @media (max-width: 640px) {
            .card {
                padding: 36px 24px;
                border-radius: 16px;
            }

            h1 {
                font-size: 26px;
                margin-bottom: 12px;
            }

            .subtitle {
                font-size: 14px;
                margin-bottom: 32px;
            }

            .bot-avatar {
                width: 80px;
                height: 80px;
                margin-bottom: 24px;
            }

            .features {
                gap: 12px;
                margin-bottom: 32px;
            }

            .feature {
                padding: 12px;
            }

            .feature-text {
                font-size: 13px;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                padding: 12px 20px;
                font-size: 13px;
            }
        }

        /* Extra small */
        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .card {
                padding: 30px 20px;
            }

            h1 {
                font-size: 24px;
            }

            .subtitle {
                font-size: 13px;
            }

            .bot-avatar {
                width: 70px;
                height: 70px;
                margin-bottom: 20px;
            }

            .feature {
                padding: 12px 10px;
                gap: 10px;
            }

            .feature-text {
                font-size: 12px;
            }

            .btn {
                padding: 11px 16px;
                font-size: 12px;
            }

            .info-text {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="<?php echo $baseUrl; ?>/../assets/images/Disperindag_Asisstant.png" alt="DISA Assistant" class="bot-avatar">

            <h1>Selamat Datang! 👋</h1>
            <p class="subtitle">
                Tanya apapun tentang UMKM, layanan, atau informasi Disperindag kepada DISA Assistant kami.
            </p>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon">⚡</div>
                    <div class="feature-text">Respon cepat dan akurat dalam hitungan detik</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">🎯</div>
                    <div class="feature-text">Informasi terpercaya dari database resmi</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">💬</div>
                    <div class="feature-text">Tanya berulang kali tanpa biaya apapun</div>
                </div>
            </div>

            <div class="buttons">
                <a href="<?php echo $baseUrl; ?>/chat.php" class="btn btn-primary">Mulai Chat →</a>
                <a href="<?php echo $baseUrl; ?>/landing.php" class="btn btn-secondary">Kembali</a>
            </div>

            <p class="info-text">DISA tersedia 24/7 untuk membantu Anda</p>
        </div>
    </div>
</body>
</html>
