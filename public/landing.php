
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
    <title>DISCHA - Chatbot Layanan Disperindag</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/../assets/css/glassmorphism.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/../assets/css/feedback-modal.css">
    <style>
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
            margin-top: -40px !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-content">
            <div class="nav-logo">
                <img src="<?php echo $baseUrl; ?>/../assets/images/Discha.png" alt="DISCHA" class="nav-logo-img">
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
            <div class="nav-view-toggle">
                <button class="view-toggle-btn" onclick="toggleViewMode()" title="Toggle Mobile/Desktop View">
                    <span class="toggle-icon">📱</span>
                    <span class="toggle-label">Desktop</span>
                </button>
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
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Tersedia</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Akurat</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">&lt;2s</span>
                        <span class="stat-label">Respons</span>
                    </div>
                </div>

                <div class="hero-cta">
                    <a href="#" onclick="openChatModal(event)" class="nav-cta">Mulai Chat</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="hero-image-card">
                    <div class="hero-image-glow"></div>
                    <img src="<?php echo $baseUrl; ?>/../assets/images/Discha.png" alt="DISCHA Bot" class="hero-image">
                </div>
                
                <div class="hero-features-quick">
                    <div class="quick-feature">
                        <div>Respon Instan</div>
                    </div>
                    <div class="quick-feature">
                        <div>Akurat & Tepat</div>
                    </div>
                    <div class="quick-feature">
                        <div>Aman Terjamin</div>
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
            <div class="features-grid">
                <div class="feature-card">
                    <h3>Respons Cepat</h3>
                    <p>Dapatkan jawaban instan untuk semua pertanyaan Anda</p>
                </div>
                <div class="feature-card">
                    <h3>Akurat & Terpercaya</h3>
                    <p>Informasi dari data resmi Disperindag Jawa Tengah</p>
                </div>
                <div class="feature-card">
                    <h3>Aman & Privat</h3>
                    <p>Keamanan data Anda adalah prioritas utama kami</p>
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

            <!-- Right Container - Chat -->
            <div class="chat-right-container">
                <!-- Header -->
                <div class="chat-header">
                    <div class="chat-header-left">
                        <img src="<?php echo $baseUrl; ?>/../assets/images/Discha.png" alt="DISCHA" class="chat-avatar">
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
                <button class="feedback-close-btn" onclick="closeFeedbackModal()" type="button">✕</button>
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
                    <button type="button" class="btn-cancel-modal" onclick="closeFeedbackModal()">Batal</button>
                    <button type="submit" class="btn-submit-modal">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <!-- All Questions Modal -->
    <div id="allQuestionsModal" class="questions-modal">
        <div class="questions-modal-content">
            <div class="questions-header">
                <h3>Semua Pertanyaan</h3>
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

        let currentViewMode = 'desktop'; // default desktop

        // View Mode Toggle Function
        function toggleViewMode() {
            const body = document.body;
            const btn = document.querySelector('.view-toggle-btn');
            const label = btn.querySelector('.toggle-label');
            const icon = btn.querySelector('.toggle-icon');
            
            if (currentViewMode === 'desktop') {
                currentViewMode = 'mobile';
                body.classList.add('mobile-view');
                body.classList.remove('desktop-view');
                label.textContent = 'Mobile';
                icon.textContent = '🖥️';
                localStorage.setItem('viewMode', 'mobile');
            } else {
                currentViewMode = 'desktop';
                body.classList.remove('mobile-view');
                body.classList.add('desktop-view');
                label.textContent = 'Desktop';
                icon.textContent = '📱';
                localStorage.setItem('viewMode', 'desktop');
            }
        }

        // Restore view mode from localStorage
        function restoreViewMode() {
            const saved = localStorage.getItem('viewMode') || 'desktop';
            const body = document.body;
            const btn = document.querySelector('.view-toggle-btn');
            const label = btn.querySelector('.toggle-label');
            const icon = btn.querySelector('.toggle-icon');
            
            currentViewMode = saved;
            if (saved === 'mobile') {
                body.classList.add('mobile-view');
                label.textContent = 'Mobile';
                icon.textContent = '🖥️';
            } else {
                body.classList.add('desktop-view');
                label.textContent = 'Desktop';
                icon.textContent = '📱';
            }
        }

        // Call restore on page load
        window.addEventListener('load', restoreViewMode);

        // Load template suggestions from API
        function loadTemplateSuggestions() {
            fetch('<?php echo $baseUrl; ?>/get-templates.php')
                .then(res => res.json())
                .then(templates => {
                    const container = document.getElementById('chatQuestionsList');
                    container.innerHTML = '';
                    
                    if (!templates || templates.length === 0) {
                        container.innerHTML = '<p style="color: var(--text-muted); font-size: 11px; text-align: center;">Tidak ada pertanyaan</p>';
                        return;
                    }
                    
                    templates.forEach(template => {
                        const btn = document.createElement('button');
                        btn.className = 'chat-question-item';
                        btn.textContent = template.question;
                        btn.onclick = () => sendMessage(template.question);
                        container.appendChild(btn);
                    });
                        // Simpan semua pertanyaan untuk suggested question
                        window.allQuestionsForSuggest = templates.map(t => t.question);
                })
                .catch(err => {
                    console.error('Error loading templates:', err);
                });
        }

        // Load all questions from API
        function loadAllQuestions() {
            fetch('<?php echo $baseUrl; ?>/get-all-questions.php')
                .then(res => res.json())
                .then(questions => {
                    const container = document.getElementById('allQuestionsList');
                    container.innerHTML = '';
                    
                    if (!questions || questions.length === 0) {
                        container.innerHTML = '<p>Tidak ada pertanyaan tersedia</p>';
                        return;
                    }
                    
                    questions.forEach(question => {
                        const item = document.createElement('button');
                        item.className = 'all-question-item';
                        item.textContent = question.question;
                        item.onclick = () => {
                            sendMessage(question.question);
                            closeAllQuestionsModal();
                            focusChatInput();
                        };
                        container.appendChild(item);
                    });
                    
                    document.getElementById('allQuestionsModal').classList.add('open');
                })
                .catch(err => {
                    console.error('Error loading all questions:', err);
                });
        }

        function closeAllQuestionsModal() {
            document.getElementById('allQuestionsModal').classList.remove('open');
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
            
            fetch('<?php echo $baseUrl; ?>/feedback.php', {
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
            fetch('<?php echo $baseUrl; ?>/proses.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'pesan=' + encodeURIComponent(message)
            })
            .then(res => res.text())
            .then(data => {
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
                            messageContent.innerHTML = escapeHtml(fullText.substring(0, charIndex + 1));
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
