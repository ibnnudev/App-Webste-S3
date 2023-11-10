
<?php

$SERVER = "localhost";
$username = "root";
$password = "";
$db = "hanzjoki"; // Mengganti "user" dengan "db" sesuai dengan nama database Anda.

$err = "";
$ingataku= "";
// Membuat koneksi ke database menggunakan MySQLi
$koneksi = new mysqli($SERVER, $username, $password, $db);

// Memeriksa apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
} else {
    echo " ";
}


?>