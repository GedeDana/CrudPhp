<?php 
require_once 'database.php';

class buku extends database {

    function show_data() {
        $sql = "SELECT * FROM buku, kategori_buku WHERE buku.id_kategori = kategori_buku.id_kategori AND id_status ='1'";
        $result = mysqli_query(parent::__construct(), $sql);

        while($rows = mysqli_fetch_assoc($result)){
            $data[] = $rows;
        }

        return $data;
    }
    function show_data_by_category() {
        $sql = "SELECT * FROM kategori_buku";
        $result = mysqli_query(parent::__construct(), $sql);

        while($rows = mysqli_fetch_assoc($result)){
            $data[] = $rows;
        }

        return $data;
        
    }
    function insert_data_category_book($kategori) {
        $sql =  "INSERT INTO kategori_buku (nama_kategori) VALUES ('$kategori')";
        $result = mysqli_query(parent::__construct(), $sql);

        return $result;
       
    }

    function show_data_by_id(?string $id_buku) {

        if($id_buku != NULL) {
            $sql = "SELECT * FROM buku, kategori_buku WHERE buku.id_kategori = kategori_buku.id_kategori AND kode_buku='$id_buku'";
            $result = mysqli_query(parent::__construct(), $sql);
            $data = $result;
        } else {
            $sql = "SELECT * FROM buku WHERE id_status = 1";
            $result = mysqli_query(parent::__construct(), $sql);
            while($rows = mysqli_fetch_assoc($result)){
                $data[] = $rows;
            }
        }
        return $data;
    }

    function add_data($kodeBuku,$judulBuku,$pengarangBuku,$penerbitBuku,$jumlahHalaman, $tahunTerbit, $kategori,?int $statusBuku = 1 ) {
        $sql = "INSERT INTO buku 
        (kode_buku,
        judul_buku,
        pengarang,penerbit,
        jumlah_halaman, 
        tahun_terbit,
         id_kategori, id_status) VALUES 
         ('$kodeBuku',
         '$judulBuku',
         '$pengarangBuku',
         '$penerbitBuku',
         '$jumlahHalaman',
         '$tahunTerbit',
         '$kategori',
         '$statusBuku'
         )";
        $result = mysqli_query(parent::__construct(),$sql);

        return $result; 
    }

    function change_data($judulBuku,$pengarangBuku,$penerbitBuku,$jumlahHalaman,$tahunTerbit,$kategori,$id_buku) {
        $sql = "UPDATE buku SET
        judul_buku= '$judulBuku', 
        pengarang = '$pengarangBuku', 
        penerbit = '$penerbitBuku', 
        jumlah_halaman	 = '$jumlahHalaman',
        tahun_terbit = '$tahunTerbit',
        id_kategori = '$kategori' WHERE kode_buku='$id_buku'";

        $result = mysqli_query(parent::__construct(),$sql);

        return $result; 
    }

    function delete_data($idbuku) {
        $sql = "DELETE FROM buku WHERE kode_buku='$idbuku'";

        $result = mysqli_query(parent::__construct(),$sql);

        return $result;
    }

}

?>