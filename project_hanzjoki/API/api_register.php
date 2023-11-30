<?php

include ('C:\xampp\htdocs\website\App-Webste-S3\project_hanzjoki\koneksi.php');

$userMail = $_POST['email'];
$usernama_depan = $_POST['nama_depan'];
$usernama_belakang = $_POST['nama_belakang'];
$username = $_POST['username'];
$userPass = $_POST['pw'];
$pertanyaan = $_POST['pertanyaan'];
$jawaban = $_POST['jawaban'];

$sql = "INSERT INTO data_customer ( email, nama_depan, nama_belakang, username, pw, pertanyaan, jawaban)
VALUES ('$userMail', '$usernama_depan', '$usernama_belakang', '$username', '$userPass', '$pertanyaan', '$jawaban');";

$query = mysqli_query($koneksi, $sql);
if($query){
    echo json_encode(array(
        'status' => 'data_tersimpan'
    ));
}else {
    echo "gagal";
}               