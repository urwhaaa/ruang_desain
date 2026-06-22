<?php
session_start();

if(isset($_SESSION['user'])){

    header("Location: pemesanan.php");

}else{

    $_SESSION['redirect_after_login'] = 'pemesanan.php';

    header("Location: login.php");

}

exit;
?>