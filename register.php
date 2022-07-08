<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once ('./Controller/login.php');
require_once ('./Controller/database.php');

if( isset($_POST["register"])) {
    $register = new login();
     $result = $register->register($_POST);
  

    if( $result > 0  ){
        echo "<script>
               alert('User baru berhasil ditambahkan'); 
               location.href='login.php';
              </script>";
    }
    else{
        $db = new database();
        echo mysqli_error($db->__construct());
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="./asset/css/easion.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="../asset/js/chart-js-config.js"></script>
    <title>Our Perpus</title>
</head>

<body>
    <div class="form-screen">
        <a href="index.html" class="easion-logo"><i class="fas fa-book"></i> <span>OurBook</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white"> Create an account </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="jabatan_user" id="jabatan_user" placeholder="Jabatan User">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                   
                    <div class="form-group">
                        <input type="password" class="form-control"  name="password2" id="password2" placeholder="Ketik Ulang Password">
                    </div>
                    <div class="account-dialog-actions">
                        <button type="submit" class="btn btn-primary" name="register">Sign up</button>
                        <a class="account-dialog-link" href="./login.php">Already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./asset/js/easion.js"></script>
</body>

</html>