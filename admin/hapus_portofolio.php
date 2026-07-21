<?php
include "auth.php";
include "../koneksi.php";

$id = (int)$_GET['id'];

// Ambil nama gambar
$q = mysqli_query($koneksi, "SELECT gambar FROM portofolio WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if($data){
    $file = "../assets/css/img/portofolio/".$data['gambar'];

    if(file_exists($file)){
        unlink($file);
    }

    mysqli_query($koneksi, "DELETE FROM portofolio WHERE id='$id'");
}

header("Location: portofolio.php");
exit;