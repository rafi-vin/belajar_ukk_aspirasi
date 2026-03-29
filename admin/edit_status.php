<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

// ================= AMBIL ID =================
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: dashboard.php");
    exit;
}

// ================= AMBIL DATA =================
$query = mysqli_query($koneksi, "
    SELECT a.*, k.ket_kategori
    FROM aspirasi a
    JOIN kategori k ON a.id_kategori = k.id_kategori
    WHERE a.id_aspirasi = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: dashboard.php");
    exit;
}
?>

<?php include '../assets/template/header.php'; ?>
<?php include '../assets/template/sidebar_admin.php'; ?>
<?php include '../assets/template/navbar.php'; ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Status & Feedback</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <!-- Header -->
                <div class="card-header py-3 bg-warning text-dark">
                    <h6 class="m-0 font-weight-bold">
                        Aspirasi Siswa (<?= $data['ket_kategori']; ?>)
                    </h6>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="../proses/update_status.php" method="POST">

                        <input type="hidden" name="id_aspirasi" value="<?= $data['id_aspirasi']; ?>">

                        <!-- NIS -->
                        <div class="form-group">
                            <label class="font-weight-bold">NIS</label>
                            <input type="text" class="form-control"
                                value="<?= $data['nis']; ?>" readonly>
                        </div>

                        <!-- Lokasi -->
                        <div class="form-group">
                            <label class="font-weight-bold">Lokasi</label>
                            <input type="text" class="form-control"
                                value="<?= $data['lokasi']; ?>" readonly>
                        </div>

                        <!-- Keterangan -->
                        <div class="form-group">
                            <label class="font-weight-bold">Keterangan</label>
                            <textarea class="form-control" rows="3" readonly><?= $data['keterangan']; ?></textarea>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="font-weight-bold">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Menunggu" <?= $data['status'] == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                <option value="Proses" <?= $data['status'] == 'Proses' ? 'selected' : ''; ?>>Proses</option>
                                <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                            </select>
                        </div>

                        <!-- Feedback -->
                        <div class="form-group">
                            <label class="font-weight-bold">Feedback</label>
                            <textarea name="feedback" class="form-control" rows="4"
                                placeholder="Masukkan feedback untuk siswa..."><?= $data['feedback']; ?></textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>

                            <a href="dashboard.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

</div>

<?php include '../assets/template/footer.php'; ?>