<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'perpustakan';

$conn = mysqli_connect($host, $username, $password, $db_name);

if(!$conn) {
    echo "Koneksi gagal: ". mysqli_connect_error();;
}

?>