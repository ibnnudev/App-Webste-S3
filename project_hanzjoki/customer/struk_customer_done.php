<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_transaksi'])) {
    // Jika tidak, mungkin redirect ke halaman login atau tindakan lainnya
    header('Location: lacakorderan.php');
    exit;
}

// Mengakses informasi pengguna yang login
$id_transaksi = $_SESSION['id_transaksi'];
?>

<?php
// Periksa apakah request dikirimkan melalui metode POST
if (isset($_POST["TRANSFER"])) {
    // Mengambil data yang dikirim melalui POST
    $id_transaksi = $_POST["id_transaksi"];

    // Koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "hanzjoki");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }

    // Periksa apakah kunci img_ktp ada dan tangani kasus ketika tidak ada gambar yang diunggah
    $img_ktp = !empty($_FILES["img_ktp"]["name"]) ? $_FILES["img_ktp"]["name"] : '';

    if (!empty($img_ktp)) {
        $lokasi_sementara = $_FILES["img_ktp"]["tmp_name"];
        $lokasi_tujuan = '../upload/' . $img_ktp;
        move_uploaded_file($lokasi_sementara, $lokasi_tujuan);

        // Melakukan update data bukti_ss pada transaksi
        $sql = "UPDATE transaksi SET bukti_ss = '$img_ktp' WHERE id_transaksi = '$id_transaksi'";

        if ($koneksi->query($sql) === TRUE) {
            echo "Update status berhasil.";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } else {
        echo "Error: Foto tidak valid atau tidak diunggah.";
    }

    // Menutup koneksi
    $koneksi->close();
} else {
    // Jika tidak ada data yang dikirimkan melalui POST, kirimkan pesan error
    echo "Error: Data tidak valid.";
}
?>

<?php
$koneksi = mysqli_connect("localhost","root","","hanzjoki");

$result= mysqli_query ($koneksi,"SELECT *
FROM transaksi
JOIN data_akun ON transaksi.id_data_akun = data_akun.id_data_akun
JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi
JOIN paket_joki_rank ON detail_transaksi.id_paket = paket_joki_rank.id_paket
LEFT JOIN discount ON transaksi.id_transaksi = discount.nama_discount
WHERE transaksi.id_transaksi = '$id_transaksi'");
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
            <div class="id_pesanan1">Pesanan kamu <?php echo $id_transaksi; ?> Telah dikirim dan akan segera tiba.</div>
            <div class="tgl-pemesanan1">Transaksi dibuat pada </div>
            <?php while ($row=mysqli_fetch_assoc($result)): ?>  
            <!-- Garis horizontal -->   
            <hr class="horizontal-line">
            <div class="body-rt">
                <div class="rt-1">
                        <div class="via-login">
                        <div class="via1">Login Via</div>
                        <div class="via1">User ID & NickName </div>
                        <div class="via1">Email/No Hp </div>
                        <div class="via1">Password </div>
                        <div class="via1">Request Hero </div>
                        <div class="via1">Catatan para pejoki </div>
                        
                    </div>
                    <div class="data-akuncst"> 
    <div class="id_pesanan1"> : <?php echo $row ["login_via"]?></div>
    <div class="id_pesanan1"> : <?php echo $row ["nick_id"]?></div>
    <div class="id_pesanan1"> : <?php echo $row ["email_nohp"]?></div>
    <div class="id_pesanan1"> : <?php echo $row ["pw"]?></div>
    <div class="id_pesanan1"> : <?php echo $row ["req_hero"]?></div>
    <div class="id_pesanan1"> : <?php echo $row ["catatan"]?></div>
    
    
                    </div>        
                            
                    </div>
                    
                    
                                <div class="rt-2">
                                    <div class="metod-pembayaran">Metode Pembayaran : 
                                        <?php echo $row ["payment"] ?>   </div>
                                    
                                    <hr class="horizontal-line1">  
                                    <div class="rt-3"> 
                                    <div class="nomor-invoice1" >Nomor Invoice</div>
                                    <div class="stats-transaksi">Status Transgitaksi</div>
                                    <div class="pembayaran-status">Status Pembayaran</div>
                                    <div class="stats-pesan">Pesan</div>  
                                    
            </div>
            <?php endwhile;?>
            <!-- <form id="form1" method="POST">
                        <input type="file" name="img_ktp" accept="image/*">
                        <button class="payment-button" type="submit" name="TRANSFER">
                <div class="payment-content">
            <h3 class="payment-title">KIRIM</h3>
        </div>
     </button>
                        </form>
            <a href="dashboardcust.php" class="pesan-button">Beli Lagi</a>
            
            </div> -->
            
            </div>
            </div>
            
                                


                                        
                                    </div>
                                    
                                    </div>  
 
                                    </div>
                 
                                    
                   
                            













</body>
</html>