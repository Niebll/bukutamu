<?php
include "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $sql = "INSERT INTO buku_tamu (name, email, message) VALUES ('$name', '$email', '$message')";
    mysqli_query($db, $sql);
}

// Tampilkan daftar tamu
include "tampil.php";

mysqli_close($db);
?>