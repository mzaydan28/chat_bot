<?php
require_once __DIR__ . '/../includes/db.php';
session_start();
if (empty($_SESSION['admin_id'])) { header('Location: /chatbot/admin/login.php'); exit; }
$msg='';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['pertanyaan'])){
    $kat = $_POST['kategori_id'] ?: null;
    $p = $_POST['pertanyaan'];
    $j = $_POST['jawaban'];
    $ins = $pdo->prepare('INSERT INTO faq (kategori_id,pertanyaan,jawaban) VALUES (?,?,?)');
    $ins->execute([$kat,$p,$j]);
    $msg = 'FAQ ditambahkan';
}

$faqs = $pdo->query('SELECT f.*, k.nama as kategori FROM faq f LEFT JOIN kategori_layanan k ON k.id=f.kategori_id ORDER BY f.id DESC')->fetchAll();
$kats = $pdo->query('SELECT * FROM kategori_layanan')->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>Kelola FAQ</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<div class="container">
  <h4>Kelola FAQ</h4>
  <?php if($msg):?><div class="alert alert-success"><?php echo htmlentities($msg);?></div><?php endif;?>
  <form method="post">
    <div class="mb-2">
      <select name="kategori_id" class="form-select">
        <option value="">-- Pilih Kategori --</option>
        <?php foreach($kats as $k):?><option value="<?php echo $k['id']?>"><?php echo htmlentities($k['nama']);?></option><?php endforeach;?>
      </select>
    </div>
    <div class="mb-2"><input name="pertanyaan" class="form-control" placeholder="Pertanyaan" required></div>
    <div class="mb-2"><textarea name="jawaban" class="form-control" placeholder="Jawaban" required></textarea></div>
    <div><button class="btn btn-primary">Tambah FAQ</button></div>
  </form>
  <hr>
  <h5>Daftar FAQ</h5>
  <table class="table table-sm"><thead><tr><th>ID</th><th>Kategori</th><th>Pertanyaan</th><th>Jawaban</th></tr></thead><tbody>
    <?php foreach($faqs as $f):?>
    <tr><td><?php echo $f['id']?></td><td><?php echo htmlentities($f['kategori'])?></td><td><?php echo htmlentities($f['pertanyaan'])?></td><td><?php echo htmlentities($f['jawaban'])?></td></tr>
    <?php endforeach;?>
  </tbody></table>
</div>
</body></html>