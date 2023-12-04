<?php

$SERVER   = "localhost";
$username = "root";
$password = "";           // Change this to your database password
$db       = "hanzjoki";   // Change this to your database name

$err      = "";
$ingataku = "";

// Creating a connection to the database using MySQLi
$koneksi = new mysqli($SERVER, $username, $password, $db);

// Checking the connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
