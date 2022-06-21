<?php 

require_once 'transaksi.php';


if(isset($_GET['aksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
    $kode_buku = $_GET['kode_buku'];

    $sqlTransaksiUpdate = "UPDATE transaksi_pinjam SET status = 'Kembali' WHERE id_transaksi = '$id_transaksi'";
    $sqlBukuUpdate = "UPDATE buku SET id_status = '1' WHERE kode_buku = '$kode_buku'";

    $resultUpdateBook = mysqli_query($conn,$sqlBukuUpdate);
    $result1UpdateTransaksi = mysqli_query($conn,$sqlTransaksiUpdate);

    if(( $resultUpdateBook AND $result1UpdateTransaksi ) == true) {
        echo "<script>
                alert('Berhasil Mengembalikan Data Buku');
                location.href ='transaksi.php';
        </script>";
    }
}

?>