<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . "/../config/koneksi.php";

$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$show_popup = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $saran = isset($_POST['saran']) ? trim($_POST['saran']) : '';

    // Validasi sederhana
    if ($rating > 0 && !empty($saran)) {
        // Insert ke database
        $query = "INSERT INTO feedback (komentar, rating, status) VALUES (?, ?, 'pending')";
        
        if ($stmt = mysqli_prepare($koneksi, $query)) {
            mysqli_stmt_bind_param($stmt, "si", $saran, $rating);
            
            if (mysqli_stmt_execute($stmt)) {
                $show_popup = true;
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kritik & Saran - DISA Chatbot</title>
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
            font-family: 'Cabinet Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 16px 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            z-index: 100;
        }

        .header-content {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .back-btn {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.12) 0%, rgba(118, 75, 162, 0.08) 100%);
            border: 1.5px solid rgba(102, 126, 234, 0.25);
            padding: 10px 18px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 12px;
            font-family: 'Cabinet Grotesk', sans-serif;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.12);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.18) 0%, rgba(118, 75, 162, 0.12) 100%);
            border-color: rgba(102, 126, 234, 0.4);
            transform: translateX(-3px);
        }

        /* Container */
        .container {
            margin-top: 80px;
            width: 100%;
            max-width: 700px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 50px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            margin-bottom: 40px;
        }

        .card-title {
            font-size: 32px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 12px;
            font-family: 'Fraunces', serif;
        }

        .card-subtitle {
            font-size: 15px;
            color: #64748b;
            line-height: 1.6;
        }

        /* Form */
        .form-group {
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 12px;
        }

        textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Cabinet Grotesk', sans-serif;
            font-size: 14px;
            resize: vertical;
            min-height: 120px;
            transition: all 0.3s ease;
        }

        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea::placeholder {
            color: #cbd5e0;
        }

        /* Rating */
        .rating-section {
            margin-bottom: 30px;
        }

        .rating-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 16px;
        }

        .rating-group {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }

        .rating-option {
            position: relative;
        }

        .rating-option input[type="radio"] {
            display: none;
        }

        .rating-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 8px;
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0;
            height: 100%;
        }

        .rating-option input[type="radio"]:checked + label {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
            transform: scale(1.05);
        }

        .rating-emoji {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .rating-text {
            font-size: 12px;
            font-weight: 500;
            text-align: center;
        }

        .rating-option input[type="radio"]:checked + label .rating-text {
            color: white;
        }

        /* Email Input */
        input[type="email"] {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Cabinet Grotesk', sans-serif;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input[type="email"]::placeholder {
            color: #cbd5e0;
        }

        /* Button */
        .btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Cabinet Grotesk', sans-serif;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            margin-top: 20px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Popup Notification */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .popup-overlay.show {
            display: flex;
        }

        .popup-content {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: popupScale 0.3s ease-out;
            max-width: 420px;
        }

        @keyframes popupScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .popup-icon {
            font-size: 70px;
            margin-bottom: 20px;
            animation: bounce 0.6s ease-out;
        }

        @keyframes bounce {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        .popup-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 12px;
            font-family: 'Fraunces', serif;
        }

        .popup-text {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .popup-loader {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            margin: 0 auto 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card {
                padding: 32px 24px;
            }

            .card-title {
                font-size: 24px;
            }

            .card-subtitle {
                font-size: 14px;
            }

            .rating-group {
                grid-template-columns: repeat(5, 1fr);
                gap: 8px;
            }

            .rating-option label {
                padding: 12px 6px;
                font-size: 11px;
            }

            .rating-emoji {
                font-size: 18px;
                margin-bottom: 2px;
            }

            .container {
                margin-top: 90px;
            }

            .popup-content {
                max-width: 300px;
                padding: 40px 24px;
            }

            .popup-icon {
                font-size: 50px;
            }

            .popup-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="header-title">� Kritik & Saran</div>
            </div>
            <a href="<?php echo $baseUrl; ?>/landing.php" class="back-btn"><span>←</span> Kembali</a>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Kritik & Saran</h1>
                <p class="card-subtitle">Kami menghargai setiap masukan Anda untuk meningkatkan kualitas layanan kami.</p>
            </div>

            <form method="POST" id="feedbackForm">
                <!-- Kritik dan Saran -->
                <div class="form-group">
                    <label for="saran">Kritik & Saran Anda:</label>
                    <textarea id="saran" name="saran" placeholder="Sampaikan kritik dan saran Anda untuk layanan chatbot kami..." required></textarea>
                </div>

                <!-- Rating -->
                <div class="rating-section">
                    <label class="rating-label">Seberapa puas Anda dengan layanan kami?</label>
                    <div class="rating-group">
                        <div class="rating-option">
                            <input type="radio" id="rating1" name="rating" value="1" required>
                            <label for="rating1">
                                <span class="rating-emoji">😞</span>
                                <span class="rating-text">Sangat Tidak Puas</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="rating2" name="rating" value="2">
                            <label for="rating2">
                                <span class="rating-emoji">😕</span>
                                <span class="rating-text">Tidak Puas</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="rating3" name="rating" value="3">
                            <label for="rating3">
                                <span class="rating-emoji">😐</span>
                                <span class="rating-text">Biasa Saja</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="rating4" name="rating" value="4">
                            <label for="rating4">
                                <span class="rating-emoji">😊</span>
                                <span class="rating-text">Puas</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="radio" id="rating5" name="rating" value="5">
                            <label for="rating5">
                                <span class="rating-emoji">😍</span>
                                <span class="rating-text">Sangat Puas</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn">Kirim Kritik & Saran</button>
            </form>
        </div>
    </div>

    <!-- Popup Notification -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content">
            <img src="<?php echo $baseUrl; ?>/../assets/images/DISA_Terimakasih.png" alt="Thank You" style="width: 140px; height: auto; margin-bottom: 20px; animation: bounce 0.6s ease-out;">
            <h2 class="popup-title">Terima Kasih!</h2>
            <p class="popup-text">Kritik dan saran Anda sangat berharga bagi kami untuk terus berkembang.</p>
            <button id="backBtn" class="btn" style="margin-top: 30px;">Kembali ke Halaman Utama</button>
        </div>
    </div>

    <script>
        const form = document.getElementById('feedbackForm');
        const popup = document.getElementById('popupOverlay');
        const backBtn = document.getElementById('backBtn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(form);
            
            // Submit form
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Show popup
                popup.classList.add('show');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        });

        // Back button event listener
        backBtn.addEventListener('click', function() {
            window.location.href = '<?php echo $baseUrl; ?>/landing.php';
        });
    </script>
</body>
</html>
