<?php
// File: index.php
require_once __DIR__ . '/siswaController.php';
$siswaList = getAllSiswa();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Daftar Siswa</title>
</head>
<body class="p-5">
  <div class="container">
    <h1 class="mb-4">Buku Tahunan Siswa</h1>
    <a href="create.php" class="btn btn-primary mb-3">Tambah Siswa</a>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Umur</th>
          <th>Jenis Kelamin</th>
          <th>Alamat</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($siswaList as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['id']) ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['umur']) ?></td>
          <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['alamat'])) ?></td>
          <td><img src="<?= htmlspecialchars($row['image']) ?>" width="80"></td>
          <td>
            <a href="create.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
