<?php
// Pastikan sesi sudah dimulai
session_start();

// Periksa apakah pengguna telah login
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    // Menentukan keterangan berdasarkan peran pengguna
    $keterangan = '';
    if ($user['sebagai'] === 'admin') {
        $keterangan = '' . $user['username'];
    } elseif ($user['sebagai'] === 'worker') {
        $keterangan = 'Halo, Worker ' . $user['nama_worker'];
    }

    // Output keterangan
    echo $keterangan;
} else {
    // Jika pengguna belum login, kembalikan ke halaman login
    header('Location: login_admin.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" /> 
        <title>home Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/style3.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">HanzStore</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="setting_admin.php">Settings</a></li>
                        <li><a class="dropdown-item" href="add_admin.php">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="home.php" style=" background-color: #FF9900; height: 50px;">
                                    <img src="../image/icons8-dashboard-48.png" alt="" >
                                    <span class="jdl-konten-2">Dashboard</span>
                            </a>
                            <a class="nav-link" href="tambah_worker.php">
                                    <img src="../image/icons8-worker-50.png" alt="">
                                    <span class="jdl-konten-2">Worker</span>
                            </a>
                            <a class="nav-link" href="data_costumer.php">
                                    <img src="../image/CUstomer.png" alt="">
                                    <span class="jdl-konten-2">Customer</span>
                            </a>
                            <a class="nav-link" href="data_orderan.php">
                                    <img src="../image/icons8-shopping-cart-64.png" alt="">
                                    <span class="jdl-konten-2">Orderan</span>
                            </a>
                            <a class="nav-link" href="data_joki.php">
                                    <img src="../image/icons8-game-controller-64.png" alt="">
                                    <span class="jdl-konten-2">Joki</span>
                            </a>
                            <a class="nav-link" href="history.php">
                                <img src="../image/icons8-history-24.png" alt="">
                                <span class="jdl-konten-2">History</span>
                            </a>
                                       
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <div class="small"> <?php
                                if ($user['sebagai'] === 'admin') {
                                    echo '' . $user['username'];
                                } elseif ($user['sebagai'] === 'worker') {
                                    echo 'Halo, Worker ' . $user['nama_worker'];
                                }
                                ?></div>
                        <!-- <p></p> --> <h1> <br></h1>
                        <img src="../image/LOGO HANZJOKI.png" alt="" class="imge-23">
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Selamat Datang </h1>
                        
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                       
<!-- =============================================================================================================================== -->
<?php

                        $servername = "localhost";
                        $username = "tifcmyho_hanzjoki";
                        $password = "@JTIpolije2023";
                        $dbname = "tifcmyho_hanzjoki";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Periksa koneksi
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }
// Kueri SQL untuk mendapatkan jumlah transaksi hari ini
$sql = "SELECT COUNT(*) as total_transaksi FROM transaksi WHERE DATE(tgl_order) = CURDATE()";
$result = $conn->query($sql);

// Ambil hasil kueri
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalTransaksiday = $row['total_transaksi'];
} else {
    $totalTransaksiday = 0;
}

// ... Tutup koneksi ke database ...
?>
                                
<div class="row" style="margin-left: 10px; margin-right: 10px;">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Transaksi
                                        (Hari Ini)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalTransaksiday; ?></div>
                                </div>
                                <div class="col-auto">
                                    <img src="../image/transaction.png" alt="" style="width: 60px;">
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
<!-- ========================================================================================================= -->
<?php
$servername = "localhost";
$username = "tifcmyho_hanzjoki";
$password = "@JTIpolije2023";
$dbname = "tifcmyho_hanzjoki";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Kueri SQL untuk mendapatkan jumlah total transaksi
$sql = "SELECT COUNT(*) as transaksi_keseluruhan FROM transaksi";
$result = $conn->query($sql);

// Ambil hasil kueri
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalTransaksi = $row['transaksi_keseluruhan'];
} else {
    $totalTransaksi = 0;
}

// Tutup koneksi ke database
$conn->close();
?>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"> Total Transaksi 
                                        </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalTransaksi ?></div>
                                </div>
                                <div class="col-auto">
                                    <img src="../image/mobile-banking.png" alt="" style="width: 60px;">
                                </div>
                            </div>
                        </div> .
                    </div>
                </div>
<!-- =================================================================================================================================================== -->
                <!-- Earnings (Monthly) Card Example -->
                <?php
                        // Buat koneksi ke database (gantilah sesuai dengan konfigurasi Anda)
                        $servername = "localhost";
                        $username = "tifcmyho_hanzjoki";
                        $password = "@JTIpolije2023";
                        $dbname = "tifcmyho_hanzjoki";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Periksa koneksi
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        // Eksekusi kueri SQL untuk mendapatkan jumlah pekerja
                        $sql = "SELECT COUNT(*) as total_customer FROM data_customer";
                        $result = $conn->query($sql);

                        // Ambil hasil kueri
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $totalcustomer = $row['total_customer'];
                        } else {
                            $totalcustomer = 0;
                        }

                        // Tutup koneksi ke database
                        $conn->close();
                        ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Custemer </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalcustomer; ?></div>
                                </div>
                                <div class="col-auto">
                                    <img src="../image/customer_3585921.png" alt="" style="width: 60px;">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
<!-- ============================================================================================================================================= -->
<!-- -----------------------total worker------------------------- -->
                <!-- Pending Requests Card Example -->
                <?php
                        // Buat koneksi ke database (gantilah sesuai dengan konfigurasi Anda)
                        $servername = "localhost";
                        $username = "tifcmyho_hanzjoki";
                        $password = "@JTIpolije2023";
                        $dbname = "tifcmyho_hanzjoki";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Periksa koneksi
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        // Eksekusi kueri SQL untuk mendapatkan jumlah pekerja
                        $sql = "SELECT COUNT(*) as total_worker FROM data_worker";
                        $result = $conn->query($sql);

                        // Ambil hasil kueri
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $totalWorker = $row['total_worker'];
                        } else {
                            $totalWorker = 0;
                        }

                        // Tutup koneksi ke database
                        $conn->close();
                        ?>

                        <!-- Tampilkan jumlah pekerja dalam elemen HTML -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Worker Saat ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalWorker; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-users fa-2x text-gray-300"></i> -->
                                            <img src="../image/worker.png" alt="" style="width: 60px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            <div class="row" style="margin-left: 10px; margin-right: 10px; margin-top:40px;">








                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; HanzStore</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>