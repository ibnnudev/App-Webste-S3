<?php
// Memulai sesi
session_start();

// Menyertakan file koneksi database
require('../koneksi.php');

// Mengecek apakah tombol submit diklik
if (isset($_POST['submit'])) {
    // Mengambil nilai email/username dan password dari formulir
    $emailOrUsername = $_POST['email'];
    $password = $_POST['password'];

    // Mengeksekusi kueri SQL untuk memeriksa keberadaan pengguna dengan email/username dan password yang sesuai
    $query = "SELECT * FROM data_customer WHERE (email = ? OR username = ?)";
    
    $stmt = mysqli_prepare($koneksi, $query);

    // Mengecek apakah kueri berhasil diprepare
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $emailOrUsername, $emailOrUsername);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Mengecek apakah hasil kueri ditemukan
        if ($result) {
            $row = mysqli_fetch_assoc($result);

            // Mengecek apakah email/username dan password sesuai
            if ($row && password_verify($password, $row['pw'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username']; 

                // Memeriksa peran pengguna dan mengarahkannya ke halaman yang sesuai
                header('Location: ../customer/dashboardcust.php');
                exit;
            } else {
                // Menampilkan pesan kesalahan jika email/username atau password tidak sesuai
                $_SESSION['error'] = 'Email/Username atau password tidak valid!';
                header('Location: logindulu.php');
                exit;
            }
        } else {
            // Menampilkan pesan kesalahan jika eksekusi kueri gagal
            $_SESSION['error'] = 'Terjadi kesalahan dalam eksekusi query!';
            header('Location: logindulu.php');
            exit;
        }
    } else {
        // Menampilkan pesan kesalahan jika persiapan kueri gagal
        $_SESSION['error'] = 'Terjadi kesalahan dalam query!';
        header('Location: logindulu.php');
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
    <title>Login Admin</title>
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
