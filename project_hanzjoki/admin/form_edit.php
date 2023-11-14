<?php
require('../koneksi.php');

if (isset($_POST['update'])) {
    $idWorker = $_POST['text_id'];
    $namaLengkap = $_POST['text_nama'];
    $alamat = $_POST['text_alamat'];
    $jenisKelamin = $_POST['text_jenis_kelamin'];
    $noWa = $_POST['text_no_wa'];
    $email = $_POST['text_email'];
    $pangkat = $_POST['text_pangkat'];
    $roleUtama = $_POST['text_role_utama'];
    $sebagai = $_POST['text_sebagai'];

    $query = "UPDATE data_admin_worker SET 
              nama_lengkap = '$namaLengkap', 
              alamat = '$alamat', 
              jenis_kelamin = '$jenisKelamin', 
              no_wa = '$noWa', 
              email = '$email', 
              pangkat = '$pangkat', 
              Role_utama = '$roleUtama', 
              sebagai = '$sebagai' 
              WHERE id_worker='$idWorker'";
    
    $result = mysqli_query($koneksi, $query);
    header('Location: tambah_worker.php');
}

$id = $_GET['id'];
$query = "SELECT * FROM data_admin_worker WHERE id_worker='$id'";
$result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

while ($row = mysqli_fetch_array($result)) {
    $idWorker = $row['id_worker'];
    $namaLengkap = $row['nama_lengkap'];
    $alamat = $row['alamat'];
    $jenisKelamin = $row['jenis_kelamin'];
    $noWa = $row['no_wa'];
    $email = $row['email'];
    $pangkat = $row['pangkat'];
    $roleUtama = $row['Role_utama'];
    $sebagai = $row['sebagai'];
}
?>

<html>
<head>
    <title>Edit Data Admin Worker</title>
</head>
<body>
    <form action="form_edit.php" method="POST">
        <p><input type="hidden" name="text_id" value="<?php echo $idWorker; ?>"></p>
        <p>Nama Lengkap: <input type="text" name="text_nama" value="<?php echo $namaLengkap; ?>"></p>
        <p>Alamat: <input type="text" name="text_alamat" value="<?php echo $alamat; ?>"></p>
        <p>Jenis Kelamin: <input type="text" name="text_jenis_kelamin" value="<?php echo $jenisKelamin; ?>"></p>
        <p>Nomor WA: <input type="text" name="text_no_wa" value="<?php echo $noWa; ?>"></p>
        <p>Email: <input type="text" name="text_email" value="<?php echo $email; ?>"></p>
        <p>Pangkat: <input type="text" name="text_pangkat" value="<?php echo $pangkat; ?>"></p>
        <p>Role Utama: <input type="text" name="text_role_utama" value="<?php echo $roleUtama; ?>"></p>
        <p>Sebagai: <input type="text" name="text_sebagai" value="<?php echo $sebagai; ?>"></p>
        <button type="submit" name="update">Update</button>
    </form>
    <p><a href="home.php">Kembali</a></p>
</body>
</html>
