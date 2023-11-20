<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hanzjoki";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari database
$sql = "SELECT paket_joki_rank.id_paket, paket_joki_rank.judul_paket, paket_joki_rank.nama_paket, paket_joki_rank.harga, (paket_joki_rank.harga - discount.potongan) AS hasil 
FROM paket_joki_rank
LEFT JOIN discount ON paket_joki_rank.id_paket = paket_joki_rank.id_paket
WHERE paket_joki_rank.judul_paket = 'Promo'";


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data dari Database</title>
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>

<div class="container">
    <?php
    // Loop untuk menampilkan data dari database
    $counter = 0; // Menggunakan counter untuk melacak indeks data
    while ($row = $result->fetch_assoc()) {
        $background_class = ($counter % 2 == 0) ? 'even-background' : 'odd-background';
    ?>
        <div class="col-md-4 <?= $background_class; ?>">
            <input type="radio" class="btn-check" name="nominal" id="option<?= $row['id_paket']; ?>" autocomplete="off">
            <label class="btn btn-outline-light col-12" for="option<?= $row['id_paket']; ?>">
                <div class="row">
                    <div class="col-7 column-font"><?= $row['nama_paket']; ?></div>
                    <!-- Menampilkan harga_setelah_discount -->
                    <div class="col-12"><span class="text-warning">Rp. <?= number_format($row['hasil'], 0, ',', '.'); ?></span></div>
                    <div class="col-12"><span class="text-warning">Rp. <s><?= number_format($row['harga'], 0, ',', '.'); ?></s></span></div>

                </div>
            </label>
        </div>
    <?php
        $counter++;
    }

    // Tutup koneksi database
    $conn->close();
    ?>

</div>

</body>
</html>
