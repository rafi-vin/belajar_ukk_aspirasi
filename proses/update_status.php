<?php
include '../config/koneksi.php';

// ================= VALIDASI INPUT =================
$id       = $_POST['id_aspirasi'] ?? null;
$status   = $_POST['status'] ?? null;
$feedback = $_POST['feedback'] ?? null;

if (!$id || !$status) {
    header("Location: ../admin/dashboard.php");
    exit;
}

// ================= PREPARED STATEMENT =================
$stmt = mysqli_prepare($koneksi, "
    UPDATE aspirasi
    SET status = ?, feedback = ?
    WHERE id_aspirasi = ?
");

mysqli_stmt_bind_param($stmt, "ssi", $status, $feedback, $id);
mysqli_stmt_execute($stmt);

// ================= REDIRECT =================
header("Location: ../admin/dashboard.php");
exit;