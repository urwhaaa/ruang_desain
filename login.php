<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi,"
    SELECT * FROM users
    WHERE username='$username'
    AND password='$password'
    ");

    if(mysqli_num_rows($query)>0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];

        if(isset($_SESSION['redirect_after_login'])){

            $redirect = $_SESSION['redirect_after_login'];

            unset($_SESSION['redirect_after_login']);

            header("Location: ".$redirect);

        }else{

            header("Location: profil.php");

        }

        exit;

    }else{

        $error = "Username atau Password salah!";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="login-container">

<form method="POST" class="login-form">

<h2>Login</h2>

<?php
if(isset($error)){
echo "<p style='color:red;'>$error</p>";
}
?>

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">

Login

</button>

</form>

</div>

</body>
</html>