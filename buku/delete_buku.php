<?php
    require_once "../Controller/buku.php";
    if(isset($_GET['hapus'])) {
        $idbuku = $_GET['hapus'];
        $buku = new buku();

        $result = $buku->delete_data($idbuku);

        if($result) {
            echo "<script>
                    alert('Berhasil Menghapus Data Buku');
                    location.href ='buku.php';
            </script>";
        }
    }            
?>