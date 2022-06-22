<?php 
require_once 'transaksi.php';

if(isset($_GET['aksi'])){
    $id_transaksi = $_GET['id_transaksi'];
    $lambat = $_GET['lambat'];
    $tgl_kembali = $_GET['tgl_kembali'];


if($lambat > 3) {
    echo "<script>
        alert('Perpanjgan Peminjaman Tidak Bisa Dilakukan, Karena Lebih dari 30 Hari.Silahkan Kembalikan buku terlebih dahulu');
        location.href ='transaksi.php';
    </script>";
} else {
    
	$pecah_tgl_kembali = explode('-', $tgl_kembali);
    var_dump($pecah_tgl_kembali);
	$next7Hari = mktime(0,0,0, $pecah_tgl_kembali[1] , $pecah_tgl_kembali[0] + 7);
	$hari_next = date('d-m-Y', $next7Hari);
    $sql = $conn->query("UPDATE transaksi_pinjam  SET tanggal_kembali ='$hari_next'  WHERE id_transaksi = '$id_transaksi'") or die(mysqli_error($conn));

	if($sql) {
		echo "<script>alert('Perpanjang jangka waktu buku berhasil.');window.location='?p=transaksi';</script>";
	} else {
		echo "<script>alert('Perpanjang gagal.');window.location='?p=transaksi';</script>";
	}
}

}




?>