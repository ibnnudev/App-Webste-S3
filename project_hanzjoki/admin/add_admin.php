<?php
require('../koneksi.php'); // Gantilah dengan nama file koneksi yang sesuai
$message = "";  // Variabel untuk menyimpan pesan kesalahan atau berhasil

if (isset($_POST['register'])) {
    // Ambil nilai dari form
    $username = $_POST['username'];
    $emailOrUsername = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk menyisipkan data admin ke dalam tabel data_admin
    $sql = "INSERT INTO data_admin (email, username, pw, sebagai) VALUES (?, ?, ?, 'admin')";
    
    $stmt = $koneksi->prepare($sql);
    // Bind parameter dengan tipe data yang sesuai
    $stmt->bind_param("sss", $emailOrUsername, $username, $password);

    if ($stmt->execute()) {
        $message = "Admin berhasil didaftarkan. Silakan login <a href=' login_admin.php'>di sini</a>.";
    } else {
        $message = "Error: " . $stmt->error;
        header('Location: login_admin.php');
    }

    $stmt->close();
    $koneksi->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap">
    <style>
        /* CSS untuk popup */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .popup {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
    
</head>
<body>
<div class="container-65">
        <div class="box-login-admin">
            <div class="box-foto">
                <img src="../image/profile.png" alt="" class="foto-login">
                <span class="title-wave">Welcome</span>
            </div>
            <h1 class="aduh">Sign In</h1>
            <?php if ($message): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <form action="add_admin.php" method="post">
                <label for="email">Email/Username:</label>
                <input type="email" id="email" name="email" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" name="register"></input>
            </form>
        </div>
    </div>

     <!-- Overlay untuk popup berhasil -->
     <div id="successOverlay" class="overlay">
        <div class="popup">
            <p><?php echo $message; ?></p>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>

    <!-- Overlay untuk popup error -->
    <div id="errorOverlay" class="overlay">
        <div class="popup">
            <p><?php echo $message; ?></p>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
    <script>
        // JavaScript untuk menampilkan popup
        function showPopup() {
            document.getElementById('successOverlay').style.display = 'flex';
        }

        function showErrorPopup() {
            document.getElementById('errorOverlay').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('successOverlay').style.display = 'none';
            document.getElementById('errorOverlay').style.display = 'none';
        }
    </script>
</body>
</html>
