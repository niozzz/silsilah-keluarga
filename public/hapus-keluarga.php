<?php

require "config.php";


if (isset($_GET['idKeluarga']))
{

    $idKeluarga = htmlspecialchars($_GET['idKeluarga']);
    $deleteKeluarga = mysqli_query($conn, "DELETE FROM keluarga WHERE id = '$idKeluarga' ") ;

    if ($deleteKeluarga)
    {
        echo "
        <script>
        alert ('Berhasil!');
        document.location.href='input-keluarga.php';
        </script>
        ";
    }else
    {
        echo "
        <script>
        alert ('Tidak Valid!');
        // document.location.href='input-keluarga.php';
        </script>
        ";
    }
}