<?php
session_start();
include '../config/koneksi.php';


if (!isset($_SESSION['nis'])) {
    header("Location: ../index.php");
}
?>


<?php include '../assets/template/header.php'; ?>
<?php include '../assets/template/sidebar_siswa.php'; ?>
<?php include '../assets/template/navbar.php'; ?>


<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Input Aspirasi</h1>


    <div class="row justify-content-center">
        <div class="col-lg-8">


            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Form Pengaduan Sarana Sekolah</h6>
                </div>


                <div class="card-body">
                    <form action="../proses/simpan_aspirasi.php" method="POST">


                        <!-- Kategori -->
                        <div class="form-group">
                            <label class="font-weight-bold">Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM kategori");
                                while ($k = mysqli_fetch_assoc($q)) {
                                    echo "<option value='{$k['id_kategori']}'>{$k['ket_kategori']}</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <!-- Lokasi -->
                        <div class="form-group">
                            <label class="font-weight-bold">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control"
                                   placeholder="Contoh: Ruang Kelas X RPL" required>
                        </div>


                        <!-- Keterangan -->
                        <div class="form-group">
                            <label class="font-weight-bold">Keterangan</label>
                            <textarea name="keterangan" rows="4" class="form-control"
                                      placeholder="Jelaskan kondisi sarana..." required></textarea>
                        </div>


                        <!-- Tombol -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane"></i> Kirim Aspirasi
                            </button>
                            <a href="dashboard.php" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>


                    </form>
                </div>
            </div>


        </div>
    </div>


</div>


<?php include '../assets/template/footer.php'; ?>


