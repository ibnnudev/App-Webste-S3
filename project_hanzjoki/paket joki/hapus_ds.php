<?php
require_once('../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['no'])) {
    $nama_discount = $_GET['no'];


    // Query to delete data from the database
    $query = "DELETE FROM discount WHERE nama_discount = ?";

    // Use prepared statement
    $stmt = mysqli_prepare($koneksi, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "s", $nama_discount);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to discount.php after successful deletion
        header("Location: discount.php");
        exit(); // Important to stop further execution
    } else {
        echo "Terjadi kesalahan saat menghapus data promo: " . mysqli_error($koneksi);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    echo "Parameter nama_discount tidak valid.";
}
?>
