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
        $keterangan = 'Halo, Worker ' . $user['username'];
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
                    <div class="small">
                        <?php
                        if ($user['sebagai'] === 'admin') {
                            echo 'Admin: ' . $user['username'];
                        } elseif ($user['sebagai'] === 'worker') {
                            echo 'Hallo, Penjoki ' . $user['nama_lengkap'];

                            // Ganti nilai $nik dengan id_worker
                            $nik = $user['id_worker'];

                            // Tampilkan ID Worker di bawah nama worker
                            echo '<br>ID Worker: ' . $nik;
                        }
                        ?>

                    </div>
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

                    <div class="atas-bgn">
                        <a href="job_worker.php" class="jobdesk">
                            <span>Progres</span>
                        </a>

                    </div>






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

                                        <th>Id Transaksi</th>
                                        <th>Id Customer</th>
                                        <th>Id Worker</th>
                                        <th>Data Akun</th>
                                        <th>Qty Order</th>
                                        <th>Tanggal</th>
                                        <th>Total Transaksi</th>
                                        <th>Payment</th>
                                        <th>no_wa</th>
                                        <th>Status pembayatan</th>


                                        <th>status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    require('../koneksi.php');
                                    // $koneksi = new mysqli("localhost", "tifcmyho_hanzjoki", "@JTIpolije2023", "tifcmyho_hanzjoki");
                                    if ($koneksi->connect_error) {
                                        die("Connection failed: " . $koneksi->connect_error);
                                    }

                                    $sql = "SELECT id_transaksi, id_customer, id_worker, id_data_akun, qty_order, tgl_order, total_transaksi, payment, no_wa, stats, bukti_tf, laporan_ss, statsdone FROM transaksi WHERE stats = 'Lunas' AND statsdone = 'Undertake'";

                                    $result = $koneksi->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                <td>" . $row["id_transaksi"] . "</td>
                <td>" . $row["id_customer"] . "</td>
                <td>" . $row["id_worker"] . "</td>
                <td>" . $row["id_data_akun"] . "</td>
                <td>" . $row["qty_order"] . "</td>
                <td>" . $row["tgl_order"] . "</td>
                <td>" . $row["total_transaksi"] . "</td> 
                <td>" . $row["payment"] . "</td> 
                <td>" . $row["no_wa"] . "</td> 
                <td>" . $row["stats"] . "</td>                          
                <td>" . $row["statsdone"] . "</td>      
                                       
                <td>
                <button class='btn btn-info btn-detail' data-id='{$row['id_transaksi']}'>Detail</button>
                <a href='update_job.php?id_transaksi={$row['id_transaksi']}' class='btn btn-danger' onclick='takeJob({$row['id_transaksi']})'>Take</a>

                </td>
            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>0 result</td></tr>";
                                    }

                                    $koneksi->close();
                                    ?>
                                    <!-- bootstrap -->
                                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                    <script>
                                        function takeJob(id_transaksi) {
                                            // Mendapatkan user yang login (gantilah dengan cara yang sesuai dengan sistem Anda)
                                            var id_worker = getUserId(); // Gantilah ini dengan cara mendapatkan ID user yang login

                                            // Mengirim data melalui AJAX untuk diupdate
                                            $.ajax({
                                                type: 'POST',
                                                url: 'takejob.php', // Gantilah dengan nama file PHP yang sesuai
                                                data: {
                                                    id_transaksi: id_transaksi,
                                                    id_worker: id_worker
                                                },
                                                success: function(response) {
                                                    // Jika update berhasil, ubah statsdone menjadi "Progres"
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'update_statsdone.php', // Gantilah dengan nama file PHP yang sesuai
                                                        data: {
                                                            id_transaksi: id_transaksi,
                                                            statsdone: 'Progres'
                                                        },
                                                        success: function(response) {
                                                            // Tidak ada pesan yang ditampilkan
                                                            // Refresh halaman
                                                            location.reload();
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    </script>
                                    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="popupTitle">Detail Orderan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="popupContent">
                                                    <!-- Konten popup akan dimuat di sini -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- jQuery and Bootstrap JS scripts -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

                                    <!-- Script untuk menampilkan popup -->
                                    <script>
                                        $(document).ready(function() {
                                            // Fungsi untuk menampilkan popup
                                            function showPopup(id_transaksi) {
                                                // Ganti 'popup_detail_order.php' dengan file yang berisi detail popup Anda
                                                $.post('../admin/popup_detail_order.php', {
                                                    id_transaksi: id_transaksi
                                                }, function(data) {
                                                    $('#popupContent').html(data);
                                                    $('#popup').modal('show');
                                                });
                                            }

                                            function takejob(id_transaksi) {
                                                // Tampilkan notifikasi konfirmasi
                                                var confirmation = confirm("Apakah Anda yakin ingin mengedit worker untuk transaksi dengan ID " + id_transaksi + "id_transaksi");

                                                // Jika pengguna menekan "OK", lakukan pembaruan pada id_worker
                                                if (confirmation) {
                                                    // Lakukan pembaruan pada id_worker sesuai dengan NIK yang terdaftar
                                                    // Implementasikan sesuai dengan kebutuhan dan cara penyimpanan data pada database Anda
                                                    // Contoh menggunakan AJAX untuk mengirim permintaan pembaruan
                                                    var xhr = new XMLHttpRequest();
                                                    xhr.open("POST", "takejobw.php", true);
                                                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                    xhr.onreadystatechange = function() {
                                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                                            // Tindakan yang diambil setelah mendapatkan respons dari server
                                                            console.log(xhr.responseText);
                                                            // Mungkin Anda ingin melakukan sesuatu setelah pembaruan selesai
                                                        }
                                                    };
                                                    // Kirim permintaan pembaruan dengan ID transaksi
                                                    xhr.send("id_transaksi=" + id_transaksi);
                                                }
                                            }

                                            // Event handler untuk tombol Detail
                                            $('.btn-detail').click(function() {
                                                // Ambil nilai id_transaksi dari atribut data-id
                                                var id_transaksi = $(this).data('id');

                                                // Output debug untuk memastikan nilai id_transaksi diambil dengan benar
                                                console.log("ID Transaksi yang diklik: " + id_transaksi);

                                                // Panggil fungsi untuk menampilkan popup
                                                showPopup(id_transaksi);
                                            });

                                            function closeModal() {
                                                $('#popup').modal('hide');
                                            }
                                        });
                                    </script>


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