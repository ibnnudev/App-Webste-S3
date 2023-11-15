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
?>
