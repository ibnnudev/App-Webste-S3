<?php

include ('D:\xampp\htdocs\PHP\App-Webste-S3\project_hanzjoki\koneksi.php');

$userMail = $_POST['email'];
$userPass = $_POST['pw'];

$sql = "SELECT * FROM data_customer 
            WHERE email = '$userMail' AND  pw = '$userPass'";

$query = mysqli_query($koneksi, $sql);
if($query){
    echo json_encode(array(
        'status' => 'ok'
    ));
}else {
    echo "gagal";
}
