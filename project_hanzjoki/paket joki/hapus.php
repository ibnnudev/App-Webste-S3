<?php
require_once('../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_paket'])) {
    $id_paket = $_GET['id_paket'];

    // Query to delete data from the database
    $query = "DELETE FROM paket_joki_rank WHERE id_paket = ?";

    // Use prepared statement
    $stmt = mysqli_prepare($koneksi, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "s", $id_paket);
    header("Location: ../admin/data_joki.php");
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data promo berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan saat menghapus data promo: " . mysqli_error($koneksi);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    echo "Parameter id_paket tidak valid.";
}
?>
