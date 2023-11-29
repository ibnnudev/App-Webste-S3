<?php
require('../koneksi.php');
session_start();

if (isset($_POST['OKE'])) {
    $id_transaksi = $_POST['OKE'];


    if (empty(trim($id_transaksi))) {
        $_SESSION['error'] = 'Masukan ID_TRANSAKSI dengan benar!';
        header('Location: lacakorderan.php');
        exit;
    }

    // Use parameterized query to prevent SQL Injection
    $query = "SELECT * FROM transaksi WHERE id_transaksi = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if (!$stmt) {
        $_SESSION['error'] = 'Terjadi kesalahan dalam query!';
        header('Location: lacakorderan.php');
        exit;
    }

    mysqli_stmt_bind_param($stmt, 's', $id_transaksi);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        $_SESSION['error'] = 'Terjadi kesalahan dalam eksekusi query!';
        header('Location: lacakorderan.php');
        exit;
    }

    $row = mysqli_fetch_assoc($result);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        // Informasi pengguna yang login disimpan dalam session
        $_SESSION['id_transaksi'] = $row['id_transaksi'];

        // Header langsung ke dashboard tanpa memeriksa peran
        header('Location: struk_customer_done.php');
        exit;
    } else {
        $_SESSION['error'] = 'Harap masukan ID_TRANSAKSI dengan benar!';
        header('Location: lacakorderan.php');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Orderan</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One?query=mochiy+ ">

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
    <div class="background-3">
        <p class="textbg-3">Lacak Orderan</p>
        <label class="label-order1">Lacak Orderan kamu hanya dengan email atau nomor invoice</label>
        <form id="formlacak" method="POST">
    <input type="text" id="orderTrackingInput" name="OKE" class="input-orderan" placeholder="   email/invoice" required>
    <button id="trackOrderButton" class="button-orderan" type="submit">Lacak Orderan </button>
</form>


        <p class="textbg-4">Pesanan kamu tidak terdaftar meskipun kamu yakin sudah memesan? Harap tunggu 1-2 jam </p>
        <p class="textbg-5">Namun jika pesanan masih tidak muncul maka kamu dapat menghubungi kami <a href="https://www.instagram.com/hanzjoki.id/?igshid=NzZlODBkYWE4Ng%3D%3D&utm_source=qr" target="_blank">disini</a></p>
    </div>

    


        
    <footer>
        <section class="tentang" id="tentang">
            <div class="card">
                <h1>TENTANG KAMI</h1>
                <br>
                <p>
                    <a href="../admin/aboutus.php" class="title">HANZJOKI</a> Hanz Joki adalah sebuah aplikasi yang didesain khusus untuk layanan Joki (boosting) untuk game MLBB.
                    <br>  Aplikasi ini juga menyediakan 
                    layanan joki MLBB dimana pemain dapat membayar untuk meningkatkan peringkat atau 
                </br>kemampuan mereka dalam permainan tersebut. 
                </p>
            </div>
        </section>
        <div class="sosmed">
            <h1>SOSIAL MEDIA</h1>
            <a href="https://instagram.com/wrzeno_" target="_blank" rel="noopener noreferrer"><img src="../image/ig.png" alt=""></a>
            <a href="http://" target="_blank" rel="noopener noreferrer"><img src="../image/fb.png" alt=""></a>
            <a href="http://" target="_blank" rel="noopener noreferrer"><img src="../image/twitter.png" alt=""></a>
            <a href="http://" target="_blank" rel="noopener noreferrer"><img src="../image/wa.png" alt=""></a>
            
        </div>
    </footer>
    <div id="copyright">
        &copy;2022 HANZJOKI
    </div>
    

</body>
</html>