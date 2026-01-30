<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) $input = $_POST;
$message = trim($input['message'] ?? '');
$session = $input['session'] ?? null;

if (!$message) {
    echo json_encode(['error'=>'no message']);
    exit;
}

// Simple keyword search in faq
$stmt = $pdo->prepare('SELECT * FROM faq WHERE pertanyaan LIKE ? OR jawaban LIKE ? LIMIT 5');
$kw = "%".str_replace('%','',$message)."%";
$stmt->execute([$kw,$kw]);
$rows = $stmt->fetchAll();

$answer = null;
$is_answered = 0;
if ($rows && count($rows)>0) {
    $answer = $rows[0]['jawaban'];
    $is_answered = 1;
} else {
    // store to unanswered queue
    $u = $pdo->prepare('INSERT INTO chat_unanswered (session_key,message) VALUES (?,?)');
    $u->execute([$session, $message]);
    $answer = 'Maaf, saya belum punya jawaban untuk itu. Pertanyaan Anda akan diteruskan ke admin.';
}

// log chat
$log = $pdo->prepare('INSERT INTO chat_log (session_key,user_message,bot_response,is_answered) VALUES (?,?,?,?)');
$log->execute([$session, $message, $answer, $is_answered]);

echo json_encode(['answer'=>$answer,'found'=>$is_answered]);
