<?php
require('../koneksi.php');
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
                        <li><hr class="dropdown-divider" /></li>
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
                            <a class="nav-link" href="../admin/home.php" >
                                    <img src="../image/icons8-dashboard-48.png" alt="" >
                                    <span class="jdl-konten-2">Dashboard</span>
                            </a>
                            <a class="nav-link" href="tambah_worker.php" style=" background-color: #FF9900; height: 50px;">
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
                        <?php

require('../koneksi.php');

$id_paket = $_GET['id'];
$query = "SELECT * FROM paket_joki_rank WHERE id_paket='$id_paket'";
$result = $koneksi->query($query) or die($koneksi->error);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_paket = $row['id_paket'];
    $judul_paket = $row['judul_paket'];
    $nama_paket = $row['nama_paket'];
    $harga = $row['harga'];
} else {
    echo "Data tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    $id_paket = $_POST['text_id'];
    $judul_paket = $_POST['text_judul_paket'];
    $nama_paket = $_POST['text_nama_paket'];
    $harga = $_POST['text_harga'];

    // Query update
    $update_query = "UPDATE paket_joki_rank SET 
              judul_paket = ?, 
              nama_paket = ?, 
              harga = ? 
              WHERE id_paket=?";
    
    // Prepare statement
    $update_stmt = $koneksi->prepare($update_query);

    // Bind parameter ke statement
    $update_stmt->bind_param("ssii", $judul_paket, $nama_paket, $harga, $id_paket);

    // Eksekusi statement
    if ($update_stmt->execute()) {
        header('Location: form_edit_promo.php?id=' . $id_paket); // Redirect ke halaman form edit
    } else {
        echo "Terjadi kesalahan saat mengupdate data: " . $update_stmt->error;
    }

    // Tutup statement
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- ... (sisa kode HTML tetap sama) ... -->
<div class="box-edit-promo">
    <form action="form_edit_promo.php" method="POST">
        <p><input type="hidden" name="text_id" value="<?php echo $id_paket; ?>"></p>
        <p>Judul Paket: <input type="text" name="text_judul_paket" value="<?php echo $judul_paket; ?>"></p>
        <p>Nama Paket: <input type="text" name="text_nama_paket" value="<?php echo $nama_paket; ?>"></p>
        <p>Harga: <input type="text" name="text_harga" value="<?php echo $harga; ?>"></p>
        <button type="submit" name="update">Update</button>
    </form>
</div>
<!-- ... (sisa kode HTML setelahnya) ... -->


<!-- ... (sisa kode HTML tetap sama) ... -->


                        
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