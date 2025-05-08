<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.html");
    exit;
}

include "dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO buku_tamu (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($db, $sql)) {
        echo "";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($db);
    }

    mysqli_close($db);
    
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap');

        body {
            font-family: Arial, sans-serif;
            background-color: #ffe5b4;
            text-align: center;
        }

        .header {
            font-family: 'Luckiest Guy', cursive;
            font-size: 3rem;
            color: #ff5733;
            background-color: #ffe5b4;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-top: 60px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #ff5733;
            font-family: 'Luckiest Guy', cursive;
            font-size: 2rem;
        }

        input,
        textarea {
            width: 90%;
            margin: 5px 0;
            margin-left: auto;
            margin-left: auto;
            padding: 10px;
            border: 2px solid #ff5733;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus,
        textarea:focus {
            border-color: #ff5733;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #ff5733;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        button:hover {
            background: #ff5733;
        }

        .error-message {
            color: #d32f2f;
            font-size: 14px;
        }

        .container-bukutamu {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;

        }

        .daftar-tamu-title {
            color: #ff5733;
            font-family: 'Luckiest Guy', cursive;
            font-size: 1.5rem;
            margin-top: 20px;
        }

        .daftar-tamu-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .daftar-tamu-table th {
            background: #ff5733;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .daftar-tamu-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .daftar-tamu-table tr:nth-child(even) {
            background: #ffe5b4;
        }

        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 100;
        }

        .logout a {
            text-decoration: none;
            color: white;
            background: #3a9234;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
            display: inline-block;
        }

        .logout a:hover {
            background: #2e6d27;
            transform: scale(1.05);
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.3);
        }


        @media screen and (max-width: 600px) {
            .header {
                font-size: 2rem;
                padding: 8px;
            }

            .container {
                max-width: 95%;
                padding: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }

            input,
            textarea {
                width: 100%;
                font-size: 14px;
                padding: 8px;
            }

            button {
                font-size: 14px;
                padding: 8px;
            }

            .container-bukutamu {
                max-width: 95%;
                padding: 15px;
            }

            .daftar-tamu-table th,
            .daftar-tamu-table td {
                font-size: 12px;
                padding: 8px;
            }

            .daftar-tamu-title {
                font-size: 1.2rem;
            }

            .logout {
                right: 10px;
                top: 10px;
            }

            .logout a {
                padding: 8px 14px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="header">LIVE PODCAST <font color="#3a9234">Gitu</font>Ya! </div>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h2 style="margin-top: 0px">
            Buku Tamu
        </h2>
        <form id="guestForm" action="" method="POST">
            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Alamat Email" required>
            <textarea name="message" placeholder="Pesan Anda" required></textarea>
            <button type="submit">Kirim</button>
        </form>

    </div>
    <div class="container-bukutamu">
    <h3 class="daftar-tamu-title">Daftar Tamu</h3>
    <div id="guestList">
        <?php include "tampil.php"; ?>
    </div>
</div>

<script>
    document.getElementById("guestForm").addEventListener("submit", function(e) {
        e.preventDefault(); // Mencegah submit form secara default

        const formData = new FormData(this);

        fetch("submit.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Update daftar tamu
            document.getElementById("guestList").innerHTML = data;
            // Clear form setelah submit
            this.reset();
        })
        .catch(error => console.error("Error:", error));
    });
</script>

</body>

</html>