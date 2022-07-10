<?php

require '../Controller/anggota.php';

$keyword = $_GET["keyword"];
$anggota = new anggota();
$data = $anggota->search_data($keyword);


?>
<style>
    h3 {
        display: flex;
        justify-content: center;
        margin: 30px;
    }
</style>

<table class="table table-in-card">
    <thead>
        <tr>
            <th scope="2">Id</th>
            <th scope="2">Nama Anggota</th>
            <th scope="2">Jurusan</th>
            <th scope="2">Angkatan</th>
            <th scope="2">Nim</th>
            <th scope="2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

        if ($data != null) {
            $numberLoop = 1;
            foreach ($data as $row) {

                echo "<tr>";
                echo "<th scope='row'>" .  $numberLoop++ . "</th>";
                echo "<td>" . $row['nama_anggota'] . "</td>";
                echo "<td>" . $row['jurusan_anggota'] . "</td>";
                echo "<td>" . $row['angkatan_anggota'] . "</td>";
                echo "<td>" . $row['nim_anggota'] . "</td>";
                echo "<td>";

                echo " <div class='d-flex gap-3'>
                        <a href='delete_anggota.php?hapus=$row[id_anggota]' onClick=\"return confirm('Apakah anda ingin menghapus data ?');\">
                            <button type='button' class='btn btn-danger'>
                                    <i class='fa fa-trash-o' aria-hidden='true'></i>
                            </button>
                        </a>
                        <a href='update_anggota.php?id=$row[id_anggota]'>
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