
<?php
require('../koneksi.php');

$id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : '';

if (!empty($id_transaksi)) {
    $stmt = $koneksi->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
    if ($stmt) {
        $stmt->bind_param("s", $id_transaksi);
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
