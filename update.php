<?php
require_once __DIR__ . '/siswaController.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$old = getSiswaById($id);

if (!$old) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateSiswa($id, $_POST, $_FILES);
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Edit Siswa</title>
    <style>
    body {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        background-attachment: fixed;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 30px;
        max-width: 700px;
        margin: 0 auto;
    }

    .form-title {
        color: #2575fc;
        font-weight: 700;
        border-bottom: 3px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .btn-submit {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        width: 100%;
        margin-top: 15px;
    }

    .btn-submit:hover {
        background: linear-gradient(to right, #2575fc, #6a11cb);
        transform: scale(1.02);
    }

    .form-label {
        font-weight: 600;
        color: #555;
    }

    .photo-preview {
        width: 150px;
        height: 200px;
        object-fit: cover;
        border: 2px dashed #6a11cb;
        border-radius: 10px;
        padding: 5px;
        display: block;
        margin: 15px auto;
    }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="form-title text-center">
            <i class="fas fa-user-edit me-2"></i>Edit Data Siswa
        </h2>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $old['id'] ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control form-control-lg" required
                        value="<?= htmlspecialchars($old['nama']) ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Umur</label>
                    <input type="number" name="umur" class="form-control form-control-lg"
                        value="<?= htmlspecialchars($old['umur']) ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select form-select-lg">
                        <option value="L" <?= $old['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= $old['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control form-control-lg"
                    rows="3"><?= htmlspecialchars($old['alamat']) ?></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Foto Siswa (Rasio 3:4)</label>
                <input type="file" name="image" class="form-control form-control-lg" id="imageInput">

                <?php if($old['image']): ?>
                <img src="<?= htmlspecialchars($old['image']) ?>" class="photo-preview mt-3" id="photoPreview"
                    alt="Foto Sebelumnya">
                <?php else: ?>
                <div class="text-center mt-3">
                    <img src="" class="photo-preview d-none" id="photoPreview" alt="Preview Foto">
                    <p class="text-muted mt-2" id="previewText">Belum ada foto dipilih</p>
                </div>
                <?php endif; ?>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-submit">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
                <a href="index.php" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('photoPreview');
        const previewText = document.getElementById('previewText');

        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (previewText) previewText.classList.add('d-none');
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
    </script>
</body>

</html>