



<?php
require('../koneksi.php');
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty(trim($email)) || empty(trim($password))) {
        $_SESSION['error'] = 'Email dan Password harus diisi!';
        header('Location: logindulu.php');
        exit;
    }

    // Ganti query SQL dan gunakan parameterized query untuk mencegah SQL Injection
    $query = "SELECT * FROM perloginan WHERE (email = ? OR username = ?) AND password = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if (!$stmt) {
        $_SESSION['error'] = 'Terjadi kesalahan dalam query!';
        header('Location: logindulu.php');
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'sss', $email, $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        $_SESSION['error'] = 'Terjadi kesalahan dalam eksekusi query!';
        header('Location: logindulu.php');
        exit;
    }

    $row = mysqli_fetch_assoc($result);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $roleVal = $row['role'];

        // Periksa peran pengguna
        switch ($roleVal) {
            case 'admin':
                header('Location: dashboard.php');
                exit;
            case 'penjoki':
                header('Location: dashboard.php');
                exit;
            case 'customer':
                header('Location: dashboard.php');
                exit;
            default:
                $_SESSION['error'] = 'Role tidak valid!';
                header('Location: logindulu.php');
                exit;
        }
    } else {
        $_SESSION['error'] = 'Login gagal. Email atau Password salah.';
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
                <h1 class="text-3">Masukan Email dan Password Anda untuk masuk</h1>

                <form action="logindulu.php" method="post"> <!-- Formulir untuk memproses input dengan metode POST -->
                    <div class="colomn-login">
                        <input type="email" id="email" class="email-login-admin" name="email" placeholder="Masukkan Email Anda">
                        <input type="password" id="password" class="pw-login-admin" name="password" placeholder="Masukkan Password Anda">
                        <button type="submit" name="submit" class="login-button">Masuk Sekarang</button>
                    </div>
                </form>
                
            </div>




            <div class="container-2">
                <div class="box-kotak-slize op">
                    <img src="../image/WALLPAPER1LOGIN.png" alt="Gambar 1">
                    <img src="../image/WALLPAPER2LOGIN.png" alt="Gambar 2">
                    <img src="../image/WALLPAPER3LOGIN.png" alt="Gambar 3">
                    <!-- Tambahkan gambar sesuai kebutuhan -->
                </div>
            </div>
    </div>





    
</body>
</html>
