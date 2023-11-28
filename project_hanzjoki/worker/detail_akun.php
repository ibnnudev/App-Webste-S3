<?php
require('../koneksi.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil ID transaksi dari permintaan AJAX
    $id_transaksi = $_POST['id_transaksi'];

    // Jalankan query untuk mendapatkan detail transaksi sesuai dengan ID transaksi
    // Gantilah query ini sesuai dengan struktur tabel dan query yang sesuai
    $sql_detail = "SELECT
    transaksi.id_transaksi,
    data_akun.login_via,
    data_akun.email_nohp,
    data_akun.req_hero,
    data_akun.nick_id,
    data_akun.pw,
    data_akun.catatan
FROM
    transaksi
JOIN
    data_akun ON transaksi.id_data_akun = data_akun.id_data_akun
WHERE
    transaksi.id_transaksi = ? ";


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
            echo "login_via: {$row_detail['login_via']}<br>";
            echo "email_nohp: {$row_detail['email_nohp']}<br>";
            echo "req_hero: {$row_detail['req_hero']}<br>";
            echo "nick_id: {$row_detail['nick_id']}<br>";
            echo "pw: {$row_detail['pw']}<br>";
            echo "catatan: {$row_detail['catatan']}<br>";
            
            echo "<hr>";
        }
    } else {
        echo "Tidak ada detail transaksi.";
    }

    // Tutup statement
    $stmt->close();
}
?>
