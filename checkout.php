<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if(empty($_POST['keranjang'])){
    echo "<script>
    alert('Silakan pilih minimal satu layanan.');
    window.location='keranjang.php';
    </script>";
    exit;
}

$user_id = $_SESSION['user_id'];

$idKeranjang = array_map('intval', $_POST['keranjang']);
$idList = implode(",", $idKeranjang);

$query = mysqli_query($koneksi,"
SELECT *
FROM keranjang
WHERE user_id='$user_id'
AND id IN ($idList)
");

$data = [];
$totalHarga = 0;

while($row = mysqli_fetch_assoc($query)){

    $row['subtotal'] = $row['harga'] * $row['jumlah'];

    $totalHarga += $row['subtotal'];

    $data[] = $row;
}

if(count($data) == 1){

    $item = $data[0];

    header("Location: pemesanan.php?layanan="
        . urlencode($item['layanan'])
        . "&paket=Checkout"
        . "&harga=" . $item['subtotal']);

    exit;
}

$_SESSION['checkout'] = $data;
$_SESSION['checkout_id'] = $idList;
$_SESSION['total_harga'] = $totalHarga;

header("Location: pemesanan_checkout.php");
exit;