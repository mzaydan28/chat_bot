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
    <title>DISA Chat - Chatbot Layanan Disperindag</title>
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
            font-family: 'Cabinet Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Header */
        .chat-header {
            background: rgba(255, 255, 255, 0.98);
            padding: 16px 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border-bottom: none;
            backdrop-filter: blur(10px);
        }

        .header-content {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .bot-identity {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bot-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            animation: float 3s ease-in-out infinite;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .bot-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-8px);
            }
        }

        .bot-info h2 {
            font-family: 'Fraunces', serif;
            font-size: 16px;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.6px;
        }

        .bot-info p {
            font-size: 12px;
            color: #94a3b8;
            margin: 0;
            font-weight: 400;
            letter-spacing: -0.2px;
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
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-radius: 12px;
            flex-shrink: 0;
            font-family: 'Cabinet Grotesk', sans-serif;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.12);
        }

        .back-btn:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.18) 0%, rgba(118, 75, 162, 0.12) 100%);
            border-color: rgba(102, 126, 234, 0.4);
            transform: translateX(-3px);
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.2);
        }

        .back-btn:active {
            transform: translateX(-1px);
        }

        /* Chat Container */
        .chat-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-content {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .chat-content::-webkit-scrollbar {
            width: 8px;
        }

        .chat-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .chat-content::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.3);
            border-radius: 10px;
        }

        .chat-content::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.5);
        }

        /* Messages */
        .message {
            display: flex;
            gap: 12px;
            animation: slide-in 0.3s ease-out;
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.user-message {
            justify-content: flex-end;
        }

        .message.bot-message {
            justify-content: flex-start;
        }

        .message-avatar {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .message-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .message-content {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 16px;
            word-wrap: break-word;
            line-height: 1.5;
            font-size: 14px;
        }

        .user-message .message-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .bot-message .message-content {
            background: rgba(255, 255, 255, 0.95);
            color: #2d3748;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Typing Effect Cursor */
        .typing-cursor {
            display: inline-block;
            width: 2px;
            height: 1em;
            background-color: #2d3748;
            margin-left: 2px;
            animation: blink-cursor 0.7s infinite;
        }

        @keyframes blink-cursor {
            0%, 49% {
                background-color: #2d3748;
            }
            50%, 100% {
                background-color: transparent;
            }
        }

        /* Typing Indicator */
        .typing-dots {
            display: flex;
            gap: 4px;
            align-items: center;
            height: 20px;
        }

        .typing-dots span {
            width: 8px;
            height: 8px;
            background: #667eea;
            border-radius: 50%;
            animation: bounce 1.4s infinite;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {
            0%, 80%, 100% {
                transform: translateY(0);
                opacity: 0.5;
            }
            40% {
                transform: translateY(-8px);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }

        .bot-avatar.active {
            animation: float 3s ease-in-out infinite, pulse 2s infinite;
        }

        /* Template Section */
        .template-section {
            padding: 20px 0;
            background: transparent;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            display: none;
        }

        .template-title {
            font-family: 'Cabinet Grotesk', sans-serif;
            font-size: 11px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 10px;
            max-width: 600px;
            margin: 0 auto;
        }

        .template-btn {
            padding: 9px 12px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-family: 'Cabinet Grotesk', sans-serif;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.95);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 500;
            line-height: 1.5;
            backdrop-filter: blur(8px);
            letter-spacing: -0.2px;
        }

        .template-btn:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .template-btn:active {
            transform: translateY(0);
        }

        .view-all-btn {
            margin-top: 12px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Cabinet Grotesk', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .view-all-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 32px;
            max-width: 500px;
            width: 90%;
            max-height: 70vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            margin-bottom: 24px;
            text-align: center;
        }

        .modal-header h2 {
            font-family: 'Fraunces', serif;
            font-size: 24px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 8px;
        }

        .modal-header p {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        .modal-questions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        .question-option {
            padding: 14px 16px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            color: #1a202c;
            text-align: left;
            font-family: 'Cabinet Grotesk', sans-serif;
        }

        .question-option:hover {
            background: rgba(102, 126, 234, 0.08);
            border-color: #667eea;
            transform: translateX(4px);
        }

        .question-option:active {
            transform: translateX(2px);
        }

        .modal-close {
            display: flex;
            justify-content: center;
        }

        .close-btn {
            padding: 10px 20px;
            background: #e2e8f0;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            color: #667eea;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Cabinet Grotesk', sans-serif;
        }

        .close-btn:hover {
            background: #cbd5e0;
        }

        /* Input Area */
        .chat-input-area {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 16px 24px;
            border-top: 1px solid rgba(102, 126, 234, 0.1);
            display: flex;
            gap: 12px;
        }

        .input-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            gap: 12px;
        }

        #pesan {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-family: 'Cabinet Grotesk', sans-serif;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        #pesan:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        #pesan::placeholder {
            color: #cbd5e0;
        }

        .btn-send {
            padding: 12px 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            font-family: 'Cabinet Grotesk', sans-serif;
        }

        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-send:active {
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .chat-content {
                padding: 16px;
                gap: 12px;
            }

            .message-content {
                max-width: 85%;
                font-size: 13px;
            }

            .chat-input-area {
                padding: 12px 16px;
            }

            .input-wrapper {
                gap: 8px;
            }

            #pesan {
                padding: 10px 14px;
                font-size: 13px;
            }

            .btn-send {
                padding: 10px 20px;
                font-size: 13px;
            }

            .header-content {
                justify-content: space-between;
            }

            .back-btn {
                padding: 6px 12px;
                font-size: 12px;
            }

            .templates-grid {
                grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
                gap: 8px;
            }

            .template-btn {
                padding: 8px 10px;
                font-size: 11px;
            }
        }

        @media (max-width: 480px) {
            .bot-info h2 {
                font-size: 14px;
            }

            .bot-info p {
                font-size: 11px;
            }

            .message-content {
                max-width: 90%;
                padding: 10px 12px;
                font-size: 13px;
            }

            .chat-content {
                padding: 12px;
            }

            .chat-input-area {
                padding: 10px 12px;
            }

            .templates-grid {
                grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
                gap: 6px;
            }

            .template-btn {
                padding: 7px 8px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="chat-header">
        <div class="header-content">
            <div class="bot-identity">
                <div class="bot-avatar">
                    <img src="<?php echo $baseUrl; ?>/../assets/images/Disperindag_Asisstant.png" alt="NUSA Bot">
                </div>
                <div class="bot-info">
                    <h2>DISA Chat</h2>
                    <p>Siap melayani Anda</p>
                </div>
            </div>
            <a href="<?php echo $baseUrl; ?>/feedback.php" class="back-btn"><span>✓</span> Selesai</a>
        </div>
    </div>

    <!-- Chat Container -->
    <div class="chat-container">
        <div id="chat-content" class="chat-content"></div>

        <!-- Templates Section -->
        <div class="template-section" id="templateSection">
            <div class="template-title">Coba salah satu pertanyaan ini:</div>
            <div class="templates-grid" id="templatesGrid">
                <!-- Akan diisi oleh JavaScript -->
            </div>
            <div style="text-align: center;">
                <button class="view-all-btn" onclick="openQuestionModal()">📋 Lihat Semua Pertanyaan</button>
            </div>
        </div>

        <!-- Question Modal -->
        <div class="modal" id="questionModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Pilih Pertanyaan</h2>
                    <p>Pilih salah satu pertanyaan yang ingin Anda tanyakan</p>
                </div>
                <div class="modal-questions" id="modalQuestionsList">
                    <!-- Akan diisi oleh JavaScript -->
                </div>
                <div class="modal-close">
                    <button class="close-btn" onclick="closeQuestionModal()">Tutup</button>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="chat-input-area">
            <div class="input-wrapper">
                <input type="text" id="pesan" placeholder="Ketik pertanyaan Anda..." />
                <button onclick="kirim()" class="btn-send">Kirim</button>
            </div>
        </div>
    </div>

    <script>
        // Initial greeting
        window.addEventListener('DOMContentLoaded', function() {
            let chatContent = document.getElementById('chat-content');
            let greeting = document.createElement('div');
            greeting.className = 'message bot-message';
            
            let avatarDiv = document.createElement('div');
            avatarDiv.className = 'message-avatar';
            avatarDiv.innerHTML = '<img src="<?php echo $baseUrl; ?>/../assets/images/Disperindag_Asisstant.png" alt="Bot">';
            
            let contentDiv = document.createElement('div');
            contentDiv.className = 'message-content';
            contentDiv.id = 'greeting-content';
            
            greeting.appendChild(avatarDiv);
            greeting.appendChild(contentDiv);
            chatContent.appendChild(greeting);
            
            // Greeting text with typing animation
            const greetingText = 'Halo! 👋 Saya DISA, asisten digital Anda. Ada yang bisa saya bantu tentang layanan Disperindag?';
            typeMessage(contentDiv, greetingText, 25);
            
            setTimeout(() => {
                chatContent.scrollTop = chatContent.scrollHeight;
            }, 0);

            // Enter key handler
            document.getElementById('pesan').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    kirim();
                }
            });

            // Load template questions
            loadTemplateQuestions();

            // Modal click outside handler
            let modal = document.getElementById('questionModal');
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeQuestionModal();
                }
            });
        });

        function loadTemplateQuestions() {
            // Fetch sample questions from server
            fetch('<?php echo $baseUrl; ?>/get-templates.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error, status=' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Templates data:', data);
                    if (data && Array.isArray(data) && data.length > 0) {
                        const grid = document.getElementById('templatesGrid');
                        const section = document.getElementById('templateSection');
                        
                        // Clear existing buttons
                        grid.innerHTML = '';
                        
                        data.forEach(template => {
                            const btn = document.createElement('button');
                            btn.className = 'template-btn';
                            btn.textContent = template.question;
                            btn.type = 'button';
                            btn.onclick = function(e) {
                                e.preventDefault();
                                document.getElementById('pesan').value = template.question;
                                kirim();
                            };
                            grid.appendChild(btn);
                        });
                        
                        section.style.display = 'block';
                    } else {
                        console.log('No templates available or invalid data format');
                    }
                })
                .catch(err => {
                    console.error('Error loading templates:', err);
                });
        }

        function kirim() {
            let pesan = document.getElementById('pesan').value.trim();
            if (pesan === '') return;

            let chatContent = document.getElementById('chat-content');
            
            // User message
            let userMsg = document.createElement('div');
            userMsg.className = 'message user-message';
            userMsg.innerHTML = '<div class="message-content">' + escapeHtml(pesan) + '</div><div class="message-avatar">👤</div>';
            chatContent.appendChild(userMsg);

            document.getElementById('pesan').value = '';
            chatContent.scrollTop = chatContent.scrollHeight;

            // Typing indicator
            let typingMsg = document.createElement('div');
            typingMsg.className = 'message bot-message';
            typingMsg.id = 'typing-indicator';
            typingMsg.innerHTML = '<div class="message-avatar"><img src="<?php echo $baseUrl; ?>/../assets/images/Disperindag_Asisstant.png" alt="Bot"></div><div class="message-content typing-dots"><span></span><span></span><span></span></div>';
            chatContent.appendChild(typingMsg);
            chatContent.scrollTop = chatContent.scrollHeight;

            // Send to server
            fetch('<?php echo $baseUrl; ?>/proses.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'pesan=' + encodeURIComponent(pesan)
            })
            .then(response => response.text())
            .then(data => {
                // Remove typing indicator
                let typingInd = document.getElementById('typing-indicator');
                if (typingInd) typingInd.remove();

                // Bot response with typing animation
                let botMsg = document.createElement('div');
                botMsg.className = 'message bot-message';
                let contentDiv = document.createElement('div');
                contentDiv.className = 'message-content';
                contentDiv.id = 'bot-typing-' + Date.now();
                
                let avatarDiv = document.createElement('div');
                avatarDiv.className = 'message-avatar';
                avatarDiv.innerHTML = '<img src="<?php echo $baseUrl; ?>/../assets/images/Disperindag_Asisstant.png" alt="Bot">';
                
                botMsg.appendChild(avatarDiv);
                botMsg.appendChild(contentDiv);
                chatContent.appendChild(botMsg);
                
                // Type out the response character by character
                typeMessage(contentDiv, escapeHtml(data), 30);
                
                chatContent.scrollTop = chatContent.scrollHeight;
            })
            .catch(error => {
                let typingInd = document.getElementById('typing-indicator');
                if (typingInd) typingInd.remove();

                let errMsg = document.createElement('div');
                errMsg.className = 'message bot-message';
                errMsg.innerHTML = '<div class="message-avatar"><img src="<?php echo $baseUrl; ?>/../assets/images/Disperindag_Asisstant.png" alt="Bot"></div><div class="message-content">Maaf, ada kesalahan. Silakan coba lagi.</div>';
                chatContent.appendChild(errMsg);
                chatContent.scrollTop = chatContent.scrollHeight;
            });
        }

        function escapeHtml(text) {
            let div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Typing animation function
        function typeMessage(element, text, speed = 30) {
            let index = 0;
            let chatContent = document.getElementById('chat-content');
            
            function type() {
                if (index < text.length) {
                    element.innerHTML = text.substring(0, index + 1) + '<span class="typing-cursor"></span>';
                    index++;
                    
                    // Auto scroll ke bawah
                    chatContent.scrollTop = chatContent.scrollHeight;
                    
                    // Random speed untuk efek yang lebih natural (20-40ms)
                    let randomSpeed = speed + Math.random() * 20 - 10;
                    setTimeout(type, randomSpeed);
                } else {
                    // Hapus cursor setelah selesai
                    element.innerHTML = text;
                }
            }
            
            type();
        }

        // Modal functions
        function openQuestionModal() {
            let modal = document.getElementById('questionModal');
            modal.classList.add('show');
            
            // Fetch all questions
            fetch('<?php echo $baseUrl; ?>/get-all-questions.php')
                .then(response => response.json())
                .then(data => {
                    let list = document.getElementById('modalQuestionsList');
                    list.innerHTML = '';
                    
                    data.forEach(question => {
                        let questionBtn = document.createElement('button');
                        questionBtn.className = 'question-option';
                        questionBtn.textContent = question;
                        questionBtn.onclick = () => selectQuestion(question);
                        list.appendChild(questionBtn);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function closeQuestionModal() {
            let modal = document.getElementById('questionModal');
            modal.classList.remove('show');
        }

        function selectQuestion(question) {
            let input = document.getElementById('pesan');
            input.value = question;
            closeQuestionModal();
            input.focus();
        }
    </script>
</body>
</html>
