<?php
    require_once "buku.php";
    if(isset($_GET['hapus'])) {
        $idbuku = $_GET['hapus'];
        $sql = "DELETE FROM buku WHERE kode_buku='$idbuku'";

        $result = mysqli_query($conn,$sql);

        if($result) {
            echo "<script>
                    alert('Berhasil Menghapus Data Buku');
                    location.href ='buku.php';
            </script>";
        }
    }            
?>