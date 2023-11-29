<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_customer'])) {
    // Jika tidak, mungkin redirect ke halaman login atau tindakan lainnya
    header('Location: logindulu.php');
    exit;
}

// Mengakses informasi pengguna yang login
$id_customer = $_SESSION['id_customer'];
$username = $_SESSION['username'];
?>




<?php
// Koneksi ke database (gantilah dengan informasi koneksi yang sesuai)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hanzjoki";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil ID transaksi dari database
$sql = "SELECT
transaksi.id_transaksi,
transaksi.payment,
data_akun.login_via,
data_akun.email_nohp,
data_akun.req_hero,
data_akun.nick_id,
data_akun.pw,
data_akun.catatan
FROM
transaksi
JOIN
data_akun ON transaksi.id_data_akun = data_akun.id_data_akun
WHERE
transaksi.id_transaksi = '?' ";
$result = $conn->query($sql);

// Periksa apakah query berhasil dijalankan
if ($result->num_rows > 0) {
    // Ambil hasil query
    $row = $result->fetch_assoc();
    $id_transaksi = $row["id_transaksi"];
    $payment = $row ["payment"];
} else {
    // Jika tidak ada hasil, berikan nilai default
    $id_transaksi = "N/A";
}

// Tutup koneksi ke database
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One?query=mochiy+ ">
    <style>

        

        @media only screen and (max-width: 1600px) {
            /* Sesuaikan gaya untuk perangkat dengan lebar maksimum 600px */
            .thank {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
        <header>
            <div class="container"> 
                <h2 class="logo">
                    <img src="../image/LOGO HANZJOKI.png" alt="LOGO" style="width:150px; height:auto; ">
                </h2>
                  
        
                 <nav class="navigation3">
            
                    <a href="dashboardcust.php">
                        <span class="link-text">Beranda</span>
                    </a>
                    <a href="lacakorderan.html" style="text-decoration: none; color: #06D85F;">
                        <span class="link-text">Lacak Orderan</span>
                    </a>
                    <a href="hubungikami.php">
                        <span class="link-text">Hubungi Kami</span>
                    </a>
                    <a href="calculator.php">
                        <span class="link-text">Calculator Ml</span>
                    </a>
                </nav>
            </div>
        </header>

<!-- ====================================================================================================================== -->
                

<div class="body-struk">
            <h1 class="thank">Terima Kasih!</h1>
            <h1 class="thank2"> Transaksi Sudah Selesai. </h1>
            <div class="id_pesanan1">Pesanan kamu <?php echo $id_transaksi; ?> Telah dikirim dan akan segera tiba. </div>

            <div class="tgl-pemesanan1">
                Transaksi dibuat pada 
                <br> <?php      echo " "?>
            </div>
                        
            <!-- Garis horizontal -->   
            <hr class="horizontal-line">


            <div class="body-rt">
                <div class="rt-1">
                    <div class="data-paket"></div>
                    <div class="data-akuncst"> 
                    <div class="login-via">Login Via <?php echo "pler" ?></div>
            </div>
                   
                </div>


                            <div class="rt-2">
                            <div class="metod-pembayaran">Metode Pembayaran 
                                <br> <?php echo $payment; ?>
                            </div>

                                    <hr class="horizontal-line1">  

                                    <div class="nomor-invoice1" >Nomor Invoice <?php echo $id_transaksi; ?></div>
                                    <div class="stats-transaksi">Status Transaksi </div>
                                    <div class="pembayaran-status">Status Pembayaran</div>
                                    <div class="stats-pesan">Pesan</div>

                                    <a href="dashboardcust.php" class="pesan-button">Beli Lagi</a>

                            </div>
            
            </div>





        </div>













</body>
</html>