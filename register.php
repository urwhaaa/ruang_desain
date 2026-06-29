<?php
session_start();
include "koneksi.php";

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi,"
    SELECT * FROM users
    WHERE username='$username'
    ");

    if(mysqli_num_rows($cek)>0){

        $error = "Username sudah digunakan!";

    }else{

        mysqli_query($koneksi,"
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

        echo "
        <script>
        alert('Registrasi berhasil');
        window.location='login.php';
        </script>
        ";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="login-container">

<form method="POST" class="login-form">

<h2>Daftar Akun</h2>

<?php
if(isset($error)){
echo "<p style='color:red;'>$error</p>";
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
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="register">

Daftar

</button>

</form>

</div>

</body>
</html>