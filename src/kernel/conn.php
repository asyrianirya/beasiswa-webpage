<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "beasiswa_webpage";
$port = 3306;

$conn = mysqli_connect($hostname, $username, $password, $database, $port);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>