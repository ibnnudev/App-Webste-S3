<?php
// update_job.php

session_start(); // Pastikan ini ada di awal file jika belum dimulai

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_transaksi"])) {
    // Mengambil data yang dikirim melalui GET
    $id_transaksi = $_GET["id_transaksi"];

    // Periksa apakah pengguna telah login dan peran pengguna adalah 'worker'
    if (isset($_SESSION['user']) && $_SESSION['user']['sebagai'] === 'worker') {
        // Ambil informasi pengguna dari sesi
        $user = $_SESSION['user'];

        // Pastikan bahwa 'id_worker' ada dalam array $user sebelum mengaksesnya
        if (isset($user['id_worker'])) {
            $id_worker = $user['id_worker'];
        } else {
            echo "Error: Tidak dapat menemukan kunci 'id_worker' dalam array pengguna.";
            exit;
        }

        // Memanggil fungsi koneksi dari file 'koneksi.php'
        require('../koneksi.php');
    
        // Periksa koneksi
        if ($koneksi->connect_error) {
            die("Connection failed: " . $koneksi->connect_error);
        }

        // Melakukan update data id_worker dan statsdone pada transaksi
        $sql = "UPDATE transaksi SET id_worker = '$id_worker', statsdone = 'Progres' WHERE id_transaksi = '$id_transaksi'";
        if ($koneksi->query($sql) === TRUE) {
            // Arahkan pengguna ke halaman tambah_worker.php setelah berhasil
            header('Location: takejob.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }

        // Menutup koneksi
        $koneksi->close();
    } else {
        echo "Error: Pengguna tidak memiliki hak akses untuk melakukan tindakan ini.";
        exit;
    }
}
?>

