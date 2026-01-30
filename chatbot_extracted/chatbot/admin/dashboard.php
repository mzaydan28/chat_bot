<?php
require_once __DIR__ . '/../includes/db.php';
session_start();
if (empty($_SESSION['admin_id'])) { header('Location: /chatbot/admin/login.php'); exit; }

// simple stats
$faqCount = $pdo->query('SELECT COUNT(*) as c FROM faq')->fetch()['c'];
$unanswered = $pdo->query('SELECT COUNT(*) as c FROM chat_unanswered')->fetch()['c'];
$logs = $pdo->query('SELECT COUNT(*) as c FROM chat_log')->fetch()['c'];
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<div class="container">
  <h4>Dashboard — <?php echo htmlentities($_SESSION['admin_name']);?></h4>
  <div class="row">
    <div class="col-md-4"><div class="card p-3">FAQs: <?php echo $faqCount;?></div></div>
    <div class="col-md-4"><div class="card p-3">Unanswered: <?php echo $unanswered;?></div></div>
    <div class="col-md-4"><div class="card p-3">Chat Logs: <?php echo $logs;?></div></div>
  </div>
  <hr>
  <a class="btn btn-sm btn-primary" href="/chatbot/admin/manage_faq.php">Kelola FAQ</a>
  <a class="btn btn-sm btn-secondary" href="/chatbot/admin/manage_faq.php?view=unanswered">Lihat Unanswered</a>
  <a class="btn btn-sm btn-outline-danger" href="/chatbot/admin/logout.php">Logout</a>
</div>
</body></html>