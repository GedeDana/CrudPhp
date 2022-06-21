<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="../css/buku.css">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require_once "../Controller/config.php";

                        $sql = " SELECT * FROM transaksi_pinjam INNER JOIN buku
                        ON transaksi_pinjam.kode_buku = buku.kode_buku INNER JOIN anggota_perpus
                        ON transaksi_pinjam.id_anggota = anggota_perpus.id_anggota WHERE status ='pinjam'";


                        $result = mysqli_query($conn, $sql);

                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) {

                            echo "<tr>";
                            echo "<th scope='row'>" . $i++ . "</th>";
                            echo "<td>" . $row['nama_anggota'] . "</td>";
                            echo "<td>" . $row['nim_anggota'] . "</td>";
                            echo "<td>" . $row['judul_buku'] . "</td>";
                            echo "<td>" . $row['tanggal_pinjam'] . "</td>";
                            echo "<td>" . $row['tanggal_kembali'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>";

                            echo " <div class='d-flex gap-3'>
                                    <a href='kembali_transaksi.php?aksi=kembali&id_transaksi=$row[id_transaksi]&kode_buku=$row[kode_buku]' onClick=\"return confirm('Apakah anda ingin megembalikan buku ?');\">
                                        <button type='button' class='btn btn-danger'>
                                               Telah Dikembalikan
                                        </button>
                                    </a>
                                    <a href='update_anggota.php?id_anggota=$row[id_anggota]'>
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