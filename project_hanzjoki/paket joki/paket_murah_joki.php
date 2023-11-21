<?php
// Pastikan sesi sudah dimulai
session_start();


require_once('../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paket = isset($_POST['id_paket']) ? $_POST['id_paket'] : null;

    $judul_paket = $_POST['judul_paket'];
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];

    // Query to insert data into the database
    $query = "INSERT INTO paket_joki_rank (id_paket, judul_paket, nama_paket, harga, nama_discount) 
    VALUES (?, ?, ?, ?, 'no discount')";

    // Use prepared statement
    $stmt = mysqli_prepare($koneksi, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssss", $id_paket, $judul_paket, $nama_paket, $harga);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data promo berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data promo: " . mysqli_error($koneksi);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
}

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
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
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
                            <a class="nav-link" href="../admin/home.php" >
                                    <img src="../image/icons8-dashboard-48.png" alt="" >
                                    <span class="jdl-konten-2">Dashboard</span>
                            </a>
                            <a class="nav-link" href="../admin/tambah_worker.php">
                                    <img src="../image/icons8-worker-50.png" alt="">
                                    <span class="jdl-konten-2">Worker</span>
                            </a>
                            <a class="nav-link" href="../admin/data_costumer.php">
                                    <img src="../image/CUstomer.png" alt="">
                                    <span class="jdl-konten-2">Customer</span>
                            </a>
                            <a class="nav-link" href="../admin/data_orderan.php">
                                    <img src="../image/icons8-shopping-cart-64.png" alt="">
                                    <span class="jdl-konten-2">Orderan</span>
                            </a>
                            <a class="nav-link" href="#" style=" background-color: #FF9900; height: 50px;">
                                    <img src="../image/icons8-game-controller-64.png" alt="">
                                    <span class="jdl-konten-2">Joki</span>
                            </a>
                            <a class="nav-link" href="../admin/history.php">
                                <img src="../image/icons8-history-24.png" alt="">
                                <span class="jdl-konten-2">History</span>
                            </a>
                                       
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"><?php
                                if ($user['sebagai'] === 'admin') {
                                    echo '' . $user['username'];
                                } elseif ($user['sebagai'] === 'worker') {
                                    echo 'Halo, Worker ' . $user['nama_worker'];
                                }
                                ?></div>
                         <h1> <br></h1>
                        <img src="../image/LOGO HANZJOKI.png" alt="" class="imge-23">
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">
                        <h1 class="mt-4">Promo </h1>
                        <!-- <?php echo $email; ?> -->
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data JOKI</li>
                        </ol>
                        <div class="box-lainya">
                                <div class="atas-bgn">
                                    <a href="../admin/data_joki.php">
                                        <span>All</span>
                                    </a>
                                    <a href="promo_joki.php" >
                                        <span>Promo Joki</span>
                                    </a>
                                    <a href="promo_star.php">
                                        <span>Joki/Star</span>
                                    </a>
                                    <a href="paket_murah_joki.php" style="background-color: #FF9900; height: 40px; color: #FFf;">
                                        <span>Paket Murah Joki</span>
                                    </a>
                                    <a href="promo_mcl.php">
                                        <span>Joki MCL</span>
                                    </a>
                                </div>
                                <div class="bwh-bgn">
                                    <a href="promo_mabar.php">
                                        <span>Jasa Mabar</span>
                                    </a>
                                    <a href="promo_day.php" >
                                        <span>Promo Hari ini</span>
                                    </a>
                                    <a href="promo.clasic.php">
                                        <span>Joki Classic</span>
                                    </a>
                                    <a href="promo.vidio.php">
                                        <span>Joki Video</span>
                                    </a>
                                    <a href="discount.php">
                                        <span>Discount</span>
                                    </a>
                                </div>
                            </div>
                         
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table Promo joki
                            </div>
                            <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div class="search-container">
                                                    <label for="searchInput" class="form-label visually-hidden">Search:</label>
                                                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                                                </div>

                                                <div class="box-add">
    <button type="button" class="btn-add_w" data-bs-toggle="modal" data-bs-target="#addPromoModal">
        Tambah Promo
    </button>
</div>
<div class="modal fade" id="addPromoModal" tabindex="-1" aria-labelledby="addPromoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Isi modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="addPromoModalLabel">Form Tambah Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="promo_joki.php" method="post" id="promoForm">
                    <!-- Isian formulir -->
                    <label for="id">ID:</label>
                    <input type="text" name="id_paket" id="id_paket" required>

                    <label for="judul_paket">Judul paket:</label>
                    <input type="text" name="judul_paket" required>

                    <label for="nama_paket">Nama Paket:</label>
                    <input type="text" name="nama_paket" required>

                    <label for="harga_promo">Harga:</label>
                    <input type="text" name="harga" required>

                    <input type="submit" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>

                                            </div>
                                        </div>
                                        

     <table id="datatablesSimple" class="custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul Paket</th>
            <th>Nama Paket</th>
            <th>harga</th>         
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
                                
    
    <?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "hanzjoki");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk menampilkan data
