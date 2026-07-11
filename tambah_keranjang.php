<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data dari URL
$layanan = mysqli_real_escape_string($koneksi, $_GET['layanan'] ?? '');
$paket   = mysqli_real_escape_string($koneksi, $_GET['paket'] ?? '');
$harga   = (int)($_GET['harga'] ?? 0);
$gambar  = mysqli_real_escape_string($koneksi, $_GET['gambar'] ?? '');

// Validasi
if($layanan == "" || $paket == "" || $harga <= 0){
    die("Data layanan tidak lengkap.");
}

// Cek apakah layanan + paket sudah ada
$cek = mysqli_query($koneksi,"
SELECT id
FROM keranjang
WHERE user_id='$user_id'
AND layanan='$layanan'
AND paket='$paket'
");

if(mysqli_num_rows($cek) == 0){

    $insert = mysqli_query($koneksi,"
    INSERT INTO keranjang
    (
        user_id,
        layanan,
        paket,
        harga,
        gambar,
        jumlah
    )
    VALUES
    (
        '$user_id',
        '$layanan',
        '$paket',
        '$harga',
        '$gambar',
        '1'
    )
    ");

    if(!$insert){
        die(mysqli_error($koneksi));
    }

}else{

    // Kalau layanan + paket sudah ada, tambah jumlahnya
    mysqli_query($koneksi,"
    UPDATE keranjang
    SET jumlah = jumlah + 1
    WHERE user_id='$user_id'
    AND layanan='$layanan'
    AND paket='$paket'
    ");

}

header("Location: paket.php?layanan=logo&success=1");
exit;