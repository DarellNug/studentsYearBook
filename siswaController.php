<?php
// File: siswaController.php
// Controller functions for CRUD
require_once __DIR__ . '/db.php';

function getAllSiswa() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM siswa ORDER BY id DESC");
    return $stmt->fetchAll();
}

function getSiswaById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM siswa WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createSiswa($data, $file) {
    global $pdo;
    $imgPath = uploadImage($file);
    $sql = "INSERT INTO siswa (nama, umur, jenis_kelamin, alamat, image) VALUES (?, ?, ?, ?, ?)";
    $pdo->prepare($sql)->execute([
        $data['nama'],
        $data['umur'],
        $data['jenis_kelamin'],
        $data['alamat'],
        $imgPath
    ]);
}

function updateSiswa($id, $data, $file) {
    global $pdo;
    if (isset($file['image']) && $file['image']['error'] === UPLOAD_ERR_OK) {
        $imgPath = uploadImage($file);
    } else {
        $old = getSiswaById($id);
        $imgPath = $old['image'];
    }
    $sql = "UPDATE siswa SET nama = ?, umur = ?, jenis_kelamin = ?, alamat = ?, image = ? WHERE id = ?";
    $pdo->prepare($sql)->execute([
        $data['nama'],
        $data['umur'],
        $data['jenis_kelamin'],
        $data['alamat'],
        $imgPath,
        $id
    ]);
}

function deleteSiswa($id) {
    global $pdo;
    $old = getSiswaById($id);
    if ($old && file_exists($old['image'])) {
        unlink($old['image']);
    }
    $pdo->prepare("DELETE FROM siswa WHERE id = ?")->execute([$id]);
}

function uploadImage($file) {
    $targetDir = __DIR__ . '/uploads/';
    if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
    $filename = time() . '_' . basename($file['image']['name']);
    $targetFile = $targetDir . $filename;
    move_uploaded_file($file['image']['tmp_name'], $targetFile);
    return 'uploads/' . $filename;
}
?>