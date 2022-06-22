<?php 

require_once "../Controller/config.php";
error_reporting(E_ALL);
ini_set('display_errors', 'on');

$sqlTampilkanAnggota = "SELECT * FROM anggota_perpus";
$sqlTampilkanBuku = "SELECT * FROM buku WHERE id_status = '1'";
$tgl_pinjam = date('d-m-Y');
$empatbelas_hari = mktime(0,0,0, date('n'), date('j') + 14, date('Y'));
// $kembali = date('d-m-Y', $empatbelas_hari);


if (isset($_POST['submit'])) {


    $namaAnggota = htmlspecialchars($_POST['id_anggota']);
    $bukuDipinjam =   htmlspecialchars($_POST['kode_buku']);
    $tglPinjam = htmlspecialchars($_POST['tglPinjam']);
    $tglKembali = htmlspecialchars($_POST['tglKembali']);
    $tglKembaliConvert = date("d-m-Y", strtotime($tglKembali));
    $status = "Pinjam";

    $tgl1 = new DateTime($tglPinjam);
    $tgl2 = new DateTime($tglKembaliConvert);
    $jarak = $tgl2->diff($tgl1);
    

    if( ($jarak->days) > 30) {
        echo "<script>
            alert('Peminjaman Lebih dari 30 Hari');
            location.href ='transaksi.php';
            
         </script>";
         return $jarak->days;
    } 
    
    $sqlInsertData = "INSERT INTO transaksi_pinjam (kode_buku,id_anggota, tanggal_pinjam, tanggal_kembali, status) VALUES ('$bukuDipinjam','$namaAnggota','$tglPinjam', '$tglKembaliConvert','$status')";
    $sqlUpdateData = "UPDATE buku SET id_status = '2' WHERE kode_buku = '$bukuDipinjam'";
    $result1 =  mysqli_query($conn, $sqlUpdateData);
    $result = mysqli_query($conn, $sqlInsertData);


    if (($result AND $result1) == true) {
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
    <link href="../asset/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
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
                                    <select name="id_anggota" aria-label="Default select example"class="form-select" required>
                                    <option selected>Pilih Anggota</option>
                                    <?php 
                                    
                                    $query = mysqli_query($conn,$sqlTampilkanAnggota);
                                    while($data = mysqli_fetch_array($query)) {
                                        echo "<option value=$data[id_anggota]> $data[nama_anggota]  </option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="namaAnggota">Buku yang dipinjam </label>
                                    <select name="kode_buku" aria-label="Default select example"class="form-select" required>
                                    <option selected>Pilih Buku</option>
                                    <?php 
                                    
                                    $query = mysqli_query($conn,$sqlTampilkanBuku);

                                    while($data = mysqli_fetch_array($query)) {
                                        echo "<option value=$data[kode_buku]> $data[kode_buku] -- $data[judul_buku]  </option>";
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
                                    <input type="date" class="form-control" aria-describedby="emailHelp" placeholder="Nim Anggota" name="tglKembali" id="tglKembali" required >
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

<script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>

</html> 