<?php 

include_once "config.php";

$id_buku = $_GET['id'];
$sql = "SELECT * FROM buku, kategori_buku WHERE buku.id_kategori = kategori_buku.id_kategori AND kode_buku='$id_buku'";

$data=mysqli_query($conn,$sql);

$result=mysqli_fetch_array($data);

?>
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
                <p class="fw-normal fs-4 fw-light text-white">Update Data Buku</p>
            </div>
        </nav>
    </header>
    <div class="d-flex align-items-center light-blue-gradient" style="height: 100vh;">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card rounded-0 shadow">
                        <div class="card-header bg-primary p-n1">
                            <h3 class="d-flex justify-content-center text-white">Update Buku</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" class="d-grid gap-3" action="">
                                <div class="form-group">
                                    <label for="judulBuku">Judul Buku: </label>
                                    <input type="text" class="form-control" placeholder="Judul Buku" name="judulBuku" id=judulBuku value="<?php echo $result['judul_buku']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="pengarang">Pengarang : </label>
                                    <input type="text" class="form-control" placeholder="Nama Pengarang" name="pengarang" id="pengarang" value="<?php echo $result['pengarang']; ?>"  required >
                                </div>
                                <div class="form-group">
                                    <label for="penerbit">Penerbit : </label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Penerbit" name="penerbit" id="penerbit" value="<?php echo $result['penerbit']; ?>"  required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlahHalaman">Jumlah Halaman : </label>
                                    <input type="number" class="form-control" placeholder="Jumlah halaman" name="jumlahHalaman" id="jumlahHalaman"  value="<?php echo $result['jumlah_halaman']; ?>"  required>
                                </div>
                                <div class="form-group">
                                    <label for="tahunTerbit">Tahun Terbit :</label>
                                    <input type="number" class="form-control" placeholder="Tahun Terbit" name="tahunTerbit" id="tahunTerbit"  value="<?php echo $result['tahun_terbit']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategoriBuku">Kategori Buku :</label>
                                    <select class="form-select" aria-label="Default select example" name="id_kategori"required>
                                        <?php
                                         echo "<option value=$result[id_kategori]> $result[nama_kategori]  </option>";

                                        $sql = "SELECT * FROM kategori_buku";
                                        $query = mysqli_query($conn, $sql);
                                       
                                        while ($data = mysqli_fetch_array($query)) {
                                            echo "<option value=$data[id_kategori]> $data[nama_kategori]  </option>";
                                        }

                                        ?>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <input type="submit" class="btn btn-success col-md-3" name="submit">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
<?php 
    if(isset($_POST['submit'])) {

        $judulBuku =   htmlspecialchars($_POST['judulBuku']);
        $pengarangBuku = htmlspecialchars($_POST['pengarang']); 
        $jumlahHalaman = htmlspecialchars($_POST['jumlahHalaman']); 
        $tahunTerbit = htmlspecialchars($_POST['tahunTerbit']); 
        $kategori =  htmlspecialchars($_POST['id_kategori']); 
        $penerbitBuku = htmlspecialchars($_POST['penerbit']);

        $hasil = "UPDATE buku SET
        judul_buku= '$judulBuku', 
        pengarang = '$pengarangBuku', 
        penerbit = '$penerbitBuku', 
        jumlah_halaman	 = '$jumlahHalaman',
        tahun_terbit = '$tahunTerbit',
        id_kategori = '$kategori' WHERE kode_buku='$id_buku'";

        $result = mysqli_query($conn,$hasil);
        if($result) {
            echo "<script>
                alert('Berhasil mengubah data buku');
                location.href ='buku.php';
                </script>";
            
        }
    }
    ?>