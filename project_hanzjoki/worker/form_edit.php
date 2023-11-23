<?php
require('../koneksi.php');

if (isset($_POST['update'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_worker = $_POST['id_worker'];
    $data_akun = $_POST['data_akun'];
    $qty_order = $_POST['qty_order'];
    $laporan = $_POST['laporan'];
    $statsdone = $_POST['statsdone'];

    $query = "UPDATE take_job SET 
              id_transaksi = '$id_transaksi', 
              id_worker = '$id_worker', 
              data_akun = '$data_akun', 
              qty_order = '$qty_order', 
              laporan = '$laporan', 
              statsdone = '$statsdone', 
              WHERE id='$id'";

    $result = mysqli_query($koneksi, $query);
    header('Location: takejob.php');
}

$id = $_GET['id'];
$query = "SELECT * FROM take_job WHERE id='$id'";
$result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

while ($row = mysqli_fetch_array($result)) {
    $id = $row['id'];
    $id_transaksi = $row['id_transaksi'];
    $id_worker = $row['id_worker'];
    $data_akun = $row['data_akun'];
    $qty_order = $row['qty_order'];
    $laporan = $row['laporan'];
    $statsdone = $row['statsdone'];
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
    <title>Edit Worker </title>
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

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
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
                        <a class="nav-link" href="worker_dashboard.php">
                            <img src="../image/icons8-dashboard-48.png" alt="">
                            <span class="jdl-kgonten-2">Dashboard</span>
                        </a>
                        <a class="nav-link" href="takejob.php" style=" background-color: #FF9900; height: 50px;">
                            <img src="../image/icons8-game-controller-64.png" alt="">
                            <span class="jdl-konten-2">Take Jobe</span>
                        </a>
                        <a class="nav-link" href="worker_penghasilan.php">
                            <img src="../image/report (1).png" alt="">
                            <span class="jdl-konten-2">Penghasilan</span>
                        </a>


                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    HanzStore
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Selamat Datang </h1>
                    <!-- <?php echo $email; ?> -->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit Worker</li>
                    </ol>
                    <div class="box-edit-worker col-md-6">
                        <form action="form_edit.php" method="POST">
                            <p>ID<input disabled name="id" value="<?php echo $id; ?>"></p>
                            <p>ID Transaksi <input disabled name="id_transaksi" value="<?php echo $id_transaksi; ?>"></p>
                            <p>ID Worker <input disabled name="id_worker" value="<?php echo $id_worker; ?>"></p>
                            <p>Data Akun: <input type="text" name="data_akun" value="<?php echo $data_akun; ?>"></p>
                            <p>QTY Order: <input type="number" name="qty_order" value="<?php echo $qty_order; ?>"></p>
                            <p>gaji: <input type="number" name="gaji" value="<?php echo $gaji; ?>"></p>
                            <!-- <p>Status: <input type="text" name="statsdone" value="<?php echo $statsdone; ?>"></p> -->
                            <p>Status:
                                <label><input type="radio" name="statsdone" value="problem" <?php echo ($statsdone === 'problem') ? 'checked' : ''; ?>> Problem</label>
                                <label><input type="radio" name="statsdone" value="progres" <?php echo ($statsdone === 'progres') ? 'checked' : ''; ?>> Progres</label>
                                <label><input type="radio" name="statsdone" value="sukses" <?php echo ($statsdone === 'sukses') ? 'checked' : ''; ?>> Sukses</label>
                                <!-- Tambahkan opsi sesuai kebutuhan -->
                            </p>
                            <button type="submit" name="update">Update</button>
                        </form>
                    </div>
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