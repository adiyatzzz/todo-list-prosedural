<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "todolist");

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT*FROM admin WHERE user = '$username' AND pass = '$password' ");

    if (mysqli_num_rows($result) > 0) {
            // set session
            $username = $_POST["username"];
            $_SESSION["loginAdmin"] = true;
            header("Location: index.php");
            exit;
    }

    $error = true;
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>admin-todo</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-image: url(&quot;assets/img/mountain_bg.jpg&quot;);">
    <div class="login-clean" style="background: transparent;">
        <form method="post" action="">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-android-person" style="color: rgb(21,18,176);"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group" ><button class="btn btn-primary btn-block" type="submit" style="background: rgb(21,18,176);" name="login">Log In</button></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>