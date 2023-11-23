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
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
                    <div class="small"> <?php
                                        if ($user['sebagai'] === 'admin') {
                                            echo '' . $user['username'];
                                        } elseif ($user['sebagai'] === 'worker') {
                                            echo 'Hallo, Penjoki ' . $user['nama_lengkap'];
                                        }
                                        ?></div>
                    <!-- <p></p> -->
                    <h1> <br></h1>
                    <img src="../image/LOGO HANZJOKI.png" alt="" class="imge-23">
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Selamat Datang </h1>
                    <!-- <?php echo $email; ?> -->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data Worker</li>
                    </ol>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Table Data Job
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="search-container">
                                    <label for="searchInput" class="form-label visually-hidden">Search:</label>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                                </div>
                            </div>


                            <table id="datatablesSimple" class="custom-table" border="2">

                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Id Transaksi</th>
                                        <th>Id Worker</th>
                                        <th>Data Akun</th>
                                        <th>Qty Order</th>
                                        <th>Gaji</th>
                                        <th>Laporan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $koneksi = new mysqli("localhost", "root", "", "hanzjoki");
                                    if ($koneksi->connect_error) {
                                        die("Connection failed: " . $koneksi->connect_error);
                                    }

                                    $sql = "SELECT id,id_transaksi,id_worker,data_akun,qty_order,gaji,laporan,statsdone,null FROM take_job";
                                    $result = $koneksi->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                        <td>" . $row["id"] . "</td>
                                                        <td>" . $row["id_transaksi"] . "</td>
                                                        <td>" . $row["id_worker"] . "</td>
                                                        <td>" . $row["data_akun"] . "</td>
                                                        <td>" . $row["qty_order"] . "</td>
                                                        <td>" . $row["gaji"] . "</td>
                                                        <td>" . $row["laporan"] . "</td>                             
                                                        <td>" . $row["statsdone"] . "</td>                              
                                                        <td>
                                                        <a href='form_edit.php?id=" . $row['id'] . "' class='btn btn-info'>Edit</a>
                                                        <a href='../crud/job_hapus.php?id=" . $row['id'] . "' class='btn btn-danger'>hapus</a>
                                                        </td>
                                                    </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>0 result</td></tr>";
                                    }

                                    $koneksi->close();
                                    ?>
                                </tbody>

                            </table>


                            <script>
                                function searchTable() {
                                    var input, filter, table, tr, td, i, txtValue;
                                    input = document.getElementById("searchInput");
                                    filter = input.value.toUpperCase();
                                    table = document.getElementById("datatablesSimple");
                                    tr = table.getElementsByTagName("tr");

                                    for (i = 0; i < tr.length; i++) {
                                        // Change the index according to your table structure
                                        td = tr[i].getElementsByTagName("td")[2]; // Index 2 represents the "Nama Lengkap" column

                                        if (td) {
                                            txtValue = td.textContent || td.innerText;

                                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                tr[i].style.display = "";
                                            } else {
                                                tr[i].style.display = "none";
                                            }
                                        }
                                    }
                                }
                            </script>
                        </div>
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