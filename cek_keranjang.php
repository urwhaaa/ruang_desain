<?php
session_start();

if(isset($_SESSION['user'])){

    header("Location: keranjang.php");

}else{

    $_SESSION['redirect_after_login'] = 'keranjang.php';

    header("Location: login.php");

}

exit;
?>