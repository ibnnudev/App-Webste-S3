<?php

// Periksa apakah request dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_transaksi"])) {
    // Mengambil data yang dikirim melalui POST
    $id_transaksi = $_POST["id_transaksi"];

    // Koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "hanzjoki");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }

    // Melakukan update data statsdone pada transaksi
    $sql = "UPDATE transaksi SET statsdone = 'Problem' WHERE id_transaksi = '$id_transaksi'";
    
    if ($koneksi->query($sql) === TRUE) {
        echo "Update statsdone berhasil.";
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
