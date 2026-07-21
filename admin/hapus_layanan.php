<?php
include "auth.php";
include "../koneksi.php";

$id = (int)$_GET['id'];

$q = mysqli_query($koneksi,"SELECT gambar FROM layanan WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if($data){

    $file = "../assets/css/img/layanan/".$data['gambar'];

    if(file_exists($file)){
        unlink($file);
    }

    mysqli_query($koneksi,"DELETE FROM layanan WHERE id='$id'");
}

header("Location: layanan.php");
exit;