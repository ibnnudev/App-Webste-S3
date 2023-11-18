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
        <style>
        /* CSS untuk popup */
        .overlay-pp {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }
        .title-pp{
            
        }
        
/* CSS untuk menyusun elemen-elemen secara sejajar */
.profile-pop h2,
.profile-pop label,
.profile-pop input,
.profile-pop img,
.profile-pop button {
    margin-bottom: 10px;
}

.profile-pop label {
    display: block;
}
        .profile-pop {
            display: none;
            background: #fff;
            padding: 40px;
            border-radius: 5px;
            margin: 0;
            margin-left: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
    <script>
        // JavaScript untuk menampilkan popup
        function showProfilePopup() {
            document.getElementById('profileOverlay').style.display = 'flex';
            document.getElementById('profilePop').style.display = 'block';
        }

        function closeProfilePopup() {
            document.getElementById('profileOverlay').style.display = 'none';
            document.getElementById('profilePop').style.display = 'none';
        }
    </script>
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
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
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
                            <li class="breadcrumb-item active">Setting</li>
                        </ol>
                       


<!-- Tombol untuk membuka popup -->
<button onclick="showProfilePopup()">Buka Profil</button>

<!-- Overlay untuk popup profil -->
<div id="profileOverlay" class="overlay-pp">
    <!-- Popup Profil -->
    <div id="profilePop" class="profile-pop">
        <!-- Konten popup -->
        <h2 class="title-pp">Profile</h2>
        <form action="setting_admin.php" method="post" enctype="multipart/form-data" >
            <!-- Input untuk mengubah email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <!-- Input untuk mengubah username -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <!-- Input untuk mengubah password -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <!-- Input untuk mengunggah foto -->
            <label for="photo">Upload Foto:</label>
            <input type="file" id="photo" name="photo">

            <!-- Tampilkan foto yang diunggah -->
            <img id="previewPhoto" src="#" alt="Preview Foto" style="max-width: 100%; max-height: 150px; margin-top: 10px; display: none;">

            <!-- Tombol untuk menutup popup -->
            <button type="button" onclick="closeProfilePopup()">Tutup</button>
            <!-- Tombol untuk menyimpan perubahan -->
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>

<!-- JavaScript untuk menampilkan preview foto -->
<script>
    document.getElementById('photo').addEventListener('change', function (e) {
        var preview = document.getElementById('previewPhoto');
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(e.target.files[0]);
    });
</script>
<?php
require('../koneksi.php');

// Mulai sesi


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirimkan melalui formulir
    $id_admin = $_POST['id_admin'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk melakukan update data profil
    $sql = "UPDATE data_admin SET email=?, username=?, pw=? WHERE id_admin=?";

    // Bind parameter
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sssi", $email, $username, $password, $id_admin);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "Profil berhasil diperbarui.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
}
?>

<!-- ========================================================================== -->
<?php
// Mulai sesi

// Periksa apakah pengguna telah login
if (isset($_SESSION['id_admin'])) {
    // Jika sudah login, ambil informasi pengguna
    $id_admin = $_SESSION['id_admin'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];

    // Tampilkan tombol untuk membuka popup
    echo "<button onclick=\"showProfilePopup('$id_admin', '$email', '$username')\">Buka Profil</button>";
} else {
    // Jika belum login, tampilkan form login atau redirect ke halaman login
    // header("Location: login.php");
    exit();
}
?>

<!-- Include CSS dan JavaScript untuk popup dari pertanyaan sebelumnya -->

<script>
    function showProfilePopup(id_admin, email, username) {
        // Set nilai dari input pada popup
        document.getElementById('id_admin').value = id_admin;
        document.getElementById('email').value = email;
        document.getElementById('username').value = username;

        // Tampilkan popup
        document.getElementById('profileOverlay').style.display = 'flex';
        document.getElementById('profilePop').style.display = 'block';
    }

    // Fungsi lainnya...
</script>













                        
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