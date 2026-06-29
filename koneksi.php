<?php

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "ruang_desain"
);

if(!$koneksi){
    die("Koneksi database gagal!");
}

?>