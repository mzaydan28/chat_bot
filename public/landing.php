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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>DISCHA - Chatbot Layanan Disperindag</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        :root {
            --primary: #37517E;
            --primary-dark: #2d4166;
            --primary-light: #4a658f;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-tertiary: #f3f4f6;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            --gradient-secondary: linear-gradient(135deg, #37517E 0%, #2d4166 100%);
            --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.18);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #e8f0f7;
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            z-index: -1;
        }

        @keyframes backgroundShift {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }

        .navbar, .chat-container {
            position: relative;
            z-index: 1;
        }

        .navbar {
            background: linear-gradient(135deg, #37517E 0%, #4a658f 50%, #5a7eb8 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding: 0 24px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 32px rgba(55, 81, 126, 0.4), 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
        }

        .navbar::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255, 215, 0, 0.4) 20%, 
                rgba(255, 255, 255, 0.6) 50%, 
                rgba(255, 215, 0, 0.4) 80%, 
                transparent 100%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-logo {
            width: 46px;
            height: 46px;
            object-fit: contain;
            filter: drop-shadow(0 4px 16px rgba(255, 255, 255, 0.5));
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-logo:hover {
            transform: scale(1.15) rotate(5deg);
            filter: drop-shadow(0 8px 24px rgba(255, 255, 255, 0.8));
        }

        .navbar-title {
            font-size: 22px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar-subtitle {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: -2px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .tutorial-btn {
            padding: 9px 18px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #37517E;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            letter-spacing: 0.01em;
        }

        .tutorial-btn .btn-text,
        .feedback-btn .btn-text {
            display: inline;
        }

        .tutorial-btn:hover {
            background: white;
            color: #2d4166;
            border-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .navbar-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .feedback-btn {
            padding: 9px 18px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #37517E;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            letter-spacing: 0.01em;
        }

        .feedback-btn:hover {
            background: white;
            color: #2d4166;
            border-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .info-section {
            background: linear-gradient(180deg, #e8f0f7 0%, #d4e3f0 100%);
            padding: 80px 24px;
            text-align: center;
        }

        .info-logo {
            width: 180px;
            height: 180px;
            margin: 0 auto 32px;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 25px rgba(55, 81, 126, 0.3));
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .info-title {
            font-size: 56px;
            font-weight: 800;
            background: linear-gradient(135deg, #37517E 0%, #5a7eb8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            letter-spacing: -2px;
        }

        .info-subtitle {
            font-size: 24px;
            font-weight: 600;
            color: #37517E;
            margin-bottom: 16px;
        }

        .info-description {
            font-size: 16px;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .footer {
            background: linear-gradient(135deg, #2d3e50 0%, #1a252f 100%);
            color: white;
            padding: 40px 24px;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-copyright {
            font-size: 14px;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .footer-powered {
            font-size: 13px;
            opacity: 0.7;
        }

        .chat-container {
            display: flex;
            height: 600px;
            max-width: 1400px;
            margin: 10px auto 40px;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid var(--glass-border);
        }

        .sidebar {
            width: 340px;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-right: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid var(--glass-border);
            background: linear-gradient(135deg, rgba(55, 81, 126, 0.1) 0%, rgba(74, 101, 143, 0.1) 100%);
        }

        .sidebar-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .sidebar-header p {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 12px;
        }

        .ppid-links-section {
            padding: 16px 12px;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, rgba(55, 81, 126, 0.05) 0%, rgba(74, 101, 143, 0.05) 100%);
        }

        .ppid-section-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 10px;
            padding-left: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .ppid-links-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .ppid-link-btn {
            padding: 9px 11px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(55, 81, 126, 0.15);
            border-radius: 7px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.22s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .ppid-link-btn:hover {
            background: #37517E;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(55, 81, 126, 0.25);
            border-color: #37517E;
        }

        .ppid-link-btn::before {
            content: '📄';
            font-size: 14px;
        }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid var(--border-color);
        }

        .view-all-btn {
            width: 100%;
            padding: 12px;
            background: #37517E;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(55, 81, 126, 0.25);
            letter-spacing: 0.01em;
        }

        .view-all-btn:hover {
            background: #2d4166;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(55, 81, 126, 0.35);
        }

        .question-category {
            margin-bottom: 12px;
        }

        .category-header {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(55, 81, 126, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        }

        .category-header:hover {
            background: #37517E;
            color: white;
            transform: translateX(2px);
            box-shadow: 0 3px 10px rgba(55, 81, 126, 0.3);
        }

        .category-title {
            flex: 1;
            text-align: left;
        }

        .category-count {
            font-size: 12px;
            opacity: 0.7;
            margin-right: 8px;
        }

        .category-arrow {
            font-size: 10px;
            transition: transform 0.3s;
        }

        .category-questions {
            padding: 8px 0;
            display: none;
        }

        .chat-question-item {
            width: 100%;
            padding: 11px 13px;
            margin: 5px 0;
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(55, 81, 126, 0.12);
            border-radius: 7px;
            text-align: left;
            font-size: 13px;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .chat-question-item:hover {
            background: #37517E !important;
            color: white !important;
            transform: translateX(4px) !important;
            border-color: #37517E !important;
            box-shadow: 0 3px 10px rgba(55, 81, 126, 0.28) !important;
        }

        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--bg-primary);
        }

        .chat-header {
            padding: 20px 28px;
            border-bottom: 2px solid rgba(55, 81, 126, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(250, 250, 255, 0.9) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 2px 12px rgba(55, 81, 126, 0.1);
            position: relative;
        }

        .chat-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-header-right {
            display: none;
            position: relative;
        }

        .ppid-dropdown {
            position: relative;
        }

        .ppid-dropdown-btn {
            padding: 7px 13px;
            background: #37517E;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.22s ease;
            box-shadow: 0 2px 6px rgba(55, 81, 126, 0.22);
            white-space: nowrap;
            letter-spacing: 0.01em;
        }

        .ppid-dropdown-btn:hover {
            background: #2d4166;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(55, 81, 126, 0.3);
        }

        .ppid-dropdown-btn.active {
            background: #2d4166;
        }

        .dropdown-arrow {
            font-size: 10px;
            transition: transform 0.3s;
        }

        .ppid-dropdown-btn.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .ppid-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow: hidden;
        }

        .ppid-dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .ppid-dropdown-item {
            display: block;
            padding: 11px 15px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-bottom: 1px solid rgba(55, 81, 126, 0.08);
            transition: all 0.2s ease;
        }

        .ppid-dropdown-item:last-child {
            border-bottom: none;
        }

        .ppid-dropdown-item:hover {
            background: #37517E;
            color: white;
            padding-left: 18px;
        }

        .chat-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-avatar {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            object-fit: contain;
            background: linear-gradient(135deg, rgba(55, 81, 126, 0.1) 0%, rgba(74, 101, 143, 0.08) 100%);
            padding: 6px;
            box-shadow: 0 4px 12px rgba(55, 81, 126, 0.2);
        }

        .chat-info h3 {
            font-size: 18px;
            font-weight: 800;
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4px;
        }

        .chat-status {
            font-size: 12px;
            color: #10b981;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
        }

        .chat-status::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0.1) 100%);
        }

        .message {
            display: flex;
            margin-bottom: 20px;
            animation: messageSlide 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .bot-msg .msg-content {
            background: rgba(255, 255, 255, 0.95);
            color: var(--text-primary);
            padding: 16px 20px;
            border-radius: 20px 20px 20px 4px;
            max-width: 70%;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            line-height: 1.7;
            font-size: 14px;
            border: 1px solid rgba(55, 81, 126, 0.1);
        }

        .user-msg {
            justify-content: flex-end;
        }

        .user-msg .msg-content {
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            color: white;
            padding: 16px 20px;
            border-radius: 20px 20px 4px 20px;
            max-width: 70%;
            box-shadow: 0 8px 24px rgba(55, 81, 126, 0.4);
            line-height: 1.7;
            font-size: 14px;
        }

        .typing-indicator {
            display: flex;
            gap: 6px;
            padding: 16px 20px !important;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px 20px 20px 4px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(55, 81, 126, 0.1);
        }

        .typing-indicator span {
            width: 10px;
            height: 10px;
            background: linear-gradient(135deg, #37517E 0%, #4a658f 100%);
            border-radius: 50%;
            animation: typing 1.4s ease-in-out infinite;
            box-shadow: 0 2px 4px rgba(55, 81, 126, 0.3);
        }

        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0%, 60%, 100% {
                transform: translateY(0) scale(1);
                opacity: 0.7;
            }
            30% {
                transform: translateY(-12px) scale(1.2);
                opacity: 1;
            }
        }

        .chat-input-area {
            padding: 20px 28px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid var(--glass-border);
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.05);
        }

        .input-wrapper {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .chat-input {
            flex: 1;
            padding: 15px 18px;
            border: 1px solid rgba(55, 81, 126, 0.2);
            border-radius: 10px;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.25s ease;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .chat-input:focus {
            outline: none;
            border-color: #37517E;
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 0 3px rgba(55, 81, 126, 0.08), 0 2px 8px rgba(55, 81, 126, 0.15);
        }

        .send-btn {
            width: 54px;
            height: 54px;
            background: #37517E;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 22px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(55, 81, 126, 0.25);
        }

        .send-btn:hover {
            background: #2d4166;
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(55, 81, 126, 0.35);
        }

        .send-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
            transform: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .mobile-view-all-btn {
            display: none;
            width: 100%;
            padding: 11px;
            background: #37517E;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(55, 81, 126, 0.25);
            margin-bottom: 12px;
            letter-spacing: 0.01em;
        }

        .mobile-view-all-btn:hover {
            background: #2d4166;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(55, 81, 126, 0.35);
        }

        .chat-suggestions {
            display: none;
            padding: 12px 0;
            margin-bottom: 8px;
        }

        .chat-suggestions.show {
            display: block;
        }

        .suggestions-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .suggestion-chip {
            padding: 7px 14px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(55, 81, 126, 0.18);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
        }

        .suggestion-chip:hover {
            background: #37517E;
            color: white;
            border-color: #37517E;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(55, 81, 126, 0.28);
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none !important;
            }

            .sidebar-footer {
                display: none;
            }

            .mobile-view-all-btn {
                display: block;
            }

            .navbar {
                padding: 0 16px;
            }

            .tutorial-btn,
            .feedback-btn {
                padding: 7px 12px;
                font-size: 12px;
            }

            .navbar-buttons {
                gap: 8px;
            }

            .chat-header-right {
                display: block;
            }

            .chat-header {
                padding: 14px 16px;
            }

            .chat-avatar {
                width: 44px;
                height: 44px;
            }

            .chat-info h3 {
                font-size: 16px;
            }

            .chat-status {
                font-size: 11px;
            }

            .ppid-dropdown-btn {
                padding: 6px 10px;
                font-size: 11px;
                gap: 4px;
            }

            .ppid-dropdown-menu {
                min-width: 150px;
            }

            .ppid-dropdown-item {
                padding: 10px 14px;
                font-size: 12px;
            }

            .chat-container {
                margin: 5px;
                border-radius: 16px;
                max-width: 100%;
            }

            .chat-main {
                width: 100%;
            }

            .chat-messages {
                padding: 16px;
            }

            .chat-input {
                padding: 14px 16px;
                font-size: 14px;
            }

            .bot-msg .msg-content,
            .user-msg .msg-content {
                max-width: 85%;
                font-size: 13px;
                padding: 14px 16px;
            }

            .chat-input-area {
                padding: 16px;
            }

            .send-btn {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .chat-avatar {
                width: 42px;
                height: 42px;
            }

            .chat-info h3 {
                font-size: 16px;
            }

            .chat-status {
                font-size: 11px;
            }

            .chat-container {
                height: 600px;
            }

            .info-section {
                padding: 60px 20px;
            }

            .info-logo {
                width: 140px;
                height: 140px;
                margin-bottom: 24px;
            }

            .info-title {
                font-size: 40px;
            }

            .info-subtitle {
                font-size: 20px;
            }

            .info-description {
                font-size: 15px;
                padding: 0 10px;
            }

            .footer {
                padding: 32px 20px;
            }

            .footer-copyright {
                font-size: 13px;
            }

            .footer-powered {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0 12px;
                height: 65px;
            }

            .navbar-logo {
                width: 36px;
                height: 36px;
            }

            .navbar-title {
                font-size: 16px;
            }

            .navbar-subtitle {
                font-size: 9px;
            }

            .tutorial-btn,
            .feedback-btn {
                padding: 6px 10px;
                font-size: 11px;
                gap: 3px;
            }

            .tutorial-btn .btn-icon,
            .feedback-btn .btn-icon {
                display: none;
            }

            .navbar-buttons {
                gap: 5px;
            }

            .chat-header {
                padding: 12px 14px;
            }

            .chat-avatar {
                width: 40px;
                height: 40px;
            }

            .chat-info h3 {
                font-size: 15px;
            }

            .chat-status {
                font-size: 10px;
            }

            .ppid-dropdown-btn {
                padding: 6px 10px;
                font-size: 10px;
                gap: 4px;
            }

            .ppid-dropdown-menu {
                min-width: 145px;
            }

            .ppid-dropdown-item {
                padding: 10px 12px;
                font-size: 11px;
            }

            .chat-container {
                margin: 3px;
                border-radius: 12px;
                height: calc(100vh - 68px);
            }

            .chat-input {
                padding: 12px 14px;
                font-size: 13px;
            }

            .send-btn {
                width: 46px;
                height: 46px;
                font-size: 18px;
            }

            .mobile-view-all-btn {
                padding: 10px;
                font-size: 12px;
            }

            .bot-msg .msg-content,
            .user-msg .msg-content {
                max-width: 90%;
                font-size: 12px;
                padding: 12px 14px;
            }

            .questions-modal-content,
            .feedback-modal-content {
                width: 95%;
                max-height: 85vh;
                border-radius: 20px;
            }

            .questions-header {
                padding: 16px 20px;
                font-size: 18px;
            }

            .all-question-item {
                padding: 12px 14px;
                font-size: 13px;
                margin: 6px 0;
            }

            .feedback-header {
                padding: 24px 20px 20px;
            }

            .feedback-header h3 {
                font-size: 19px;
            }

            .feedback-close-btn {
                width: 32px;
                height: 32px;
                top: 16px;
                right: 16px;
                font-size: 18px;
            }

            .form-group,
            .form-group:first-of-type {
                padding: 16px 20px !important;
            }

            .form-group.rating-section {
                margin: 8px 20px;
                padding: 20px !important;
            }

            .rating-group-modal label {
                font-size: 36px;
            }

            .form-group label {
                font-size: 13px;
                margin-bottom: 8px;
            }

            .form-group input,
            .form-group textarea {
                padding: 12px 14px;
                font-size: 13px;
            }

            .form-actions-modal {
                padding: 20px 20px 24px;
            }

            .btn-submit-modal {
                padding: 15px;
                font-size: 14px;
            }

            .modal-questions-body {
                padding: 16px;
            }

            .questions-grid {
                padding: 12px;
            }

            .all-category-header {
                padding: 12px 14px;
                font-size: 13px;
            }

            .all-category-title {
                font-size: 13px;
            }

            .all-category-count {
                font-size: 11px;
            }

            .chat-container {
                height: calc(100vh - 75px);
                margin: 5px 5px 30px;
            }

            .info-section {
                padding: 50px 16px;
            }

            .info-logo {
                width: 120px;
                height: 120px;
                margin-bottom: 20px;
            }

            .info-title {
                font-size: 32px;
                letter-spacing: -1px;
            }

            .info-subtitle {
                font-size: 18px;
                margin-bottom: 12px;
            }

            .info-description {
                font-size: 14px;
                padding: 0 5px;
            }

            .footer {
                padding: 28px 16px;
            }

            .footer-copyright {
                font-size: 12px;
            }

            .footer-powered {
                font-size: 11px;
            }
        }

        @media (max-width: 360px) {
            .navbar {
                padding: 0 8px;
                height: 60px;
            }

            .navbar-logo {
                width: 32px;
                height: 32px;
            }

            .navbar-title {
                font-size: 14px;
            }

            .navbar-subtitle {
                font-size: 8px;
            }

            .tutorial-btn,
            .feedback-btn {
                padding: 5px 8px;
                font-size: 10px;
                min-width: auto;
            }

            .navbar-buttons {
                gap: 4px;
            }

            .chat-header {
                padding: 12px 10px;
            }

            .chat-avatar {
                width: 38px;
                height: 38px;
            }

            .chat-info h3 {
                font-size: 14px;
            }

            .chat-status {
                font-size: 10px;
            }

            .ppid-dropdown-btn {
                padding: 5px 8px;
                font-size: 10px;
                gap: 3px;
            }

            .ppid-dropdown-menu {
                min-width: 140px;
            }

            .ppid-dropdown-item {
                padding: 9px 12px;
                font-size: 11px;
            }

            .all-question-item {
                padding: 10px 12px;
                font-size: 12px;
                margin: 5px 0;
            }

            .all-category-header {
                padding: 10px 12px;
                font-size: 12px;
            }
        }

        .all-question-item:hover,
        button.all-question-item:hover {
            background: #37517E !important;
            color: white !important;
            transform: translateX(4px) !important;
            box-shadow: 0 4px 14px rgba(55, 81, 126, 0.32) !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(55, 81, 126, 0.5);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(55, 81, 126, 0.7);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideOutUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        .questions-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .questions-modal.open {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .questions-modal-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            max-width: 900px;
            width: 90%;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .questions-header {
            padding: 24px 28px;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(55, 81, 126, 0.1) 0%, rgba(74, 101, 143, 0.1) 100%);
        }

        .questions-header h3 {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(55, 81, 126, 0.15);
            width: 38px;
            height: 38px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            color: var(--text-secondary);
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .close-btn:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
            transform: rotate(90deg);
            box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
        }

        .questions-grid {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .all-question-category {
            margin-bottom: 16px;
        }

        .all-category-header {
            width: 100%;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(55, 81, 126, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            font-weight: 600;
            color: var(--text-primary);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
        }

        .all-category-header:hover {
            background: rgba(55, 81, 126, 0.12);
            transform: translateX(2px);
            box-shadow: 0 3px 10px rgba(55, 81, 126, 0.2);
        }

        .all-category-header.expanded {
            background: #37517E;
            color: white;
            border-color: #37517E;
            box-shadow: 0 3px 10px rgba(55, 81, 126, 0.3);
        }

        .all-category-title {
            font-size: 15px;
            flex: 1;
        }

        .all-category-count {
            font-size: 13px;
            opacity: 0.8;
            margin-left: 8px;
            margin-right: 8px;
        }

        .all-category-arrow {
            font-size: 12px;
        }

        .all-category-questions {
            overflow-y: auto;
            overflow-x: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .all-question-item {
            width: 100%;
            padding: 12px 16px;
            margin: 7px 0;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(55, 81, 126, 0.12);
            border-radius: 7px;
            text-align: left;
            font-size: 14px;
            font-weight: 400;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        #feedbackModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: 3000;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .feedback-modal-content {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 250, 255, 0.98) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            max-width: 540px;
            width: 92%;
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 70px rgba(55, 81, 126, 0.35), 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.6);
            animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feedback-header {
            position: relative;
            padding: 32px 32px 28px;
            background: linear-gradient(145deg, #37517E 0%, #4a658f 100%);
            text-align: center;
        }

        .feedback-header h3 {
            font-size: 24px;
            font-weight: 800;
            color: white;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 0.3px;
        }

        .feedback-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 2px;
        }

        .feedback-close-btn {
            position: absolute;
            top: 20px;
            right: 24px;
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 7px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            padding: 0;
        }

        .feedback-close-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.45);
            transform: rotate(90deg);
        }

        #feedbackForm {
            overflow-y: auto;
            max-height: calc(90vh - 180px);
        }

        .form-group {
            padding: 20px 32px;
        }

        .form-group:first-of-type {
            padding-top: 28px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            font-size: 14px;
            font-weight: 600;
            color: #37517E;
            letter-spacing: 0.01em;
        }

        .form-group .required {
            color: #e74c3c;
            font-weight: 700;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid rgba(55, 81, 126, 0.18);
            border-radius: 9px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.25s ease;
            background: white;
            color: var(--text-primary);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(55, 81, 126, 0.35);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #37517E;
            background: white;
            box-shadow: 0 0 0 3px rgba(55, 81, 126, 0.08), 0 2px 8px rgba(55, 81, 126, 0.12);
        }

        .form-group textarea {
            min-height: 110px;
            resize: vertical;
        }

        .form-group.rating-section {
            background: linear-gradient(145deg, rgba(55, 81, 126, 0.04) 0%, rgba(74, 101, 143, 0.04) 100%);
            border-radius: 16px;
            margin: 8px 32px;
            padding: 24px 32px !important;
        }

        .form-group.rating-section label:first-child {
            text-align: center;
            margin-bottom: 16px;
            font-size: 15px;
        }

        .rating-group-modal {
            display: flex;
            gap: 12px;
            flex-direction: row-reverse;
            justify-content: center;
            padding: 8px 0;
        }

        .rating-group-modal input {
            display: none;
        }

        .rating-group-modal label {
            font-size: 42px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #d0d0d0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.1));
        }

        .rating-group-modal label:hover {
            transform: scale(1.3) rotate(-5deg);
        }

        .rating-group-modal label:hover,
        .rating-group-modal label:hover ~ label {
            color: #ffd700;
            filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.4));
        }

        .rating-group-modal input:checked ~ label {
            color: #ffd700;
            filter: drop-shadow(0 4px 8px rgba(255, 215, 0, 0.5));
        }

        .form-actions-modal {
            padding: 24px 32px 32px;
            border-top: 1px solid rgba(55, 81, 126, 0.1);
            background: linear-gradient(180deg, transparent 0%, rgba(255, 255, 255, 0.5) 100%);
        }

        .btn-submit-modal {
            width: 100%;
            padding: 16px;
            background: #37517E;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 3px 12px rgba(55, 81, 126, 0.3);
            letter-spacing: 0.03em;
        }

        .btn-submit-modal:hover {
            background: #2d4166;
            transform: translateY(-1px);
            box-shadow: 0 5px 16px rgba(55, 81, 126, 0.4);
        }

        .required {
            color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">
            <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA" class="navbar-logo">
            <div>
                <div class="navbar-title">DISCHA</div>
                <div class="navbar-subtitle">Disperindag Jateng Chat Assistant</div>
            </div>
        </div>
        <div class="navbar-buttons">
            <a href="<?php echo $baseUrl; ?>/tutorial.php" class="tutorial-btn" title="Panduan Penggunaan">
                <span class="btn-icon">📖</span>
                <span class="btn-text">Panduan</span>
            </a>
            <button class="feedback-btn" onclick="openFeedbackModal()" title="Kritik & Saran">
                <span class="btn-icon">💬</span>
                <span class="btn-text">Kritik & Saran</span>
            </button>
        </div>
    </div>

    <div class="chat-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3>Pertanyaan Populer</h3>
                <p>Pilih atau ketik pertanyaan Anda</p>
            </div>

            <div class="ppid-links-section">
                <div class="ppid-section-title">
                    <span>📋</span>
                    <span>Informasi Publik</span>
                </div>
                <div class="ppid-links-grid">
                    <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/MWUxZmQ3ODgyYjQ2ZWQ0MmE3MDMwMTMyZThiNThlNTFkYjJmN2E2ZTQ0OTMzZjQxYzQ5YjliMmEyNWYyM2Q5" target="_blank" class="ppid-link-btn">
                        Berkala
                    </a>
                    <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/OGFmMGYwZWY1MTgwZDM4YzIyZDlmYjdjMGRmZGI0YWI4NDY2NWE5ZjcxZDcyOTY2ZjUxNzFmNWMyN2MzMWI-" target="_blank" class="ppid-link-btn">
                        Serta Merta
                    </a>
                    <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/NTYwNTczZTViYjg2ZmI1YmY4NThiMTY2MzQ2M2Q0ODVhNTY2NDk0OTIzNzc5NGNiNTRhMGQ3NmU0YmY2YjZi" target="_blank" class="ppid-link-btn">
                        Setiap Saat
                    </a>
                    <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/Yjk4MjVhMGM3YTFjOWYyOGU2Y2YwNzE1Yjc1NWY4OGNmMGI1ZjFjNzI0MzcxMTk1ZmEwMTIyM2Q4OWMzYzRh" target="_blank" class="ppid-link-btn">
                        Dikecualikan
                    </a>
                </div>
            </div>
            
            <div class="sidebar-content" id="chatQuestionsList">
            </div>
            <div class="sidebar-footer">
                <button class="view-all-btn" onclick="loadAllQuestions()">📋 Lihat Semua Pertanyaan</button>
            </div>
        </div>

        <div class="chat-main">
            <div class="chat-header">
                <div class="chat-header-left">
                    <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA" class="chat-avatar">
                    <div class="chat-info">
                        <h3>DISCHA</h3>
                        <span class="chat-status">Online 24/7</span>
                    </div>
                </div>
                <div class="chat-header-right">
                    <div class="ppid-dropdown">
                        <button class="ppid-dropdown-btn" onclick="togglePPIDDropdown()">
                            <span>📋 Info</span>
                            <span class="dropdown-arrow">▼</span>
                        </button>
                        <div class="ppid-dropdown-menu" id="ppidDropdownMenu">
                            <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/MWUxZmQ3ODgyYjQ2ZWQ0MmE3MDMwMTMyZThiNThlNTFkYjJmN2E2ZTQ0OTMzZjQxYzQ5YjliMmEyNWYyM2Q5" target="_blank" class="ppid-dropdown-item">📄 Berkala</a>
                            <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/OGFmMGYwZWY1MTgwZDM4YzIyZDlmYjdjMGRmZGI0YWI4NDY2NWE5ZjcxZDcyOTY2ZjUxNzFmNWMyN2MzMWI-" target="_blank" class="ppid-dropdown-item">📑 Serta Merta</a>
                            <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/NTYwNTczZTViYjg2ZmI1YmY4NThiMTY2MzQ2M2Q0ODVhNTY2NDk0OTIzNzc5NGNiNTRhMGQ3NmU0YmY2YjZi" target="_blank" class="ppid-dropdown-item">📋 Setiap Saat</a>
                            <a href="https://disperindag.jatengprov.go.id/v3/ppid/post_baca/Yjk4MjVhMGM3YTFjOWYyOGU2Y2YwNzE1Yjc1NWY4OGNmMGI1ZjFjNzI0MzcxMTk1ZmEwMTIyM2Q4OWMzYzRh" target="_blank" class="ppid-dropdown-item">📃 Dikecualikan</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages">
                <div class="message bot-msg">
                    <div class="msg-content">👋 Halo! Saya DISCHA, asisten virtual Disperindag Jawa Tengah. Ada yang bisa saya bantu?</div>
                </div>
            </div>

            <div class="chat-input-area">
                <button class="mobile-view-all-btn" onclick="loadAllQuestions()">📋 Lihat Semua Pertanyaan</button>
                <div id="chatSuggestions" class="chat-suggestions">
                    <div id="suggestionsList" class="suggestions-list"></div>
                </div>
                <div class="input-wrapper">
                    <input type="text" id="pesan" class="chat-input" placeholder="Ketik pertanyaan Anda..." autocomplete="off">
                    <button class="send-btn" onclick="sendChatMessage()">➤</button>
                </div>
            </div>
        </div>
    </div>

    <section class="info-section">
        <img src="<?php echo $baseUrl; ?>/../assets/images/Discha-removebg-preview.png" alt="DISCHA Logo" class="info-logo">
        <h1 class="info-title">DISCHA</h1>
        <h2 class="info-subtitle">Asisten Digital Disperindag Jateng</h2>
        <p class="info-description">Informasi layanan, program UMKM, dan perizinan usaha - tersedia 24/7</p>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-copyright">
                🏛️ © 2026 DISCHA Chatbot - Dinas Perindustrian dan Perdagangan Jawa Tengah
            </div>
            <div class="footer-powered">
                Powered by AI • Tersedia 24/7 • Informasi Terpercaya
            </div>
        </div>
    </footer>

    <div id="allQuestionsModal" class="questions-modal">
        <div class="questions-modal-content">
            <div class="questions-header">
                <h3>Daftar Pertanyaan</h3>
                <button class="close-btn" onclick="closeAllQuestionsModal()">✕</button>
            </div>
            <div class="questions-grid" id="allQuestionsList">
            </div>
        </div>
    </div>

    <div id="feedbackModal">
        <div class="feedback-modal-content">
            <div class="feedback-header">
                <h3>Umpan Balik Anda</h3>
                <button type="button" class="feedback-close-btn" onclick="closeFeedbackModal()">×</button>
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
                <div class="form-group rating-section">
                    <label>Penilaian Kepuasan</label>
                    <div class="rating-group-modal">
                        <input type="radio" name="rating" value="4" id="rating4m">
                        <label for="rating4m">★</label>
                        <input type="radio" name="rating" value="3" id="rating3m">
                        <label for="rating3m">★</label>
                        <input type="radio" name="rating" value="2" id="rating2m">
                        <label for="rating2m">★</label>
                        <input type="radio" name="rating" value="1" id="rating1m">
                        <label for="rating1m">★</label>
                    </div>
                </div>
                <div class="form-actions-modal">
                    <button type="submit" class="btn-submit-modal">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        console.log('🚀 DISCHA Chat Interface loaded');
        
        // PPID Dropdown Toggle (Mobile)
        function togglePPIDDropdown() {
            const btn = document.querySelector('.ppid-dropdown-btn');
            const menu = document.getElementById('ppidDropdownMenu');
            
            btn.classList.toggle('active');
            menu.classList.toggle('show');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.querySelector('.ppid-dropdown');
            if (dropdown && !dropdown.contains(e.target)) {
                const btn = document.querySelector('.ppid-dropdown-btn');
                const menu = document.getElementById('ppidDropdownMenu');
                if (btn && menu) {
                    btn.classList.remove('active');
                    menu.classList.remove('show');
                }
            }
        });
        
        // Load template suggestions on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing chat...');
            loadTemplateSuggestions();
            initChatSuggestions();
            loadTemplateQuestions();
            
            // Setup Enter key listener
            const chatInput = document.getElementById('pesan');
            if (chatInput) {
                chatInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        e.preventDefault();
                        sendChatMessage();
                    }
                });
            }
            
            // Focus on input
            setTimeout(() => {
                const input = document.getElementById('pesan');
                if (input) input.focus();
            }, 300);
        });

        // Load template suggestions from API with categories
        function loadTemplateSuggestions() {
            fetch('<?php echo $baseUrl; ?>/get-templates.php')
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('chatQuestionsList');
                    container.innerHTML = '';
                    
                    if (!data || !data.categories || data.categories.length === 0) {
                        container.innerHTML = '<p style="color: var(--text-secondary); font-size: 12px; text-align: center; padding: 20px;">Tidak ada pertanyaan</p>';
                        return;
                    }
                    
                    data.categories.forEach((category, index) => {
                        const categoryDiv = document.createElement('div');
                        categoryDiv.className = 'question-category';
                        
                        const categoryHeader = document.createElement('button');
                        categoryHeader.className = 'category-header';
                        categoryHeader.innerHTML = `
                            <span class="category-title">${category.name}</span>
                            <span class="category-count">${category.count}</span>
                            <span class="category-arrow">▶</span>
                        `;
                        
                        const questionsContainer = document.createElement('div');
                        questionsContainer.className = 'category-questions';
                        questionsContainer.style.display = 'none';
                        
                        category.questions.forEach(question => {
                            const btn = document.createElement('button');
                            btn.className = 'chat-question-item';
                            btn.textContent = question;
                            btn.onclick = () => sendMessage(question);
                            questionsContainer.appendChild(btn);
                        });
                        
                        categoryHeader.onclick = () => {
                            const isVisible = questionsContainer.style.display === 'block';
                            questionsContainer.style.display = isVisible ? 'none' : 'block';
                            categoryHeader.querySelector('.category-arrow').textContent = isVisible ? '▶' : '▼';
                        };
                        
                        categoryDiv.appendChild(categoryHeader);
                        categoryDiv.appendChild(questionsContainer);
                        container.appendChild(categoryDiv);
                    });
                    
                    const allQuestions = data.categories.flatMap(cat => cat.questions);
                    window.allQuestionsForSuggest = allQuestions;
                })
                .catch(err => {
                    console.error('Error loading templates:', err);
                    document.getElementById('chatQuestionsList').innerHTML = 
                        '<p style="color: #ef4444; font-size: 12px; text-align: center; padding: 20px;">Error loading templates</p>';
                });
        }

        // Load all questions from API with categories
        function loadAllQuestions() {
            console.log('🔄 Loading all questions...');
            
            fetch('<?php echo $baseUrl; ?>/get-all-questions.php')
                .then(res => res.json())
                .then(data => {
                    console.log('📊 Data received:', data);
                    
                    const container = document.getElementById('allQuestionsList');
                    if (!container) {
                        console.error('❌ Container not found!');
                        return;
                    }
                    
                    container.innerHTML = '';
                    
                    if (!data || !data.categories || data.categories.length === 0) {
                        container.innerHTML = '<p style="padding: 20px; text-align: center; color: var(--text-secondary);">Tidak ada pertanyaan tersedia</p>';
                        return;
                    }
                    
                    data.categories.forEach((category, index) => {
                        const categoryDiv = document.createElement('div');
                        categoryDiv.className = 'all-question-category';
                        
                        const categoryHeader = document.createElement('button');
                        categoryHeader.className = 'all-category-header';
                        
                        categoryHeader.innerHTML = `
                            <span class="all-category-title">${category.name}</span>
                            <span class="all-category-count">(${category.count} pertanyaan)</span>
                            <span class="all-category-arrow">▶</span>
                        `;
                        
                        const questionsContainer = document.createElement('div');
                        questionsContainer.className = 'all-category-questions';
                        questionsContainer.style.cssText = `
                            padding: 0 12px;
                            max-height: 0;
                        `;
                        
                        category.questions.forEach(question => {
                            const btn = document.createElement('button');
                            btn.className = 'all-question-item';
                            btn.textContent = question;
                            btn.onclick = () => {
                                sendMessage(question);
                                closeAllQuestionsModal();
                                document.getElementById('pesan').focus();
                            };
                            questionsContainer.appendChild(btn);
                        });
                        
                        categoryHeader.onclick = () => {
                            const isExpanded = questionsContainer.style.maxHeight !== '0px';
                            const arrow = categoryHeader.querySelector('.all-category-arrow');
                            
                            if (isExpanded) {
                                questionsContainer.style.maxHeight = '0px';
                                questionsContainer.style.padding = '0 12px';
                                arrow.textContent = '▶';
                                categoryHeader.classList.remove('expanded');
                            } else {
                                // Gunakan scrollHeight untuk konten lebih responsif
                                // Dengan batas max 400px untuk desktop, unlimited untuk mobile
                                const contentHeight = questionsContainer.scrollHeight;
                                const isMobile = window.innerWidth <= 768;
                                const maxHeight = isMobile ? contentHeight : Math.min(contentHeight, 400);
                                
                                questionsContainer.style.maxHeight = maxHeight + 'px';
                                questionsContainer.style.padding = '12px';
                                arrow.textContent = '▼';
                                categoryHeader.classList.add('expanded');
                                
                                // Auto scroll ke kategori yang dibuka
                                setTimeout(() => {
                                    categoryDiv.scrollIntoView({ 
                                        behavior: 'smooth', 
                                        block: 'nearest'
                                    });
                                }, 100);
                            }
                        };
                        
                        categoryDiv.appendChild(categoryHeader);
                        categoryDiv.appendChild(questionsContainer);
                        container.appendChild(categoryDiv);
                    });
                    
                    document.getElementById('allQuestionsModal').classList.add('open');
                })
                .catch(err => {
                    console.error('❌ Error loading all questions:', err);
                    const container = document.getElementById('allQuestionsList');
                    if (container) {
                        container.innerHTML = '<p style="color: #ef4444; text-align: center; padding: 20px;">Error memuat pertanyaan</p>';
                    }
                });
        }

        function closeAllQuestionsModal() {
            document.getElementById('allQuestionsModal').classList.remove('open');
        }

        // Feedback Functions
        function openFeedbackModal() {
            console.log('Opening feedback modal');
            const feedbackModal = document.getElementById('feedbackModal');
            if (feedbackModal) {
                feedbackModal.style.display = 'flex';
                feedbackModal.style.visibility = 'visible';
                feedbackModal.style.opacity = '1';
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

        // Close feedback modal when clicking outside
        document.addEventListener('click', function(e) {
            const feedbackModal = document.getElementById('feedbackModal');
            if (e.target === feedbackModal) {
                closeFeedbackModal();
            }
        });

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
                animation: slideInDown 0.4s ease;
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
                successDiv.style.animation = 'slideOutUp 0.4s ease forwards';
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
                const suggestionsContainer = document.getElementById('chatSuggestions');
                if (suggestionsContainer) {
                    suggestionsContainer.classList.remove('show');
                }
                input.focus();
            }
        }

        function loadTemplateQuestions() {
            console.log('📡 Loading questions...');
            fetch('<?php echo $baseUrl; ?>/get-all-questions.php')
                .then(response => response.json())
                .then(data => {
                    if (data && data.categories) {
                        const allQuestions = data.categories.flatMap(cat => 
                            cat.questions.map(q => ({ question: q }))
                        );
                        window.chatTemplates = allQuestions;
                        console.log('✓ Loaded ' + allQuestions.length + ' questions');
                    }
                })
                .catch(error => console.error('✗ Error:', error));
        }
        
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
        }

        function sendMessage(message) {
            const chatMessages = document.getElementById('chatMessages');
            const sendButton = document.querySelector('.send-btn');
            const chatInput = document.getElementById('pesan');
            
            // Anti-spam: Check cooldown
            const now = Date.now();
            const cooldownTime = 2000;
            
            if (window.lastMessageTime && (now - window.lastMessageTime) < cooldownTime) {
                const remainingTime = Math.ceil((cooldownTime - (now - window.lastMessageTime)) / 1000);
                
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 80px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: rgba(239, 68, 68, 0.95);
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
            
            if (sendButton) sendButton.disabled = true;
            if (chatInput) chatInput.disabled = true;
            
            window.lastMessageTime = now;
            
            const userMsgDiv = document.createElement('div');
            userMsgDiv.className = 'message user-msg';
            userMsgDiv.innerHTML = `<div class="msg-content">${escapeHtml(message)}</div>`;
            chatMessages.appendChild(userMsgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            const botMsgDiv = document.createElement('div');
            botMsgDiv.className = 'message bot-msg';
            botMsgDiv.innerHTML = `<div class="msg-content typing-indicator"><span></span><span></span><span></span></div>`;
            chatMessages.appendChild(botMsgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            fetch('<?php echo $baseUrl; ?>/proses.php', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: 'pesan=' + encodeURIComponent(message)
            })
            .then(res => {
                const contentType = res.headers.get('content-type');
                if (contentType && contentType.includes('text/html')) {
                    return res.text().then(html => {
                        if (html.includes('aes.js') || html.includes('challenge') || html.includes('<script')) {
                            throw new Error('SECURITY_CHALLENGE');
                        }
                        return html;
                    });
                }
                return res.text();
            })
            .then(data => {
                if (sendButton) sendButton.disabled = false;
                if (chatInput) chatInput.disabled = false;
                
                if (data && data.trim()) {
                    const fullText = data.trim();
                    const messageContent = botMsgDiv.querySelector('.msg-content');
                    messageContent.innerHTML = '';
                    messageContent.classList.remove('typing-indicator');
                    
                    let charIndex = 0;
                    const typingSpeed = 20;
                    
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
                if (sendButton) sendButton.disabled = false;
                if (chatInput) chatInput.disabled = false;
                
                console.error('Error:', err);
                
                if (err.message === 'SECURITY_CHALLENGE') {
                    botMsgDiv.innerHTML = `<div class="msg-content">
                        ⚠️ <strong>Verifikasi Keamanan Diperlukan</strong><br><br>
                        Sistem hosting mendeteksi akses dari perangkat baru.<br><br>
                        <strong>Solusi:</strong><br>
                        1. Refresh halaman ini (tekan F5)<br>
                        2. Tunggu 5-10 detik hingga verifikasi selesai<br>
                        3. Coba kirim pesan lagi<br><br>
                        <em>Ini adalah proteksi keamanan otomatis dari hosting.</em>
                    </div>`;
                } else {
                    botMsgDiv.innerHTML = `<div class="msg-content">Maaf, terjadi kesalahan koneksi. Silakan periksa koneksi internet Anda dan coba lagi.</div>`;
                }
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        function linkifyText(text) {
            let safe = escapeHtml(text);
            safe = safe.replace(/\n/g, '<br>');
            const urlPattern = /(https?:\/\/[^\s<>"]+)/gi;
            safe = safe.replace(urlPattern, function(url) {
                let cleanUrl = url.replace(/[.,;!?)]$/, '');
                return `<a href="${cleanUrl}" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline; word-break: break-all;">${cleanUrl}</a>`;
            });
            return safe;
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('allQuestionsModal');
            if (e.target === modal) {
                closeAllQuestionsModal();
            }
            
            const feedbackModal = document.getElementById('feedbackModal');
            if (e.target === feedbackModal) {
                closeFeedbackModal();
            }
        });
    </script>
</body>
</html>
