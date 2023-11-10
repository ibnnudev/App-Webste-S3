<?php
require('koneksi.php');
session_start();

if (isset($_POST['loginbtn'])) { // Perubahan nama tombol dari 'submit' menjadi 'loginbtn'
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ingataku = isset($_POST['ingataku']) ? 1 : 0; // Ubah cara mendapatkan nilai checkbox ingataku

    $err = '';

    if ($email == '' or $password == '') {
        $err .= "<li>Silakan masukkan email dan password.</li>";
    } else {
        $sql1 = "SELECT * FROM customer WHERE email = '$email'";
        $q1 = mysqli_query($koneksi, $sql1);

        if (!$q1) {
            die("Query error: " . mysqli_error($koneksi));
        }

        $r1 = mysqli_fetch_array($q1);

        if (!$r1) {
            $err .= "<li>Email <b>$email</b> tidak tersedia.</li>";
        } elseif ($r1['password'] != md5($password)) {
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }

        if (empty($err)) {
            $_SESSION['session_email'] = $email;
            $_SESSION['session_password'] = $password;

            if ($ingataku == 1) {
                $cookie_name = "cookie_email";
                $cookie_value = $email;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name, $cookie_value, $cookie_time, "/");

                $cookie_name = "cookie_password";
                $cookie_value = $password;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name, $cookie_value, $cookie_time, "/");
            }

            header('location: dashboard.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <header>
        <h2 class="logo">Hanzjoki</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About us</a>
            <a href="#">Contact</a>
            <button class="btnLogin">Login</button>
        </nav>
     </header>

     <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-outline"></ion-icon></span>
        <div class="form-box Login">
            <h2>Login</h2>
            <form action="dashboard.php" method="post"> <!-- Mengarahkan formulir ke proses_login.php -->
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required> <!-- Menambahkan atribut name -->
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required> <!-- Menambahkan atribut name -->
                    <label>password</label>
                </div>
                <div class="remember-forget">
                    <label><input type="checkbox" name="ingataku"> <!-- Menambahkan atribut name -->
                    Remember me</label>
                    <a href="#" >Forget Password?</a>
                </div>
                <button type="submit" class="btn"
                name="loginbtn">Login</button>
                <div class="Login-register">
                    <p>Dont have an account ? <a href="register.php" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div>
           <?php
            if (isset($_POST['loginbtn'])) {
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($koneksi,"SELECT * FROM customer WHERE email='$email'");

                $coundata = mysqli_num_rows($query);
                echo $coundata;
            }
           ?>

        </div>

     </div>

     <script src="script.js"></script>
     <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
