<?php

include '../koneksi.php';

$response = array();

if (isset($_POST['email']) && isset($_POST['pw'])) {
    $userMail = $_POST['email'];
    $userPass = $_POST['pw'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM data_customer WHERE email = ? AND pw = ?";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, 'ss', $userMail, $userPass);
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            // User exists
            $response['status'] = 'ok';
            echo json_encode($response);
        } else {
            // User doesn't exist or incorrect credentials
            echo "gagal";
        }
    } else {
        echo "Terjadi kesalahan dalam query.";
    }
} else {
    echo "Email / Password tidak ada.";
}
