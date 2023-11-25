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
            <!-- <nav class="navigation2">
                <a href="../register.php">Daftar Sekarang</a>
                <a href="../login.php">Masuk</a>
            </nav> -->
            
    </header>   
    <div class="background-3">
        <p class="textbg-3">Lacak Orderan</p>
        <label class="label-order1">Lacak Orderan kamu hanya dengan email atau nomor invoice</label>
        <input type="text" id="orderTrackingInput" class="input-orderan" placeholder="   email/invoice" required>
        
        <!-- Tombol untuk melakukan pelacakan -->
        <button id="trackOrderButton" class="button-orderan" onclick="trackOrder()">Lacak Orderan </button>
        
        <p class="textbg-4">Pesanan kamu tidak terdaftar meskipun kamu yakin sudah memesan? Harap tunggu 1-2 jam </p>
        <p class="textbg-5">Namun jika pesanan masih tidak muncul maka kamu dapat menghubungi kami <a href="https://www.instagram.com/hanzjoki.id/?igshid=NzZlODBkYWE4Ng%3D%3D&utm_source=qr" target="_blank">disini</a></p>
    </div>

    <!-- Tempat untuk menampilkan struk -->
    <!-- <div id="receipt" style="display: none; margin-top: 20px;">
        <h2>Struk Pembayaran</h2>
        <p id="receiptContent"></p>
    </div>

    <script>
        function trackOrder() {
            // Dapatkan nilai input
            var orderInput = document.getElementById("orderTrackingInput").value;

            // Lakukan logika pelacakan order di sini (gunakan AJAX untuk mengirim permintaan ke server)

            // Contoh struk (gantilah dengan data sebenarnya dari pelacakan order)
            var receiptContent = "ID Transaksi: 123456<br>Customer: John Doe<br>Total Transaksi: $50.00";

            // Tampilkan struk setelah melacak order
            document.getElementById("receiptContent").innerHTML = receiptContent;
            document.getElementById("receipt").style.display = "block";
        }
    </script> -->


        
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