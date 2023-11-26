<?php


if (isset($_GET['id']) && isset($_GET['namaPaket']) && isset($_GET['harga']) && isset($_GET['qty']) && isset($_GET['subtotal'])) {
    // Ambil data dari $_GET
    $id = $_GET['id'];
    $namaPaket = $_GET['namaPaket'];
    $harga = $_GET['harga'];
    $qty = $_GET['qty'];
    $subtotal = $_GET['subtotal'];

    // Lakukan apa yang perlu Anda lakukan dengan data yang diambil
    // Misalnya, simpan ke database atau lakukan operasi lainnya.
    
    // Contoh:
    echo "Data berhasil diambil dari tabel. ID: $id, Nama Paket: $namaPaket, Harga: $harga, Qty: $qty, Subtotal: $subtotal";
} else {
    // Data tidak lengkap
    echo "Data tidak lengkap. Permintaan tidak dapat diproses.";
}
?>
