<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require '../Controller/transaksi.php';

$keyword = $_GET["keyword"];
$transaksi = new transaksi();
$data = $transaksi->search_data($keyword);


?>

<style>
    h3 {
        display: flex;
        justify-content: center;
        margin: 30px;
    }
</style>
<div class="card-body" id="table-content-transaksi">
    <table class="table table-in-card">
        <thead>
            <tr>
                <th scope="2">Id</th>
                <th scope="2">Nama Anggota</th>
                <th scope="2">Nim Anggota</th>
                <th scope="2">Judul Buku</th>
                <th scope="2">Tanggal Pinjam</th>
                <th scope="2">Tanggal Kembali</th>
                <th scope="2">Status</th>
                <th scope="2">Denda</th>
                <th scope="2">Terlambat</th>
                <th scope="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($data != null) {
                $numberLoop = 1;
                foreach ($data as $transaksiValue) {

                    $denda = $transaksi->late_fine($transaksiValue['tanggal_kembali']);
                   
                    [$hari, $denda] = $denda;
                    echo "<tr>";
                    echo "<th scope='row'>" . $numberLoop++ . "</th>";
                    echo "<td>" . $transaksiValue['nama_anggota'] . "</td>";
                    echo "<td>" . $transaksiValue['nim_anggota'] . "</td>";
                    echo "<td>" . $transaksiValue['judul_buku'] . "</td>";
                    echo "<td>" . $transaksiValue['tanggal_pinjam'] . "</td>";
                    echo "<td>" . $transaksiValue['tanggal_kembali'] . "</td>";
                    echo "<td>" . "Dipinjam". "</td>";
                    echo "<td>" . "Rp " . $denda . "</td>";
                    echo "<td>" . str_replace('+', '', $hari) . " Hari" . "</td>";


                    echo "<td>";

                    echo " <div class='d-flex gap-3'>
                                                            <a href='kembali_transaksi.php?aksi=kembali&id_transaksi=$transaksiValue[id_transaksi]&kode_buku=$transaksiValue[kode_buku]' onClick=\"return confirm('Apakah anda ingin megembalikan buku ?');\">
                                                                <button type='button' class='btn btn-danger'>
                                                                    Dikembalikan
                                                                </button>
                                                            </a>
                                                            <a href=perpanjang_transaksi.php?aksi=perpanjang&lambat=$hari&id_transaksi=$transaksiValue[id_transaksi]&tgl_kembali=$transaksiValue[tanggal_kembali]'>
                                                                <button type='button' class='btn btn-warning'>
                                                                    Pepanjang
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
</div>