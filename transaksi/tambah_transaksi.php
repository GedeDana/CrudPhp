<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "../Controller/buku.php";
require_once "../Controller/anggota.php";
require_once "../Controller/transaksi.php";


session_start();

if( !isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
$buku = new buku();
$anggota = new anggota();
$transaksi = new transaksi();

$showAnggota = $anggota->show_data();
$showBook = $buku->show_data_by_id(null);

$tgl_pinjam = date('d-m-Y');
$empatbelas_hari = mktime(0, 0, 0, date('n'), date('j') + 14, date('Y'));

if (isset($_POST['submit'])) {

    $namaAnggota = htmlspecialchars($_POST['id_anggota']);
    $bukuDipinjam =   htmlspecialchars($_POST['kode_buku']);
    $tglPinjam = htmlspecialchars($_POST['tglPinjam']);
    $tglKembali = htmlspecialchars($_POST['tglKembali']);

    $result = $transaksi->add_transaction($bukuDipinjam, $namaAnggota, $tglPinjam, $tglKembali);

    if ($result > 30) {
        echo "<script>
                alert('Peminjaman Lebih dari 30 Hari');
                location.href ='transaksi.php';
                
            </script>";
    } else {
        echo "<script>
            alert('Data Transaksi Peminjaman Behasil Ditambahkan');
            location.href ='transaksi.php';
        </script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../asset/css/easion.css">
    <script src="https://use.fontawesome.com/7d6592d6d3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="../js/chart-js-config.js"></script>
    <title>Our Book</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="../index.php" class="easion-logo"><i class="fas fa-book"></i><span>OurPerpus</span></a>
            </header>
            <nav class="dash-nav-list">
                <a href="./index.php" class="dash-nav-item">
                    <i class="fas fa-home"></i> Dashboard </a>
                <div class="dash-nav-dropdown">
                    <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-book"></i> Buku </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="../buku/buku.php" class="dash-nav-dropdown-item">Daftar Buku</a>
                        <a href="../buku/tambah_buku.php" class="dash-nav-dropdown-item">Tambah Buku</a>
                        <a href="../buku/tambah_kategori_buku.php" class="dash-nav-dropdown-item p">Tambah Kategori Buku</a>

                    </div>
                </div>
                <div class="dash-nav-dropdown">
                    <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-user"></i> Anggota </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="../anggota/anggota.php" class="dash-nav-dropdown-item">Daftar Anggota</a>
                        <a href="../anggota/tambah_anggota.php" class="dash-nav-dropdown-item">Tambah Anggota</a>


                    </div>
                </div>
                <div class="dash-nav-dropdown">
                    <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-receipt"></i> Transaksi </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="../transaksi/transaksi.php" class="dash-nav-dropdown-item">Daftar Transaksi</a>
                        <a href="../transaksi/tambah_transaksi.php" class="dash-nav-dropdown-item">Tambah Transaksi</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>

                <div class="d-flex align-items-center tools">

                <p class="mt-2">Selama Datang <?php echo $_SESSION["username"] ?></p>

                    <div class="dropdown tools-item">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </header>
            <main class="dash-content">

                <div class="container-fluid">
                    <h1 class="dash-title d-flex justify-content-center">Tambah Peminjaman Buku</h1>
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-9">
                            <div class="card easion-card">
                                <div class="card-header">
                                    <div class="easion-card-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="easion-card-title"> Tambah Peminjaman Buku </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                        <div class="form-group">
                                            <label for="namaAnggota">Nama anggota </label>
                                            <select name="id_anggota" aria-label="Default select example" class="form-select" required>
                                                <option selected>Pilih Anggota</option>
                                                <?php


                                                foreach ($showAnggota as $showMembers) {
                                                    echo "<option value=$showMembers[id_anggota]> $showMembers[nama_anggota]  </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="namaAnggota">Buku yang dipinjam </label>
                                            <select name="kode_buku" aria-label="Default select example" class="form-select" required>
                                                <option selected>Pilih Buku</option>
                                                <?php

                                                foreach ($showBook as $showBooks) {
                                                    echo "<option value=$showBooks[kode_buku]> $showBooks[kode_buku] -- $showBooks[judul_buku]   </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tglPinjam">Tanggal Pinjam </label>
                                            <input type="text" class="form-control" placeholder="Angkatan Anggota" name="tglPinjam" id="tglPinjam" required value="<?= $tgl_pinjam ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tglKembali">Tanggal Kembali </label>
                                            <input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Nim Anggota" name="tglKembali" id="tglKembali" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../asset/js/easion.js"></script>
</body>

</html>


<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../asset/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Data Transaksi</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-danger ">
            <div class="container-fluid d-flex justify-content-center">
                <p class="fw-normal fs-4 fw-light text-white">Data Transaksi Peminjaman Buku</p>
            </div>
        </nav>
    </header>
    <div class="d-flex align-items-center light-blue-gradient" style="height: 100vh;">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card rounded-0 shadow">
                        <div class="card-header bg-primary p-n1">
                            <h3 class="d-flex justify-content-center text-white">Tambah Transaksi Peminjaman</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" class="d-grid gap-3" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <div class="form-group">
                                    <label for="namaAnggota">Nama anggota </label>
                                    <select name="id_anggota" aria-label="Default select example" class="form-select" required>
                                        <option selected>Pilih Anggota</option>
                                        <?php


                                        foreach ($showAnggota as $showMembers) {
                                            echo "<option value=$showMembers[id_anggota]> $showMembers[nama_anggota]  </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="namaAnggota">Buku yang dipinjam </label>
                                    <select name="kode_buku" aria-label="Default select example" class="form-select" required>
                                        <option selected>Pilih Buku</option>
                                        <?php

                                        foreach ($showBook as $showBooks) {
                                            echo "<option value=$showBooks[kode_buku]> $showBooks[kode_buku] -- $showBooks[judul_buku]   </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tglPinjam">Tanggal Pinjam </label>
                                    <input type="text" class="form-control" placeholder="Angkatan Anggota" name="tglPinjam" id="tglPinjam" required value="<?= $tgl_pinjam ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tglKembali">Tanggal Kembali </label>
                                    <input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Nim Anggota" name="tglKembali" id="tglKembali" required>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success col-md-3" name="submit">Submit</button>
                                        <button type="submit" class="btn btn-danger col-md-3"><a href="./transaksi.php" style="text-decoration: none !important; color: white;">Keluar</a></button>
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


    ?>
</body>

<script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</html> -->