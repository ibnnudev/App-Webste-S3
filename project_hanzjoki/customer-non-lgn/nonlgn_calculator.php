


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
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
        
                <a href="nonlgnberanda.php">
                    <span class="link-text">Beranda</span>
                </a>

            
                <a href="nonlgn_lacakorderan.php">
                    <span class="link-text">Lacak Orderan</span>
                </a>
                <a href="nonlgn_hubungikami.php">
                    <span class="link-text">Hubungi Kami</span>
                </a>
                <a href="nonlgn_calculator.php" style="text-decoration: none; color: #06D85F;">
                    <span class="link-text">Calculator Ml</span>
                </a>
            </nav>
        </div>
        <nav class="navigation2">
        <a href="../admin/register_customer.php">Daftar Sekarang</a>
        <a href="../admin/logindulu.php">Masuk</a>
    </nav>
        
    </header>   

    <div class="background-2">
        <img src="../image/LOGO2.png" alt="Calculator Icon" class="logoC">
        <p class="textbg-2">Calculator Hitung Win Rate</p>

        <div class="labelC">
            <form method="post" action="">
                <label class="label1C">Total Pertandingan Anda</label>
                <input type="number" name="totalMatches" class="input-text" required placeholder="   contoh: 150">
                <label class="label2C">Total Win Rate Anda</label>
                <input type="number" name="currentWinrate" class="input-text" required placeholder="   contoh: 50%">
                <label class="label3C">Win Rate yang Diinginkan</label>
                <input type="number" name="desiredWinrate" class="input-text" required placeholder="   contoh: 80%">
                <input type="submit" name="calculate" class="submit-button" value="Hitung">
            </form>
        </div>

        <?php
        if (isset($_POST["calculate"])) {
            $currentWinrate = $_POST["currentWinrate"];
            $totalMatches = $_POST["totalMatches"];
            $desiredWinrate = $_POST["desiredWinrate"];

            // Menghitung berapa banyak pertandingan tambahan yang diperlukan
            $requiredMatches = ceil(($desiredWinrate * $totalMatches / 100 - $currentWinrate * $totalMatches / 100) / ($desiredWinrate / 100 - $currentWinrate / 100));

            echo "<p id='p6'>Untuk mencapai winrate $desiredWinrate% dari winrate saat ini sebesar $currentWinrate%, Kamu memerlukan sekitar <b>$requiredMatches</b> menang tanpa kalah.</p>";
        }
        ?>

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