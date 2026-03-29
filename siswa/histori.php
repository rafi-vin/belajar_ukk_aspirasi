<?php
session_start();
include '../config/koneksi.php';


// Cek login siswa
if (!isset($_SESSION['nis'])) {
    header("Location: ../index.php");
}


$nis = $_SESSION['nis'];


// Query histori aspirasi siswa
$query = mysqli_query($koneksi, "SELECT a.*, k.ket_kategori
    FROM aspirasi a
    JOIN kategori k ON a.id_kategori = k.id_kategori
    WHERE a.nis = '$nis'
    ORDER BY a.tanggal DESC"); ?>


<?php include '../assets/template/header.php'; ?>
<?php include '../assets/template/sidebar_siswa.php'; ?>
<?php include '../assets/template/navbar.php'; ?>


<div class="container-fluid">


     <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Histori Aspirasi Saya</h1>


    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-success text-white">
            <h6 class="m-0 font-weight-bold">Daftar Aspirasi</h6>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>


                    <tbody>
                    <?php $no = 1; while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['ket_kategori'] ?></td>
                            <td><?= $data['lokasi'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td>
                                <?php
                                if ($data['status'] == 'Menunggu') {
                                    echo "<span class='badge badge-secondary'>Menunggu</span>";
                                } elseif ($data['status'] == 'Proses') {
                                    echo "<span class='badge badge-warning'>Proses</span>";
                                } else {
                                    echo "<span class='badge badge-success'>Selesai</span>";
                                }
                                ?>
                            </td>
                            <td><?= $data['feedback'] ? $data['feedback'] : '-' ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>


            <a href="dashboard.php" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>


</div>


<?php include '../assets/template/footer.php'; ?>
