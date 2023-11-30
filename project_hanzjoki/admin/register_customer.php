<?php
// Pastikan koneksi ke database sudah disiapkan (gunakan koneksi.php atau sesuaikan)
require('../koneksi.php');

// Fungsi untuk membersihkan dan menghindari SQL injection
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Inisialisasi variabel untuk pesan kesalahan
$errors = array();

// Periksa apakah formulir disubmit
if (isset($_POST['submit'])) {
    // Ambil dan bersihkan data dari formulir
    $nama_depan = clean_input($_POST['nama_depan']);
    $nama_belakang = clean_input($_POST['nama_belakang']);
    $username = clean_input($_POST['username']);
    $email = clean_input($_POST['email']);
    $password = clean_input($_POST['password']);
   
    // Validasi data (tambahkan validasi sesuai kebutuhan)
    if (empty($nama_depan) || empty($nama_belakang) || empty($username) || empty($email) || empty($password)) {
        $errors[] = 'Semua kolom harus diisi!';
    }

    // Contoh validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid!';
    }

    // Jika tidak ada kesalahan, lanjutkan dengan registrasi
    if (empty($errors)) {
        // Query untuk menambahkan data customer ke database
        $query = "INSERT INTO data_customer (nama_depan, nama_belakang, username, email, pw, pertanyaan, jawaban) 
                  VALUES ('$nama_depan', '$nama_belakang', '$username', '$email', '$password', null, null)";

        // Eksekusi query
        if (mysqli_query($koneksi, $query)) {
            // Registrasi berhasil, arahkan ke halaman login
            header('Location: logindulu.php');
            exit;
        } else {
            echo 'Registrasi gagal. Silakan coba lagi.';
        }
    } else {
        // Tampilkan pesan kesalahan
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}

// Tutup koneksi database (pastikan koneksi.php telah memuatnya)
mysqli_close($koneksi);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register customer</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap">
</head>
<body>

    <div class="box-cont"> 
        <div class="container-1" >
            <img src="../image/LOGO DAN NAMA.png">
            <h1 class="text-1">Register Akun Hanz Joki</h1>
            <div class="line1"></div>
            <h1 class="text-2">Selamat Datang</h1>
            <h1 class="text-3">Silakan mengisi form dibawah untuk mendaftar</h1>
            
            
            <form action="register_customer.php" method="post">
                <div class="colomn-register">

                    <input type="text" id="nama_depan" class="regi-cust" name="nama_depan" placeholder="Nama depan">
                    <input type="text" id="nama_belakang" class="regi-cust" name="nama_belakang" placeholder="Nama belakang"> 
                    
                    <input type="text" id="username" class="regi-cust" name="username" placeholder="Username">

                    <input type="text" id="email" class="regi-cust" name="email" placeholder="Masukkan Email ">
                    <input type="password" id="password" class="regi-cust" name="password" placeholder="tuliskan Password Anda">
<!-- 
                    <input type="text" id="pertanyaan" class="regi-cust" name="pertanyaan" placeholder="Tuliskan pertanyaan digunakan untuk lupa password">
                    <input type="text" id="jawaban" class="regi-cust" name="jawaban" placeholder="Tuliskan jawaban digunakan untuk lupa password"> -->

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