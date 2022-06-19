<?php

require "config.php";


if (isset($_GET['submitHubungan'])) {

    $id_keluarga1 = htmlspecialchars($_GET['id_keluarga1']);
    $id_keluarga2 = htmlspecialchars($_GET['id_keluarga2']);
    $nama_hubungan = htmlspecialchars($_GET['nama_hubungan']);

    $insertHubungan = mysqli_query($conn, "INSERT INTO hubungan VALUES (NULL, $id_keluarga1, $nama_hubungan ) ");

    if ($insertHubungan) {
        echo "
        <script>
        alert ('Berhasil!');
        document.location.href='input-keluarga.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert ('Tidak Valid!');
        // document.location.href='input-keluarga.php';
        </script>
        ";
    }
}
