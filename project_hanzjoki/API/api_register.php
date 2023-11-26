<?php

include ('C:\xampp\htdocs\website\App-Webste-S3\project_hanzjoki\koneksi.php');

$userMail = $_POST['email'];
$usernama_depan = $_POST['nama_depan'];
$usernama_belakang = $_POST['nama_belakang'];
$username = $_POST['username'];
$userPass = $_POST['pw'];

$sql = "INSERT INTO data_customer ( email, nama_depan, nama_belakang, username, pw)
VALUES ('$userMail', '$usernama_depan', '$usernama_belakang', '$username', '$userPass');";

$query = mysqli_query($koneksi, $sql);
if($query){
    echo json_encode(array(
        'status' => 'data_tersimpan'
    ));
}else {
    echo "gagal";
}               