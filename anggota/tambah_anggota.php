<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Perpustakaan</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-danger ">
            <div class="container-fluid d-flex justify-content-center">
                <p class="fw-normal fs-4 fw-light text-white">Data Buku Perpustakaan</p>
            </div>
        </nav>
    </header>
    <div class="d-flex align-items-center light-blue-gradient" style="height: 100vh;">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card rounded-0 shadow">
                        <div class="card-header bg-primary p-n1">
                            <h3 class="d-flex justify-content-center text-white">Tambah Anggota Perpustakaan</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" class="d-grid gap-3" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <div class="form-group">
                                    <label for="namaAnggota">Nama anggota </label>
                                    <input type="text" class="form-control" placeholder="Judul Anggota" name="namaAnggota" id=namaAnggota required>
                                </div>
                                <div class="form-group">
                                    <label for="jurusanAnggota">Jurusan anggota </label>
                                    <input type="text" class="form-control" placeholder="Jurusan Anggota" name="jurusanAnggota" id=jurusanAnggota required>
                                </div>
                                <div class="form-group">
                                    <label for="angkatanAnggota">Angkatan anggota </label>
                                    <input type="number" class="form-control" placeholder="Angkatan Anggota" name="angkatanAnggota" id="angkatanAnggota" required>
                                </div>
                                <div class="form-group">
                                    <label for="nimAnggota">Nim anggota </label>
                                    <input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Nim Anggota" name="nimAnggota" id="nimAnggota" required>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success col-md-3" name="submit">Submit</button>
                                        <button type="submit" class="btn btn-danger col-md-3"><a href="./index.php" style="text-decoration: none !important; color: white;">Keluar</a></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    require_once("../config.php");
    if (isset($_POST['submit'])) {


        $namaAnggota = htmlspecialchars($_POST['namaAnggota']);
        $jurusanAnggota =   htmlspecialchars($_POST['jurusanAnggota']);
        $angkatanAnggota = htmlspecialchars($_POST['angkatanAnggota']);
        $nimAnggota = htmlspecialchars($_POST['nimAnggota']);


        $sql = "INSERT INTO anggota_perpus (nama_anggota,jurusan_anggota,angkatan_anggota, nim_anggota) VALUES ('". $namaAnggota . "','" . $jurusanAnggota . "','" . $angkatanAnggota . "','" . $nimAnggota . "')";
  
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            echo "<script>
                alert('Data Anggota Behasil Ditambahkan');
                location.href ='anggota.php';
            </script>";
        }
    }
    ?>
</body>

<script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>

</html> 