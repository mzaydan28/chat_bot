<?php
$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chatbot Disperindag Jateng</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo $baseUrl; ?>/assets/styles.css" rel="stylesheet">
</head>
<body class="bg-light" style="font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo $baseUrl; ?>/index.php">
      <span class="badge bg-primary rounded-circle p-2"><i class="bi bi-chat-dots-fill text-white"></i></span>
      <span class="fw-600">Chatbot Disperindag Jateng</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="<?php echo $baseUrl; ?>/chat.php">Chat</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
        <li class="nav-item ms-2"><a class="btn btn-sm btn-outline-primary" href="<?php echo dirname($baseUrl); ?>/admin/login.php">Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">