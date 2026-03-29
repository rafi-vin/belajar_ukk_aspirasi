<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}
?>

<?php
// ================= QUERY FILTER DINAMIS =================
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

$query = mysqli_query($koneksi, "
    SELECT a.*, k.ket_kategori
    FROM aspirasi a
    JOIN kategori k ON a.id_kategori = k.id_kategori
    $whereSQL
    ORDER BY a.tanggal DESC
");
?>

<?php include '../assets/template/header.php'; ?>
<?php include '../assets/template/sidebar_admin.php'; ?>
<?php include '../assets/template/navbar.php'; ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    <!-- FILTER -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Filter Laporan Aspirasi</h6>
        </div>

        <div class="card-body">
            <form method="GET" class="row">

                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control"
                        value="<?= $_GET['tanggal'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <input type="month" name="bulan" class="form-control"
                        value="<?= $_GET['bulan'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <select name="kategori" class="form-control">
                        <option value="">-- Semua Kategori --</option>
                        <?php
                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($k = mysqli_fetch_assoc($kat)) {
                            $selected = ($_GET['kategori'] ?? '') == $k['id_kategori'] ? 'selected' : '';
                            echo "<option value='{$k['id_kategori']}' $selected>{$k['ket_kategori']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-success">Filter</button>
                    <a href="dashboard.php" class="btn btn-secondary">Reset</a>
                </div>

            </form>
        </div>
    </div>

    <!-- TABEL DATA -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-dark text-white">
            <h6 class="m-0 font-weight-bold">Data Aspirasi Siswa</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['nis'] ?></td>
                                <td><?= $data['ket_kategori'] ?></td>
                                <td><?= $data['lokasi'] ?></td>
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
                                <td>
                                    <a href="edit_status.php?id=<?= $data['id_aspirasi'] ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="hapus.php?id=<?= $data['id_aspirasi'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<?php include '../assets/template/footer.php'; ?>