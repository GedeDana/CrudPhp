<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="./css/buku.css">
    <script src="https://use.fontawesome.com/7d6592d6d3.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

                        include "config.php";

                        $sql = "SELECT * FROM buku, kategori_buku WHERE buku.id_kategori = kategori_buku.id_kategori";
                        

                        $result = mysqli_query($conn, $sql);
                        $i = 1;

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $i++ . "</th>";
                            echo "<td>" . $row['judul_buku'] . "</td>";
                            echo "<td>" . $row['pengarang'] . "</td>";
                            echo "<td>" . $row['penerbit'] . "</td>";
                            echo "<td>" . $row['jumlah_halaman'] . "</td>";
                            echo "<td>" . $row['tahun_terbit'] . "</td>";
                            echo "<td>" . $row['nama_ketegori'] . "</td>";
                            echo "<td>";
                            
                            echo " <div class='d-flex gap-3'>
                                    <a href='?hapus=$row[id_buku]' onClick=\"return confirm('Apakah anda ingin menghapus data ?');\">
                                        <button type='button' class='btn btn-danger'>
                                                <i class='fa fa-trash-o' aria-hidden='true'></i>
                                        </button>
                                    </a>
                                    <a href='update_buku.php?id=$row[id_buku]'>
                                        <button type='button' class='btn btn-warning'>
                                            <i class='fa fa-pencil' aria-hidden='true'></i>
                                        </button>
                                    </a>
                                </div>";
                            echo "</td>";
                            echo "</tr>";
                        }

                        ?>
                        <!-- <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otasdsadasdasdto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry the Bird</td>
                            <td>@twitter</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_GET['hapus'])) {
        $idbuku = $_GET['hapus'];
        $sql = "DELETE FROM buku WHERE id_buku='$idbuku'";

        $result = mysqli_query($conn,$sql);

        if($result) {
            echo "<script>
                    alert('Berhasil Menghapus Data Buku');
                    location.href ='buku.php';
            </script>";
        }
    }
    

            
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>