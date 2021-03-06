<?php


require "config.php";

$keluarga = query("SELECT * FROM keluarga ORDER BY nama_keluarga ASC");

if (isset($_POST['submit'])) {
    $namaKeluarga = htmlspecialchars($_POST['namaKeluarga']);
    $namaPasangan = htmlspecialchars($_POST['namaPasangan']);
    $domisili = htmlspecialchars($_POST['domisili']);

    // masukkan ke tabel keluarga
    $insertKeluarga = mysqli_query($conn, "INSERT INTO keluarga VALUES (NULL, '$namaKeluarga', '$namaPasangan', '$domisili')");


    if (!empty($insertKeluarga)) {
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

// input hubungan

if (($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['nama_hubungan'])) {

    // var_dump($_POST);
    // die;

    $id_keluarga1 = (int) htmlspecialchars($_POST['id_keluarga1']);
    $id_keluarga2 = (int) htmlspecialchars($_POST['id_keluarga2']);
    $nama_hubungan = htmlspecialchars($_POST['nama_hubungan']);
    $nama_hubungan_balik = 'anak';

    // var_dump($nama_hubungan);
    if ($nama_hubungan == 'anak') {
        $nama_hubungan_balik = 'orang tua';
    }

    if (!isHubungan($id_keluarga1, $id_keluarga2, $nama_hubungan)) {
        $insertHubungan = mysqli_query($conn, "INSERT INTO hubungan VALUES (NULL, $id_keluarga1, $id_keluarga2, '$nama_hubungan')");

        $insertHubunganBalik = mysqli_query($conn, "INSERT INTO hubungan VALUES (NULL, $id_keluarga2, $id_keluarga1, '$nama_hubungan_balik')");

        if ($insertHubungan) {
            if ($insertHubunganBalik) {
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
        } else {
            echo "


        <script>
        alert ('Tidak Valid!');
        // document.location.href='input-keluarga.php';
        </script>
        ";

            // echo "error" . mysqli_error($conn);
        }
    } else {
        echo "


        <script>
        alert ('Hubungan telah tersedia!');
        // document.location.href='input-keluarga.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Livedoc | Landing, Responsive &amp; Business Templatee</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <link href="assets/css/theme.css" rel="stylesheet" />

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <!-- Navbar -->

        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="#"><img src="assets/img/gallery/logo.png" width="118" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon">
                    </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">

                        <li class="nav-item px-2"><a class="nav-link" href="/silsilah/public">Home</a></li>
                    </ul><a class="btn btn-sm btn-outline-primary rounded-pill order-1 order-lg-0 ms-lg-4" href="/silsilah/public/login.php">Login</a>
                </div>
            </div>
        </nav>

        <!-- end Navbar -->
        <!-- ============================================-->
        <!-- <section> begin ============================-->

        <!-- <section> close ============================-->
        <!-- ============================================-->


        <section class="py-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 z-index-2 mb-3">
                        <h1 class="fw-light font-base fs-6 fs-xxl-7">Seluruh <strong>Anggota Keluarga </strong></h1>

                        <ol class="list-group list-group-numbered" style="overflow-y: scroll; height:200px;">
                            <?php foreach ($keluarga as $d) : ?>
                                <li class="list-group-item"><?= $d['nama_keluarga'] ?><br><a href="hapus-keluarga.php?idKeluarga=<?= $d['id'] ?>" onclick="return confirm('apakah anda yakin?')"><span class="badge rounded-pill bg-danger float-end"> <i class="fa-solid fa-trash-can"></i> </span> </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#detail<?= $d['id'] ?>" onclick="function tombol (e) { e.preventDefault()}">
                                        <span class="badge rounded-pill bg-primary float-end"> <i class="fa-solid fa-info"></i> </span>
                                    </a>

                                </li>


                            <?php endforeach; ?>

                        </ol>



                    </div>
                    <div class="col-lg-6 z-index-2 mb-3">

                        <div>
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <a href="#inputKeluarga" class="nav-link active" data-bs-toggle="tab">Input Keluarga</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#inputHubungan" class="nav-link" data-bs-toggle="tab">Input Hubungan</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="inputKeluarga">
                                    <h1 class="fw-light font-base fs-6 fs-xxl-7">Input <strong>Nama Keluarga</strong></h1>
                                    <form class="row g-3" action="" method="POST">

                                        <div class="col-md-12">
                                            <label class="form-label visually-hidden" for="namaKeluarga">Nama Keluarga</label>
                                            <input class="form-control form-livedoc-control" id="namaKeluarga" name="namaKeluarga" type="text" placeholder="Nama Keluarga (Keturunan Mbah Yutir)" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label visually-hidden" for="namaPasangan">Nama Pasangan</label>
                                            <input class="form-control form-livedoc-control" id="namaPasangan" name="namaPasangan" type="text" placeholder="Nama Pasangan (optional)" />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label visually-hidden" for="domisili">Domisili</label>
                                            <!-- <textarea class="form-control form-livedoc-control" id="domisili" name="domisili" type="text" placeholder="Domisili"  required > </textarea> -->
                                            <textarea class="form-control form-livedoc-control" id="domisili" name="domisili" placeholder="Domisili"></textarea>
                                        </div>


                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary rounded-pill" name="submit" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <!-- input hubungan -->
                                <div class="tab-pane fade" id="inputHubungan">
                                    <h1 class="fw-light font-base fs-6 fs-xxl-7">Input <strong>Hubungan</strong></h1>
                                    <form id="formHubungan" class="row g-3" action="" method="POST">

                                        <div class="col-md-12">
                                            <select class="form-select" id="nama_keluarga1" name="id_keluarga1">
                                                <option selected disabled required>Pilih Anggota Keluarga</option>
                                                <?php foreach ($keluarga as $d) : ?>
                                                    <option value="<?= $d['id'] ?>"><?= $d['nama_keluarga'] ?></option>
                                                <?php endforeach; ?>

                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-select" id="nama_keluarga2" name="id_keluarga2">
                                                <option selected disabled required>Pilih Anggota Keluarga</option>
                                                <?php foreach ($keluarga as $d) : ?>
                                                    <option value="<?= $d['id'] ?>"><?= $d['nama_keluarga'] ?></option>
                                                <?php endforeach; ?>

                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-select" id="nama_hubungan" name="nama_hubungan">
                                                <option selected disabled required>Pilih Nama Hubungan</option>
                                                <option value="anak">Anak</option>
                                                <option value="orang tua">Orang Tua</option>
                                            </select>

                                        </div>



                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input class="btn btn-primary rounded-pill" name="submitHubungan" id="submitHubungan" value="Submit" type="button">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>



        <!-- Button trigger modal -->



        <!-- ============================================-->
        <!-- <section> begin ============================-->

        <section class="py-0 bg-secondary">



            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="py-0 bg-primary">

                <div class="container">
                    <div class="row justify-content-md-between justify-content-evenly py-4">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                            <p class="fs--1 my-2 fw-bold text-200">All rights Reserved &copy; Your Company, 2021</p>
                        </div>
                        <div class="col-12 col-sm-8 col-md-6">
                            <p class="fs--1 my-2 text-center text-md-end text-200"> Made with&nbsp;
                                <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#F95C19" viewBox="0 0 16 16">
                                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z">
                                    </path>
                                </svg>&nbsp;by&nbsp;<a class="fw-bold text-info" href="https://themewagon.com/" target="_blank">ThemeWagon </a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->


        </section>
    </main>

    <!-- Modal -->
    <?php foreach ($keluarga as $d) : ?>
        <div class="modal fade " id="detail<?= $d['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Anggota Keluarga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Nama : <?= $d['nama_keluarga'] ?><br>
                        Pasangan : <?= $d['pasangan'] ?><br>
                        Domisili : <?= $d['domisili'] ?><br>

                        <?php if (!empty(getAnakById((int) $d['id']))) {
                            echo "Anak : <br>";
                            foreach (getAnakById((int) $d['id']) as $anak) {
                                echo " <ol> ";
                        ?>
                                <li> <?= $anak ?> </li>
                        <?php
                                echo " </ol> ";
                            }
                        }
                        ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap" rel="stylesheet">

    <script>
        function getOptionText(elementSelect) {

            return elementSelect.options[elementSelect.selectedIndex].text;


        }
        let nama_keluarga1 = document.getElementById('nama_keluarga1');
        let nama_keluarga2 = document.getElementById('nama_keluarga2');
        let nama_hubungan = document.getElementById('nama_hubungan');
        let form_hubungan = document.getElementById('formHubungan');

        document.getElementById('submitHubungan').addEventListener('click', function confirmHubungan(e) {
            // alert('testing')
            // e.preventDefault()
            // console.log(getOptionText(nama_keluarga1));

            if (confirm(`Apakah anda yakin ` + getOptionText(nama_keluarga1) + ` adalah ${nama_hubungan.value} dari ` + getOptionText(nama_keluarga2) + `?`)) {
                form_hubungan.submit();
            }
        })
    </script>
</body>

</html>