<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $rating = (int)($_POST['rating'] ?? 0);
    $saran  = trim($_POST['saran'] ?? '');

    if ($rating <= 0 || $saran === '') {
        echo json_encode(['status'=>'error','message'=>'Data tidak valid']);
        exit;
    }

    $insert = supabase_request(
        'POST',
        'feedback',
        [
            'komentar' => $saran,
            'rating'   => $rating,
            'status'   => 'pending'
        ]
    );

    if (isset($insert['error'])) {
        echo json_encode(['status'=>'error','message'=>'Gagal menyimpan']);
    } else {
        echo json_encode(['status'=>'success','message'=>'Feedback tersimpan']);
    }
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="cache-control" content="no-cache, no-store, must-revalidate">
    <meta name="pragma" content="no-cache">
    <meta name="expires" content="0">
    <title>Kritik & Saran - DISCHA Chatbot <?php echo time(); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* FORCED OVERRIDE - NO CACHE VERSION <?php echo time(); ?> */
        * {
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
        }
        
        body {
            font-family: 'Poppins', sans-serif !important;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
            min-height: 100vh !important;
            color: #334155 !important;
        }
        
        .header {
            background: white !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
            padding: 16px 0 !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 100 !important;
        }
        
        .header-content {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        
        .header-title {
            font-size: 20px;
            font-weight: 600;
            color: #6366f1;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #f1f5f9;
            color: #64748b;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .back-btn:hover {
            background: #6366f1;
            color: white;
        }
        
        .container {
            max-width: 600px !important;
            margin: 40px auto !important;
            padding: 0 20px !important;
        }
        
        .feedback-card {
            background: white !important;
            border-radius: 16px !important;
            padding: 40px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #e2e8f0 !important;
            margin: 20px auto !important;
            max-width: 600px !important;
        }
        
        .header-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }
        
        .subtitle {
            font-size: 16px;
            color: #64748b;
            line-height: 1.6;
        }
        
        .form-section {
            margin-bottom: 32px;
        }
        
        .form-label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
        }
        
        .form-textarea {
            width: 100% !important;
            min-height: 120px !important;
            padding: 16px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 12px !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
            color: #374151 !important;
            background: #fafbfc !important;
            transition: all 0.2s !important;
            resize: vertical !important;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: #6366f1;
            background: white;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .form-textarea::placeholder {
            color: #9ca3af;
        }
        
        .rating-section {
            margin-bottom: 32px;
        }
        
        .rating-label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 20px;
        }
        
        .rating-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }
        
        .rating-item {
            position: relative;
        }
        
        .rating-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .rating-label-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 8px;
            background: #f8fafc;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            gap: 8px;
        }
        
        .rating-label-item:hover {
            border-color: #6366f1;
            background: #f0f4ff;
        }
        
        .rating-input:checked + .rating-label-item {
            background: #6366f1;
            border-color: #6366f1;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        
        .rating-emoji {
            font-size: 32px;
            line-height: 1;
        }
        
        .rating-text {
            font-size: 12px;
            font-weight: 500;
            line-height: 1.2;
        }
        
        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }
        
        .popup-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        .popup-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transform: scale(0.9);
            transition: all 0.3s;
        }
        
        .popup-overlay.show .popup-content {
            transform: scale(1);
        }
        
        .popup-image {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }
        
        .popup-title {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }
        
        .popup-message {
            font-size: 15px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        
        .popup-btn {
            padding: 12px 24px;
            background: #6366f1;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .popup-btn:hover {
            background: #5b5bd9;
            transform: translateY(-1px);
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .feedback-card {
                padding: 24px;
                margin: 20px;
            }
            
            .title {
                font-size: 24px;
            }
            
            .rating-grid {
                gap: 8px;
            }
            
            .rating-label-item {
                padding: 12px 4px;
            }
            
            .rating-emoji {
                font-size: 24px;
            }
            
            .rating-text {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="header-title">💬 Kritik & Saran</div>
            </div>
            <a href="landing.php" class="back-btn"><span>←</span> Kembali</a>
        </div>
    </div>

    <div class="container">
        <div class="feedback-card">
            <div class="header-section">
                <h1 class="title">Kritik & Saran</h1>
                <p class="subtitle">Bantu kami meningkatkan layanan chatbot dengan memberikan masukan Anda</p>
            </div>

            <form method="POST" id="feedbackForm">
                <div class="form-section">
                    <label class="form-label" for="saran">Tuliskan kritik dan saran Anda</label>
                    <textarea 
                        id="saran" 
                        name="saran" 
                        class="form-textarea"
                        placeholder="Sampaikan pengalaman dan saran Anda menggunakan chatbot ini. Masukan Anda sangat berharga bagi kami..."
                        required
                    ></textarea>
                </div>

                <div class="rating-section">
                    <label class="rating-label">Bagaimana penilaian Anda terhadap layanan kami?</label>
                    <div class="rating-grid">
                        <div class="rating-item">
                            <input type="radio" id="rating1" name="rating" value="1" class="rating-input" required>
                            <label for="rating1" class="rating-label-item">
                                <span class="rating-emoji">😞</span>
                                <span class="rating-text">Sangat Tidak Puas</span>
                            </label>
                        </div>
                        <div class="rating-item">
                            <input type="radio" id="rating2" name="rating" value="2" class="rating-input">
                            <label for="rating2" class="rating-label-item">
                                <span class="rating-emoji">😕</span>
                                <span class="rating-text">Tidak Puas</span>
                            </label>
                        </div>
                        <div class="rating-item">
                            <input type="radio" id="rating3" name="rating" value="3" class="rating-input">
                            <label for="rating3" class="rating-label-item">
                                <span class="rating-emoji">😐</span>
                                <span class="rating-text">Biasa Saja</span>
                            </label>
                        </div>
                        <div class="rating-item">
                            <input type="radio" id="rating4" name="rating" value="4" class="rating-input">
                            <label for="rating4" class="rating-label-item">
                                <span class="rating-emoji">😊</span>
                                <span class="rating-text">Puas</span>
                            </label>
                        </div>
                        <div class="rating-item">
                            <input type="radio" id="rating5" name="rating" value="5" class="rating-input">
                            <label for="rating5" class="rating-label-item">
                                <span class="rating-emoji">😍</span>
                                <span class="rating-text">Sangat Puas</span>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    Kirim Feedback
                </button>
            </form>
        </div>
    </div>

    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content">
            <div class="popup-image">🎉</div>
            <h2 class="popup-title">Terima Kasih!</h2>
            <p class="popup-message">Feedback Anda telah berhasil dikirim. Masukan Anda sangat berharga untuk meningkatkan kualitas layanan kami.</p>
            <button id="backBtn" class="popup-btn">Kembali ke Beranda</button>
        </div>
    </div>

    <script>
        const form = document.getElementById('feedbackForm');
        const popup = document.getElementById('popupOverlay');
        const backBtn = document.getElementById('backBtn');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(form);
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span style="display: inline-flex; align-items: center; gap: 8px;"><span style="width: 16px; height: 16px; border: 2px solid #ffffff40; border-top: 2px solid #fff; border-radius: 50%; animation: spin 1s linear infinite;"></span>Mengirim...</span>';
            
            // Submit form via AJAX
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show success popup
                    popup.classList.add('show');
                    form.reset();
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Kirim Feedback';
            });
        });

        // Back button functionality
        backBtn.addEventListener('click', function() {
            window.location.href = 'landing.php';
        });

        // Close popup on outside click
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.classList.remove('show');
            }
        });

        // Add loading animation CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>