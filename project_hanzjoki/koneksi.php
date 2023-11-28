<?php

$SERVER = "localhost";
$username = "root";
$password = "";
$db = "hanzjoki"; // Mengganti "user" dengan "db" sesuai dengan nama database Anda.

$err = "";
$ingataku= "";
// Membuat koneksi ke database menggunakan MySQLi
$koneksi = new mysqli($SERVER, $username, $password, $db);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}


function transaksi($data) {
    global $koneksi;
    $login_via = $data['login_via'];
    $req_hero = $data['req_hero'];
    $email_nohp = $data['email_nohp'];
    $nickname = $data['nickname'];
    $pass = $data['pass'];
    $catatan = $data['catatan'];
    $qty_order = $data['jumlahIsiKeranjang'];
    $tgl_order = $data['tanggalnow'];
    $total_transaksi = $data['totaltrans'];
    $payment = $data['pembayaran'];
    $no_wa = $data['whatsappBro'];

    $sqldata = "INSERT INTO data_akun (id_data_akun, login_via, email_nohp, req_hero, nick_id, pw, catatan)
            VALUES ('', '$login_via', '$email_nohp', '$req_hero', '$nickname', '$pass', '$catatan')";
    mysqli_query($koneksi, $sqldata);
    // Eksekusi query untuk mendapatkan id_data_akun
    $result = mysqli_query($koneksi, "SELECT id_data_akun FROM data_akun WHERE email_nohp = '$email_nohp'");

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($koneksi));
    }

    // Pemeriksaan hasil query
    if ($row = mysqli_fetch_assoc($result)) {
        $id_akun = $row['id_data_akun'];
        
        
        $sqltran = "INSERT INTO transaksi (id_transaksi, id_customer, id_worker, id_data_akun, qty_order, tgl_order,
            total_transaksi, payment, no_wa, stats, bukti_tf, laporan_ss, statsdone)
            VALUES ('', NULL,NULL, '$id_akun', '$qty_order', '$tgl_order', '$total_transaksi', '$payment', '$no_wa', 'Belum Lunas', NULL, NULL, 'Undertake')";
        mysqli_query($koneksi, $sqltran);

        return mysqli_affected_rows($koneksi);
    } else {
        // Handle ketika data_akun tidak ditemukan
        die("Data_akun not found for email_nohp: $email_nohp");
    }
}

?>