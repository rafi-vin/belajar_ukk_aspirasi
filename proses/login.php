<?php
session_start();
include '../config/koneksi.php';


$user = $_POST['user'];
$password = $_POST['password'];


/* ===== CEK ADMIN ===== */
$admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user' AND password='$password'");

if (mysqli_num_rows($admin) > 0) {
    $data = mysqli_fetch_assoc($admin);
    $_SESSION['admin'] = $data['username'];
    header("Location: ../admin/dashboard.php");
    exit;
}


/* ===== CEK SISWA (NIS SAJA) ===== */
$siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$user'"); 

if (mysqli_num_rows($siswa) > 0) {
    $data = mysqli_fetch_assoc($siswa);
    $_SESSION['nis'] = $data['nis'];
    header("Location: ../siswa/dashboard.php");
    exit;
}


/* ===== GAGAL ===== */
echo "<script>
    alert('Login gagal! Data tidak ditemukan.');
    window.location='../login.php';
</script>";
