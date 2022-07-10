<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once '../Controller/anggota.php';

session_start();

if( !isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

$anggota = new anggota();

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
    <script src="../asset/js/chart-js-config.js"></script>
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
                <a href="../index.php" class="dash-nav-item">
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
                        <a href="./anggota.php" class="dash-nav-dropdown-item">Daftar Anggota</a>
                        <a href="./tambah_anggota.php" class="dash-nav-dropdown-item">Tambah Anggota</a>


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
                <form class="searchbox" action="#!">
                    <a href="./buku.php" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
                    <button type="submit" class="searchbox-submit" id="tombol-cari"> <i class="fas fa-search"></i> </button>
                    <input type="text" class="searchbox-input" placeholder="type to search" id="keyword-anggota">
                </form>
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
                    <h1 class="dash-title d-flex justify-content-center">Daftar Anggota</h1>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-10">
                            <div class="card easion-card">
                                <div class="card-header">
                                    <div class="easion-card-icon">
                                        <i class="fas fa-table"></i>
                                    </div>
                                    <div class="easion-card-title">Daftar Anggota</div>
                                </div>
                                <div class="card-body " id="table-content-anggota">
                                    <table class="table table-in-card">
                                        <thead>
                                            <tr>
                                                <th scope="2">Id</th>
                                                <th scope="2">Nama Anggota</th>
                                                <th scope="2">Jurusan</th>
                                                <th scope="2">Angkatan</th>
                                                <th scope="2">Nim</th>
                                                <th scope="2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $data = $anggota->show_data();

                                            $numberLoop = 1;
                                            foreach ($data as $row) {

                                                echo "<tr>";
                                                echo "<th scope='row'>" .  $numberLoop++ . "</th>";
                                                echo "<td>" . $row['nama_anggota'] . "</td>";
                                                echo "<td>" . $row['jurusan_anggota'] . "</td>";
                                                echo "<td>" . $row['angkatan_anggota'] . "</td>";
                                                echo "<td>" . $row['nim_anggota'] . "</td>";
                                                echo "<td>";

                                                echo " <div class='d-flex gap-3'>
                                                                        <a href='delete_anggota.php?hapus=$row[id_anggota]' onClick=\"return confirm('Apakah anda ingin menghapus data ?');\">
                                                                            <button type='button' class='btn btn-danger'>
                                                                                    <i class='fa fa-trash-o' aria-hidden='true'></i>
                                                                            </button>
                                                                        </a>
                                                                        <a href='update_anggota.php?id=$row[id_anggota]'>
                                                                            <button type='button' class='btn btn-warning'>
                                                                                <i class='fa fa-pencil' aria-hidden='true'></i>
                                                                            </button>
                                                                        </a>
                                                                    </div>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
    <script src="../asset/js/ajaxAnggota.js"></script>

</body>

</html>

