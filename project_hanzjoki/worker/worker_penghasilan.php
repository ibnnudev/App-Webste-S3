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
        $keterangan = 'Halo, Worker ' . $user['nama_lengkap'];
    }

    // Output keterangan
    echo $keterangan;
} else {
    // Jika pengguna belum login, kembalikan ke halaman login
    header('Location: ../admin/login_admin.php');
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
        <title>home Worker</title>
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
                        <li><a class="dropdown-item" href="../admin/logout.php">Logout</a></li>
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
                            <a class="nav-link" href="worker_dashboard.php" >
                                    <img src="../image/icons8-dashboard-48.png" alt="" >
                                    <span class="jdl-konten-2">Dashboard</span>
                            </a>
                            <a class="nav-link" href="takejob.php">
                                    <img src="../image/icons8-game-controller-64.png" alt="">
                                    <span class="jdl-konten-2">Take Jobe</span>
                            </a>
                            <a class="nav-link" href="data_costumer.php" style=" background-color: #FF9900; height: 50px;">
                                    <img src="../image/report (1).png" alt="">
                                    <span class="jdl-konten-2">Penghasilan</span>
                            </a>
                            
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <div class="small"> <?php
if ($user['sebagai'] === 'admin') {
    echo 'Admin: ' . $user['username'];
} elseif ($user['sebagai'] === 'worker') {
    echo 'Hallo, Penjoki ' . $user['nama_lengkap'];
    
    // Ganti nilai $nik dengan id_worker
    $nik = $user['id_worker'];
    
    // Tampilkan ID Worker di bawah nama worker
    echo '<br>ID Worker: ' . $nik;
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
                            <li class="breadcrumb-item active">Penghasilan</li>
                        </ol>
                    </div>
                </main>
                <!-- Area Chart -->
            <div class="col-xl-8 col-lg-6" style="margin-left: 200px;">
              <div class="card shadow mb-4">
               <!-- Card Header - Dropdown -->
               <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <h6 class="m-0 font-weight-bold text-primary">
    Pendapatan
    <form method="post" action="">
      <select name="tahun" onchange="this.form.submit()">
      <?php
$tahunSekarang = date("Y");
for ($tahun = $tahunSekarang; $tahun >= 2020; $tahun--) {
    $selected = ($tahun == $_POST['tahun']) ? 'selected' : '';
    echo "<option value='$tahun' $selected>$tahun</option>";
}
?>
      </select>
    </form>
  </h6>
  <div class="dropdown no-arrow">
  </div>
</div>


<?php
require('../koneksi.php');

// Fungsi koneksi ke database
function connectToDatabase() {
  global $koneksi; // Variabel koneksi diambil dari file 'koneksi.php'
  
  // Periksa koneksi
  if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
  }

  return $koneksi;
}

// Memanggil fungsi koneksi
$conn = connectToDatabase();

?>

<!-- Card Body -->
<div class="card-body">
  <div class="chart-area">
    <!-- Tempatkan grafik atau elemen lainnya di sini -->
  </div>
  
  <!-- Tabel Bulan -->
  <div class="table-responsive">
  <div class="kiri">
    <table class="table table-bordered" id="tabel1" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Bulan</th>
          <th>Total Take</th>
          <th>Penghasilan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : date("Y");
        $statsdone = 'DONE';
        $id_worker = 'WORK00001';

        $sql = "SELECT
                  YEAR(tgl_order) AS tahun,
                  MONTHNAME(tgl_order) AS bulan,
                  COUNT(id_transaksi) AS total_done,
                  SUM(total_transaksi) AS total_pendapatan
                FROM transaksi
                WHERE YEAR(tgl_order) = $tahun
                  AND statsdone = '$statsdone'
                  AND id_worker = '$id_worker'
                GROUP BY YEAR(tgl_order), MONTH(tgl_order)
                ORDER BY tahun, MONTH(tgl_order)";

        // Eksekusi query
        $result = $conn->query($sql);

        // Cek apakah query berhasil dieksekusi
        if ($result) {
          $nomor = 1;
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $nomor++ . "</td>";
            echo "<td>" . $row['bulan'] . "</td>";
            echo "<td>" . $row['total_done'] . "</td>";
            echo "<td>" . $row['total_pendapatan'] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Tutup koneksi setelah digunakan
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>








              </div>
            </div>
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