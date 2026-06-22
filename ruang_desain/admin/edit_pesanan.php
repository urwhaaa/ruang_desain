<?php

include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi,
"SELECT * FROM pesanan WHERE id='$id'");

$row = mysqli_fetch_assoc($data);

if(isset($_POST['simpan'])){

    $status = $_POST['status'];

    mysqli_query($koneksi,
    "UPDATE pesanan
    SET status='$status'
    WHERE id='$id'");

    header("Location: pesanan.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Status</title>

<link rel="stylesheet" href="../assets/css/admin.css">

</head>
<body>

<div class="edit-box">

<h2>Edit Status Pesanan</h2>

<form method="POST">

<label>Status</label>

<select name="status">

<option value="Menunggu">Menunggu</option>

<option value="Diproses">Diproses</option>

<option value="Revisi">Revisi</option>

<option value="Selesai">Selesai</option>

</select>

<button type="submit" name="simpan">
Simpan
</button>

</form>

</div>

</body>
</html>