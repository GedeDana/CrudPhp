<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data anggota</title>
    <link rel="stylesheet" href="../asset/css/buku.css">
    <link href="../asset/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <script src="https://use.fontawesome.com/7d6592d6d3.js"></script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-danger ">
            <div class="container-fluid d-flex justify-content-center">
                <p class="fw-normal fs-4 fw-light text-white">Data Anggota Perpustakaan</p>
            </div>
        </nav>
    </header>

    <div class="container ">
        <div class="flex-column justify-content-center mt-5 gap-3">
            <button type="button" class="btn btn-success mb-3">
                <i class="fa fa-plus" aria-hidden="true"><span class="ps-2 pe-2"><a href="./tambah_anggota.php" style="text-decoration: none !important; color: white;">Tambah Anggota Perpustakaan</a></span></i>
            </button>
            <div class="tbl-container " style="overflow-x:auto;">
                <table class="table table-striped rounded tbl-tag">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nama Anggota</th>
                            <th>Jurusan</th>
                            <th>Angkatan</th>
                            <th>Nim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require_once "../Controller/config.php";

                        $sql = "SELECT * FROM anggota_perpus";
                        

                        $result = mysqli_query($conn, $sql);
            
                        $i = 1;
                         while ($row = mysqli_fetch_array($result)) {
                           
                            echo "<tr>";
                            echo "<th scope='row'>" . $i++ . "</th>";
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
    

    <script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</body>

</html>