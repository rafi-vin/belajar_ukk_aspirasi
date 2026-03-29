<?php
session_start();
include '../config/koneksi.php';


$nis = $_SESSION['nis'];
$id_kategori = $_POST['id_kategori'];
$lokasi = $_POST['lokasi'];
$keterangan = $_POST['keterangan'];
$tanggal = date('Y-m-d');


mysqli_query($koneksi, "INSERT INTO aspirasi (nis, id_kategori, lokasi, keterangan, tanggal)
VALUES ('$nis','$id_kategori','$lokasi','$keterangan','$tanggal')");


header("Location: ../siswa/dashboard.php");
