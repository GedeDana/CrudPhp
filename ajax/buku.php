<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require '../Controller/buku.php';

$keyword = $_GET["keyword"];
$buku = new buku();
$data = $buku->search_data($keyword);


?>
<style>
    h3 {
        display: flex;
        justify-content: center;
        margin: 30px;   
    }
</style>
<table class="table table-in-card">
    <thead id="head-tbl">
        <th scope="col">Id</th>
        <th scope="col">Kode Buku</th>
        <th scope="col">Judul Buku</th>
        <th scope="col">Pegarang</th>
        <th scope="col">Penerbit</th>
        <th scope="col">Jumlah Halaman</th>
        <th scope="col">Tahun Terbit</th>
        <th scope="col">Kategori</th>
        <th scope="col">Aksi</th>
    </thead>
    <tbody>
        <?php
        if ($data != null) {
            $numberLoop = 1;

            foreach ($data as $row) {

                echo "<tr>";
                echo "<th scope='row'>" . $numberLoop++ . "</th>";
                echo "<td>" . $row['kode_buku'] . "</td>";
                echo "<td>" . $row['judul_buku'] . "</td>";
                echo "<td>" . $row['pengarang'] . "</td>";
                echo "<td>" . $row['penerbit'] . "</td>";
                echo "<td>" . $row['jumlah_halaman'] . "</td>";
                echo "<td>" . $row['tahun_terbit'] . "</td>";
                echo "<td>" . $row['nama_kategori'] . "</td>";
                echo "<td>";

                echo " <div class='d-flex gap-3'>
                        <a href='delete_buku.php?hapus=$row[kode_buku]' onClick=\"return confirm('Apakah anda ingin menghapus data ?');\">
                            <button type='button' class='btn btn-danger'>
                                    <i class='fa fa-trash-o' aria-hidden='true'></i>
                            </button>
                        </a>
                        <a href='update_buku.php?id=$row[kode_buku]'>
                            <button type='button' class='btn btn-warning'>
                                <i class='fa fa-pencil' aria-hidden='true'></i>
                            </button>
                        </a>
                    </div>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
        
            echo "<h3>" . 'Data Tidak Ditemukan' . "</h3>";
            
              

      

        }



        ?>
    </tbody>
  
</table>
