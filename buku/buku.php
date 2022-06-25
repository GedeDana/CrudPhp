<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once '../Controller/buku.php';

$buku = new buku();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="../asset/css/buku.css">
    <script src="https://use.fontawesome.com/7d6592d6d3.js"></script>
    <link href="../asset/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-danger ">
            <div class="container-fluid d-flex justify-content-center">
                <p class="fw-normal fs-4 fw-light text-white">Data Buku Perpustakaan</p>
            </div>
        </nav>
    </header>

    <div class="container ">
        <div class="flex-column justify-content-center mt-5 gap-3">
            <button type="button" class="btn btn-success mb-3">
                <i class="fa fa-plus" aria-hidden="true"><span class="ps-2 pe-2"><a href="./tambah_buku.php" style="text-decoration: none !important; color: white;">Tambah Data Buku</a></span></i>
            </button>
            <button type="button" class="btn btn-success mb-3">
                <i class="fa fa-plus" aria-hidden="true"><span class="ps-2 pe-2"><a href="./tambah_kategori_buku.php" style="text-decoration: none !important; color: white;">Tambah Kategori Buku</a></span></i>
            </button>
            <div class="tbl-container " style="overflow-x:auto;">
                <table class="table table-striped rounded tbl-tag">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Pegarang</th>
                            <th>Penerbit</th>
                            <th>Jumlah Halaman</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $data = $buku->show_data();
                                                
                        $numberLoop = 1;
                            
                         foreach ($data as $row) {
                           
                            echo "<tr>";
                            echo "<th scope='row'>" . $numberLoop++ . "</th>";
                            echo "<td>" . $row['kode_buku'] . "</td>";
                            echo "<td>" . $row['judul_buku'] . "</td>";
                            echo "<td>" . $row['pengarang'] . "</td>";
                            echo "<td>" . $row['penerbit'] . "</td>";
                            echo "<td>" . $row['jumlah_halaman'] . "</td>";
                            echo "<td>" . $row['tahun_terbit'] . "</td>";
                            echo "<td>" . $row['nama_kategori'] . "</td>";
                            echo "<td>";
                            
                            echo " <div class='d-flex gap-3'>
                                    <a href='delete_buku.php?hapus=$row[kode_buku]' onClick=\"return confirm('Apakah anda ingin menghapus data ?');\">
                                        <button type='button' class='btn btn-danger'>
                                                <i class='fa fa-trash-o' aria-hidden='true'></i>
                                        </button>
                                    </a>
                                    <a href='update_buku.php?id=$row[kode_buku]'>
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
    

    <script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</body>

</html>