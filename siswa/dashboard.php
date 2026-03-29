<?php
session_start();


if (!isset($_SESSION['nis'])) {
    header("Location: ../index.php");
}
?>

<?php include '../assets/template/header.php'; ?>
<?php include '../assets/template/sidebar_siswa.php'; ?>
<?php include '../assets/template/navbar.php'; ?>


<div class="container-fluid">


     <!-- Page Heading  -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Siswa</h1>


    <div class="row">


         <!-- Card Input Aspirasi -->
        <div class="col-md-6 mb-4">
            <div class="card shadow border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Menu
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Input Aspirasi
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-edit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="input_aspirasi.php" class="btn btn-primary btn-sm mt-3">
                        Buka
                    </a>
                </div>
            </div>
        </div>


         <!-- Card Histori Aspirasi  -->
        <div class="col-md-6 mb-4">
            <div class="card shadow border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Menu
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Histori Aspirasi
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-history fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="histori.php" class="btn btn-success btn-sm mt-3">
                        Lihat
                    </a>
                </div>
            </div>
        </div>


    </div>


</div>


<?php include '../assets/template/footer.php'; ?>
