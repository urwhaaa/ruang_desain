<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id=$_SESSION['user_id'];
$filter = $_GET['filter'] ?? 'Semua';
// tandai semua sudah dibaca
mysqli_query($koneksi,"
UPDATE notifikasi
SET status='dibaca'
WHERE user_id='$user_id'
");

if($filter == "Semua"){

    $sql = "
    SELECT *
    FROM notifikasi
    WHERE user_id='$user_id'
    ORDER BY id DESC
    ";

}else{

    $sql = "
    SELECT *
    FROM notifikasi
    WHERE user_id='$user_id'
    AND jenis='$filter'
    ORDER BY id DESC
    ";

}

$data = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Notifikasi</title>

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include "navbar.php"; ?>

<section class="page-title">

<h1>Notifikasi</h1>

<p>Semua aktivitas akun Anda</p>

</section>
<?php
$filter = $_GET['filter'] ?? 'Semua';
?>

<div class="notif-filter">

    <a href="?filter=Semua" class="<?= ($filter=='Semua') ? 'active' : '' ?>">Semua</a>

    <a href="?filter=Pesanan" class="<?= ($filter=='Pesanan') ? 'active' : '' ?>">Pesanan</a>

    <a href="?filter=Pembayaran" class="<?= ($filter=='Pembayaran') ? 'active' : '' ?>">Pembayaran</a>

    <a href="?filter=Diproses" class="<?= ($filter=='Diproses') ? 'active' : '' ?>">Diproses</a>

    <a href="?filter=Revisi" class="<?= ($filter=='Revisi') ? 'active' : '' ?>">Revisi</a>

    <a href="?filter=File" class="<?= ($filter=='File') ? 'active' : '' ?>">File</a>

    <a href="?filter=Selesai" class="<?= ($filter=='Selesai') ? 'active' : '' ?>">Selesai</a>

    <a href="?filter=Dibatalkan" class="<?= ($filter=='Dibatalkan') ? 'active' : '' ?>">Dibatalkan</a>

</div>
<div class="notif-page">

<?php

if(mysqli_num_rows($data)==0){

echo "

<div class='notif-kosong'>

<i class='fa-regular fa-bell-slash'></i>

<h3>Belum ada notifikasi</h3>

<p>Semua pemberitahuan akan muncul di sini.</p>

</div>

";

}

while($n=mysqli_fetch_assoc($data)){

?>

<div class="notif-card">

<div class="notif-icon">

<i class="fa-solid fa-bell"></i>

</div>

<div class="notif-content">

<p><?= $n['pesan']; ?></p>

<span><?= date("d M Y H:i",strtotime($n['created_at'])); ?></span>

</div>
</div>

<?php } ?>

</div>

</body>
</html>