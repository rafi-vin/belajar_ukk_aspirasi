<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

// ================= FILTER =================
$where = [];

if (!empty($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    $where[] = "a.tanggal = '$tanggal'";
}

if (!empty($_GET['bulan'])) {
    $bulan = $_GET['bulan'];
    $where[] = "DATE_FORMAT(a.tanggal, '%Y-%m') = '$bulan'";
}

if (!empty($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $where[] = "a.id_kategori = '$kategori'";
}

$whereSQL = "";
if (count($where) > 0) {
    $whereSQL = "WHERE " . implode(" AND ", $where);
}

// ================= QUERY =================
$query = mysqli_query($koneksi, "
    SELECT a.*, k.ket_kategori
    FROM aspirasi a
    JOIN kategori k ON a.id_kategori = k.id_kategori
    $whereSQL
    ORDER BY a.tanggal DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengaduan Sarana Sekolah</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background: #f2f2f2;
        }

        th, td {
            padding: 8px;
            font-size: 12px;
            text-align: center;
        }

        .ttd {
            margin-top: 60px;
            text-align: right;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>LAPORAN PENGADUAN SARANA SEKOLAH</h2>
    <h4>Tahun Pelajaran 2025 / 2026</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>NIS</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            <?php while ($d = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['tanggal'] ?></td>
                    <td><?= $d['nis'] ?></td>
                    <td><?= $d['ket_kategori'] ?></td>
                    <td><?= $d['lokasi'] ?></td>
                    <td><?= $d['status'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="ttd">
        <p>
            Mengetahui,<br>
            Admin Sarana Sekolah<br><br><br><br>
            ( ____________________ )
        </p>
    </div>

</body>
</html>