$sql = "SELECT id_paket, judul_paket, nama_paket, harga
        FROM paket_joki_rank
        WHERE judul_paket = 'PAKET MURAH JOKI'";
$result = $koneksi->query($sql);

// Validasi form submission dan update data jika ada request POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id_paket = $_POST['id_paket'];
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];


    // Prepare statement
    $update_stmt = $koneksi->prepare($update_query);

    // Bind parameter ke statement
    $update_stmt->bind_param("ssi", $nama_paket, $harga, $id_paket);

    // Eksekusi statement
    if ($update_stmt->execute()) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Terjadi kesalahan saat mengupdate data: " . $update_stmt->error;
    }

    // Tutup statement
    $update_stmt->close();
}

$koneksi->close();
?>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_paket']}</td> 
                        <td>{$row['judul_paket']}</td>
                        <td>{$row['nama_paket']}</td>
                        <td>{$row['harga']}</td> 
                        <td>
                        <a href='hapus.php?id_paket={$row['id_paket']}' class='btn btn-danger'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>0 hasil</td></tr>";
        }
        ?>
    </tbody>
</table>



<!-- ---------------------------------------------------------------------------------------------------------------------- -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menangkap submit form
        document.getElementById('promoForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form submit secara default

            // Menggunakan Fetch API untuk mengirim form data ke server
            fetch('paket_murah_joki.php', {
                method: 'POST',
                body: new FormData(this),
            })
            .then(response => response.text())
            .then(data => {
                // Menampilkan pesan berhasil ke dalam modal
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
                
                // Membersihkan formulir setelah submit berhasil
                this.reset();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Menambahkan event listener untuk menutup modal ketika modal tertutup
        document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
            // Mengarahkan ke halaman promo_joki.php
            window.location.href = 'paket_murah_joki.php';
        });
    });
</script>
 <!-- OTOMATAIS KEISI ID PAKET DAN JUDUL PAKET -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan elemen tombol "Tambah Promo"
        var tambahPromoButton = document.querySelector('.btn-add_w');

        // Menambahkan event listener untuk tombol "Tambah Promo"
        tambahPromoButton.addEventListener('click', function () {
            // Mendapatkan elemen input ID dan Judul Paket
            var idInput = document.querySelector('input[name="id_paket"]');
            var judulPaketInput = document.querySelector('input[name="judul_paket"]');

            // Menyimpan nomor urut terakhir ke dalam sessionStorage
            var count = sessionStorage.getItem('promoCount') || 0;

            // Menginkrementasi nomor urut
            count++;

            // Menyimpan nomor urut ke sessionStorage
            sessionStorage.setItem('promoCount', count);

            // Menggabungkan "PK" dengan nomor urut yang terakhir disimpan
            var id = 'PMJ' + ('000' + count).slice(-3);

            // Mengisi nilai ID pada formulir
            idInput.value = id;

            // Mengisi otomatis Judul Paket dengan "PROMO"
            judulPaketInput.value = 'PAKET MURAH JOKI';
        });

        // Menambahkan event listener untuk formulir ketika disubmit
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form submit secara default

            // Mendapatkan nomor urut terakhir dari sessionStorage
            var count = sessionStorage.getItem('promoCount') || 0;

            // Menginkrementasi nomor urut
            count++;

            // Menyimpan nomor urut ke sessionStorage
            sessionStorage.setItem('promoCount', count);

            // Menggunakan Fetch API untuk mengirim form data ke server
            fetch('promo_star.php', {
                method: 'POST',
                body: new FormData(this),
            })
            .then(response => response.text())
            .then(data => {
                // Menampilkan pesan berhasil ke dalam modal
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                // Membersihkan formulir setelah submit berhasil
                this.reset();

                // Merefresh halaman web
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Menambahkan event listener untuk menutup modal ketika modal tertutup
        document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
            // Mendapatkan elemen input ID dan Judul Paket
            var idInput = document.querySelector('input[name="id_paket"]');
            var judulPaketInput = document.querySelector('input[name="judul_paket"]');

            // Mengosongkan nilai ID dan Judul Paket setelah pop-up ditutup
            idInput.value = '';
            judulPaketInput.value = '';
        });
    });
</script>
<!-- Modal untuk menampilkan pesan berhasil -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data promo berhasil ditambahkan.
            </div>
        </div>
    </div>
</div>






                
  <!-- logika search  -->
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