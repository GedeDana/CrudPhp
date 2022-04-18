<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                            <h3 class="d-flex justify-content-center text-white">Judul Buku</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" class="d-grid gap-3" action="<?php echo $_SERVER["PHP_SELF"];?>">
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

                                        include "config.php";
                                        $sql = "SELECT * FROM kategori_buku";
                                        $query = mysqli_query($conn, $sql);
                                       
                                        while ($data = mysqli_fetch_array($query)) {
                                            echo "<option value=$data[id_kategori]> $data[nama_ketegori]  </option>";
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
    <?php 
    
    require_once("config.php");
    if(isset($_POST['submit'])) {


  
        $judulBuku =   htmlspecialchars($_POST['judulBuku']);
        $pengarangBuku = htmlspecialchars($_POST['pengarang']); 
        $jumlahHalaman = htmlspecialchars($_POST['jumlahHalaman']); 
        $tahunTerbit = htmlspecialchars($_POST['tahunTerbit']); 
        $kategori =  htmlspecialchars($_POST['id_kategori']); 

        $sql = "INSERT INTO buku (judul_buku,pengarang,	penerbit, jumlah_halaman, tahun_terbit, id_kategori) VALUES ('".$judulBuku."','".$pengarangBuku."','".$penerbitBuku."','".$jumlahHalaman."','".$tahunTerbit."','".$kategori."')";

        $result = mysqli_query($conn,$sql);
        if($result){
            echo "<script>
            alert('Data Berhasil Ditambahkan');
            location.href ='buku.php';
            
            </script>";
        }
    }
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>