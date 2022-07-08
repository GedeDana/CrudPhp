<?php 

session_start();
require_once './Controller/database.php';

$db = new database();
$db = $db->__construct();

// cek cookie 
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id_user = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil user berdasarkan id 
  
    $sql = "SELECT username FROM user WHERE id_user = $id_user";
    $result = mysqli_query($db, $sql);



    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256',$row['username'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
    }
    
}

if ( isset($_SESSION["login"])) {
    
    header("location: index.php");
    exit;
}

if( isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
  
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db,$sql);

    // cek username

    if(mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])) {
            // set seccion
            $_SESSION["login"] = true;
            $_SESSION['username'] = $username;
            // cek jika remember me di checklist 
            if( isset($_POST['remember'])){

        
                setcookie('key', hash('sha256', $row['username']), time()+3600);
                setcookie('id', $row['id_user'], time()+3600);
             
            }

          
            header("location: index.php");
            exit;
        }

    }

    $error = true;
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
    <script src="./asset/js/chart-js-config.js"></script>
    <title>Our Book</title>
</head>

<body>
    <div class="form-screen">
        <a href="index.html" class="easion-logo"><i class="fas fa-book"></i> <span>OurPerpus</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white"> Please sign in </div>
            <?php if( isset($error)) :?>
                <p style="color: red; display:flex; align-items: center; justify-content:center; padding-top: 30px;">Username / Password Salah</p>
            <?php endif; ?>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control"  name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
              
                            <input type="checkbox" name="remember" id="remember">
                            <label for="customCheck1">Remember me</label>
                        </div>
                    </div>
                    <div class="account-dialog-actions">
                        <button type="submit" class="btn btn-primary" name="login">Sign in</button>
                        <a class="account-dialog-link" href="./register.php">Create a new account</a>
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