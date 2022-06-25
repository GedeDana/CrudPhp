<?php
// $host = 'localhost';
// $username = 'root';
// $password = '';
// $db_name = 'perpustakan';

// $conn = mysqli_connect($host, $username, $password, $db_name);

// if(!$conn) {
//     echo "Koneksi gagal: ". mysqli_connect_error();;
// }

class database {

    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'perpustakan';
    private $koneksi;

    function __construct()
    {   
        $this->koneksi = mysqli_connect(
         $this->hostname,
         $this->username,
         $this->password,
         $this->db_name,
        );

        if($this->koneksi) {
            return $this->koneksi;
        } else {
            echo "Koneksi Gagal";
        }
    }
}



?>