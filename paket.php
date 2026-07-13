<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$qLayanan = mysqli_query($koneksi,"
SELECT *
FROM layanan
WHERE id='$id'
");

if(mysqli_num_rows($qLayanan)==0){

    die("Layanan tidak ditemukan");

}

$layanan = mysqli_fetch_assoc($qLayanan);

$nama_layanan = $layanan['nama_layanan'];
$gambar        = $layanan['gambar'];
$deskripsi     = $layanan['deskripsi'];

$basic = 0;
$standar = 0;
$premium = 0;

$qPaket = mysqli_query($koneksi,"
SELECT *
FROM paket
WHERE layanan_id='$id'
");

while($p=mysqli_fetch_assoc($qPaket)){

    if($p['nama_paket']=="Basic"){
        $basic=$p['harga'];
    }

    if($p['nama_paket']=="Standar"){
        $standar=$p['harga'];
    }

    if($p['nama_paket']=="Premium"){
        $premium=$p['harga'];
    }

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
<style> 
    /* Overlay */
.popup-overlay{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.45);
    z-index: 9998;
}

/* Popup */
.popup-success{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 380px;
    background: #fff;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 15px 40px rgba(0,0,0,.2);
    z-index: 9999;
    animation: popupShow .3s ease;
}

.popup-success i{
    font-size: 65px;
    color: #22c55e;
    margin-bottom: 15px;
}

.popup-success h3{
    margin: 0;
    font-size: 24px;
    color: #222;
}

.popup-success p{
    margin: 12px 0 25px;
    color: #666;
    font-size: 15px;
}

.popup-success button{
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: #7c3aed;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
}

.popup-success button:hover{
    background: #6d28d9;
}

@keyframes popupShow{
    from{
        opacity:0;
        transform:translate(-50%,-45%) scale(.9);
    }
    to{
        opacity:1;
        transform:translate(-50%,-50%) scale(1);
    }
}
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">

<h1><?= $nama_layanan; ?></h1>

<p>
    Harga Paket Dapat Berubah Sesuai Jenis Layanan Yang Dipilih. Silahkan Pilih Paket Terbaik Sesuai Kebutuhan Anda!
</p>

<section class="package-grid">


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

<div class="package-action">

<a href="cek_login.php?id=<?= $id ?>&paket=Basic" class="btn-primary">
    Pesan Sekarang
</a>

<a href="tambah_keranjang.php?id=<?= $id ?>&paket=Basic" class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>


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

<div class="package-action">

<a href="cek_login.php?id=<?= $id ?>&paket=Standar" class="btn-primary">
    Pesan Sekarang
</a>

<a href="tambah_keranjang.php?id=<?= $id ?>&paket=Standar" class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>

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

<div class="package-action">

<a href="cek_login.php?id=<?= $id ?>&paket=Premium" class="btn-primary">
    Pesan Sekarang
</a>

<a href="tambah_keranjang.php?id=<?= $id ?>&paket=Premium" class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>

</div>
</section>
</section>
<?php include "footer.php"; ?>
<?php if(isset($_GET['success'])): ?>

<div id="popupOverlay" class="popup-overlay"></div>

<div id="popupSuccess" class="popup-success">
    <i class="fa-solid fa-circle-check"></i>
    <h3>Berhasil!</h3>
    <p>Paket berhasil ditambahkan ke keranjang.</p>

    <button onclick="tutupPopup()">OK</button>
</div>

<script>
function tutupPopup(){
    document.getElementById("popupOverlay").style.display = "none";
    document.getElementById("popupSuccess").style.display = "none";
}
</script>

<?php endif; ?>
</body>
</html>