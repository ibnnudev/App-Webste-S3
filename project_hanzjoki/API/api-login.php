<?php

// Include koneksi.php
include_once('../koneksi.php');

$response = array();

if (isset($_POST['email']) && isset($_POST['pw'])) {
    $userMail = $_POST['email'];
    $userPass = $_POST['pw'];

    // Use prepared statements to prevent SQL injection
    $cek = "SELECT * FROM data_customer WHERE email = ? AND pw = ?";
    $stmt = mysqli_prepare($koneksi, $cek);

    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, 'ss', $userMail, $userPass);
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Fetch and store data in an associative array
            $userData = mysqli_fetch_assoc($result);

            // Add user data to the response array
            $response['status_code'] = 200;
            $response['message'] = 'Success';
            $response['data'] = $userData;
        } else {
            $response['status_code'] = 200;
            $response['message'] = 'Email / Password Salah!';
        }
    } else {
        $response['status_code'] = 500;
        $response['message'] = 'Terjadi kesalahan dalam query.';
    }
} else {
    $response['status_code'] = 400;
    $response['message'] = 'Email / Password Kosong!';
}

// Output the JSON response
echo json_encode($response);
