<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . "/../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>DISCHA - Chatbot Layanan Disperindag</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/modern-light.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/assets/css/feedback-modal.css?v=<?php echo time(); ?>">
    <style>
        .chat-question-item:hover,
        .category-questions .chat-question-item:hover,
        button.chat-question-item:hover {
            background: #6366f1 !important;
            color: white !important;
            transform: translateX(2px) !important;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3) !important;
        }
        
        .all-question-item:hover,
        button.all-question-item:hover {
            background: #6366f1 !important;
            color: white !important;
            transform: translateX(4px) !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3) !important;
        }
        
        /* FORCE OVERRIDE STYLES - UX IMPROVEMENTS */
        .nav-cta {
            background: transparent !important;
            color: #6366f1 !important;
            border: 2px solid #6366f1 !important;
        }
        .nav-cta:hover {
            background: #6366f1 !important;
            color: white !important;
        }
        .hero-cta-btn {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            color: white !important;
            padding: 16px 32px !important;
            font-size: 16px !important;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4) !important;
        }
        .features-list {
            display: flex !important;
            flex-direction: column !important;
            gap: 20px !important;
        }
        .feature-item {
            display: flex !important;
            align-items: flex-start !important;
            gap: 16px !important;
            background: none !important;
            border: none !important;
            box-shadow: none !important;
        }
        .feature-icon {
            font-size: 20px !important;
        }
        .stat-icon {
            font-size: 18px !important;
            margin-bottom: 4px !important;
        }
        .stat-label {
            color: #374151 !important;
            font-weight: 500 !important;
        }
        .hero-image {
            filter: drop-shadow(0 10px 30px rgba(99, 102, 241, 0.3)) !important;
            width: 300px !important;
            height: 300px !important;
            transition: all 0.3s ease !important;
        }
        .hero-image:hover {
            transform: scale(1.05) !important;
        }
        .speech-bubble {
            position: absolute !important;
            top: -90px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            color: white !important;
            padding: 18px 24px !important;
            border-radius: 20px !important;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4) !important;
            opacity: 0 !important;
            visibility: hidden !important;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
            z-index: 1000 !important;
            min-width: 280px !important;
            max-width: 320px !important;
            text-align: center !important;
            white-space: normal !important;
        }
        .speech-bubble.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateX(-50%) translateY(-10px) !important;
        }
        .speech-text {
            font-size: 15px !important;
            line-height: 1.5 !important;
            font-weight: 500 !important;
            letter-spacing: 0.3px !important;
            word-spacing: 1px !important;
        }
        .speech-arrow {
            position: absolute !important;
            bottom: -8px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: 0 !important;
            height: 0 !important;
            border-left: 8px solid transparent !important;
            border-right: 8px solid transparent !important;
            border-top: 8px solid #8b5cf6 !important;
        }
    </style>"
    <style>
        /* Anti-spam notification animations */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }
        
        @keyframes slideOutUp {
            from {
                opacity: 1;
                transform: translate(-50%, 0);
            }
            to {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
        }
        
        /* Chat Suggestions Styles */
        .chat-suggestions {
            display: none;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            max-height: 120px;
            overflow-y: auto;
        }
        
        .chat-suggestions.show {
            display: block;
        }
        
        .suggestions-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        
        .suggestion-chip {
            display: inline-block;
            padding: 5px 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            font-size: 12px;
            color: #9CA3AF;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        
        .suggestion-chip:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #E5E7EB;
            border-color: rgba(255, 255, 255, 0.12);
        }
        
        /* Hero button position adjustment */
        .hero-cta {
            margin-top: 20px !important;
        }

        /* Mobile Responsive for Speech Bubble and Hero */
        @media (max-width: 768px) {
            .speech-bubble {
                min-width: 220px !important;
                max-width: 280px !important;
                padding: 14px 18px !important;
                font-size: 13px !important;
                top: -70px !important;
            }

            .speech-text {
                font-size: 13px !important;
                line-height: 1.4 !important;
            }

            .hero-image-card {
                margin-top: 20px;
            }

            .hero-image-glow {
                width: 200px;
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            .speech-bubble {
                min-width: 200px !important;
                max-width: 250px !important;
                padding: 12px 16px !important;
                font-size: 12px !important;
                top: -60px !important;
            }

            .speech-text {
                font-size: 12px !important;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-content">
            <div class="nav-logo">
            <img src="/assets/images/Discha-removebg-preview.png" alt="DISCHA" class="nav-logo-img">
                <div class="nav-logo-text">
                    <div class="nav-logo-main">DISCHA</div>
                    <div class="nav-logo-sub">Disperindag Jateng Chat Assistant</div>
                </div>
            </div>
            <div class="nav-links">
                <a href="#fitur">Fitur</a>
                <a href="#tutorial">Tutorial</a>
                <a href="#faq">FAQ</a>
                <a href="#" onclick="openChatModal(event)" class="nav-cta">Mulai Chat</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section - Asymmetric Layout -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-left">
                <div class="hero-badge">✨ Inovasi Digital Disperindag Jateng</div>
                <h1>Asisten Cerdas Siap Membantu Anda</h1>
                <p class="hero-subtitle">Dapatkan informasi lengkap tentang layanan, program UMKM, dan perizinan usaha dari Disperindag Jawa Tengah kapan saja, di mana saja.</p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-icon">🕰️</span>
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Selalu Tersedia</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">🎯</span>
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Tingkat Akurasi</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">⚡</span>
                        <span class="stat-number">&lt;2s</span>
                        <span class="stat-label">Waktu Respons</span>
                    </div>
                </div>

                <div class="hero-cta">
                    <a href="#" onclick="openChatModal(event)" class="hero-cta-btn">Mulai Chat Sekarang</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="hero-image-card">
                    <div class="hero-image-glow"></div>
                    <img src="/assets/images/Discha-removebg-preview.png" alt="DISCHA Bot" class="hero-image" ... >
                    <div id="dischaSpeechBubble" class="speech-bubble">
                        <div class="speech-text">
                            👋 Halo! Perkenalkan, aku DISCHA.<br>
                            Aku siap membantu kamu!
                        </div>
                        <div class="speech-arrow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="fitur">
        <div class="features-content">
            <div class="section-header">
                <h2 class="section-title">Fitur Unggulan</h2>
            </div>
            <div class="features-list">
                <div class="feature-item">
                    <span class="feature-icon">✅</span>
                    <div class="feature-text">
                        <h3>Respons Cepat</h3>
                        <p>Dapatkan jawaban instan untuk semua pertanyaan Anda</p>
                    </div>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✅</span>
                    <div class="feature-text">
                        <h3>Akurat & Terpercaya</h3>
                        <p>Informasi dari data resmi Disperindag Jawa Tengah</p>
                    </div>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✅</span>
                    <div class="feature-text">
                        <h3>Aman & Privat</h3>
                        <p>Keamanan data Anda adalah prioritas utama kami</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tutorial Section -->
    <section class="tutorial-section" id="tutorial">
        <div class="tutorial-content">
            <div class="section-header">
                <h2 class="section-title">Cara Menggunakan DISCHA</h2>
                <p class="section-subtitle">Ikuti langkah-langkah sederhana ini untuk mendapatkan informasi yang Anda butuhkan</p>
            </div>
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4>Mulai Chat</h4>
                    <p>Klik tombol "Mulai Chat Sekarang" untuk membuka jendela percakapan dengan DISCHA.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4>Pilih Pertanyaan</h4>
                    <p>Anda bisa memilih dari pertanyaan yang tersedia atau mengetik pertanyaan Anda sendiri.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4>Dapatkan Jawaban</h4>
                    <p>DISCHA akan segera memberikan jawaban yang akurat dan lengkap untuk pertanyaan Anda.</p>
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
                <p class="section-subtitle">Temukan jawaban atas pertanyaan yang sering diajukan tentang DISCHA</p>
            </div>
            <div class="faq-items">
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apa itu DISCHA?</span>
                    </div>
                    <p class="faq-answer">DISCHA adalah chatbot cerdas yang dikembangkan oleh Disperindag Jawa Tengah untuk memberikan informasi terkini tentang layanan, program UMKM, dan perizinan usaha. DISCHA tersedia 24/7 untuk membantu Anda.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apakah DISCHA benar-benar tersedia 24/7?</span>
                    </div>
                    <p class="faq-answer">Ya! DISCHA dapat diakses kapan saja, 24 jam sehari, 7 hari seminggu. Anda tidak perlu menunggu jam kerja kantor untuk mendapatkan informasi yang dibutuhkan.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Informasi apa yang bisa saya dapatkan dari DISCHA?</span>
                    </div>
                    <p class="faq-answer">DISCHA menyediakan informasi tentang jam operasional, lokasi kantor, program UMKM, proses perizinan usaha, layanan Disperindag, dan berbagai pertanyaan lain terkait dengan industri dan perdagangan.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Bagaimana jika saya tidak menemukan jawaban yang saya cari?</span>
                    </div>
                    <p class="faq-answer">Jika DISCHA tidak dapat menjawab pertanyaan Anda, coba rephrase pertanyaan dengan kata-kata yang berbeda atau kunjungi kantor Disperindag secara langsung untuk bantuan lebih lanjut.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apakah informasi dari DISCHA akurat?</span>
                    </div>
                    <p class="faq-answer">Semua informasi yang diberikan DISCHA bersumber dari database resmi Disperindag Jawa Tengah dan diperbarui secara berkala untuk memastikan akurasi dan relevansi.</p>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <div class="faq-icon">?</div>
                        <span>Apakah data saya aman?</span>
                    </div>
                    <p class="faq-answer">Ya, keamanan data Anda adalah prioritas utama kami. Semua interaksi dengan DISCHA dilindungi dengan standar keamanan tinggi untuk menjaga privasi Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Chat Modal -->
    <div id="chatModal" class="chat-modal">
        <div class="chat-modal-content">
            <!-- Left Sidebar - Questions -->
            <div class="chat-questions-sidebar">
                <h4>Pertanyaan Populer</h4>
                <div class="chat-questions-list" id="chatQuestionsList">
                    <!-- Questions loaded here -->
                </div>
                <button class="view-all-btn-sidebar" onclick="loadAllQuestions()">Lihat Semua Pertanyaan</button>
            </div>
            
            <!-- Mobile Floating Button for Questions -->
            <button class="mobile-questions-btn" onclick="loadAllQuestions()">
                📋 Lihat Semua Pertanyaan
            </button>

            <!-- Right Container - Chat -->
            <div class="chat-right-container">
                <!-- Header -->
                <div class="chat-header">
                    <div class="chat-header-left">
                        <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA" class="chat-avatar">
                        <div class="chat-info">
                            <h3 class="chat-name">DISCHA</h3>
                            <span class="chat-status">Online 24/7</span>
                        </div>
                    </div>
                    <button class="finish-btn" onclick="openFeedbackModal()" title="Tutup chat dan kirim feedback">
                        <span class="finish-btn-text">Selesai</span>
                        <span class="finish-btn-icon">✓</span>
                    </button>
                </div>

                <!-- Messages Area -->
                <div class="chat-messages" id="chatMessages">
                    <div class="message bot-msg">
                        <div class="msg-content">Halo! 👋 Ada yang bisa saya bantu?</div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="chat-input-area">
                    <!-- Suggestions Container -->
                    <div id="chatSuggestions" class="chat-suggestions">
                        <div id="suggestionsList" class="suggestions-list"></div>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" id="pesan" class="chat-input" placeholder="Tanya sesuatu..." autocomplete="off" onkeypress="handleChatKeypress(event)">
                        <button class="send-btn" onclick="sendChatMessage()">➤</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feedback Modal -->
    <div id="feedbackModal">
        <div class="feedback-modal-overlay" onclick="closeFeedbackModal()"></div>
        <div class="feedback-modal-content">
            <div class="feedback-header">
                <h3>Umpan Balik Anda</h3>
            </div>
            <form id="feedbackForm" onsubmit="submitFeedback(event)">
                <div class="form-group">
                    <label for="feedbackName">Nama (Opsional)</label>
                    <input type="text" id="feedbackName" name="name" placeholder="Masukkan nama Anda">
                </div>
                <div class="form-group">
                    <label for="feedbackEmail">Email (Opsional)</label>
                    <input type="email" id="feedbackEmail" name="email" placeholder="masukkan@email.anda">
                </div>
                <div class="form-group">
                    <label for="feedbackMessage">Umpan Balik <span class="required">*</span></label>
                    <textarea id="feedbackMessage" name="message" placeholder="Bagikan umpan balik Anda..." required></textarea>
                </div>
                <div class="form-group">
                    <label>Kepuasan</label>
                    <div class="rating-group-modal">
                        <input type="radio" name="rating" value="5" id="rating5m">
                        <label for="rating5m">😍</label>
                        <input type="radio" name="rating" value="4" id="rating4m">
                        <label for="rating4m">😊</label>
                        <input type="radio" name="rating" value="3" id="rating3m">
                        <label for="rating3m">😐</label>
                        <input type="radio" name="rating" value="2" id="rating2m">
                        <label for="rating2m">😕</label>
                        <input type="radio" name="rating" value="1" id="rating1m">
                        <label for="rating1m">😞</label>
                    </div>
                </div>
                <div class="form-actions-modal">
                    <button type="submit" class="btn-submit-modal">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <!-- All Questions Modal -->
    <div id="allQuestionsModal" class="questions-modal">
        <div class="questions-modal-content">
            <div class="questions-header">
                <h3>📋 Daftar Pertanyaan</h3>
                <button class="close-btn" onclick="closeAllQuestionsModal()">✕</button>
            </div>
            <div class="questions-grid" id="allQuestionsList">
                <!-- Questions loaded here -->
            </div>
        </div>
    </div>

    <!-- Floating Chat Button -->
    <button class="floating-chat-btn" onclick="openChatModal()" title="Buka Chat">
        <span class="chat-bubble-icon">💬</span>
    </button>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 DISCHA Chatbot - Dinas Perindustrian dan Perdagangan Jawa Tengah. Semua hak dilindungi.</p>
    </footer>

    <script>
        console.log('🚀 Landing.php script loaded');
        
        // Modal Functions - Defined at global scope
        function openChatModal(e) {
            console.log('💬 Opening modal...');
            if (e) e.preventDefault();
            const modal = document.getElementById('chatModal');
            if (modal) {
                modal.classList.add('open');
                document.body.style.overflow = 'hidden';
                loadTemplateSuggestions();
                
                // Show mobile button if on mobile device
                setTimeout(() => {
                    const mobileBtn = document.querySelector('.mobile-questions-btn');
                    if (mobileBtn && window.innerWidth <= 768) {
                        mobileBtn.style.display = 'flex';
                    }
                }, 100);
                
                setTimeout(() => {
                    const input = document.getElementById('pesan');
                    if (input) input.focus();
                    initChatSuggestions();
                    console.log('✓ Modal ready');
                }, 150);
            }
        }

        function closeChatModal() {
            const modal = document.getElementById('chatModal');
            if (modal) {
                modal.classList.remove('open');
                document.body.style.overflow = 'auto';
                
                // Hide mobile button when chat modal closes
                const mobileBtn = document.querySelector('.mobile-questions-btn');
                if (mobileBtn) {
                    mobileBtn.style.display = 'none';
                }
            }
            closeAllQuestionsModal();
        }

        function openFeedbackModal() {
            console.log('Opening feedback modal');
            closeChatModal();
            const feedbackModal = document.getElementById('feedbackModal');
            if (feedbackModal) {
                feedbackModal.style.display = 'flex';
                feedbackModal.style.visibility = 'visible';
                feedbackModal.style.opacity = '1';
                console.log('Feedback modal displayed - display:', feedbackModal.style.display);
                console.log('Feedback modal element:', feedbackModal);
            } else {
                console.error('Feedback modal element not found!');
            }
        }

        function closeFeedbackModal() {
            console.log('Closing feedback modal');
            const feedbackModal = document.getElementById('feedbackModal');
            if (feedbackModal) {
                feedbackModal.style.display = 'none';
                feedbackModal.style.visibility = 'hidden';
                feedbackModal.style.opacity = '0';
            }
            const form = document.getElementById('feedbackForm');
            if (form) form.reset();
        }

        // DISCHA Interactive Speech
        let speechTimeout;
        function toggleDischaSpeech() {
            const bubble = document.getElementById('dischaSpeechBubble');
            
            // Clear any existing timeout
            if (speechTimeout) {
                clearTimeout(speechTimeout);
            }
            
            // Show speech bubble
            bubble.classList.add('show');
            
            // Hide after 4 seconds
            speechTimeout = setTimeout(() => {
                bubble.classList.remove('show');
            }, 4000);
        }
        
        // Auto show speech bubble on page load (optional)
        window.addEventListener('load', () => {
            setTimeout(() => {
                toggleDischaSpeech();
            }, 2000);
        });

        // Load template suggestions from API with categories
        function loadTemplateSuggestions() {
            fetch('/public/get-templates.php')
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('chatQuestionsList');
                    container.innerHTML = '';
                    
                    if (!data || !data.categories || data.categories.length === 0) {
                        container.innerHTML = '<p style="color: var(--text-muted); font-size: 11px; text-align: center;">Tidak ada pertanyaan</p>';
                        return;
                    }
                    
                    data.categories.forEach((category, index) => {
                        // Create category container
                        const categoryDiv = document.createElement('div');
                        categoryDiv.className = 'question-category';
                        
                        // Create category header
                        const categoryHeader = document.createElement('button');
                        categoryHeader.className = 'category-header';
                        categoryHeader.innerHTML = `
                            <span class="category-title">${category.name}</span>
                            <span class="category-count">(${category.count})</span>
                            <span class="category-arrow">▼</span>
                        `;
                        
                        // Create questions container
                        const questionsContainer = document.createElement('div');
                        questionsContainer.className = 'category-questions';
                        questionsContainer.style.display = index === 0 ? 'block' : 'none'; // First category expanded by default
                        
                        // Add questions
                        category.questions.forEach(question => {
                            const btn = document.createElement('button');
                            btn.className = 'chat-question-item';
                            btn.textContent = question;
                            btn.onclick = () => sendMessage(question);
                            
                            // Set initial style
                            btn.style.background = '#F9FAFB';
                            btn.style.color = '#1F2937';
                            
                            // Force hover effects
                            btn.onmouseover = function() {
                                this.style.background = '#6366f1';
                                this.style.color = 'white';
                                this.style.transform = 'translateX(2px)';
                                this.style.boxShadow = '0 2px 8px rgba(99, 102, 241, 0.3)';
                            };
                            btn.onmouseout = function() {
                                this.style.background = '#F9FAFB';
                                this.style.color = '#1F2937';
                                this.style.transform = 'translateX(0)';
                                this.style.boxShadow = 'none';
                            };
                            
                            questionsContainer.appendChild(btn);
                        });
                        
                        // Toggle functionality
                        categoryHeader.onclick = () => {
                            const isVisible = questionsContainer.style.display === 'block';
                            questionsContainer.style.display = isVisible ? 'none' : 'block';
                            categoryHeader.querySelector('.category-arrow').textContent = isVisible ? '▶' : '▼';
                            categoryHeader.classList.toggle('collapsed', isVisible);
                        };
                        
                        categoryDiv.appendChild(categoryHeader);
                        categoryDiv.appendChild(questionsContainer);
                        container.appendChild(categoryDiv);
                    });
                    
                    // Collect all questions for suggestions
                    const allQuestions = data.categories.flatMap(cat => cat.questions);
                    window.allQuestionsForSuggest = allQuestions;
                })
                .catch(err => {
                    console.error('Error loading templates:', err);
                    document.getElementById('chatQuestionsList').innerHTML = 
                        '<p style="color: var(--error-color); font-size: 11px; text-align: center;">Error loading templates</p>';
                });
        }

        // Load all questions from API with categories
        function loadAllQuestions() {
            console.log('🔄 Loading all questions...');
            console.log('📍 Fetching from:', '/public/get-all-questions.php');
            
            
            // Hide mobile button when modal opens
            const mobileBtn = document.querySelector('.mobile-questions-btn');
            if (mobileBtn) {
                mobileBtn.style.display = 'none';
            }
            
            fetch('/public/get-all-questions.php')
                .then(res => {
                    console.log('📡 Response status:', res.status);
                    return res.json();
                })
                .then(data => {
                    console.log('📊 Data received:', data);
                    
                    const container = document.getElementById('allQuestionsList');
                    if (!container) {
                        console.error('❌ Container allQuestionsList not found!');
                        return;
                    }
                    
                    container.innerHTML = '';
                    
                    if (!data || !data.categories || data.categories.length === 0) {
                        container.innerHTML = '<p>Tidak ada pertanyaan tersedia</p>';
                        return;
                    }
                    
                    console.log(`📋 Creating ${data.categories.length} categories...`);
                    
                    // Create categories with expand/collapse
                    data.categories.forEach((category, index) => {
                        // Create category container
                        const categoryDiv = document.createElement('div');
                        categoryDiv.className = 'all-question-category';
                        
                        // Create category header
                        const categoryHeader = document.createElement('button');
                        categoryHeader.className = 'all-category-header';
                        if (index === 0) categoryHeader.classList.add('expanded'); // First category expanded by default
                        
                        categoryHeader.innerHTML = `
                            <span class="all-category-title">${category.name}</span>
                            <span class="all-category-count">(${category.count} pertanyaan)</span>
                            <span class="all-category-arrow">${index === 0 ? '▼' : '▶'}</span>
                        `;
                        
                        // Create questions container
                        const questionsContainer = document.createElement('div');
                        questionsContainer.className = 'all-category-questions';
                        questionsContainer.style.cssText = `
                            padding: ${index === 0 ? '12px' : '0 12px'};
                            max-height: ${index === 0 ? '300px' : '0'};
                        `;
                        
                        // Add questions
                        category.questions.forEach(question => {
                            const btn = document.createElement('button');
                            btn.className = 'all-question-item';
                            btn.textContent = question;
                            
                            btn.onclick = () => {
                                sendMessage(question);
                                closeAllQuestionsModal();
                                focusChatInput();
                            };
                            
                            // Set initial style
                            btn.style.background = '#FFFFFF';
                            btn.style.color = '#1F2937';
                            
                            // Force hover effects
                            btn.onmouseover = function() {
                                this.style.background = '#6366f1';
                                this.style.color = 'white';
                                this.style.transform = 'translateX(4px)';
                                this.style.boxShadow = '0 4px 12px rgba(99, 102, 241, 0.3)';
                            };
                            btn.onmouseout = function() {
                                this.style.background = '#FFFFFF';
                                this.style.color = '#1F2937';
                                this.style.transform = 'translateX(0)';
                                this.style.boxShadow = 'none';
                            };
                            
                            questionsContainer.appendChild(btn);
                        });
                        
                        // Toggle functionality
                        categoryHeader.onclick = () => {
                            const isExpanded = questionsContainer.style.maxHeight !== '0px';
                            const arrow = categoryHeader.querySelector('.all-category-arrow');
                            
                            if (isExpanded) {
                                // Collapse
                                questionsContainer.style.maxHeight = '0px';
                                questionsContainer.style.padding = '0 12px';
                                arrow.textContent = '▶';
                                categoryHeader.classList.remove('expanded');
                            } else {
                                // Expand
                                questionsContainer.style.maxHeight = '300px';
                                questionsContainer.style.padding = '12px';
                                arrow.textContent = '▼';
                                categoryHeader.classList.add('expanded');
                            }
                        };
                        
                        // Hover effects for collapsed categories only
                        categoryHeader.onmouseover = () => {
                            if (!categoryHeader.classList.contains('expanded')) {
                                categoryHeader.style.background = 'var(--primary-light)';
                                categoryHeader.style.color = 'white';
                            }
                        };
                        
                        categoryHeader.onmouseout = () => {
                            if (!categoryHeader.classList.contains('expanded')) {
                                categoryHeader.style.background = 'var(--bg-tertiary)';
                                categoryHeader.style.color = 'var(--text-primary)';
                            }
                        };
                        
                        categoryDiv.appendChild(categoryHeader);
                        categoryDiv.appendChild(questionsContainer);
                        container.appendChild(categoryDiv);
                    });
                    
                    console.log('✅ Categories created, opening modal...');
                    const modal = document.getElementById('allQuestionsModal');
                    if (modal) {
                        modal.classList.add('open');
                        console.log('✅ Modal opened!');
                    } else {
                        console.error('❌ Modal allQuestionsModal not found!');
                    }
                })
                .catch(err => {
                    console.error('❌ Error loading all questions:', err);
                    const container = document.getElementById('allQuestionsList');
                    if (container) {
                        container.innerHTML = '<p style="color: var(--danger); text-align: center;">Error memuat pertanyaan: ' + err.message + '</p>';
                    }
                });
        }

        function closeAllQuestionsModal() {
            document.getElementById('allQuestionsModal').classList.remove('open');
            
            // Show mobile button again when modal closes
            const mobileBtn = document.querySelector('.mobile-questions-btn');
            if (mobileBtn && window.innerWidth <= 768) {
                mobileBtn.style.display = 'flex';
            }
        }

        function focusChatInput() {
            document.getElementById('chatInput').focus();
        }

        // Feedback Submission
        function submitFeedback(e) {
            e.preventDefault();
            const name = document.getElementById('feedbackName').value.trim() || 'Anonim';
            const email = document.getElementById('feedbackEmail').value.trim();
            const message = document.getElementById('feedbackMessage').value.trim();
            const rating = document.querySelector('input[name="rating"]:checked')?.value || 0;
            
            if (!message) {
                alert('Mohon isi umpan balik Anda');
                return;
            }
            
            // Send feedback to server
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('saran', message);
            formData.append('rating', rating);
            
            fetch('feedback.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    closeFeedbackModal();
                    showSuccessNotification();
                } else {
                    alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Maaf, terjadi kesalahan saat mengirim umpan balik.');
            });
        }

        function showSuccessNotification() {
            // Create success popup
            const successDiv = document.createElement('div');
            successDiv.style.cssText = `
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: linear-gradient(135deg, #10B981 0%, #059669 100%);
                color: white;
                padding: 20px 30px;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
                z-index: 3000;
                animation: slideInUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
                max-width: 400px;
                font-weight: 600;
                font-size: 14px;
            `;
            
            successDiv.innerHTML = `
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 20px;">✓</span>
                    <div>
                        <div style="font-weight: 700; margin-bottom: 4px;">Terima Kasih!</div>
                        <div style="font-size: 12px; opacity: 0.9;">Umpan balik Anda telah kami terima</div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(successDiv);
            
            setTimeout(() => {
                successDiv.style.animation = 'slideOutDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards';
                setTimeout(() => successDiv.remove(), 400);
            }, 4000);
        }

        // Chat Functions
        function sendChatMessage() {
            const input = document.getElementById('pesan');
            const message = input.value.trim();
            if (message) {
                sendMessage(message);
                input.value = '';
                // Hide suggestions saat kirim
                const suggestionsContainer = document.getElementById('chatSuggestions');
                if (suggestionsContainer) {
                    suggestionsContainer.classList.remove('show');
                }
                input.focus();
            }
        }

        function handleChatKeypress(e) {
            if (e.key === 'Enter') {
                sendChatMessage();
            }
        }

        // Load template questions function
        function loadTemplateQuestions() {
            console.log('📡 Loading questions...');
            fetch('get-all-questions.php')
                .then(response => response.json())
                .then(questions => {
                    console.log('✓ Loaded ' + questions.length + ' questions');
                    window.chatTemplates = questions;
                })
                .catch(error => console.error('✗ Error:', error));
        }
        
        // Update suggestions display
        function updateSuggestions(templates) {
            const list = document.getElementById('suggestionsList');
            if (!list) return;
            list.innerHTML = '';
            templates.forEach(t => {
                const chip = document.createElement('div');
                chip.className = 'suggestion-chip';
                chip.textContent = t.question;
                chip.onclick = () => {
                    document.getElementById('pesan').value = t.question;
                    document.getElementById('chatSuggestions').classList.remove('show');
                };
                list.appendChild(chip);
            });
        }
        
        // Initialize suggestions
        function initChatSuggestions() {
            console.log('🚀 Init suggestions');
            
            if (window.suggestionsInitialized) return;
            
            const input = document.getElementById('pesan');
            const box = document.getElementById('chatSuggestions');
            
            if (!input || !box) {
                console.error('❌ Elements not found');
                return;
            }
            
            console.log('✓ Elements ready');
            
            input.addEventListener('input', function() {
                const q = this.value.trim().toLowerCase();
                if (!q) {
                    box.classList.remove('show');
                    return;
                }
                if (window.chatTemplates) {
                    const filtered = window.chatTemplates.filter(t => t.question.toLowerCase().includes(q));
                    console.log(q + ' → ' + filtered.length);
                    if (filtered.length > 0) {
                        updateSuggestions(filtered.slice(0, 8));
                        box.classList.add('show');
                    } else {
                        box.classList.remove('show');
                    }
                }
            });
            
            input.addEventListener('blur', () => setTimeout(() => box.classList.remove('show'), 200));
            
            window.suggestionsInitialized = true;
            loadTemplateQuestions();
        }

        function sendMessage(message) {
            const chatMessages = document.getElementById('chatMessages');
            const sendButton = document.querySelector('.chat-send-btn');
            const chatInput = document.getElementById('pesan');
            
            // Anti-spam: Check cooldown
            const now = Date.now();
            const cooldownTime = 2000; // 2 detik
            
            if (window.lastMessageTime && (now - window.lastMessageTime) < cooldownTime) {
                const remainingTime = Math.ceil((cooldownTime - (now - window.lastMessageTime)) / 1000);
                
                // Show cooldown notification
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: rgba(255, 87, 34, 0.95);
                    color: white;
                    padding: 12px 24px;
                    border-radius: 8px;
                    font-size: 14px;
                    font-weight: 600;
                    z-index: 10000;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
                    animation: slideInDown 0.3s ease;
                `;
                notification.textContent = `⏳ Tunggu ${remainingTime} detik sebelum mengirim pesan lagi`;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.animation = 'slideOutUp 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 1500);
                
                return;
            }
            
            // Disable send button & input
            if (sendButton) sendButton.disabled = true;
            if (chatInput) chatInput.disabled = true;
            
            // Update last message time
            window.lastMessageTime = now;
            
            // Add user message
            const userMsgDiv = document.createElement('div');
            userMsgDiv.className = 'message user-msg';
            userMsgDiv.innerHTML = `<div class="msg-content">${escapeHtml(message)}</div>`;
            chatMessages.appendChild(userMsgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Create bot message div with typing indicator
            const botMsgDiv = document.createElement('div');
            botMsgDiv.className = 'message bot-msg';
            botMsgDiv.innerHTML = `<div class="msg-content typing-indicator"><span></span><span></span><span></span></div>`;
            chatMessages.appendChild(botMsgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Send to server
            fetch('/public/proses.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'pesan=' + encodeURIComponent(message)
            })
            .then(res => res.text())
            .then(data => {
                // Re-enable send button & input
                if (sendButton) sendButton.disabled = false;
                if (chatInput) chatInput.disabled = false;
                if (data && data.trim()) {
                    // Typing animation dengan character reveal
                    const fullText = data.trim();
                    const messageContent = botMsgDiv.querySelector('.msg-content');
                    messageContent.innerHTML = '';
                    messageContent.classList.remove('typing-indicator');
                    
                    let charIndex = 0;
                    const typingSpeed = 20; // ms per character
                    
                    function typeText() {
                        if (charIndex < fullText.length) {
                            messageContent.innerHTML = linkifyText(fullText.substring(0, charIndex + 1));
                            charIndex++;
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                            setTimeout(typeText, typingSpeed);
                        }
                    }
                    
                    typeText();
                } else {
                    botMsgDiv.innerHTML = `<div class="msg-content">Maaf, saya tidak dapat menjawab pertanyaan tersebut. Silakan coba dengan pertanyaan lain.</div>`;
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            })
            .catch(err => {
                // Re-enable send button & input on error
                if (sendButton) sendButton.disabled = false;
                if (chatInput) chatInput.disabled = false;
                
                console.error('Error:', err);
                botMsgDiv.innerHTML = `<div class="msg-content">Maaf, terjadi kesalahan koneksi. Silakan periksa koneksi internet Anda dan coba lagi.</div>`;
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Convert URLs to clickable links while preserving line breaks and escaping other HTML
        function linkifyText(text) {
            // First escape HTML
            let safe = escapeHtml(text);
            
            // Convert line breaks to <br>
            safe = safe.replace(/\n/g, '<br>');
            
            // URL regex pattern - matches http:// and https://
            const urlPattern = /(https?:\/\/[^\s<>"]+)/gi;
            
            // Replace URLs with clickable links
            safe = safe.replace(urlPattern, function(url) {
                // Clean up URL (remove trailing punctuation if any)
                let cleanUrl = url.replace(/[.,;!?)]$/, '');
                
                return `<a href="${cleanUrl}" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline; word-break: break-all; overflow-wrap: anywhere;">${cleanUrl}</a>`;
            });
            
            return safe;
        }



        // Initialize event listeners when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing...');
            
            const chatModal = document.getElementById('chatModal');
            const feedbackModal = document.getElementById('feedbackModal');
            
            if (chatModal) {
                chatModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeChatModal();
                    }
                });
            }

            if (feedbackModal) {
                feedbackModal.addEventListener('click', function(e) {
                    if (e.target === this || e.target.classList.contains('feedback-modal-overlay')) {
                        closeFeedbackModal();
                    }
                });
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    if (this.getAttribute('href') !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
