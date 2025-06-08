<?php
// File: create.php
require_once __DIR__ . '/siswaController.php';
$isEdit = isset($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($isEdit) {
        updateSiswa($_POST['id'], $_POST, $_FILES);
    } else {
        createSiswa($_POST, $_FILES);
    }
    header('Location: index.php'); exit;
}

$old = $isEdit ? getSiswaById($_GET['id']) : null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?= $isEdit ? 'Edit' : 'Tambah' ?> Siswa</title>
</head>
<body class="p-5">
  <div class="container">
    <h1 class="mb-4"><?= $isEdit ? 'Edit' : 'Tambah' ?> Siswa</h1>
    <form method="post" enctype="multipart/form-data">
      <?php if($isEdit): ?>
        <input type="hidden" name="id" value="<?= $old['id'] ?>">
      <?php endif; ?>
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" required value="<?= $old['nama'] ?? '' ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Umur</label>
        <input type="number" name="umur" class="form-control" value="<?= $old['umur'] ?? '' ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select">
          <option value="L" <?= (isset($old['jenis_kelamin']) && $old['jenis_kelamin']=='L')? 'selected':'' ?>>L</option>
          <option value="P" <?= (isset($old['jenis_kelamin']) && $old['jenis_kelamin']=='P')? 'selected':'' ?>>P</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control"><?= $old['alamat'] ?? '' ?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" name="image" class="form-control">
        <?php if($isEdit && $old['image']): ?>
          <img src="<?= htmlspecialchars($old['image']) ?>" width="100" class="mt-2">
        <?php endif; ?>
      </div>
      <button class="btn btn-success">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</body>
</html>