<!-- <?php

include ('C:\xampp\htdocs\website\App-Webste-S3\project_hanzjoki\koneksi.php');
$response = array();

if (isset($_POST['email']) && isset($_POST['pw'])) {
    $userMail = $_POST['email'];
    $userPass = $_POST['pw'];

    $cek = "SELECT * FROM data_customer WHERE email = '$userMail' AND pw = '$userPass'";
    $mysql = mysqli_query($koneksi, $cek);
    $result = mysqli_num_rows($mysql);

    if ($result > 0) {
        // Fetch and store data in an associative array
        $userData = mysqli_fetch_assoc($mysql);

        // Add user data to the response array
        $response['status_code'] = 200;
        $response['message'] = 'Success';
        $response['data'] = $userData;
    } else {
        $response['status_code'] = 200;
        $response['message'] = 'Email / Password Salah!';
    }
} else {
    $response['status_code'] = 200;
    $response['message'] = 'Email / Password Kosong!';
}

// Output the JSON response
echo json_encode($response);
?> -->