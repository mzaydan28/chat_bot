<?php
session_start();
require_once __DIR__ . '/db.php';

function is_admin() {
    return !empty($_SESSION['admin_id']);
}

function require_admin() {
    if (!is_admin()) {
        header('Location: /chatbot/admin/login.php');
        exit;
    }
}

function admin_check_login($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users_admin WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $row = $stmt->fetch();
    if (!$row) return false;
    // For demo the SQL stores plaintext 'admin' password; in production use password_hash
    if ($password === $row['password']) {
        return $row;
    }
    return false;
}
?>