<?php
session_start();
include "koneksi.php";

$id = $_POST['id'];
$aksi = $_POST['aksi'];

$data = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

$jumlah = $row['jumlah'];

if($aksi=="plus"){
    $jumlah++;
}

if($aksi=="minus" && $jumlah>1){
    $jumlah--;
}

mysqli_query($koneksi,"
UPDATE keranjang
SET jumlah='$jumlah'
WHERE id='$id'
");

echo json_encode([
    "success"=>true,
    "jumlah"=>$jumlah
]);