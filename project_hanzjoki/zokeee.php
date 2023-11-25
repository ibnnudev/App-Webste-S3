<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Input Data</title>
</head>
<body>

    <h2>Formulir Input Data</h2>

    
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" required><br>

        <div class="col-md-3">
                              <input type="radio" id="ovo" name="metode_pembayaran" onclick="tampilkanTulisan()">
    <label class="col-12 btn btn-outline-light" for="ovo">
        <div class="row">
            <div class="col"><img src="../image/ovo.png" width="100px" height="70px" alt=""></div>
        </div>
    </label>
</div>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; // Ganti dengan nama server database Anda
    $username = "root"; // Ganti dengan username database Anda
    $password = ""; // Ganti dengan password database Anda
    $dbname = "testbro"; // Ganti dengan nama database Anda

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    

    // Mengambil data dari formulir
    $nama = $_POST['nama'];
    $genre =$_POST['genre'];
    $jumlah = $_POST['jumlah'];

    // Menyimpan data ke dalam tabel dengan prepared statement
    $sql = $conn->prepare("INSERT INTO anjai (id_bro, nama, genre, jumlah) 
    VALUES ('123', ?, ?, ?)");
    $sql->bind_param("sss", $nama, $genre, $jumlah);

    if ($sql->execute()) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $sql->error;
    }
    

    // Menutup koneksi
    $sql->close();
    $conn->close();
}
?>

