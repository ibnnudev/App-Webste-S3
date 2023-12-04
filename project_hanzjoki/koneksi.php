<?php

$SERVER   = "localhost";
$username = "tifcmyho_hanzjoki";
$password = "@JTIpolije2023";           // Change this to your database password
$db       = "tifcmyho_hanzjoki";   // Change this to your database name

$err      = "";
$ingataku = "";

// Creating a connection to the database using MySQLi
$koneksi = new mysqli($SERVER, $username, $password, $db);

// Checking the connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
