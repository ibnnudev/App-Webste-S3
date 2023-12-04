<?php
require('../koneksi.php');
session_start();

if (isset($_POST['login'])) {
    $emailOrUsername = $_POST['emailOrUsername'];
    $password = $_POST['password'];

    if (empty($emailOrUsername) || empty($password)) {
        echo "Email/Username dan password harus diisi.";
        exit;
    }

    $queryAdmin = "SELECT * FROM data_admin WHERE (email = ? OR username = ?) AND pw = ?";
    $stmtAdmin = mysqli_prepare($koneksi, $queryAdmin);

    if (!$stmtAdmin) {
        echo "Terjadi kesalahan dalam query Admin: " . mysqli_error($koneksi);
        exit;
    }

    mysqli_stmt_bind_param($stmtAdmin, 'sss', $emailOrUsername, $emailOrUsername, $password);

    if (mysqli_stmt_execute($stmtAdmin)) {
        $resultAdmin = mysqli_stmt_get_result($stmtAdmin);
        $rowAdmin = mysqli_fetch_assoc($resultAdmin);

        if ($rowAdmin && $rowAdmin['sebagai'] === 'admin') {
            $_SESSION['user'] = $rowAdmin;
            header('Location: home.php');
            exit;
        }
    } else {
        echo "Terjadi kesalahan dalam eksekusi query Admin: " . mysqli_error($koneksi);
        exit;
    }

    // If login as admin fails, check worker login
    $queryWorker = "SELECT * FROM data_worker WHERE (email = ? OR username = ?) AND pw = ?";
    $stmtWorker = mysqli_prepare($koneksi, $queryWorker);

    if (!$stmtWorker) {
        echo "Terjadi kesalahan dalam query Worker: " . mysqli_error($koneksi);
        exit;
    }

    mysqli_stmt_bind_param($stmtWorker, 'sss', $emailOrUsername, $emailOrUsername, $password);

    if (mysqli_stmt_execute($stmtWorker)) {
        $resultWorker = mysqli_stmt_get_result($stmtWorker);
        $rowWorker = mysqli_fetch_assoc($resultWorker);

        if ($rowWorker && $rowWorker['sebagai'] === 'worker') {
            $_SESSION['user'] = $rowWorker;
            header('Location: ../worker/worker_dashboard.php');
            exit;
        }
    } else {
        echo "Terjadi kesalahan dalam eksekusi query Worker: " . mysqli_error($koneksi);
        exit;
    }

    // If both admin and worker login fail
    echo "Login gagal. Periksa email/username dan password Anda atau hubungi administrator.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap">
</head>

<body>
    <div class="container-65">
        <div class="box-login-admin">


            <div class="box-foto">
                <img src="../image/profile.png" alt="" class="foto-login">
                <span class="title-wave">Welcome</span>
            </div>
            <h1 class="aduh">Sign In</h1>
            <form action="login_admin.php" method="post">
                <label for="emailOrUsername">Email/Username:</label>
                <input type="text" id="emailOrUsername" name="emailOrUsername" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="login">Login</button>

                <div class="lp-pw">
                    <a href="lupa_pw_admin.php">Lupa Password</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>