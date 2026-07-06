<?php
$layanan = $_GET['layanan'] ?? '';

$mode_info = empty($layanan);
switch($layanan){

    case "logo":
        $nama_layanan = "Desain Logo";
        break;

    case "poster":
        $nama_layanan = "Desain Poster";
        break;

    case "feed":
        $nama_layanan = "Feed Instagram";
        break;

    case "banner":
        $nama_layanan = "Banner";
        break;

    case "uiux":
        $nama_layanan = "UI/UX Design";
        break;

    case "branding":
        $nama_layanan = "Branding Kit";
        break;

    default:
        $nama_layanan = "Layanan Desain";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Paket Desain</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">

<h1><?= $nama_layanan; ?></h1>

<p>
    Harga Paket Dapat Berubah Sesuai Jenis Layanan Yang Dipilih. Silahkan Pilih Paket Terbaik Sesuai Kebutuhan Anda!
</p>

<section class="package-grid">

<?php

if($layanan=="logo"){

$basic=90000;
$standar=150000;
$premium=250000;

}elseif($layanan=="poster"){

$basic=50000;
$standar=100000;
$premium=180000;

}elseif($layanan=="feed"){

$basic=70000;
$standar=120000;
$premium=200000;

}elseif($layanan=="banner"){

$basic=60000;
$standar=120000;
$premium=180000;

}elseif($layanan=="uiux"){

$basic=250000;
$standar=500000;
$premium=800000;

}elseif($layanan=="branding"){

$basic=300000;
$standar=500000;
$premium=800000;

}else{

$basic=0;
$standar=0;
$premium=0;

}

?>

<div class="package-card">

<h3>BASIC</h3>

<div class="price">
Rp <?= number_format($basic,0,",","."); ?>
</div>

<ul>
<li>✓ 1 Desain</li>
<li>✓ 1 Kali Revisi</li>
<li>✓ File JPG / PNG</li>
<li>✓ Pengerjaan 2 Hari</li>
</ul>

<?php if($mode_info){ ?>

<a href="layanan.php" class="btn-primary">
    Lihat Layanan
</a>

<?php } else { ?>

<a href="cek_login.php?layanan=<?= urlencode($nama_layanan) ?>&paket=Basic&harga=<?= $basic ?>" class="btn-primary">
    Pesan Sekarang
</a>

<?php } ?>

</div>



<div class="package-card premium">

<span class="best">TERLARIS</span>

<h3>STANDAR</h3>

<div class="price">
Rp <?= number_format($standar,0,",","."); ?>
</div>

<ul>
<li>✓ 3 Desain</li>
<li>✓ 3 Kali Revisi</li>
<li>✓ File Source</li>
<li>✓ Prioritas Pengerjaan</li>
<li>✓ Mockup Gratis</li>
</ul>

<?php if($mode_info){ ?>

<a href="layanan.php" class="btn-primary">
    Lihat Layanan
</a>

<?php } else { ?>

<a href="cek_login.php?layanan=<?= urlencode($nama_layanan) ?>&paket=Standar&harga=<?= $standar ?>" class="btn-primary">
    Pesan Sekarang
</a>

<?php } ?>

</div>



<div class="package-card">

<h3>PREMIUM</h3>

<div class="price">
Rp <?= number_format($premium,0,",","."); ?>
</div>

<ul>
<li>✓ Unlimited Revisi</li>
<li>✓ File Source</li>
<li>✓ Prioritas Utama</li>
<li>✓ Konsultasi Gratis</li>
<li>✓ Bonus Branding Kit</li>
</ul>

<?php if($mode_info){ ?>

<a href="layanan.php" class="btn-primary">
    Lihat Layanan
</a>

<?php } else { ?>

<a href="cek_login.php?layanan=<?= urlencode($nama_layanan) ?>&paket=Premium&harga=<?= $premium ?>" class="btn-primary">
    Pesan Sekarang
</a>

<?php } ?>
</div>
</section>
</section>
<?php include "footer.php"; ?>
</body>
</html>