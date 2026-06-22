<?php
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // LOGIN SEMENTARA
    if($username == "user" && $password == "123"){

        $_SESSION['user'] = $username;

        if(isset($_SESSION['redirect_after_login'])){

            $redirect = $_SESSION['redirect_after_login'];

            unset($_SESSION['redirect_after_login']);

            header("Location: ".$redirect);

        }else{

            header("Location: profil.php");

        }

        exit;
    }

    $error = "Username atau Password salah!";
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

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>