<?php 
require_once "../Controller/buku.php";


session_start();

if( !isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
$buku = new buku();

$id_buku = $_GET['id'];
$result = $buku->show_data_by_id($id_buku);
$resultCategory = $buku->show_data_by_category();

if(isset($_POST['submit'])) {

    $judulBuku =   htmlspecialchars($_POST['judulBuku']);
    $pengarangBuku = htmlspecialchars($_POST['pengarang']); 
    $penerbitBuku = htmlspecialchars($_POST['penerbit']);
    $jumlahHalaman = htmlspecialchars($_POST['jumlahHalaman']); 
    $tahunTerbit = htmlspecialchars($_POST['tahunTerbit']); 
    $kategori =  htmlspecialchars($_POST['id_kategori']); 
  

    $updateData = $buku->change_data($judulBuku,$pengarangBuku,$penerbitBuku,$jumlahHalaman,$tahunTerbit, $kategori,$id_buku);
    if($updateData) {
        echo "<script>
            alert('Berhasil mengubah data buku');
            location.href ='buku.php';
            </script>";
        
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../asset/css/easion.css">
    <script src="https://use.fontawesome.com/7d6592d6d3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="../asset/js/chart-js-config.js"></script>

    <title>Our Book</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>
                <a href="../index.php" class="easion-logo"><i class="fas fa-book"></i><span>OurPerpus</span></a>
            </header>
            <nav class="dash-nav-list">
            <a href="../index.php" class="dash-nav-item">
                    <i class="fas fa-home"></i> Dashboard </a>  
                <div class="dash-nav-dropdown">
                    <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-book"></i> Buku </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="./buku.php" class="dash-nav-dropdown-item">Daftar Buku</a>
                        <a href="./tambah_buku.php" class="dash-nav-dropdown-item">Tambah Buku</a>
                        <a href="./tambah_kategori_buku.php" class="dash-nav-dropdown-item p">Tambah Kategori Buku</a>

                    </div>
                </div>
                <div class="dash-nav-dropdown">
                    <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-user"></i> Anggota </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="../anggota/anggota.php" class="dash-nav-dropdown-item">Daftar Anggota</a>
                        <a href="../anggota/tambah_anggota.php" class="dash-nav-dropdown-item">Tambah Anggota</a>
                   

                    </div>
                </div>
                <div class="dash-nav-dropdown">
                    <a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-receipt"></i> Transaksi </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="../transaksi/transaksi.php" class="dash-nav-dropdown-item">Daftar Transaksi</a>
                        <a href="../transaksi/tambah_transaksi.php" class="dash-nav-dropdown-item">Tambah Transaksi</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a>

                <div class="d-flex align-items-center tools">

                <p class="mt-2">Selama Datang <?php echo $_SESSION["username"] ?></p>
                    <div class="dropdown tools-item">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </header>
            <main class="dash-content">

                <div class="container-fluid">
                    <h1 class="dash-title d-flex justify-content-center">Update Buku</h1>
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-9">
                            <div class="card easion-card">
                                <div class="card-header">
                                    <div class="easion-card-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="easion-card-title"> Tambah Buku </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <label for="judulBuku">Judul Buku: </label>
                                            <input type="text" class="form-control" placeholder="Judul Buku" name="judulBuku" id=judulBuku required value="<?php echo $result['judul_buku']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="pengarang">Pengarang : </label>
                                            <input type="text" class="form-control" placeholder="Nama Pengarang" name="pengarang" id="pengarang" required value="<?php echo $result['pengarang']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="penerbit">Penerbit : </label>
                                            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Penerbit" name="penerbit" id="penerbit" required value="<?php echo $result['penerbit']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlahHalaman">Jumlah Halaman : </label>
                                            <input type="number" class="form-control" placeholder="Jumlah halaman" name="jumlahHalaman" id="jumlahHalaman" required value="<?php echo $result['jumlah_halaman']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tahunTerbit">Tahun Terbit :</label>
                                            <input type="number" class="form-control" placeholder="Tahun Terbit" name="tahunTerbit" id="tahunTerbit" required value="<?php echo $result['tahun_terbit']; ?>">
                                        </div>
                                    <div class="form-group">
                                    <label for="kategoriBuku">Kategori Buku :</label>
                                    <select class="form-select" aria-label="Default select example" name="id_kategori"required>
                                    <?php
                                        
                                        foreach($resultCategory as $category) {
                                            echo "<option value=$category[id_kategori]> $category[nama_kategori]  </option>";
                                        }
                               
                                        ?>
                                    </select>
                                </div> 
                        

                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../asset/js/easion.js"></script>
</body>

</html>

