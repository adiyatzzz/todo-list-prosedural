<?php 
$conn = mysqli_connect("localhost", "root", "", "todolist");

if (isset($_POST["daftar"])) {
    $username = strtolower($_POST["username"]);
    $password = strtolower($_POST["password"]);
    $password2 = strtolower($_POST["password2"]);
    
    // cek adakah nama user yang sama
    $userSudahAda = mysqli_query($conn, "SELECT user FROM user WHERE user = '$username'");
    if ($username == "admin") {
        echo "<script>
                    alert('Gunakan nama lain');
                    location.replace('signup.php');
                 </script>";
         return false;
    }
    if (mysqli_fetch_assoc($userSudahAda)) {
        echo "<script>
                    alert('Username tidak bisa digunakan');
                    location.replace('signup.php');
                 </script>";
         return false;
    }

    // cek apakah pass beda
    if ($password != $password2) {
        echo "<script>
                    alert('Konfirmasi password salah');
                     location.replace('signup.php'); 
                 </script>";
        return false;
    }

    // masukkan user baru
    mysqli_query($conn,"INSERT INTO user VALUES ('', '$username', '$password')");

    // membuat  table baru
    $sql = "CREATE TABLE $username (
              id int(11) AUTO_INCREMENT PRIMARY KEY,
              `task` varchar(1000) NOT NULL,
              `tanggal` date NOT NULL,
              `waktu` time NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
    

    if (mysqli_query($conn,$sql)) {
        echo "<script>
                    alert('Akun sudah di buat');
                     location.replace('login.php'); 
                 </script>";
    }



}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>newtodo</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body  style="background-image: linear-gradient(to bottom right, #97fe7d, 50%, #00bc8c);">
    <div class="login-dark" style="">
        <form class="shadow-lg" method="post" action="">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-key"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" required="" placeholder="Username"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><input class="form-control" type="password" name="password2" placeholder="Confirm password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="daftar">Sign Up</button></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>