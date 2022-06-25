<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "../Controller/transaksi.php";
$transaksi = new transaksi();

if(isset($_GET['aksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
    $kode_buku = $_GET['kode_buku'];

    $result = $transaksi->back_transaction_book($id_transaksi,$kode_buku);

    if($result) {
        echo "<script>
                alert('Berhasil Mengembalikan Data Buku');
                location.href ='transaksi.php';
        </script>";
    }
}

?>