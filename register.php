<?php
include "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

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
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $fileHandle = fopen($file, "a");
    if ($fileHandle) {
        fwrite($fileHandle, "$username|$password\n");
        fclose($fileHandle);
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left {
            padding: 30px;
            text-align: center;
            width: 350px;
        }

        .left h2 {
            margin-bottom: 10px;
        }

        .left input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .left button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .left button:hover {
            background: #ff5733;
        }

        .left a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .right img {
            width: 350px;
            height: auto;
            margin-top: 20px;
        }

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-container input {
            width: 100%;
            padding-right: 40px;
            /* Beri ruang untuk ikon mata */
        }

        .toggle-password {
            position: absolute;
            right: 20px;
            cursor: pointer;
            font-size: 18px;
            height: 15px;
        }


        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
                width: 90%;
            }

            .left,
            .right {
                width: 100%;
                padding: 20px;
            }

            .right img {
                max-width: 250px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h2>Registrasi Account</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Enter your username" required>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <span class="toggle-password" onclick="togglePassword()">
                        <img id="eyeIcon" src="hide.png" alt="Show Password" width="20">
                    </span>
                </div>
                <button type="submit">Register Account</button>
            </form>
            <p>Already have an account? <a href="index.php">Login</a></p>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.src = "view.png";
                eyeIcon.alt = "Hide Password";
            } else {
                passwordField.type = "password";
                eyeIcon.src = "hide.png";
                eyeIcon.alt = "Show Password";
            }
        }
    </script>

</body>

</html>