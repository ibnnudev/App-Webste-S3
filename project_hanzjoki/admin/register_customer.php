
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login customer</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap">
</head>
<body>

    <div class="box-cont"> 
        <div class="container-1" >
            <img src="../image/LOGO DAN NAMA.png">
            <h1 class="text-1">Masuk Akun Hanz Joki</h1>
            <div class="line1"></div>
            <h1 class="text-2">Selamat Datang</h1>
            <h1 class="text-3">Masukkan Email dan Password Anda untuk masuk</h1>
            
            
            <form action="logindulu.php" method="post">
                <div class="colomn-login">
                    <input type="text" id="email" class="email-login-admin" name="email" placeholder="Masukkan Email atau Username">
                    <input type="password" id="password" class="pw-login-admin" name="password" placeholder="Masukkan Password Anda">
                    <input type="submit" name="submit" class="login-button">
                </div>
            </form>


            
            <?php
            // Menampilkan pesan kesalahan jika ada
            if (isset($_SESSION['error'])) {
                echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']); // Menghapus pesan kesalahan setelah ditampilkan
            }
            ?>

        </div>

        <div class="container-2">
            <div class="box-kotak-slize op">
                <img src="../image/WALLPAPER1LOGIN.png" alt="Gambar 1">
                <img src="../image/WALLPAPER2LOGIN.png" alt="Gambar 2">
                <img src="../image/WALLPAPER3LOGIN.png" alt="Gambar 3">
            </div>
        </div>
    </div>

</body>
</html>