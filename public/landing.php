<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// FORCE NO CACHE
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include __DIR__ . "/../config/koneksi.php";
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$cacheBuster = time() . rand(10000, 99999);
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/../assets/css/modern-light.css?v=<?php echo $cacheBuster; ?>">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/../assets/css/feedback-modal.css?v=<?php echo $cacheBuster; ?>">
    <style>
        /* === CACHE BUSTER VERSION 20260213-1700 - LEFT NAVBAR & FULLSCREEN HERO === */
        
        /* === MODERN NAVBAR === */
        .modern-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .modern-navbar.scrolled {
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
        }
        
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .nav-brand:hover {
            transform: scale(1.02);
        }
        
        .nav-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(59, 130, 246, 0.3));
            transition: all 0.3s ease;
        }
        
        .nav-brand:hover .nav-logo {
            filter: drop-shadow(0 6px 16px rgba(59, 130, 246, 0.5));
            transform: scale(1.05);
        }
        
        .nav-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e40af;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-title-main {
            font-weight: 800;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-title-separator {
            color: #93c5fd;
            font-weight: 300;
        }
        
        .nav-title-sub {
            font-weight: 600;
            color: #475569;
        }
        
        .nav-cta-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 28px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            font-size: 15px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.35);
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .nav-cta-button:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.45);
        }
        
        .nav-cta-button:active {
            transform: translateY(0);
        }
        
        .nav-cta-button svg {
            transition: transform 0.3s ease;
        }
        
        .nav-cta-button:hover svg {
            transform: translateX(3px);
        }
        
        /* === NEW WELCOME BANNER === */
        .welcome-banner-new {
            min-height: 60vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(180deg, #eff6ff 0%, #dbeafe 50%, #ffffff 100%);
            padding: 100px 20px 60px;
            margin: 0;
            overflow: hidden;
        }
        
        .welcome-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(147, 197, 253, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .welcome-content-new {
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
            animation: heroFadeIn 1s ease-out;
            text-align: center;
        }
        
        @keyframes heroFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero-card {
            /* REMOVED - No card wrapper */
            display: none;
        }
        
        .hero-icon-container {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto 40px;
        }
        
        .hero-icon-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulseGlow 3s ease-in-out infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% { 
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.6;
            }
            50% { 
                transform: translate(-50%, -50%) scale(1.15);
                opacity: 0.9;
            }
        }
        
        .hero-icon {
            position: relative;
            width: 160px;
            height: 160px;
            object-fit: contain;
            filter: drop-shadow(0 10px 30px rgba(59, 130, 246, 0.3));
            animation: floatIcon 6s ease-in-out infinite;
            z-index: 2;
        }
        
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        .hero-title {
            margin: 0 0 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            line-height: 1.2;
        }
        
        .hero-title-main {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
        }
        
        .hero-title-separator {
            font-size: 2.5rem;
            color: #93c5fd;
            font-weight: 300;
        }
        
        .hero-title-sub {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e40af;
            letter-spacing: -0.3px;
        }
        
        .hero-subtitle {
            font-size: 1.15rem;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 40px 0;
            font-weight: 500;
        }
        
        .hero-features {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 0;
        }
        
        .feature-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 197, 253, 0.1) 100%);
            border: 2px solid rgba(59, 130, 246, 0.2);
            border-radius: 50px;
            color: #1e40af;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: default;
        }
        
        .feature-pill:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border-color: #3b82f6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
        
        .feature-pill svg {
            flex-shrink: 0;
        }
        
        .scroll-down {
            display: none;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: 12px 20px;
            }
            
            .nav-logo {
                width: 40px;
                height: 40px;
            }
            
            .nav-title {
                font-size: 14px;
                flex-direction: column;
                align-items: flex-start;
                gap: 2px;
                line-height: 1.3;
            }
            
            .nav-title-separator {
                display: none;
            }
            
            .nav-cta-button {
                padding: 10px 20px;
                font-size: 13px;
            }
            
            .nav-cta-button span {
                display: none;
            }
            
            .welcome-banner-new {
                min-height: 50vh;
                padding: 100px 20px 40px;
            }
            
            .hero-card {
                padding: 40px 30px;
                border-radius: 24px;
            }
            
            .hero-icon-container {
                width: 120px;
                height: 120px;
            }
            
            .hero-icon {
                width: 120px;
                height: 120px;
            }
            
            .hero-icon-glow {
                width: 140px;
                height: 140px;
            }
            
            .hero-title {
                flex-direction: column;
                gap: 8px;
            }
            
            .hero-title-main {
                font-size: 2.5rem;
            }
            
            .hero-title-separator {
                display: none;
            }
            
            .hero-title-sub {
                font-size: 1.1rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .feature-pill {
                padding: 10px 16px;
                font-size: 12px;
            }
            
            .cta-button {
                padding: 16px 32px;
                font-size: 16px;
            }
            
            .scroll-down {
                bottom: 20px;
            }
        }
        
        /* === TOMBOL SEND BARU === */
        .send-btn-new {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            color: white !important;
            border: none !important;
            border-radius: 12px !important;
            width: 44px !important;
            height: 44px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3) !important;
            flex-shrink: 0 !important;
            padding: 0 !important;
        }
        
        .send-btn-new:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
            transform: translateY(-2px) scale(1.05) !important;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4) !important;
        }
        
        .send-btn-new:active {
            transform: translateY(0) scale(0.98) !important;
        }
        
        .send-btn-new svg {
            transition: transform 0.3s ease !important;
            stroke: white !important;
            fill: none !important;
            display: block !important;
            width: 22px !important;
            height: 22px !important;
        }
        
        .send-btn-new:hover svg {
            transform: translateX(2px) !important;
        }
        
        /* === CHAT MESSAGE ALIGNMENT === */
        .message.user-msg {
            display: flex !important;
            justify-content: flex-end !important;
            margin-left: auto !important;
            margin-right: 0 !important;
            max-width: 75% !important;
        }
        
        .message.user-msg .msg-content {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            color: white !important;
            border-radius: 16px 16px 4px 16px !important;
            padding: 12px 16px !important;
            text-align: right !important;
            margin-left: auto !important;
        }
        
        .message.bot-msg {
            display: flex !important;
            justify-content: flex-start !important;
            align-items: flex-start !important;
            gap: 10px !important;
            margin-right: auto !important;
            margin-left: 0 !important;
            max-width: 80% !important;
        }
        
        .message.bot-msg .msg-content {
            background: #f3f4f6 !important;
            color: #1f2937 !important;
            border-radius: 16px 16px 16px 4px !important;
            padding: 12px 16px !important;
            text-align: left !important;
            line-height: 1.6 !important;
            display: block !important;
        }
        
        .bot-avatar {
            width: 36px !important;
            height: 36px !important;
            border-radius: 50% !important;
            flex-shrink: 0 !important;
            margin-top: 2px !important;
        }
        
        /* === LIVE SEARCH SUGGESTIONS IMPROVED === */
        .suggestion-item, .suggestion-chip {
            padding: 12px 16px !important;
            background: white !important;
            border-bottom: 1px solid #f3f4f6 !important;
            font-size: 14px !important;
            color: #374151 !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            line-height: 1.5 !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            white-space: normal !important;
        }
        
        .suggestion-item:hover, .suggestion-chip:hover {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%) !important;
            color: #1e40af !important;
            border-left: 3px solid #3b82f6 !important;
            padding-left: 13px !important;
        }
        
        .suggestions-header {
            padding: 12px 16px !important;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%) !important;
            border-bottom: 2px solid #e5e7eb !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            color: #6b7280 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }
        
        /* === QUESTION HOVER EFFECTS === */
        .chat-question-item:hover,
        .category-questions .chat-question-item:hover,
        button.chat-question-item:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%) !important;
            color: white !important;
            transform: translateX(2px) !important;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3) !important;
        }
        
        .all-question-item:hover,
        button.all-question-item:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%) !important;
            color: white !important;
            transform: translateX(4px) !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3) !important;
        }
        
        .hero-cta-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%) !important;
            color: white !important;
            padding: 16px 32px !important;
            font-size: 16px !important;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important;
        }
        
        /* === WELCOME BANNER ADJUSTMENT === */
        .welcome-banner {
            padding-top: 40px !important;
        }
        
    </style>
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
        
        /* Chat Suggestions Styles - Live Search - IMPROVED */
        .chat-suggestions {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #dbeafe;
            border-radius: 16px 16px 0 0;
            box-shadow: 0 -8px 24px rgba(59, 130, 246, 0.15);
            max-height: 280px;
            overflow: hidden;
            z-index: 10;
            margin-bottom: 0;
        }
        
        .chat-suggestions.show {
            display: block;
            animation: slideUpFade 0.3s ease-out;
        }
        
        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .suggestions-list {
            display: flex;
            flex-direction: column;
            gap: 0;
            max-height: 230px;
            overflow-y: auto;
        }
        
        .suggestion-item {
            padding: 14px 18px;
            background: white;
            border-bottom: 1px solid #f0f9ff;
            font-size: 14px;
            color: #1e40af;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
            line-height: 1.5;
        }

        .suggestion-item:last-child {
            border-bottom: none;
        }
        
        .suggestion-item::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #3b82f6;
            border-radius: 50%;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        
        .suggestion-item:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            color: white;
            padding-left: 22px;
            box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.2);
        }

        .suggestion-item:hover::before {
            background: white;
            transform: scale(1.3);
        }

        .suggestions-header {
            padding: 12px 18px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-bottom: 2px solid #bfdbfe;
            font-size: 12px;
            color: #1e40af;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .suggestions-header svg {
            flex-shrink: 0;
        }

        /* Suggestions Scrollbar */
        .suggestions-list::-webkit-scrollbar {
            width: 6px;
        }

        .suggestions-list::-webkit-scrollbar-track {
            background: #f0f9ff;
            border-radius: 10px;
        }

        .suggestions-list::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border-radius: 10px;
        }

        .suggestions-list::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }
        
        /* Hero button position adjustment */
        .hero-cta {
            margin-top: 20px !important;
        }

        
        /* Removed old speech bubble styles - now integrated in welcome-banner */

        /* Chat Section Styles - Full Screen */
        .chat-section {
            padding: 40px 20px;
            background: #f8f9fa;
            position:relative;
            min-height: 100vh;
        }

        .chat-section::before {
            display: none;
        }

        .chat-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            gap: 0;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 100vh;
            max-height: none;
            position: relative;
            z-index: 1;
            border: none;
        }

        .chat-questions-sidebar {
            width: 350px;
            background: linear-gradient(180deg, #dbeafe 0%, #eff6ff 50%, #ffffff 100%);
            border-right: 2px solid #bfdbfe;
            display: flex;
            flex-direction: column;
            max-height: 100vh;
            overflow: hidden;
        }
        
        .sidebar-scrollable-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            padding-bottom: 10px;
        }

        .chat-questions-sidebar h4 {
            font-size: 15px;
            font-weight: 700;
            color: #3b82f6;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Public Info Section */
        .public-info-section {
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 2px solid #bfdbfe;
        }

        .public-info-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .public-info-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
            border: 2px solid #bfdbfe;
            border-radius: 10px;
            text-decoration: none;
            color: #1e40af;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .public-info-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            transition: left 0.3s ease;
            z-index: 0;
        }

        .public-info-link:hover::before {
            left: 0;
        }

        .public-info-link:hover {
            border-color: #3b82f6;
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .link-icon {
            font-size: 18px;
            position: relative;
            z-index: 1;
        }

        .link-text {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .link-arrow {
            font-size: 16px;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .public-info-link:hover .link-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        .chat-right-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
            overflow: hidden;
        }

        .chat-header {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border-bottom: none;
            padding: 20px 24px;
            border-radius: 0;
        }

        /* Question Categories Styling */
        #chatQuestionsList {
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding-right: 8px;
        }

        .question-category {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .question-category:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .category-header {
            width: 100%;
            padding: 14px 18px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-weight: 600;
            color: #1e40af;
            transition: all 0.3s ease;
        }

        .category-header:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            color: white;
        }

        .category-header:hover .category-count,
        .category-header:hover .category-arrow {
            color: white;
        }

        .category-title {
            font-size: 14px;
            flex: 1;
        }

        .category-count {
            font-size: 12px;
            color: #3b82f6;
            font-weight: 500;
            margin-left: 8px;
        }

        .category-arrow {
            font-size: 10px;
            color: #3b82f6;
            transition: transform 0.3s ease;
        }

        .category-header.collapsed .category-arrow {
            transform: rotate(-90deg);
        }

        .category-questions {
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
        }

        .chat-question-item {
            width: 100%;
            padding: 12px 16px;
            background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
            border: 1.5px solid #bfdbfe;
            border-radius: 8px;
            text-align: left;
            font-size: 13px;
            color: #1e40af;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .chat-question-item:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%) !important;
            color: white !important;
            transform: translateX(3px) !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3) !important;
        }



        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            background: linear-gradient(180deg, #f0f9ff 0%, #ffffff 100%);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .chat-input-area {
            padding: 20px 24px;
            border-top: 2px solid #e5e7eb;
            background: white;
            border-radius: 0;
            position: relative;
        }

        .input-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .chat-input {
            flex: 1;
            padding: 12px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 25px;
            background: #f9fafb;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
        }

        .send-btn {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%) !important;
            color: white !important;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex !important;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
            flex-shrink: 0;
            z-index: 10;
            position: relative;
            pointer-events: auto;
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .send-btn:active {
            transform: scale(0.95);
        }

        .send-btn svg {
            color: white !important;
            stroke: white !important;
            fill: none !important;
            display: block !important;
            width: 18px !important;
            height: 18px !important;
        }

        /* OLD Welcome Banner - DEPRECATED */
        .welcome-banner {
            display: none;
        }

        /* Floating circles animation */
        .welcome-banner::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -100px;
            left: -50px;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { 
                transform: translate(0, 0) scale(1);
                opacity: 0.5;
            }
            50% { 
                transform: translate(30px, -30px) scale(1.1);
                opacity: 0.8;
            }
        }

        /* Subtle particle effect */
        .welcome-content::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%);
            border-radius: 50%;
            top: 20%;
            right: 10%;
            animation: float 6s ease-in-out infinite 1s;
        }

        .welcome-content::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(59,130,246,0.06) 0%, transparent 70%);
            border-radius: 50%;
            bottom: 15%;
            left: 8%;
            animation: float 7s ease-in-out infinite 2s;
        }

        .welcome-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Hero Container with Glassmorphism */
        .hero-container {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            padding: 28px 32px;
            margin: 0 auto 30px;
            max-width: 480px;
            position: relative;
            box-shadow: 
                0 4px 20px rgba(59, 130, 246, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
        }
        
        .hero-container:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 8px 30px rgba(59, 130, 246, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }
        
        /* Removed heavy animations for better performance */
        
        .hero-container .welcome-icon {
            margin: 0 auto 18px;
        }
        
        .hero-container h1 {
            margin: 0;
            font-size: 1.05rem;
            line-height: 1.4;
            font-weight: 700;
        }

        .welcome-icon {
            width: 135px;
            height: 135px;
            margin: 0 auto 24px;
            position: relative;
            animation: fadeInScale 0.8s ease-out !important;
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 10px 30px rgba(59,130,246,0.3)) !important;
            transition: all 0.3s ease;
        }

        .welcome-icon img:hover {
            transform: scale(1.05) !important;
            filter: drop-shadow(0 15px 40px rgba(59,130,246,0.5)) !important;
        }

        .welcome-banner h1 {
            font-size: 2.8rem;
            font-family: 'Playfair Display', serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            text-shadow: none;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .welcome-banner p {
            font-size: 1.1rem;
            color: #1e40af;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .welcome-stats {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .stat-badge {
            background: rgba(59, 130, 246, 0.15);
            backdrop-filter: blur(10px);
            padding: 12px 24px;
            border-radius: 50px;
            color: #1e40af;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .stat-badge:hover {
            background: rgba(59, 130, 246, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            z-index: 10;
            animation: bounce 2s infinite;
        }

        .scroll-indicator span {
            color: white;
            font-size: 14px;
            font-weight: 600;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .scroll-arrow {
            width: 30px;
            height: 30px;
            border-left: 3px solid white;
            border-bottom: 3px solid white;
            transform: rotate(-45deg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* Info Section */
        .info-section {
            padding: 60px 20px;
            background: #f8f9fa;
        }

        .info-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            gap: 30px;
        }

        .info-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0,0,0,0.12);
        }

        .info-card h3 {
            font-size: 1.8rem;
            margin-bottom: 28px;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* Feedback CTA Section */
        .feedback-cta-card {
            text-align: center;
        }
        
        .feedback-description {
            font-size: 1rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Feedback Pills - Minimal */
        .feedback-pills {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        
        .feedback-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 2px solid #bfdbfe;
            border-radius: 50px;
            color: #1e40af;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .feedback-pill:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border-color: #3b82f6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .feedback-pill.active {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border-color: #3b82f6;
            color: white;
        }
        
        .feedback-pill svg {
            flex-shrink: 0;
        }
        
        /* Inline Feedback Form */
        .feedback-form-inline {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 30px;
            max-width: 700px;
            margin: 0 auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group-inline {
            margin-bottom: 20px;
        }
        
        .form-group-inline label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .form-group-inline input,
        .form-group-inline textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        
        .form-group-inline input:focus,
        .form-group-inline textarea:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-group-inline textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .required {
            color: #ef4444;
        }
        
        /* Star Rating */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 8px;
            font-size: 40px !important;
            line-height: 1 !important;
        }
        
        .star-rating input {
            display: none;
        }
        
        .star-rating label {
            cursor: pointer;
            color: #d1d5db;
            transition: all 0.2s ease;
            font-size: 40px !important;
        }
        
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #fbbf24;
        }
        
        .star-rating input:checked ~ label {
            color: #fbbf24;
        }
        
        .submit-feedback-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        
        .submit-feedback-btn:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }
        
        .submit-feedback-btn:active {
            transform: translateY(0);
        }

        /* Feature Grid */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        .feature-box {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 28px;
            border-radius: 16px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #bfdbfe;
        }

        .feature-box:hover {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
        }

        .feature-emoji {
            font-size: 3rem;
            display: block;
            margin-bottom: 16px;
        }
        
        .feature-emoji svg {
            stroke: #3b82f6;
        }

        .feature-box h4 {
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: #1e40af;
        }

        .feature-box p {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Guide & FAQ Compact */
        .guide-faq-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .steps-compact {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .step-compact {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 16px 20px;
            border-radius: 12px;
            border-left: 4px solid #3b82f6;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .step-compact:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);
        }

        .step-num {
            background: #3b82f6;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        .faq-compact-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .faq-detail {
            background: #f8f9fa;
            padding: 16px 20px;
            border-radius: 12px;
            border: 2px solid #e9ecef;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .faq-detail:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .faq-detail[open] {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-color: #3b82f6;
        }

        .faq-detail summary {
            font-weight: 600;
            color: #1f2937;
            cursor: pointer;
            list-style: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .faq-detail summary::before {
            content: '▶';
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .faq-detail[open] summary::before {
            transform: rotate(90deg);
        }

        .faq-detail p {
            margin-top: 12px;
            padding-left: 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .welcome-banner {
                padding: 100px 20px 50px;
            }

            /* Hide decorative elements on mobile */
            .welcome-banner::before,
            .welcome-banner::after,
            .welcome-content::before,
            .welcome-content::after {
                display: none;
            }

            .welcome-banner h1 {
                font-size: 1.8rem;
            }

            .welcome-icon {
                width: 100px;
                height: 100px;
            }

            .scroll-indicator {
                bottom: 20px;
            }

            .scroll-indicator span {
                font-size: 12px;
            }

            .scroll-arrow {
                width: 24px;
                height: 24px;
                border-width: 2px;
            }

            .chat-section {
                padding: 0;
            }

            .chat-container {
                flex-direction: column;
                min-height: auto;
                max-height: none;
                border-radius: 0;
                box-shadow: none;
            }

            .chat-questions-sidebar {
                width: 100%;
                max-height: 400px;
                min-height: auto;
                border-right: none;
                border-bottom: 2px solid #e5e7eb;
                overflow: hidden;
                order: 1;
                display: flex;
                flex-direction: column;
                position: relative;
                z-index: 10;
            }
            
            .sidebar-scrollable-content {
                padding: 16px;
            }
            
            .view-all-btn {
                width: calc(100% - 32px);
                margin: 10px 16px 16px 16px;
            }

            .chat-right-container {
                order: 2;
                width: 100%;
            }

            .chat-right-container {
                order: 2;
                width: 100%;
            }

            .public-info-section {
                margin-bottom: 16px;
                padding-bottom: 14px;
            }

            .public-info-section {
                margin-bottom: 20px;
                padding-bottom: 16px;
            }

            .public-info-link {
                padding: 12px 14px;
                font-size: 13px;
            }

            .link-icon {
                font-size: 16px;
            }

            .view-all-btn {
                margin-top: 16px;
            }

            .chat-messages {
                min-height: 500px;
            }
            
            .bot-msg .msg-content {
                max-width: 85%;
                font-size: 13px;
                padding: 12px 16px;
                text-align: left !important;
            }
            
            .bot-avatar {
                width: 32px;
                height: 32px;
            }

            .welcome-banner h1 {
                font-size: 1.75rem;
                letter-spacing: -0.3px;
            }
            
            .welcome-banner p {
                font-size: 0.95rem;
            }
            
            .hero-container {
                padding: 22px 25px;
                border-radius: 16px;
                max-width: 90%;
            }
            
            .hero-container .welcome-icon {
                width: 95px;
                height: 95px;
                margin: 0 auto 14px;
            }
            
            .hero-container h1 {
                font-size: 0.95rem;
                line-height: 1.35;
            }

            .welcome-icon {
                width: 70px;
                height: 70px;
                animation: fadeInScale 0.8s ease-out !important;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
            
            .feedback-cta-grid {
                grid-template-columns: 1fr;
            }
            
            .feedback-description {
                font-size: 0.95rem;
                margin-bottom: 30px;
            }
            
            .feedback-cta-button {
                padding: 24px 20px;
            }
            
            .feedback-pills {
                gap: 8px;
            }
            
            .feedback-pill {
                padding: 8px 14px;
                font-size: 12px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .feedback-form-inline {
                padding: 20px;
            }
            
            .star-rating {
                font-size: 32px !important;
                gap: 6px !important;
            }
            
            .star-rating label {
                font-size: 32px !important;
            }
            
            .submit-feedback-btn {
                padding: 12px 24px;
                font-size: 14px;
            }

            .chat-suggestions {
                max-height: 200px;
            }

            .suggestion-item {
                padding: 9px 14px;
                font-size: 12px;
            }

            .suggestions-header {
                padding: 7px 14px;
                font-size: 10px;
            }
        }

        /* Custom Scrollbar */
        .chat-messages::-webkit-scrollbar,
        .chat-questions-sidebar::-webkit-scrollbar,
        .sidebar-scrollable-content::-webkit-scrollbar {
            width: 8px;
        }

        .chat-messages::-webkit-scrollbar-track,
        .chat-questions-sidebar::-webkit-scrollbar-track,
        .sidebar-scrollable-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .chat-messages::-webkit-scrollbar-thumb,
        .chat-questions-sidebar::-webkit-scrollbar-thumb,
        .sidebar-scrollable-content::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border-radius: 10px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover,
        .chat-questions-sidebar::-webkit-scrollbar-thumb:hover,
        .sidebar-scrollable-content::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        /* Smooth Animations */
        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chat-container,
        .info-card {
            animation: fadeInSlide 0.6s ease-out;
        }

        .info-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        /* Enhanced Footer */
        footer {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: rgba(255,255,255,0.9);
            padding: 30px 20px;
            text-align: center;
            border-top: 3px solid #3b82f6;
        }

        footer p {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
            margin: 0;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }

        /* Chat Section Full Screen ID Offset */
        #chat {
            scroll-margin-top: 0;
        }

        /* Loading State */
        body.loading {
            overflow: hidden;
        }

        /* View All Button */
        .view-all-btn {
            width: calc(100% - 40px);
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
            margin: 10px 20px 20px 20px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        /* Navigation Enhancement */
        nav {
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        nav.scrolled {
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.12);
        }

        .nav-links a {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a:hover {
            color: #3b82f6;
        }

        .chat-header {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border-bottom: none;
            padding: 20px 24px;
        }

        .chat-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .chat-info h3 {
            margin: 0;
            font-size: 18px;
            color: white;
            font-weight: 700;
        }

        .chat-status {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        /* Message Animations */
        .message {
            animation: slideInMessage 0.4s ease-out;
        }
        
        .bot-msg {
            display: flex;
            gap: 8px;
            align-items: flex-start;
            margin-bottom: 16px;
        }
        
        .bot-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: contain;
            flex-shrink: 0;
            background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
            padding: 4px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
            border: 2px solid #bfdbfe;
        }
        
        .bot-msg .msg-content {
            background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
            color: #1e40af;
            padding: 10px 14px;
            border-radius: 14px;
            border-bottom-left-radius: 4px;
            max-width: 70%;
            line-height: 1.6;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
            border: 1px solid #bfdbfe;
            word-wrap: break-word;
            text-align: left !important;
            margin: 0;
        }
            line-height: 1.6;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
            border: 1px solid #bfdbfe;
            word-wrap: break-word;
        }

        @keyframes slideInMessage {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Input Focus State */
        .chat-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="modern-navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA" class="nav-logo">
                <div class="nav-title">
                    <span class="nav-title-main">DISCHA</span>
                    <span class="nav-title-separator">•</span>
                    <span class="nav-title-sub">Asisten Digital Disperindag Jateng</span>
                </div>
            </div>
            <a href="#chat" class="nav-cta-button">
                <span>Mulai Chat</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </a>
        </div>
    </nav>

    <!-- Welcome Banner - Redesigned -->
    <section id="welcome" class="welcome-banner-new">
        <div class="welcome-overlay"></div>
        <div class="welcome-content-new">
            <!-- Content tanpa card wrapper -->
            <div class="hero-icon-container">
                <div class="hero-icon-glow"></div>
                <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA Bot" class="hero-icon">
            </div>
            <h1 class="hero-title">
                <span class="hero-title-main">DISCHA</span>
                <span class="hero-title-separator">•</span>
                <span class="hero-title-sub">Asisten Digital Disperindag Jateng</span>
            </h1>
            <p class="hero-subtitle">Informasi layanan, program UMKM, dan perizinan usaha - tersedia 24/7</p>
            
            <!-- Feature Pills -->
            <div class="hero-features">
                <div class="feature-pill">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                    <span>Respons Cepat</span>
                </div>
                <div class="feature-pill">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span>Data Akurat</span>
                </div>
                <div class="feature-pill">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>Aman & Privat</span>
                </div>
                <div class="feature-pill">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span>24/7 Online</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Chat Section - Priority Position -->
    <section id="chat" class="chat-section">
        <div class="chat-container">
            <!-- Left Sidebar - Popular Questions -->
            <div class="chat-questions-sidebar" id="faq">
                <!-- Scrollable Content Wrapper -->
                <div class="sidebar-scrollable-content">
                    <!-- Informasi Publik Section -->
                    <div class="public-info-section">
                    <h4>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 8px;">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        Informasi Publik
                    </h4>
                    <div class="public-info-links">
                        <a href="https://disperindag.jatengprov.go.id/v3/publik/baca/449" target="_blank" class="public-info-link">
                            <span class="link-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </span>
                            <span class="link-text">PPID-Berkala</span>
                            <span class="link-arrow">→</span>
                        </a>
                        <a href="https://disperindag.jatengprov.go.id/v3/publik/baca/71" target="_blank" class="public-info-link">
                            <span class="link-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>
                            </span>
                            <span class="link-text">Serta Merta</span>
                            <span class="link-arrow">→</span>
                        </a>
                        <a href="https://disperindag.jatengprov.go.id/v3/publik/baca/237" target="_blank" class="public-info-link">
                            <span class="link-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </span>
                            <span class="link-text">Setiap Saat</span>
                            <span class="link-arrow">→</span>
                        </a>
                        <a href="https://disperindag.jatengprov.go.id/v3/publik/baca/243" target="_blank" class="public-info-link">
                            <span class="link-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </span>
                            <span class="link-text">Dikecualikan</span>
                            <span class="link-arrow">→</span>
                        </a>
                    </div>
                </div>

                <!-- Pertanyaan Populer Section -->
                <h4>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 8px;">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Pertanyaan Populer
                </h4>
                <div id="chatQuestionsList">
                    <!-- Questions will be loaded dynamically -->
                    <p style="color: #6b7280; font-size: 13px; text-align: center; padding: 20px;">Memuat pertanyaan...</p>
                </div>
                </div>
                <!-- End Scrollable Content -->
                
                <!-- Fixed Button at Bottom -->
                <button class="view-all-btn" onclick="loadAllQuestions()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 6px;">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                    Lihat Semua Pertanyaan
                </button>
            </div>

            <!-- Right Container - Chat -->
            <div class="chat-right-container">
                <!-- Header -->
                <div class="chat-header">
                    <div class="chat-header-left">
                        <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA" class="chat-avatar">
                        <div class="chat-info">
                            <h3 class="chat-name">DISCHA</h3>
                            <span class="chat-status">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="#10b981" style="display: inline-block; vertical-align: middle; margin-right: 4px;">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>
                                Online 24/7
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Messages Area -->
                <div class="chat-messages" id="chatMessages">
                    <div class="message bot-msg">
                        <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="Bot" class="bot-avatar">
                        <div class="msg-content">Halo! Saya DISCHA, asisten digital Disperindag Jawa Tengah. Ada yang bisa saya bantu?</div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="chat-input-area">
                    <!-- Live Search Suggestions Container -->
                    <div id="chatSuggestions" class="chat-suggestions">
                        <div class="suggestions-header">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 6px;">
                                <line x1="22" y1="12" x2="2" y2="12"></line>
                                <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                <line x1="10" y1="16" x2="10.01" y2="16"></line>
                            </svg>
                            Saran Pertanyaan
                        </div>
                        <div id="suggestionsList" class="suggestions-list"></div>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" id="pesan" class="chat-input" placeholder="Ketik pertanyaan Anda..." autocomplete="off" oninput="handleLiveSearch(event)" onkeypress="handleChatKeypress(event)">
                        <button class="send-btn-new" onclick="sendChatMessage()" title="Kirim Pesan">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="info-section" id="fitur">
        <div class="info-container">
            <div class="info-card feedback-cta-card">
                <h3>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 8px;">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    Berikan Umpan Balik Anda
                </h3>
                <p class="feedback-description">
                    Pendapat Anda sangat berarti bagi kami! Bantu kami meningkatkan layanan DISCHA.
                </p>
                
                <!-- Feedback Category Pills -->
                <!-- Pills dihapus, form langsung muncul -->
                
                <!-- Inline Feedback Form -->
                <div class="feedback-form-inline">
                    <form id="feedbackFormInline" onsubmit="submitFeedback(event)">
                        <div class="form-row">
                            <div class="form-group-inline">
                                <label for="feedbackNameInline">Nama (Opsional)</label>
                                <input type="text" id="feedbackNameInline" name="name" placeholder="Nama Anda">
                            </div>
                            <div class="form-group-inline">
                                <label for="feedbackEmailInline">Email (Opsional)</label>
                                <input type="email" id="feedbackEmailInline" name="email" placeholder="emailanda@.com">
                            </div>
                        </div>
                        <div class="form-group-inline">
                            <label for="feedbackRating">Rating <span class="required">*</span></label>
                            <div class="star-rating" style="font-size: 40px !important; gap: 8px;">
                                <input type="radio" id="star5" name="rating" value="5" required>
                                <label for="star5" title="5 bintang" style="font-size: 40px !important;">★</label>
                                <input type="radio" id="star4" name="rating" value="4">
                                <label for="star4" title="4 bintang" style="font-size: 40px !important;">★</label>
                                <input type="radio" id="star3" name="rating" value="3">
                                <label for="star3" title="3 bintang" style="font-size: 40px !important;">★</label>
                                <input type="radio" id="star2" name="rating" value="2">
                                <label for="star2" title="2 bintang" style="font-size: 40px !important;">★</label>
                                <input type="radio" id="star1" name="rating" value="1">
                                <label for="star1" title="1 bintang" style="font-size: 40px !important;">★</label>
                            </div>
                        </div>
                        <div class="form-group-inline">
                            <label for="feedbackMessageInline">Umpan Balik <span class="required">*</span></label>
                            <textarea id="feedbackMessageInline" name="message" placeholder="Bagikan umpan balik Anda..." required rows="4"></textarea>
                        </div>
                        <button type="submit" class="submit-feedback-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                            <span>Kirim Umpan Balik</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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



    <!-- Footer -->
    <footer>
        <p>💼 &copy; 2026 DISCHA Chatbot - Dinas Perindustrian dan Perdagangan Jawa Tengah</p>
        <p style="margin-top: 8px; font-size: 12px; opacity: 0.7;">Powered by AI • Tersedia 24/7 • Informasi Terpercaya</p>
    </footer>

    <script>
        console.log('🚀 Landing.php script loaded');
        
        // Live Search Function - IMPROVED
        function handleLiveSearch(event) {
            const input = event.target;
            const query = input.value.trim().toLowerCase();
            const suggestionsContainer = document.getElementById('chatSuggestions');
            const suggestionsList = document.getElementById('suggestionsList');
            
            console.log('🔍 Live search:', query);
            
            // PERBAIKAN: Tunggu user ketik minimal 2 karakter
            if (query.length < 2) {
                suggestionsContainer.classList.remove('show');
                return;
            }
            
            // Check if questions are loaded
            if (!window.allQuestionsForSuggest || window.allQuestionsForSuggest.length === 0) {
                console.log('⚠️ Questions not loaded yet, loading now...');
                // Try to load questions if not loaded
                loadTemplateSuggestions();
                suggestionsContainer.classList.remove('show');
                return;
            }
            
            console.log('✓ Questions available:', window.allQuestionsForSuggest.length);
            
            let questionsToShow = [];
            let headerText = '';
            
            // Filter questions based on query (minimum 2 chars)
            const filteredQuestions = window.allQuestionsForSuggest.filter(question => 
                question.toLowerCase().includes(query)
            );
            
            console.log('📊 Filtered results:', filteredQuestions.length);
            
            if (filteredQuestions.length > 0) {
                questionsToShow = filteredQuestions.slice(0, 5);
                const totalCount = filteredQuestions.length;
                const showingCount = questionsToShow.length;
                headerText = `${showingCount} hasil${totalCount > 5 ? ` dari ${totalCount}` : ''}`;
            } else {
                suggestionsContainer.classList.remove('show');
                return;
            }
            
            // Clear previous suggestions
            suggestionsList.innerHTML = '';
            
            // Update header
            const headerDiv = suggestionsContainer.querySelector('.suggestions-header');
            if (headerDiv) {
                // Keep the SVG icon and update text
                const icon = headerDiv.querySelector('svg');
                headerDiv.innerHTML = '';
                if (icon) headerDiv.appendChild(icon.cloneNode(true));
                headerDiv.appendChild(document.createTextNode(headerText));
            }
            
            // Add questions
            questionsToShow.forEach(question => {
                const suggestionDiv = document.createElement('div');
                suggestionDiv.className = 'suggestion-item';
                
                // Simple display without highlight
                suggestionDiv.textContent = question;
                
                // Single click - fill input
                suggestionDiv.onclick = () => {
                    input.value = question;
                    suggestionsContainer.classList.remove('show');
                    input.focus();
                };
                
                // Double click - send directly
                suggestionDiv.ondblclick = () => {
                    input.value = question;
                    suggestionsContainer.classList.remove('show');
                    sendMessage(question);
                    input.value = '';
                };
                
                suggestionsList.appendChild(suggestionDiv);
            });
            
            suggestionsContainer.classList.add('show');
            console.log('✓ Suggestions displayed');
        }

        // Close suggestions when clicking outside
        document.addEventListener('click', function(event) {
            const suggestionsContainer = document.getElementById('chatSuggestions');
            const input = document.getElementById('pesan');
            
            if (suggestionsContainer && input && 
                !suggestionsContainer.contains(event.target) && 
                event.target !== input) {
                suggestionsContainer.classList.remove('show');
            }
        });

        // Auto-initialize chat on page load
        window.addEventListener('DOMContentLoaded', function() {
            console.log('💬 Initializing chat...');
            
            // Load popular questions - this also loads allQuestionsForSuggest
            loadTemplateSuggestions();
            
            // Wait a bit to ensure questions are loaded
            setTimeout(() => {
                const input = document.getElementById('pesan');
                if (input) {
                    console.log('✓ Chat input ready');
                    console.log('✓ Questions loaded:', window.allQuestionsForSuggest ? window.allQuestionsForSuggest.length : 0);
                }
                console.log('✓ Chat ready');
            }, 500);
        });

        function openFeedbackModal() {
            console.log('Opening feedback modal');
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
        
        // Inline Feedback Form - Pill Selection
        // Pills dan event listener dihapus, form langsung bisa diisi
        
        // Submit Feedback Function
        function submitFeedback(event) {
            event.preventDefault();
            const form = document.getElementById('feedbackFormInline');
            const formData = new FormData(form);
            // Validasi manual
            const message = form.querySelector('textarea[name="message"]').value.trim();
            const rating = form.querySelector('input[name="rating"]:checked');
            if (!message) {
                alert('Mohon isi umpan balik Anda');
                return;
            }
            if (!rating) {
                alert('Mohon beri rating');
                return;
            }
            // Tidak perlu kategori pill, langsung submit
            // Show loading state
            const submitBtn = form.querySelector('.submit-feedback-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Mengirim...</span>';
            fetch('feedback.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✓ Terima kasih! Umpan balik Anda telah terkirim.');
                    form.reset();
                    document.querySelectorAll('.feedback-pill').forEach(p => p.classList.remove('active'));
                    document.querySelectorAll('.star-rating input').forEach(r => r.checked = false);
                } else {
                    alert('❌ Maaf, terjadi kesalahan. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan jaringan. Silakan coba lagi.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        }

        // Load template suggestions from API with categories
        function loadTemplateSuggestions() {
            fetch('<?php echo $baseUrl; ?>/get-templates.php')
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
                        categoryHeader.className = 'category-header collapsed';
                        categoryHeader.innerHTML = `
                            <span class="category-title">${category.name}</span>
                            <span class="category-count">(${category.count})</span>
                            <span class="category-arrow">▶</span>
                        `;
                        
                        // Create questions container
                        const questionsContainer = document.createElement('div');
                        questionsContainer.className = 'category-questions';
                        questionsContainer.style.display = 'none'; // All categories collapsed by default
                        
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
                                this.style.background = '#3b82f6';
                                this.style.color = 'white';
                                this.style.transform = 'translateX(2px)';
                                this.style.boxShadow = '0 2px 8px rgba(59, 130, 246, 0.3)';
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
            console.log('📍 Fetching from:', '<?php echo $baseUrl; ?>/get-all-questions.php');
            
            fetch('<?php echo $baseUrl; ?>/get-all-questions.php')
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
                                this.style.background = '#3b82f6';
                                this.style.color = 'white';
                                this.style.transform = 'translateX(4px)';
                                this.style.boxShadow = '0 4px 12px rgba(59, 130, 246, 0.3)';
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
            if (!rating) {
                alert('Mohon beri rating');
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
            const suggestionsContainer = document.getElementById('chatSuggestions');
            
            // Close suggestions on Escape
            if (e.key === 'Escape') {
                if (suggestionsContainer) {
                    suggestionsContainer.classList.remove('show');
                }
                return;
            }
            
            // Send message on Enter
            if (e.key === 'Enter') {
                if (suggestionsContainer && suggestionsContainer.classList.contains('show')) {
                    // If suggestions are open, close them first
                    suggestionsContainer.classList.remove('show');
                    return;
                }
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
            botMsgDiv.innerHTML = `
                <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="Bot" class="bot-avatar">
                <div class="msg-content typing-indicator"><span></span><span></span><span></span></div>
            `;
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
                    const msgContent = botMsgDiv.querySelector('.msg-content');
                    msgContent.innerHTML = 'Maaf, saya tidak dapat menjawab pertanyaan tersebut. Silakan coba dengan pertanyaan lain.';
                    msgContent.classList.remove('typing-indicator');
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            })
            .catch(err => {
                // Re-enable send button & input on error
                if (sendButton) sendButton.disabled = false;
                if (chatInput) chatInput.disabled = false;
                
                console.error('Error:', err);
                const msgContent = botMsgDiv.querySelector('.msg-content');
                msgContent.innerHTML = 'Maaf, terjadi kesalahan koneksi. Silakan periksa koneksi internet Anda dan coba lagi.';
                msgContent.classList.remove('typing-indicator');
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
            
            const feedbackModal = document.getElementById('feedbackModal');

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
