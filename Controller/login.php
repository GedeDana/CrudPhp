<?php 

require_once 'database.php';

class login extends database {
    function register ($data) {
      
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string(parent::__construct(), $data["password"]);
        $password2 = mysqli_real_escape_string(parent::__construct(), $data["password2"]);
        $jabatanUser = strtolower(stripslashes($data["jabatan_user"]));
        // cek username sudah ada/blom
        $result = mysqli_query(parent::__construct(), "SELECT username from user WHERE
                    username = '$username'");
    
        // var_dump($result);            
    
        if (mysqli_fetch_assoc($result) ){
            echo "<script>  
                    alert('Username yang digunakan sudah terdaftar!')
                  </script>";
            return false;
        }
    
        // cek konfirmasi password
        if ( $password !== $password2 ){
            echo "<script>
                      alert('password tidak sesuai');  
                  </script>";
    
            return false;
        }
        // enksripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        
    
        //    tambahkan user baru ke database
        mysqli_query(parent::__construct(), "INSERT INTO  user (username, jabatan_user,password) VALUES('$username','$jabatanUser','$password')");
    
        mysqli_affected_rows(parent::__construct());

        return true;
    }


}
