<?php
$conn = mysqli_connect("localhost","root","","silsilah");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// else{
//     echo"berhasil connect";
// }

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result))
    {
        $data[] = $row;
    }

    return $data;
}






?>