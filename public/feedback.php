<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

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
    <title>Kritik & Saran - DISA Chatbot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabinet+Grotesk:wght@400;500;600;700&family=Fraunces:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ... Style CSS Anda tetap sama ... */
        /* Pastikan CSS Anda disalin penuh di sini */
        /* Tambahan perbaikan aksesibilitas untuk radio button */
        .rating-option input[type="radio"] {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 1; /* Agar bisa diklik di atas label */
        }
        
        /* ... Sisa CSS Anda ... */
        
        /* Copy Paste CSS dari file asli di sini (saya persingkat agar tidak penuh) */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Cabinet Grotesk', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .header { position: fixed; top: 0; left: 0; right: 0; background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); padding: 16px 24px; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06); z-index: 100; }
        .header-content { max-width: 1000px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; }
        .header-title { font-size: 18px; font-weight: 700; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .back-btn { background: linear-gradient(135deg, rgba(102, 126, 234, 0.12) 0%, rgba(118, 75, 162, 0.08) 100%); border: 1.5px solid rgba(102, 126, 234, 0.25); padding: 10px 18px; cursor: pointer; font-size: 13px; font-weight: 600; color: #667eea; text-decoration: none; border-radius: 12px; display: flex; align-items: center; gap: 6px; }
        .container { margin-top: 80px; width: 100%; max-width: 700px; }
        .card { background: white; border-radius: 20px; padding: 50px 45px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15); }
        .card-header { margin-bottom: 40px; }
        .card-title { font-size: 32px; font-weight: 700; color: #1a202c; margin-bottom: 12px; font-family: 'Fraunces', serif; }
        .card-subtitle { font-size: 15px; color: #64748b; line-height: 1.6; }
        .form-group { margin-bottom: 30px; }
        label { display: block; font-size: 14px; font-weight: 600; color: #1a202c; margin-bottom: 12px; }
        textarea { width: 100%; padding: 14px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-family: 'Cabinet Grotesk', sans-serif; font-size: 14px; min-height: 120px; }
        textarea:focus { outline: none; border-color: #667eea; }
        .rating-section { margin-bottom: 30px; }
        .rating-group { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; }
        .rating-option { position: relative; }
        .rating-option label { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 16px 8px; background: #f7fafc; border: 2px solid #e2e8f0; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; height: 100%; }
        .rating-option input[type="radio"]:checked + label { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-color: #667eea; color: white; transform: scale(1.05); }
        .rating-emoji { font-size: 24px; margin-bottom: 4px; }
        .rating-text { font-size: 12px; font-weight: 500; text-align: center; }
        .rating-option input[type="radio"]:checked + label .rating-text { color: white; }
        .btn { width: 100%; padding: 16px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer; margin-top: 20px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); }
        .btn:hover { transform: translateY(-2px); }
        .popup-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 2000; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
        .popup-overlay.show { display: flex; }
        .popup-content { background: white; border-radius: 20px; padding: 50px 40px; text-align: center; max-width: 420px; animation: popupScale 0.3s ease-out; }
        @keyframes popupScale { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
        .popup-title { font-size: 28px; font-weight: 700; margin-bottom: 12px; font-family: 'Fraunces', serif; }
        .popup-text { font-size: 15px; color: #64748b; margin-bottom: 20px; }
        @media (max-width: 768px) { .rating-group { gap: 8px; } .rating-option label { padding: 12px 6px; font-size: 11px; } }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="header-title">💬 Kritik & Saran</div>
            </div>
            <a href="<?php echo $baseUrl; ?>/landing.php" class="back-btn"><span>←</span> Kembali</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Kritik & Saran</h1>
                <p class="card-subtitle">Kami menghargai setiap masukan Anda untuk meningkatkan kualitas layanan kami.</p>
            </div>

            <form method="POST" id="feedbackForm">
                <div class="form-group">
                    <label for="saran">Kritik & Saran Anda:</label>
                    <textarea id="saran" name="saran" placeholder="Sampaikan kritik dan saran Anda untuk layanan chatbot kami..." required></textarea>
                </div>

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

                <button type="submit" class="btn">Kirim Kritik & Saran</button>
            </form>
        </div>
    </div>

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
            const submitBtn = form.querySelector('button[type="submit"]');
            
            // Disable button loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Mengirim...';
            
            // Submit form via AJAX
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Parse JSON response from PHP
            .then(data => {
                if (data.status === 'success') {
                    // Show popup only if success
                    popup.classList.add('show');
                    form.reset();
                } else {
                    alert('Gagal mengirim saran: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Kirim Kritik & Saran';
            });
        });

        // Back button event listener
        backBtn.addEventListener('click', function() {
            window.location.href = '<?php echo $baseUrl; ?>/landing.php';
        });
    </script>
</body>
</html>