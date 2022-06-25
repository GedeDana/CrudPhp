<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "../Controller/buku.php";
$buku = new buku();
$resultCategory = $buku->show_data_by_category();
if (isset($_POST['submit'])) {

 

    $kodeBuku = htmlspecialchars($_POST['kodeBuku']);
    $judulBuku =   htmlspecialchars($_POST['judulBuku']);
    $pengarangBuku = htmlspecialchars($_POST['pengarang']);
    $penerbitBuku = htmlspecialchars($_POST['penerbit']);
    $jumlahHalaman = htmlspecialchars($_POST['jumlahHalaman']);
    $tahunTerbit = htmlspecialchars($_POST['tahunTerbit']);
    $kategori =  htmlspecialchars($_POST['id_kategori']);

    $data = $buku->add_data($kodeBuku,$judulBuku,$pengarangBuku,$penerbitBuku,$jumlahHalaman,$tahunTerbit,$kategori);  

    if ($data) {
        echo "<script>
            alert('Data Buku Behasil Ditambahkan');
            location.href ='buku.php';
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
                            <h3 class="d-flex justify-content-center text-white">Tambah Buku</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" class="d-grid gap-3" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <div class="form-group">
                                    <label for="judulBuku">Kode Buku: </label>
                                    <input type="text" class="form-control" placeholder="Judul Buku" name="kodeBuku" id=kodeBuku required>
                                </div>
                                <div class="form-group">
                                    <label for="judulBuku">Judul Buku: </label>
                                    <input type="text" class="form-control" placeholder="Judul Buku" name="judulBuku" id=judulBuku required>
                                </div>
                                <div class="form-group">
                                    <label for="pengarang">Pengarang : </label>
                                    <input type="text" class="form-control" placeholder="Nama Pengarang" name="pengarang" id="pengarang" required>
                                </div>
                                <div class="form-group">
                                    <label for="penerbit">Penerbit : </label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Penerbit" name="penerbit" id="penerbit" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlahHalaman">Jumlah Halaman : </label>
                                    <input type="number" class="form-control" placeholder="Jumlah halaman" name="jumlahHalaman" id="jumlahHalaman" required>
                                </div>
                                <div class="form-group">
                                    <label for="tahunTerbit">Tahun Terbit :</label>
                                    <input type="number" class="form-control" placeholder="Tahun Terbit" name="tahunTerbit" id="tahunTerbit" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategoriBuku">Kategori Buku :</label>
                                    <select class="form-select" aria-label="Default select example" name="id_kategori" required>
                                        <option selected>Pilih kategori</option>
                                        <?php

                                        foreach($resultCategory as $category) {
                                            echo "<option value=$category[id_kategori]> $category[nama_kategori]  </option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" hidden>
                                    <label for="kategoriBuku">Status Buku :</label>
                                    <select class="form-select" aria-label="Default select example" name="id_status" required hidden>
                                        <?php

                                        foreach($resultCategory as $category) {
                                            echo "<option value=$category[id_kategori]> $category[nama_kategori]  </option>";
                                        }


                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success col-md-3" name="submit">Submit</button>
                                        <button type="submit" class="btn btn-danger col-md-3"><a href="./buku.php" style="text-decoration: none !important; color: white;">Keluar</a></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</html>