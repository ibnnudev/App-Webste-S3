<?php

include ('D:\xampp\htdocs\PHP\App-Webste-S3\project_hanzjoki\koneksi.php');


if($_SERVER['REQUEST_METHOD'] == 'GET' ){
    
    $sql = mysqli_query($koneksi, 'SELECT * FROM paket_joki_rank 
            JOIN discount ON paket_joki_rank.nama_discount
            = discount.nama_discount');

    $result = array();

    while ($row = mysqli_fetch_assoc($sql)) {
        $result[] = $row;
    }

    $response = [
        "code" => 200,
         "status" => "oke",
         "data" => $result
         
    ];

    echo json_encode($response);
}