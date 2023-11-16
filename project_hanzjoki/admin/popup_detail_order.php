<?php
require('../koneksi.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil ID transaksi dari permintaan AJAX
    $id_transaksi = $_POST['id_transaksi'];

    // Jalankan query untuk mendapatkan detail transaksi sesuai dengan ID transaksi
    // Gantilah query ini sesuai dengan struktur tabel dan query yang sesuai
    $sql_detail = "SELECT 
                        detail_transaksi.id_transaksi,
                        detail_transaksi.qty,
                        paket_joki_rank.judul_paket,
                        paket_joki_rank.nama_paket
                    FROM
                        detail_transaksi
                    JOIN
                        paket_joki_rank ON detail_transaksi.id_paket = paket_joki_rank.id_paket
                    WHERE
                        detail_transaksi.id_transaksi = ?";

    // Persiapkan statement
    $stmt = $koneksi->prepare($sql_detail);

    // Bind parameter
    $stmt->bind_param("s", $id_transaksi); // Mengganti "i" dengan "s" karena $id_transaksi mungkin string

    // Eksekusi statement
    $stmt->execute();

    // Dapatkan hasil query
    $result_detail = $stmt->get_result();

    if ($result_detail->num_rows > 0) {
        while ($row_detail = $result_detail->fetch_assoc()) {
            echo "ID Transaksi: {$row_detail['id_transaksi']}<br>";
            echo "Qty: {$row_detail['qty']}<br>";
            // echo "ID Paket: {$row_detail['id_paket']}<br>";
            echo "Judul Paket: {$row_detail['judul_paket']}<br>";
            echo "Nama Paket: {$row_detail['nama_paket']}<br>";
            // Tambahkan informasi lainnya sesuai kebutuhan
            echo "<hr>";
        }
    } else {
        echo "Tidak ada detail transaksi.";
    }

    // Tutup statement
    $stmt->close();
}
?>
