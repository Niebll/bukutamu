<?php
session_start();

include "dbconfig.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO server (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($db, $sql)) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($db);
    }
    
    mysqli_close($db);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = "buku_tamu2";
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    
    if (file_exists($file)) {
        $fileHandle = fopen($file, "r");
        while (($line = fgets($fileHandle)) !== false) {
            list($storedUser, $storedPass) = explode("|", trim($line));
            
            if ($username === $storedUser && password_verify($password, $storedPass)) {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $username;
                fclose($fileHandle);
                header("Location: buku_tamu.php");
                exit;
            }
        }
        fclose($fileHandle);
    }

    echo "<script>alert('Login gagal! Username atau password salah.'); window.location='index.php';</script>";
}
?>
