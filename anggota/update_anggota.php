<?php 

require_once "../Controller/config.php";

$id_anggota = $_GET['id'];
$sql = "SELECT * FROM anggota_perpus WHERE  id_anggota='$id_anggota'";

$data=mysqli_query($conn,$sql);

$result=mysqli_fetch_array($data);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/buku.css">
    <link href="../asset/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <title>Data</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-danger ">
            <div class="container-fluid d-flex justify-content-center">
                <p class="fw-normal fs-4 fw-light text-white">Update Data Anggota Perpustakaan</p>
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
                                    <label for="namaAnggota">Nama anggota </label>
                                    <input type="text" class="form-control" placeholder="Judul Anggota" name="namaAnggota" id=namaAnggota required value="<?php echo $result['nama_anggota']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jurusanAnggota">Jurusan anggota </label>
                                    <input type="text" class="form-control" placeholder="Jurusan Anggota" name="jurusanAnggota" id=jurusanAnggota required value="<?php echo $result['jurusan_anggota']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="angkatanAnggota">Angkatan anggota </label>
                                    <input type="number" class="form-control" placeholder="Angkatan Anggota" name="angkatanAnggota" id="angkatanAnggota" required value="<?php echo $result['angkatan_anggota']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nimAnggota">Nim anggota </label>
                                    <input type="number" class="form-control" aria-describedby="emailHelp" placeholder="Nim Anggota" name="nimAnggota" id="nimAnggota" required value="<?php echo $result['nim_anggota']; ?>">
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success col-md-3" name="submit">Submit</button>
                                        <button type="submit" class="btn btn-danger col-md-3"><a href="./index.php" style="text-decoration: none !important; color: white;">Keluar</a></button>
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

<script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>

</html>
<?php 
    if(isset($_POST['submit'])) {

        $namaAnggota = htmlspecialchars($_POST['namaAnggota']);
        $jurusanAnggota =   htmlspecialchars($_POST['jurusanAnggota']);
        $angkatanAnggota = htmlspecialchars($_POST['angkatanAnggota']);
        $nimAnggota = htmlspecialchars($_POST['nimAnggota']);

        $hasil = "UPDATE anggota_perpus SET
        nama_anggota = '$namaAnggota', 
        jurusan_anggota = ' $jurusanAnggota', 
        angkatan_anggota = '$angkatanAnggota', 
        nim_anggota	 = '$nimAnggota' WHERE id_anggota='$id_anggota'";

        $result = mysqli_query($conn,$hasil);
        if($result) {
            echo "<script>
                    alert('Berhasil mengubah data anggota');
                    location.href ='anggota.php';
                </script>";
            
        }
    }
    ?>