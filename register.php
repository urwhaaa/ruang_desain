<?php
session_start();
include "koneksi.php";

if(isset($_POST['register'])){

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi,"
    SELECT * FROM users
    WHERE username='$username'
    OR email='$email'
    ");

    if(mysqli_num_rows($cek)>0){

        $error = "Username atau Email sudah digunakan!";

    }else{

        $insert = mysqli_query($koneksi,"
        INSERT INTO users
        (nama,username,email,password)
        VALUES
        (
        '$nama',
        '$username',
        '$email',
        '$password'
        )
        ");

        if($insert){

            echo "
            <script>
            alert('Registrasi berhasil');
            window.location='login.php';
            </script>
            ";
            exit;

        }else{

            $error = "Registrasi gagal!";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#f4f6f9;
}

.login-container{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-form{
    width:380px;
    background:#fff;
    padding:35px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.login-form h2{
    text-align:center;
    margin-bottom:25px;
    color:#333;
    font-size:40px;
}

.login-form input{
    width:100%;
    padding:14px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
    font-size:15px;
    transition:.3s;
}

.login-form input:focus{
    border-color:#4f46e5;
    box-shadow:0 0 5px rgba(79,70,229,.3);
}

.password-box{
    position:relative;
}

.password-box input{
    padding-right:45px;
}

.toggle-eye{
    position:absolute;
    right:15px;
    top:42%;
    transform:translateY(-50%);
    cursor:pointer;
    color:#666;
    user-select:none;
}

.login-form button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#4f46e5;
    color:#fff;
    font-size:18px;
    cursor:pointer;
    transition:.3s;
}

.login-form button:hover{
    background:#4338ca;
}

.error{
    color:red;
    text-align:center;
    margin-bottom:15px;
    font-size:14px;
}

.login-form p{
    text-align:center;
    margin-top:18px;
    font-size:15px;
}

.login-form a{
    color:#4f46e5;
    text-decoration:none;
    font-weight:600;
}

.login-form a:hover{
    text-decoration:underline;
}

</style>

</head>
<body>

<div class="login-container">

<form method="POST" class="login-form" autocomplete="on">

<h2>Daftar Akun</h2>

<?php
if(isset($error)){
    echo "<p class='error'>$error</p>";
}
?>

<input
type="text"
name="nama"
placeholder="Nama Lengkap"
required>

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="email"
name="email"
placeholder="Email"
autocomplete="email"
required>

<div class="password-box">

<input
type="password"
name="password"
id="password"
placeholder="Password"
required>

<span class="toggle-eye" onclick="togglePassword()">👁</span>

</div>

<button
type="submit"
name="register">

Daftar

</button>

<p>
Sudah punya akun?
<a href="login.php">Login di sini</a>
</p>

</form>

</div>

<script>

function togglePassword(){

    const pw=document.getElementById("password");

    if(pw.type==="password"){
        pw.type="text";
    }else{
        pw.type="password";
    }

}

</script>

</body>
</html>