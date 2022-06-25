<?php 
require_once 'database.php';

class anggota extends database {

    function show_data() {
        $sql = "SELECT * FROM anggota_perpus";
        $result = mysqli_query(parent::__construct(), $sql);

        while($rows = mysqli_fetch_assoc($result)){
            $data[] = $rows;
        }
        return $data;
    }

    function show_data_by_id($id_anggota) {
        $sql = "SELECT * FROM anggota_perpus WHERE  id_anggota='$id_anggota'";
        $result = mysqli_query(parent::__construct(), $sql);
        $rows = mysqli_fetch_assoc($result);
        return $rows;
    }

    function add_data($namaAnggota,$jurusanAnggota,$angkatanAnggota,$nimAnggota) {
        $sql = "INSERT INTO anggota_perpus (nama_anggota,jurusan_anggota,angkatan_anggota, nim_anggota) VALUES ('". $namaAnggota . "','" . $jurusanAnggota . "','" . $angkatanAnggota . "','" . $nimAnggota . "')";
        $result = mysqli_query(parent::__construct(),$sql);

        return $result; 
    }

    function change_data($namaAnggota,$jurusanAnggota,$angkatanAnggota,$nimAnggota,$id_anggota) {
        $sql = "UPDATE anggota_perpus SET
        nama_anggota = '$namaAnggota', 
        jurusan_anggota = ' $jurusanAnggota', 
        angkatan_anggota = '$angkatanAnggota', 
        nim_anggota	 = '$nimAnggota' WHERE id_anggota='$id_anggota'";
        $result = mysqli_query(parent::__construct(),$sql);
        return $result;
    }

    function delete_data($id_anggota) {
        $sql = "DELETE FROM anggota_perpus WHERE id_anggota='$id_anggota'";

        $result = mysqli_query(parent::__construct(),$sql);

        return $result;
    }

}

?>