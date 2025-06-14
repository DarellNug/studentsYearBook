<?php
require_once __DIR__ . '/siswaController.php';
$siswaList = getAllSiswa();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>CRUD Siswa</title>
    <style>
    body {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        background-attachment: fixed;
        background-size: cover;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .header-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .student-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        height: 100%;
        background: rgba(255, 255, 255, 0.95);
    }

    .student-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .student-photo {
        height: 250px;
        width: 100%;
        object-fit: cover;
        border-bottom: 4px solid #6a11cb;
    }

    .gender-icon {
        font-size: 1.2rem;
        margin-right: 5px;
    }

    .btn-primary {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #2575fc, #6a11cb);
        transform: scale(1.05);
    }

    .action-buttons .btn {
        border-radius: 10px;
        width: 100%;
        margin-bottom: 8px;
    }

    .card-title {
        color: #2575fc;
        font-weight: 700;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
    }

    .info-label {
        color: #6a11cb;
        font-weight: 600;
    }
    </style>
</head>

<body class="p-4">
    <div class="container">
        <div class="header-card p-4 mb-4 text-center">
            <h1 class="display-4 fw-bold mb-3" style="color: #2575fc;">
                <i class="fas fa-book me-2"></i>CRUD Siswa
            </h1>
            <a href="create.php" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Siswa Baru
            </a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($siswaList as $row): ?>
            <div class="col">
                <div class="card h-100 student-card">
                    <img src="<?= htmlspecialchars($row['image']) ?>" class="student-photo"
                        alt="Foto <?= htmlspecialchars($row['nama']) ?>">

                    <div class="card-body p-4">
                        <h3 class="card-title mb-4"><?= htmlspecialchars($row['nama']) ?></h3>

                        <div class="d-flex mb-3">
                            <div class="me-4">
                                <div class="info-label">Umur</div>
                                <div class="fs-5 fw-bold"><?= htmlspecialchars($row['umur']) ?> tahun</div>
                            </div>

                            <div>
                                <div class="info-label">Jenis Kelamin</div>
                                <div class="fs-5 fw-bold">
                                    <?php if($row['jenis_kelamin'] == 'L'): ?>
                                    <i class="fas fa-mars gender-icon text-primary"></i>Laki-laki
                                    <?php else: ?>
                                    <i class="fas fa-venus gender-icon text-danger"></i>Perempuan
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="info-label">Alamat</div>
                            <div class="card-text border rounded p-3 bg-light">
                                <?= nl2br(htmlspecialchars($row['alamat'])) ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white p-3 action-buttons">
                      <a href="update.php?id=<?= $row['id'] ?>" 
                        class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit
                      </a>
                      <a href="delete.php?id=<?= $row['id'] ?>" 
                        class="btn btn-danger" 
                        onclick="return confirm('Yakin hapus data siswa ini?')">
                        <i class="fas fa-trash me-2"></i>Hapus
                      </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="text-center text-white mt-5 py-3">
        <p class="mb-0">© 2023 Buku Tahunan Sekolah | Dibuat dengan <i class="fas fa-heart text-danger"></i></p>
    </footer>
</body>

</html>