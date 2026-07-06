<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi,"
        SELECT * FROM users
        WHERE email='$email'
        AND password='$password'
    ");

    if(mysqli_num_rows($query)>0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $data['id'];
        $_SESSION['user'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['email'] = $data['email'];

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

<style>
body{
    font-family: Poppins, sans-serif;
    background: #f4f6f9;
}

/* wrapper biar center */
.login-wrapper{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* card login */
.login-box{
    width: 320px;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: center;
}

/* judul */
.login-box h2{
    margin-bottom: 20px;
}

/* input */
.login-box input{
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
}

/* tombol login */
.login-box button{
    width: 100%;
    padding: 12px;
    background: #4f46e5;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.login-box button:hover{
    background: #4338ca;
}

/* password box */
.password-box{
    position: relative;
}

.password-box input{
    padding-right: 40px;
}

/* icon mata */
.toggle-eye{
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

/* error */
.error-msg{
    color: red;
    margin-bottom: 10px;
    font-size: 14px;
}
.password-box{
    position: relative;
}

.password-box input{
    width: 100%;
    padding: 12px 40px 12px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    box-sizing: border-box;
}

.toggle-eye{
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 16px;
    color: #666;
    z-index: 10;
    user-select: none;
}
</style>
</head>
<body>
<div class="login-wrapper">

    <div class="login-box">

        <h2>Login</h2>

        <?php
        if(isset($error)){
            echo "<p class='error-msg'>$error</p>";
        }
        ?>
<form method="POST" autocomplete="on">

    <input type="email" name="email" placeholder="Email" required autocomplete="email">

  <div class="password-box">
    <input type="password" name="password" id="password" placeholder="Password" required>

    <span class="toggle-eye" onclick="togglePassword()">👁</span>
</div>

    <button type="submit" name="login">Login</button>

<p style="margin-top:15px; text-align:center;">
    Belum punya akun?
    <a href="register.php">Daftar di sini</a>
</p>
</form>

    </div>

</div>
<script>

function togglePassword(){
    const pw = document.getElementById("password");
    pw.type = pw.type === "password" ? "text" : "password";
}
</script>

</body>
</html>