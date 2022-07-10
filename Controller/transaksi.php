<?php
require_once 'database.php';

class transaksi extends database
{

    function show_data()
    {
        $sql = " SELECT * FROM transaksi_pinjam INNER JOIN buku
                        ON transaksi_pinjam.kode_buku = buku.kode_buku INNER JOIN anggota_perpus
                        ON transaksi_pinjam.id_anggota = anggota_perpus.id_anggota WHERE status ='Pinjam'";
        $result = mysqli_query(parent::__construct(), $sql);

        while ($rows = mysqli_fetch_assoc($result)) {
            $data[] = $rows;
        }

        return $data;
    }

    function late_fine($transaksiValue)
    {
        $t = date_create($transaksiValue);
        $n = date_create(date('d-m-Y'));
        $terlambat = date_diff($t, $n);
        $hari = $terlambat->format("%R%a");

        if ($hari > 0) {
            $denda = $hari * 5000;
        } else {
            $denda = 0;
            $hari = 0;
        }
        return [$hari, $denda];
    }

    function add_transaction($bukuDipinjam, $namaAnggota, $tglPinjam, $tglKembali)
    {

        $tglKembaliConvert = date("d-m-Y", strtotime($tglKembali));
        var_dump($tglKembaliConvert);
        $status = "Pinjam";

        $tgl1 = new DateTime($tglPinjam);
        $tgl2 = new DateTime($tglKembaliConvert);
        $jarak = $tgl2->diff($tgl1);

        $beyondDays = $jarak->days;
        if (($jarak->days) > 30) {

            return $beyondDays;
        } else {
            $sqlInsertData = "INSERT INTO transaksi_pinjam (kode_buku,id_anggota, tanggal_pinjam, tanggal_kembali, status) 
            VALUES ('$bukuDipinjam','$namaAnggota','$tglPinjam', '$tglKembaliConvert','$status')";

            $sqlUpdateData = "UPDATE buku SET id_status = '2' WHERE kode_buku = '$bukuDipinjam'";
            $resultUpdate =  mysqli_query(parent::__construct(), $sqlUpdateData);
            $resultInsert = mysqli_query(parent::__construct(), $sqlInsertData);
            if (($resultUpdate and $resultInsert) == true) {
                return $beyondDays;
            }
        }
    }

    function back_transaction_book($id_transaksi, $id_buku)
    {
        $id_transaksi = $_GET['id_transaksi'];
        $kode_buku = $_GET['kode_buku'];

        $sqlTransaksiUpdate = "UPDATE transaksi_pinjam SET status = 'Kembali' WHERE id_transaksi = '$id_transaksi'";
        $sqlBukuUpdate = "UPDATE buku SET id_status = '1' WHERE kode_buku = '$kode_buku'";

        $resultUpdateBook = mysqli_query(parent::__construct(), $sqlBukuUpdate);
        $resultUpdateBook = mysqli_query(parent::__construct(), $sqlTransaksiUpdate);

        if (($resultUpdateBook & $resultUpdateBook) == true) {
            return true;
        }

       
    }
    function add_days_transaction($id_transaksi, $lambat, $tgl_kembali)
    {
   
        if ($lambat > 3) {
            return false;
        } else {
                $pecah_tgl_kembali = explode('-', $tgl_kembali);
     
                $next7Hari = mktime(0,0,0, $pecah_tgl_kembali[1] , $pecah_tgl_kembali[0] + 7);
                $hari_next = date('d-m-Y', $next7Hari);
                $sqlUpdateTransaction = "UPDATE transaksi_pinjam  SET tanggal_kembali ='$hari_next'  WHERE id_transaksi = '$id_transaksi'";
                $resultUpdateTransaction= mysqli_query(parent::__construct(),$sqlUpdateTransaction);

                if($resultUpdateTransaction) {
                    return true;
                } else {
                    return false;
                }
        }
    }

    function show_count() {
        $sql = "SELECT COUNT(*) as total FROM transaksi_pinjam";
        $result = mysqli_query(parent::__construct(),$sql);
        $rows = mysqli_fetch_assoc($result);
        return $rows['total'];

    }

    function search_data($keyword){
        $sql = "SELECT a.nama_anggota, a.nim_anggota, b.judul_buku, c.tanggal_pinjam, c.tanggal_kembali 
        FROM transaksi_pinjam c INNER JOIN buku b
        ON c.kode_buku = b.kode_buku INNER JOIN anggota_perpus a
        ON c.id_anggota = a.id_anggota WHERE status ='Pinjam' AND
        nama_anggota LIKE '%$keyword%' OR
        nim_anggota LIKE '%$keyword%' OR
        judul_buku LIKE '%$keyword%' OR
        tanggal_pinjam LIKE '%$keyword%' OR
        tanggal_kembali LIKE '%$keyword%'";
       
               
        $result = mysqli_query(parent::__construct(), $sql);
        
        while($rows = mysqli_fetch_assoc($result)){
            $data[] = $rows;
        }

        return $data;
    }

   
}
