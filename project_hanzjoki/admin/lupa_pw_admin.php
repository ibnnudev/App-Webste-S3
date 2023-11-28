`<?php
require_once('../koneksi.php');

$pertanyaan = $jawaban = $password_baru = '';
$pertanyaanDropdown = array();

if (isset($_POST['submit'])) {
    $emailOrUsername = $_POST['emailOrUsername'];

    $query = "SELECT pertanyaan, jawaban FROM data_akun WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $emailOrUsername);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $pertanyaan, $jawaban);
    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);

    if ($pertanyaan) {
        $queryPertanyaan = "SELECT pertanyaan FROM data_pertanyaan ORDER BY RAND() LIMIT 3";
        $resultPertanyaan = mysqli_query($koneksi, $queryPertanyaan);

        while ($rowPertanyaan = mysqli_fetch_assoc($resultPertanyaan)) {
            $pertanyaanDropdown[] = $rowPertanyaan['pertanyaan'];
        }
    }
}

if (isset($_POST['jawabanSubmit'])) {
    $jawabanUser = $_POST['jawabanUser'];
    
    if ($jawabanUser == $jawaban) {
        $password_baru = password_hash("password_baru_anda", PASSWORD_DEFAULT);

        $queryUpdatePassword = "UPDATE data_akun SET password = ? WHERE email = ?";
        $stmtUpdatePassword = mysqli_prepare($koneksi, $queryUpdatePassword);
        mysqli_stmt_bind_param($stmtUpdatePassword, "ss", $password_baru, $emailOrUsername);
        mysqli_stmt_execute($stmtUpdatePassword);

        mysqli_stmt_close($stmtUpdatePassword);
    }
}
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap">

</head>
<body>
    <div class="container-65">
        <div class="box-login-admin">
            <div class="box-foto">
                <img src="../image/profile.png" alt="" class="foto-login">
                <span class="title-wave">Selamat Datang</span>
            </div>
            <h1 class="aduh">Lupa password</h1>
            <form action="lupa_pw_admin.php" method="post">
                <label for="emailOrUsername">Email/Username:</label>
                <input type="text" id="emailOrUsername" name="emailOrUsername" required>

                <label for="pertanyaan" class="<?php echo $pertanyaan ? '' : 'hidden'; ?>">Pertanyaan:</label>
                <select id="pertanyaan" name="pertanyaan" class="<?php echo $pertanyaan ? '' : 'hidden'; ?>" required>
                    <?php
                    $pertanyaanDropdown = array(
                        "Siapa nama ayah anda?",
                        "Siapa nama bunda anda?",
                        "Kapan terakhir anda sekolah?"
                    );
                    foreach ($pertanyaanDropdown as $option) {
                        echo "<option value='$option'>$option</option>";
                    }
                    ?>
                </select>

                <label for="jawaban" class="<?php echo $jawaban ? '' : 'hidden'; ?>">Jawaban:</label>
                <input type="text" id="jawaban" name="jawabanUser" class="<?php echo $jawaban ? '' : 'hidden'; ?>" required>
                <button type="submit" name="jawabanSubmit" class="<?php echo $jawaban ? '' : 'hidden'; ?>">Cek Jawaban</button>

                <label for="password" class="<?php echo $password_baru ? '' : 'hidden'; ?>">Password:</label>
                <input type="password" id="password" name="password" class="<?php echo $password_baru ? '' : 'hidden'; ?>" value="<?php echo $password_baru; ?>" disabled>

                <button type="submit" name="submit">Ganti Password</button>
                

                <div class="lp-pw">
                    <a href="login_admin.php">Login Kembali</a>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>
`