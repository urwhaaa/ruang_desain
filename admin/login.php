<?php
session_start();
include "../koneksi.php";

if(isset($_SESSION['admin_id'])){
    header("Location: dashboard.php");
    exit;
}

$error = "";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi,"
        SELECT * FROM admin
        WHERE username='$username'
        AND password='$password'
    ");

    if(mysqli_num_rows($query) > 0){

        $admin = mysqli_fetch_assoc($query);

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        header("Location: dashboard.php");
        exit;

    }else{

        $error = "Username atau Password salah!";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Admin</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f5f6fa;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.login-box{

width:380px;
background:white;
padding:35px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.1);

}

.login-box h2{

text-align:center;
margin-bottom:25px;
color:#6c5ce7;

}

.input-group{

margin-bottom:18px;

}

.input-group label{

display:block;
margin-bottom:8px;
font-weight:bold;

}

.input-group input{

width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:8px;
outline:none;

}

.input-group input:focus{

border-color:#6c5ce7;

}

button{

width:100%;
padding:12px;
background:#6c5ce7;
color:white;
border:none;
border-radius:8px;
font-size:16px;
cursor:pointer;

}

button:hover{

background:#5848c2;

}

.error{

background:#ffdede;
color:#c0392b;
padding:10px;
border-radius:8px;
margin-bottom:15px;
text-align:center;

}

</style>

</head>

<body>

<div class="login-box">

<h2>

<i class="fa-solid fa-user-shield"></i>

Login Admin

</h2>

<?php if($error!=""){ ?>

<div class="error">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<div class="input-group">

<label>Username</label>

<input
type="text"
name="username"
required>

</div>

<div class="input-group">

<label>Password</label>

<input
type="password"
name="password"
required>

</div>

<button
type="submit"
name="login">

<i class="fa-solid fa-right-to-bracket"></i>

Login

</button>

</form>

</div>

</body>
</html>