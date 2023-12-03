<?php

// Periksa apakah request dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_transaksi"])) {
    // Mengambil data yang dikirim melalui POST
    $id_transaksi = $_POST["id_transaksi"];

    // Sertakan file koneksi.php
    require('../koneksi.php');

    // Melakukan update data statsdone pada transaksi
    $sql = "UPDATE transaksi SET stats = 'Lunas' WHERE id_transaksi = '$id_transaksi'";
    
    if ($koneksi->query($sql) === TRUE) {
        echo "Update status berhasil.";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Menutup koneksi
    $koneksi->close();
} else {
    // Jika tidak ada data yang dikirimkan melalui POST, kirimkan pesan error
    echo "Error: Data tidak valid.";
}

?>

