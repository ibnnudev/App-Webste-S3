<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil ID transaksi dari permintaan POST
    $idTransaksi = $_POST['id_transaksi'];

    require('../koneksi.php');

    // Lakukan pembaruan status di database
    $updateSql = "UPDATE transaksi SET stats = 'bermasalah' WHERE id_transaksi = ?";
    $stmt = $koneksi->prepare($updateSql);

    if ($stmt) {
        $stmt->bind_param("s", $idTransaksi);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Status berhasil diperbarui menjadi bermasalah";
        } else {
            echo "Gagal memperbarui status";
        }

        $stmt->close();
    } else {
        echo "Kesalahan dalam persiapan pernyataan SQL";
    }

    $koneksi->close();
} else {
    echo "Metode permintaan tidak valid";
}
?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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
                        <a class="nav-link" href="home.php">
                            <img src="../image/icons8-dashboard-48.png" alt="">
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
                        <a class="nav-link" href="#" style=" background-color: #FF9900; height: 50px;">
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
                    <h1 class="mt-4">Selamat Datang </h1>
                    <!-- <?php echo $email; ?> -->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Orderan</li>
                    </ol>

                    <div class="box-lainya">
                        <div class="bwh-bgn">
                            <a href="#" style="background-color: #FF9900; height: 40px; color: #FFf;">
                                <span>Belum Lunas</span>
                            </a>
                            <a href="data_orderan_lunas.php">
                                <span>Lunas</span>
                            </a>
                            <a href="data_orderan_done.php">
                                <span>Done</span>
                            </a>
                            <a href="data_orderan_problem.php">
                                <span>Problem</span>
                            </a>


                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table Orderan
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="search-container">
                                        <label for="searchInput" class="form-label visually-hidden">Search:</label>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                                    </div>
                                </div>


                                <table id="datatablesSimple" class="custom-table">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Tanggal Order</th>
                                            <th>Data Akun</th>
                                            <th>Qty</th>
                                            <th>Payment</th>
                                            <th>Total</th>
                                            <th>status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require('../koneksi.php');

                                        $sql = "SELECT 
transaksi.id_transaksi,
transaksi.tgl_order,
transaksi.id_data_akun,
transaksi.qty_order,
transaksi.payment,
transaksi.total_transaksi,
transaksi.stats
FROM 
transaksi
WHERE 
transaksi.stats = 'belum lunas'";
                                        $result = $koneksi->query($sql);


                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>{$row['id_transaksi']}</td>
                                                        <td>{$row['tgl_order']}</td>
                                                        <td>{$row['id_data_akun']}</td>
                                                        <td>{$row['qty_order']}</td> 
                                                        <td>{$row['payment']}</td>
                                                        <td>{$row['total_transaksi']}</td>
                                                        <td>{$row['stats']}</td>
                                                        <td>
                                                            <a href='#' class='btn btn-success btn-ready' data-id='{$row['id_transaksi']}'>Ready</a>
                                                            <button class='btn btn-info btn-detail' data-id='{$row['id_transaksi']}'>Detail</button>
                                                            <a href='../crud/transaksi_hapus.php?id_transaksi={$row['id_transaksi']}' class='btn btn-danger'>Hapus</a>
                                                            <a href='cek_bukti_tf.php?id=" . $row['id_transaksi'] . "' class='btn btn-info'>Cek TF</a>
                                                            <a href='#' class='btn btn-danger btn-problem' data-id='{$row['id_transaksi']}'>Problem</a>

                                                        </td>
                                                    </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>0 result</td></tr>";
                                        }

                                        $koneksi->close();
                                        ?>
                                    </tbody>
                                </table>

                                <!-- ========================================================================================== -->
                                <!-- -----------------------------READY BUTTOM-------------------------- -->
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const readyButtons = document.querySelectorAll('.btn-danger');
                                        readyButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const id_transaksi = this.getAttribute('data-id');
                                                handleReadyButtonClick(id_transaksi);
                                            });
                                        });

                                        function handleReadyButtonClick(id_transaksi) {
                                            fetch('data_orderan_lunas.php', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                    },
                                                    body: `id_transaksi=${id_transaksi}` // Fixed the body format
                                                })
                                                .then(response => {
                                                    if (!response.ok) {
                                                        throw new Error(`HTTP Error! Status: ${response.status}`);
                                                    }
                                                    return response.json();
                                                })
                                                .then(data => {
                                                    console.log('Record successfully inserted into take_job:', data);
                                                    // You can update the UI or perform other actions as needed
                                                })
                                                .catch(error => {
                                                    console.error('Error inserting record into take_job:', error);
                                                });
                                        }
                                    });
                                </script>


                                <script>
                                    $(document).ready(function() {
                                        $(".btn-problem").click(function(e) {
                                            e.preventDefault();

                                            // Ambil ID transaksi dari data-id pada tombol
                                            var idTransaksi = $(this).data('id');

                                            // Kirim permintaan AJAX ke endpoint PHP
                                            $.ajax({
                                                type: 'POST',
                                                url: 'data_orderan.php', // Ganti dengan nama file PHP yang sesuai
                                                data: {
                                                    id_transaksi: idTransaksi
                                                },
                                                success: function(response) {
                                                    // Tidak perlu alert(response);
                                                    location.reload();
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                }
                                            });
                                        });
                                    });
                                </script>


                                <script>
                                    $(document).ready(function() {
                                        // Tindakan ketika tombol "Done" ditekan
                                        $('.btn-ready').on('click', function(e) {
                                            e.preventDefault();

                                            // Ambil id_transaksi dari atribut data-id
                                            var id_transaksi = $(this).data('id');

                                            // Kirim data ke update_done.php menggunakan AJAX
                                            $.ajax({
                                                type: 'POST',
                                                url: 'update_lunas.php',
                                                data: {
                                                    id_transaksi: id_transaksi
                                                },
                                                success: function(response) {
                                                    // Tampilkan pesan sukses atau lakukan tindakan lain sesuai kebutuhan
                                                    alert(response);
                                                    // Refresh halaman
                                                    location.reload();
                                                },
                                                error: function(error) {
                                                    // Tampilkan pesan error atau lakukan tindakan lain sesuai kebutuhan
                                                    console.error('Error:', error);
                                                }
                                            });
                                        });
                                    });
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
                                            $.post('popup_detail_order.php', {
                                                id_transaksi: id_transaksi
                                            }, function(data) {
                                                $('#popupContent').html(data);
                                                $('#popup').modal('show');
                                            });
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
                                    });

                                    function closeModal() {
                                        $('#popup').modal('hide');
                                    }
                                </script>









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