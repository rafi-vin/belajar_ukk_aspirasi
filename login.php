<?php include 'assets/template/header.php'; ?>

<div class="container">

    <div class="row justify-content-center mt-5">
        <div class="col-lg-5">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="m-0 font-weight-bold">
                        Login Aplikasi Pengaduan Sekolah
                    </h5>
                </div>

                <div class="card-body">

                    <form action="proses/login.php" method="POST">
                        <div class="form-group">
                            <label>Username / NIS</label>
                            <input type="text" name="user" class="form-control"
                                placeholder="Masukkan Username Admin / NIS Siswa" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Masukkan Password">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>

                </div>

            </div>

            <div class="text-center mt-3">
                <a href="index.php">← Kembali ke Beranda</a>
            </div>
            
        </div>
    </div>
</div>


<?php include 'assets/template/footer.php'; ?>