<?php
include "koneksi.php";

$id = $_POST['id'];
$status = $_POST['status'];

mysqli_query($koneksi,"
UPDATE keranjang
SET checked='$status'
WHERE id='$id'
");

echo "ok";