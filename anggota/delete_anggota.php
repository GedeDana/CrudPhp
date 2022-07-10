<?php
    require_once '../Controller/anggota.php';
    if(isset($_GET['hapus'])) {
        $id_anggota = $_GET['hapus'];
        $anggota = new anggota();

        $result = $anggota->delete_data($id_anggota);
        if($result) {
            echo "<script>
                    alert('Berhasil Menghapus Data Anggota Buku');
                    location.href ='anggota.php';
            </script>";
        }
}
    

            
?>