<?php
require('koneksi.php');
if (isset($_POST['register'])) {
    $userMail = $_POST['email'];
    $usernama_depan = $_POST['nama_depan'];
    $usernama_belakang = $_POST['nama_belakang'];
    $userusername = $_POST['username'];
    $userPass = $_POST['password'];

 // Validasi form
 if (empty($userMail) || empty($usernama_depan) || empty($usernama_belakang) || empty($userusername) || empty($userPass)) { 
    echo "Semua field harus diisi!";
    exit();
}


    $query = "INSERT INTO customer (email, nama_depan, nama_belakang, username , password ) VALUES (?, ?, ?, ?, ?)";
    
    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $koneksi->prepare($query);

    if ($stmt) {
        $stmt->bind_param("sssss", $userMail, $usernama_depan, $usernama_belakang, $userusername, $userPass);
        if ($stmt->execute()) {
            // Registrasi berhasil
            echo "Registrasi berhasil!";
            $stmt->close();
            $koneksi->close();
            header('Location: login.php');
            exit();
        } else {
            // Registrasi gagal
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $koneksi->error;
    }
}
if (isset($_GET['error']) && $_GET['error'] == 'true') {
    echo "<script>alert('Registrasi gagal. Silakan coba lagi.')</script>";
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <header>
        <h2 class="logo">Hanzjoki</h2>
        <nav class="navigation">

            <a href="#">About us</a>
            <a href="#">Team Dev</a>
            <a href="#">Contact</a>
            <a href="login.php">Login</a>
            <button class="btnLogin">Register</button>
        </nav>
     </header>

     <div class="wrapper">       
        <div class="form-box register">
            <h2>Register</h2>
            <form action="register.php" method="post"> <!-- Mengarahkan formulir ke proses_login.php -->
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required> <!-- Menambahkan atribut name -->
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="nama_depan" name="nama_depan" required> <!-- Menambahkan atribut name -->
                    <label>Nama depan</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="nama_depan" name="nama_belakang" required> <!-- Menambahkan atribut name -->
                    <label>Nama Belakang</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="username" name="username" required> <!-- Menambahkan atribut name -->
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required> <!-- Menambahkan atribut name -->
                    <label>password</label>
                </div>

                <button type="submit" class="btn">Register</button>
                <div class="Login-register">

                </div>
            </form>
        </div>
     </div>

     <script src="script.js"></script>
     <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

