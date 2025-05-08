<?php
session_start(); 
include "dbconfig.php";
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);


    if (!empty($name) && !empty($email) && !empty($message)) {
        $data = "$name|$email|$message\n";

        $file = fopen("buku_tamu2.txt", "a");
        if ($file) {
            fwrite($file, $data);
            fclose($file);
        }

        header("Location: buku_tamu2.php");
        exit;
    } else {

        echo "<script>alert('Semua kolom harus diisi!'); window.location='buku_tamu.php';</script>";
        exit;
    }
}
