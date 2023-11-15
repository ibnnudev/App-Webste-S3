<?php
require_once('../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NIK = $_POST['NIK'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_wa = $_POST['no_wa'];
    $pangkat = $_POST['pangkat'];
    $email = $_POST['email'];
    $sebagai = $_POST['sebagai'];
    $Role_utama = $_POST['Role_utama'];
    $pw = $_POST['pw'];

    // Check if the img_ktp key exists and handle the case when no image is uploaded
    $img_ktp = !empty($_FILES["img_ktp"]["name"]) ? $_FILES["img_ktp"]["name"] : '';

    // Proses upload gambar KTP
    if (!empty($img_ktp)) {
        $lokasi_sementara = $_FILES["img_ktp"]["tmp_name"];
        $lokasi_tujuan = '../upload/' . $img_ktp;
        move_uploaded_file($lokasi_sementara, $lokasi_tujuan);
    }

    // Query to insert data into the database
    $query = "INSERT INTO data_worker (NIK, nama_lengkap, alamat, jenis_kelamin, no_wa, pangkat, email, sebagai, rolee, pw, img_ktp) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statement
    $stmt = mysqli_prepare($koneksi, $query);
    
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssss", $NIK, $nama_lengkap, $alamat, $jenis_kelamin, $no_wa, $pangkat, $email, $sebagai, $Role_utama, $pw, $img_ktp);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data: " . mysqli_error($koneksi);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
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
        <title>tambah worker</title>
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
                            <a class="nav-link" href="home.php" >
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
                            <li class="breadcrumb-item active">Tambah data Worker</li>
                        </ol>
                       
                            <div class="box-create-worker">
                            <h2>Form Input Data Pekerja</h2>
                                    <form action="add_worker.php" method="post" enctype="multipart/form-data">
                                        <!-- Isian formulir -->
                                        <label for="NIK">NIK:</label>
                                        <input type="text" name="NIK" required>

                                        <label for="nama_lengkap">Nama Lengkap:</label>
                                        <input type="text" name="nama_lengkap" required>

                                        <label for="alamat">Alamat:</label>
                                        <textarea name="alamat" required></textarea>

                                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                                        
                                        <select name="jenis_kelamin" required>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>

                                        <label for="no_wa">Nomor WhatsApp:</label>
                                        <input type="text" name="no_wa" required>

                                        <label for="pangkat">Pangkat:</label>
                                        <input type="text" name="pangkat" required>

                                        <label for="email">Email:</label>
                                        <input type="email" name="email" required>

                                        <label for="sebagai">Sebagai:</label>
                                        <input type="text" name="sebagai" required>

                                        <label for="Role_utama">Role Utama:</label>
                                        <input type="text" name="Role_utama" required>

                                        <label for="pw">Password:</label>
                                        <input type="password" name="pw" required>

                                        <label for="img_ktp">Unggah Gambar KTP:</label>
                                        <input type="file" name="img_ktp" accept="image/*">

                                        <input type="submit" value="Simpan">
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