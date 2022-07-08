<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once '../Controller/transaksi.php';

session_start();

if( !isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
$transaksi = new transaksi();
if(isset($_GET['aksi'])){
    $id_transaksi = $_GET['id_transaksi'];
    $lambat = $_GET['lambat'];
    $tgl_kembali = $_GET['tgl_kembali'];

    $updateDaysTransaction = $transaksi->add_days_transaction($id_transaksi,$lambat,$tgl_kembali);


    if(!$updateDaysTransaction) {
        echo "<script>
        alert('Perpanjagan Peminjaman Tidak Bisa Dilakukan, Karena Melebihi Batas Peminjaman.Silahkan Kembalikan Terlebih Dahulu');
        location.href ='transaksi.php';
    </script>";
    } else {
        if($updateDaysTransaction) {
            echo "<script>
                alert('Perpanjangan hari berhasil');
                location.href ='transaksi.php';
            </script>"; 
        } else {
            echo "<script>
                alert('Ada Kesalahan Dalam Server');
                location.href ='transaksi.php';
            </script>"; 
        }
    }

}




?>