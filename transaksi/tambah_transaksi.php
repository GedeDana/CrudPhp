<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "../Controller/buku.php";
require_once "../Controller/anggota.php";
require_once "../Controller/transaksi.php";
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

<!DOCTYPE html>
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

</html>