<?php
$conn = mysqli_connect("localhost", "root", "", "silsilah");

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
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}

function getNamaKeluargaById($id)
{
  global $conn;
  $getKeluarga = query("SELECT * FROM keluarga WHERE id = $id");

  return $getKeluarga[0]['nama_keluarga'];
}

function isHubungan($id_keluarga1, $id_keluarga2, $nama_hubungan)
{
  global $conn;
  $getNamaHubungan = query("SELECT * FROM hubungan WHERE id_keluarga1 = $id_keluarga1 AND id_keluarga2 = $id_keluarga2 AND nama_hubungan = '$nama_hubungan' ");

  // var_dump($getNamaHubungan[0]['nama_hubungan']);
  // die;

  if (empty($getNamaHubungan[0]['nama_hubungan'])) {
    return false;
  } else {
    return true;
  }
}

function getAnakById($id)
{
  $getAnak = query("SELECT id_keluarga2 FROM hubungan WHERE id_keluarga1 = $id AND nama_hubungan = 'orang tua'");

  $data = [];
  foreach ($getAnak as $d) {
    // var_dump($d);
    $data[] = getNamaKeluargaById($d['id_keluarga2']);
  }

  return $data;
  // return $getAnak[0];
}

// var_dump(getNamaKeluargaById(3));
// var_dump(isHubungan(5, 8, 'orang tua'));
// die;

// var_dump(getAnakById(4));
// die;
// var_dump(getAnakById(3));
// die;

?>

<!-- <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet"> -->