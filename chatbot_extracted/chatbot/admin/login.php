<?php
require_once __DIR__ . '/../includes/db.php';
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM users_admin WHERE username = ? LIMIT 1');
    $stmt->execute([$u]);
    $row = $stmt->fetch();
    if ($row && $p === $row['password']){
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'] ?? $row['username'];
        header('Location: /chatbot/admin/dashboard.php');
        exit;
    } else {
        $message = 'Creds salah';
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<div class="container" style="max-width:420px;">
  <h4>Admin Login</h4>
  <?php if($message):?><div class="alert alert-danger"><?php echo htmlentities($message);?></div><?php endif;?>
  <form method="post">
    <div class="mb-2"><input name="username" class="form-control" placeholder="username" required></div>
    <div class="mb-2"><input name="password" type="password" class="form-control" placeholder="password" required></div>
    <div><button class="btn btn-primary">Login</button></div>
  </form>
</div>
</body></html>