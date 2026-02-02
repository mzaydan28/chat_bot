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
    <title>Mulai Chat - NUSA Chatbot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Sora:wght@600;700;800&display=swap\" rel=\"stylesheet\">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/../assets/css/style.combined.css">
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
            font-family: 'Cabinet Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
            letter-spacing: -0.3px;
            letter-spacing: -0.4px;
            overflow: hidden;
        }

        .gradient-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 50%, rgba(79, 172, 254, 0.15) 100%);
            backdrop-filter: blur(50px);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 20px;
        }

        .chat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 60px 50px;
            max-width: 550px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: slide-up 0.8s ease-out;
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bot-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            animation: float 3s ease-in-out infinite;
            overflow: hidden;
        }

        .bot-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        h1 {
            font-family: 'Sora', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 12px;
            line-height: 1.2;
            letter-spacing: -0.8px;
        }

        .subtitle {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 40px;
            line-height: 1.7;
            font-weight: 400;
            letter-spacing: -0.3px;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 40px;
            text-align: left;
            padding: 20px 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: #4a5568;
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }

        .feature-text {
            flex: 1;
        }

        .cta-buttons {
            display: flex;
            gap: 12px;
            margin-top: 40px;
        }

        .btn-primary, .btn-secondary {
            flex: 1;
            padding: 16px 30px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
        }

        .btn-primary:active {
            transform: translateY(-1px);
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

        .btn-secondary:active {
            transform: translateY(-1px);
        }

        .search-section {
            margin-bottom: 30px;
        }

        .search-input-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        .search-input {
            width: 100%;
            padding: 14px 16px 14px 40px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Cabinet Grotesk', sans-serif;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
        }

        .search-results {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: white;
            display: none;
        }

        .search-results.active {
            display: block;
        }

        .search-result-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
            color: #334155;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background: #f0f4ff;
            color: #667eea;
            padding-left: 20px;
        }

        .search-no-results {
            padding: 16px;
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
        }

        .info-text {
            margin-top: 20px;
            font-size: 12px;
            color: #a0aec0;
        }

        @media (max-width: 768px) {
            .chat-card {
                padding: 40px 30px;
                border-radius: 25px;
            }

            h1 {
                font-size: 28px;
            }

            .subtitle {
                font-size: 14px;
            }

            .bot-icon {
                width: 100px;
                height: 100px;
                font-size: 50px;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .features-list {
                padding: 15px 0;
            }

            .feature-item {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .chat-card {
                padding: 30px 20px;
                border-radius: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .subtitle {
                font-size: 13px;
            }

            .bot-icon {
                width: 80px;
                height: 80px;
                font-size: 40px;
                margin-bottom: 20px;
            }

            .btn-primary, .btn-secondary {
                padding: 14px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="gradient-bg"></div>
    
    <div class="container">
        <div class="chat-card">
            <div class="bot-icon">
                <img src="<?php echo $baseUrl; ?>/../assets/images/bot.png.png" alt="NUSA Bot">
            </div>

            <h1>Halo! 👋</h1>
            <p class="subtitle">
                Kami siap membantu Anda dengan informasi tentang UMKM, program, dan layanan Disperindag.
            </p>

            <div class="search-section">
                <div class="search-input-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" class="search-input" id="searchInput" placeholder="Cari pertanyaan...">
                </div>
                <div class="search-results" id="searchResults"></div>
            </div>

            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div class="feature-text"><strong>Respon Cepat</strong> - Jawaban instan 24/7</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div class="feature-text"><strong>Akurat</strong> - Informasi dari database terpercaya</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div class="feature-text"><strong>Mudah</strong> - Interface yang user-friendly</div>
                </div>
            </div>

            <div class="cta-buttons">
                <a href="<?php echo $baseUrl; ?>/chat.php" class="btn-primary">
                    Mulai Chat Sekarang →
                </a>
                <a href="<?php echo $baseUrl; ?>/landing.php" class="btn-secondary">
                    Kembali
                </a>
            </div>

            <p class="info-text">
                💬 Berbicara dengan NUSA Chatbot Anda
            </p>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        let allQuestions = [];

        // Load all questions on page load
        async function loadAllQuestions() {
            try {
                const baseUrl = '<?php echo $baseUrl; ?>';
                const response = await fetch(`${baseUrl}/get-all-questions.php`);
                const data = await response.json();
                if (data.success) {
                    allQuestions = data.questions;
                }
            } catch (error) {
                console.error('Error loading questions:', error);
            }
        }

        // Search functionality
        function searchQuestions(query) {
            const trimmedQuery = query.trim().toLowerCase();

            if (trimmedQuery.length === 0) {
                searchResults.classList.remove('active');
                return;
            }

            const results = allQuestions.filter(q => 
                q.toLowerCase().includes(trimmedQuery)
            ).slice(0, 8);

            if (results.length === 0) {
                searchResults.innerHTML = '<div class="search-no-results">Tidak ada hasil ditemukan</div>';
                searchResults.classList.add('active');
                return;
            }

            searchResults.innerHTML = results.map(q => 
                `<div class="search-result-item" onclick="goToChat('${q.replace(/'/g, "\\'")}')">${q}</div>`
            ).join('');

            searchResults.classList.add('active');
        }

        // Navigate to chat with selected question
        function goToChat(question) {
            const baseUrl = '<?php echo $baseUrl; ?>';
            window.location.href = `${baseUrl}/chat.php?q=${encodeURIComponent(question)}`;
        }

        // Event listeners
        searchInput.addEventListener('input', (e) => {
            searchQuestions(e.target.value);
        });

        // Close search results when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-section')) {
                searchResults.classList.remove('active');
            }
        });

        // Load questions on page load
        window.addEventListener('load', loadAllQuestions);
    </script>
</body>
</html>
