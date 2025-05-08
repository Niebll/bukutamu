<?php
include "dbconfig.php";

$sql = "SELECT name, email, message FROM buku_tamu ORDER BY id DESC";
$result = mysqli_query($db, $sql);

echo "<table class='daftar-tamu-table'>";
echo "<thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
        </tr>
      </thead>";
echo "<tbody>";

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='3' style='text-align:center;'>Belum ada tamu</td></tr>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $message = htmlspecialchars($row['message']);

        echo "<tr>
                <td>$name</td>
                <td>$email</td>
                <td>$message</td>
              </tr>";
    }
}

echo "</tbody>";
echo "</table>";

mysqli_close($db);
?>