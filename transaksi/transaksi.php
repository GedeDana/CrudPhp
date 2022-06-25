<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once '../Controller/transaksi.php';

$transaksi = new transaksi();
$transaksiData = $transaksi->show_data();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="../asset/css/buku.css">
    <script src="https://use.fontawesome.com/7d6592d6d3.js"></script>
    <link href="../asset/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-danger ">
            <div class="container-fluid d-flex justify-content-center">
                <p class="fw-normal fs-4 fw-light text-white">Data Transaksi Peminjaman Buku</p>
            </div>
        </nav>
    </header>

    <div class="container ">
        <div class="flex-column justify-content-center mt-5 gap-3">
            <button type="button" class="btn btn-success mb-3">
                <i class="fa fa-plus" aria-hidden="true"><span class="ps-2 pe-2"><a href="./tambah_transaksi.php" style="text-decoration: none !important; color: white;">Tambah Transaksi Peminjaman</a></span></i>
            </button>
            <div class="tbl-container " style="overflow-x:auto;">
                <table class="table table-striped rounded tbl-tag">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nama Anggota</th>
                            <th>Nim Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Terlambat</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
;           
                        $numberLoop = 1;
                        foreach ($transaksiData as $transaksiValue) {

                            $denda = $transaksi->late_fine($transaksiValue['tanggal_kembali']);

                           [$hari, $denda ] = $denda;
                            echo "<tr>";
                            echo "<th scope='row'>" . $numberLoop++ . "</th>";
                            echo "<td>" . $transaksiValue['nama_anggota'] . "</td>";
                            echo "<td>" . $transaksiValue['nim_anggota'] . "</td>";
                            echo "<td>" . $transaksiValue['judul_buku'] . "</td>";
                            echo "<td>" . $transaksiValue['tanggal_pinjam'] . "</td>";
                            echo "<td>" . $transaksiValue['tanggal_kembali'] . "</td>";
                            echo "<td>" . $transaksiValue['status'] . "</td>";
                            echo "<td>" . "Rp ".$denda . "</td>";
                            echo "<td>" . str_replace('+', '', $hari). " Hari". "</td>";
                            
                     
                            echo "<td>";

                            echo " <div class='d-flex gap-3'>
                                    <a href='kembali_transaksi.php?aksi=kembali&id_transaksi=$transaksiValue[id_transaksi]&kode_buku=$transaksiValue[kode_buku]' onClick=\"return confirm('Apakah anda ingin megembalikan buku ?');\">
                                        <button type='button' class='btn btn-danger'>
                                               Dikembalikan
                                        </button>
                                    </a>
                                    <a href=perpanjang_transaksi.php?aksi=perpanjang&lambat=$hari&id_transaksi=$transaksiValue[id_transaksi]&tgl_kembali=$transaksiValue[tanggal_kembali]'>
                                        <button type='button' class='btn btn-warning'>
                                            Pepanjang
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


    <script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    
</body>

</html>