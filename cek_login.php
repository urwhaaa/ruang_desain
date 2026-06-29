<?php
session_start();

$layanan = $_GET['layanan'] ?? '';
$paket   = $_GET['paket'] ?? '';
$harga   = $_GET['harga'] ?? '';

$url = "pemesanan.php?layanan=" . urlencode($layanan) .
       "&paket=" . urlencode($paket) .
       "&harga=" . urlencode($harga);

if(isset($_SESSION['user'])){

    header("Location: $url");

}else{

    $_SESSION['redirect_after_login'] = $url;

    header("Location: login.php");

}

exit;
?>