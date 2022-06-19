<?php
    require_once "index.php";
    if(isset($_GET['hapus'])) {
        $id_anggota = $_GET['hapus'];
        $sql = "DELETE FROM anggota_perpus WHERE id_anggota='$id_anggota'";

        $result = mysqli_query($conn,$sql);

        if($result) {
            echo "<script>
                    alert('Berhasil Menghapus Data Anggota Buku');
                    location.href ='anggota.php';
            </script>";
        }
    }
    

            
?>