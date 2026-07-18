<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data dari URL
$id = (int)($_GET['id'] ?? 0);

$query = mysqli_query($koneksi,"
SELECT
    layanan.nama_layanan,
    layanan.gambar,
    paket.nama_paket,
    paket.harga
FROM paket
JOIN layanan
ON layanan.id = paket.layanan_id
WHERE paket.id='$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data paket tidak ditemukan.");
}

$layanan = $data['nama_layanan'];
$paket   = $data['nama_paket'];
$harga   = $data['harga'];
$gambar  = $data['gambar'];

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