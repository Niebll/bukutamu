<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "buku_tamu2";

$db = mysqli_connect($hostname, $username, $password, $dbName);

if ($db->connect_error) {
    echo "koneksi database rusak";
    die("error");
}

?>