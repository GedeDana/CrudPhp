<?php

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