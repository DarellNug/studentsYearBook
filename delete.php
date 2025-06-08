<?php
// File: delete.php
require_once __DIR__ . '/siswaController.php';
if (isset($_GET['id'])) {
    deleteSiswa($_GET['id']);
}
header('Location: index.php');
exit;
?>