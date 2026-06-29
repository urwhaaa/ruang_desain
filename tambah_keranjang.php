<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$layanan = $_GET['layanan'];
$harga   = $_GET['harga'];
$gambar  = $_GET['gambar'];

// Cek apakah produk sudah ada di keranjang
$cek = mysqli_query($koneksi,"
SELECT *
FROM keranjang
WHERE user_id='$user_id'
AND layanan='$layanan'
");

if(mysqli_num_rows($cek) == 0){

    $insert = mysqli_query($koneksi,"
    INSERT INTO keranjang
    (
        user_id,
        layanan,
        harga,
        gambar
    )
    VALUES
    (
        '$user_id',
        '$layanan',
        '$harga',
        '$gambar'
    )
    ");

}

header("Location: layanan.php?berhasil=1");
exit;