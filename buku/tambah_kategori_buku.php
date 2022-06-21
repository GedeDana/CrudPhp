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
                            <h3 class="d-flex justify-content-center text-white">Tambah Kategori Buku</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" class="d-grid gap-3" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <div class="form-group">
                                    <label for="kategori">Kategori Buku: </label>
                                    <input type="text" class="form-control" placeholder="Kategori Buku" name="kategori" id=kategori required>
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
    <?php
    require_once "../Controller/config.php";

    if (isset($_POST['submit'])) {

        $kategori = htmlspecialchars($_POST['kategori']);
        $sql = "INSERT INTO kategori_buku (nama_kategori) VALUES ('" . $kategori . "')";

        $result = mysqli_query($conn, $sql);
        echo $result;
        echo "<script>alert('Data Berhasil Ditambahkan')</script>";
    }

    ?>
</body>
<script src="../asset/bootstrap-5.0.2-dist/js/bootstrap.min.js" crossorigin="anonymous"></script>


</html>