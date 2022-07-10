<?php
    require_once "../Controller/buku.php";


    session_start();

    if( !isset($_SESSION["login"])) {
        header("location: login.php");
        exit;
    }

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