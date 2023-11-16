<?php
require('../koneksi.php');

// Pastikan id_worker ada dan merupakan bilangan bulat positif
$id = isset($_GET['id_worker']) ? intval($_GET['id_worker']) : 0;

if ($id > 0) {
    // Gunakan parameterized query untuk mencegah SQL injection
    $stmt = $koneksi->prepare("DELETE FROM data_worker WHERE id_worker = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirect ke halaman home.php setelah penghapusan
    header("Location: tambah_worker.php");
    exit();
} else {
    // Tampilkan pesan atau jalankan tindakan lain jika id_worker tidak valid
    echo "Invalid id_worker";
}






$id_transaksi = isset($_GET['id_transaksi']) ? intval($_GET['id_transaksi']) : 0;

if ($id_transaksi > 0) {
    $stmt = $koneksi->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id_transaksi);
        $stmt->execute();
        $stmt->close();

        // Redirect ke halaman data_orderan.php setelah penghapusan
        header("Location: data_orderan.php");
        exit();
    } else {
        // Tampilkan pesan kesalahan jika prepare statement gagal
        echo "Error in prepare statement: " . $koneksi->error;
    }
} else {
    // Tampilkan pesan atau jalankan tindakan lain jika id_transaksi tidak valid
    echo "Invalid id_transaksi";
}

?>
