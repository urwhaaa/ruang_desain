<?php
$kategori = $_GET['kategori'] ?? 'semua';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Layanan Kami</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<?php include 'navbar.php'; ?>
<?php
if(isset($_GET['berhasil'])){
    echo "
    <script>
    alert('Produk berhasil ditambahkan ke keranjang');
    </script>
    ";
}
?>

<section class="page-title">
<h1>Layanan Desain</h1>
<p>Pilih layanan terbaik untuk kebutuhan bisnis Anda</p>
</section>

<?php
$kategori = $_GET['kategori'] ?? 'semua';
?>

<div class="kategori-menu">
    <a href="layanan.php?kategori=semua" class="<?= $kategori=='semua'?'aktif':'' ?>">Semua</a>

    <a href="layanan.php?kategori=logo" class="<?= $kategori=='logo'?'aktif':'' ?>">Logo</a>

    <a href="layanan.php?kategori=poster" class="<?= $kategori=='poster'?'aktif':'' ?>">Poster</a>

    <a href="layanan.php?kategori=feed" class="<?= $kategori=='feed'?'aktif':'' ?>">Feed IG</a>

    <a href="layanan.php?kategori=banner" class="<?= $kategori=='banner'?'aktif':'' ?>">Banner</a>

    <a href="layanan.php?kategori=uiux" class="<?= $kategori=='uiux'?'aktif':'' ?>">UI/UX</a>

    <a href="layanan.php?kategori=branding" class="<?= $kategori=='branding'?'aktif':'' ?>">Branding</a>
</div>

<section class="layanan-grid">
<?php if($kategori == 'semua' || $kategori == 'logo'): ?>
<div class="layanan-card logo"
onclick="openModal('logo')">
<img src="https://i.pinimg.com/736x/71/f4/39/71f4398426a645d009ab3cfe8a9d4641.jpg">
<h3>Desain Logo</h3>
<p>Logo profesional untuk UMKM dan perusahaan.</p>


<div class="action-btn">

<a href="paket.php?layanan=logo" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Desain%20Logo&harga=90000&gambar=logo.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'poster'): ?>
<div class="layanan-card poster" onclick="openModal('poster')">
<img class="layanan-img"src="https://i.pinimg.com/736x/eb/1d/65/eb1d650c45315882771aaf0ea29b06d2.jpg">
<h3>Desain Poster</h3>
<p>Poster promosi produk dan event.</p>


<div class="action-btn">

<a href="paket.php?layanan=poster" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Desain%20Poster&harga=50000&gambar=poster.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'feed'): ?>
<div class="layanan-card feed"
onclick="openModal('feed')">
<img src="https://i.pinimg.com/736x/93/66/47/936647fbb83ad7f6ae376ae354d37b1b.jpg">
<h3>Feed Instagram</h3>
<p>Feed Instagram modern dan menarik.</p>


<div class="action-btn">

<a href="paket.php?layanan=feed" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Feed%20Instagram&harga=70000&gambar=feed.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>
</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'banner'): ?>
<div class="layanan-card banner" onclick="openModal('banner')">
<img src="https://i.pinimg.com/1200x/57/93/71/579371d3b53cd1a215f5871ea648b2ee.jpg">
<h3>Banner</h3>
<p>Banner promosi online maupun offline.</p>


<div class="action-btn">

<a href="paket.php?layanan=banner" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Banner&harga=60000&gambar=banner.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'uiux'): ?>
<div class="layanan-card uiux"
onclick="openModal('uiux')">
<img src="https://i.pinimg.com/736x/83/b4/1c/83b41caad8b8f92639df49c6aec99fe2.jpg">
<h3>UI/UX Design</h3>
<p>Desain aplikasi dan website modern.</p>


<div class="action-btn">

<a href="paket.php?layanan=uiux" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=UI%2FUX%20Design&harga=250000&gambar=uiux.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'branding'): ?>
<div class="layanan-card branding"
onclick="openModal('branding')">
<img src="https://i.pinimg.com/736x/21/0a/b5/210ab53bbd9d48baa15548658da82af1.jpg">
<h3>Branding Kit</h3>
<p>Identitas visual lengkap untuk bisnis.</p>


<div class="action-btn">
<a href="paket.php?layanan=branding" class="btn-pesan">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Branding%20Kit&harga=300000&gambar=branding.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>
</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'logo'): ?>
<div class="layanan-card logo"
onclick="openModal('logo')">
<img src="https://i.pinimg.com/736x/71/f4/39/71f4398426a645d009ab3cfe8a9d4641.jpg">
<h3>Desain Logo</h3>
<p>Logo profesional untuk UMKM dan perusahaan.</p>


<div class="action-btn">

<a href="paket.php?layanan=logo" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Desain%20Logo&harga=90000&gambar=logo.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'poster'): ?>
<div class="layanan-card poster" onclick="openModal('poster')">
<img class="layanan-img"src="https://i.pinimg.com/736x/eb/1d/65/eb1d650c45315882771aaf0ea29b06d2.jpg">
<h3>Desain Poster</h3>
<p>Poster promosi produk dan event.</p>


<div class="action-btn">

<a href="paket.php?layanan=poster" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Desain%20Poster&harga=50000&gambar=poster.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'feed'): ?>
<div class="layanan-card feed"
onclick="openModal('feed')">
<img src="https://i.pinimg.com/736x/93/66/47/936647fbb83ad7f6ae376ae354d37b1b.jpg">
<h3>Feed Instagram</h3>
<p>Feed Instagram modern dan menarik.</p>


<div class="action-btn">

<a href="paket.php?layanan=feed" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Feed%20Instagram&harga=70000&gambar=feed.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>
</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'banner'): ?>
<div class="layanan-card banner" onclick="openModal('banner')">
<img src="https://i.pinimg.com/1200x/57/93/71/579371d3b53cd1a215f5871ea648b2ee.jpg">
<h3>Banner</h3>
<p>Banner promosi online maupun offline.</p>


<div class="action-btn">

<a href="paket.php?layanan=banner" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Banner&harga=60000&gambar=banner.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'uiux'): ?>
<div class="layanan-card uiux"
onclick="openModal('uiux')">
<img src="https://i.pinimg.com/736x/83/b4/1c/83b41caad8b8f92639df49c6aec99fe2.jpg">
<h3>UI/UX Design</h3>
<p>Desain aplikasi dan website modern.</p>


<div class="action-btn">

<a href="paket.php?layanan=uiux" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=UI%2FUX%20Design&harga=250000&gambar=uiux.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'branding'): ?>
<div class="layanan-card branding"
onclick="openModal('branding')">
<img src="https://i.pinimg.com/736x/21/0a/b5/210ab53bbd9d48baa15548658da82af1.jpg">
<h3>Branding Kit</h3>
<p>Identitas visual lengkap untuk bisnis.</p>


<div class="action-btn">
<a href="paket.php?layanan=branding" class="btn-pesan">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Branding%20Kit&harga=300000&gambar=branding.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>
</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'logo'): ?>
<div class="layanan-card logo"
onclick="openModal('logo')">
<img src="https://i.pinimg.com/736x/71/f4/39/71f4398426a645d009ab3cfe8a9d4641.jpg">
<h3>Desain Logo</h3>
<p>Logo profesional untuk UMKM dan perusahaan.</p>


<div class="action-btn">

<a href="paket.php?layanan=logo" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Desain%20Logo&harga=90000&gambar=logo.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'poster'): ?>
<div class="layanan-card poster" onclick="openModal('poster')">
<img class="layanan-img"src="https://i.pinimg.com/736x/eb/1d/65/eb1d650c45315882771aaf0ea29b06d2.jpg">
<h3>Desain Poster</h3>
<p>Poster promosi produk dan event.</p>


<div class="action-btn">

<a href="paket.php?layanan=poster" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Desain%20Poster&harga=50000&gambar=poster.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'feed'): ?>
<div class="layanan-card feed"
onclick="openModal('feed')">
<img src="https://i.pinimg.com/736x/93/66/47/936647fbb83ad7f6ae376ae354d37b1b.jpg">
<h3>Feed Instagram</h3>
<p>Feed Instagram modern dan menarik.</p>


<div class="action-btn">

<a href="paket.php?layanan=feed" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Feed%20Instagram&harga=70000&gambar=feed.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>
</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'banner'): ?>
<div class="layanan-card banner" onclick="openModal('banner')">
<img src="https://i.pinimg.com/1200x/57/93/71/579371d3b53cd1a215f5871ea648b2ee.jpg">
<h3>Banner</h3>
<p>Banner promosi online maupun offline.</p>


<div class="action-btn">

<a href="paket.php?layanan=banner" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Banner&harga=60000&gambar=banner.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'uiux'): ?>
<div class="layanan-card uiux"
onclick="openModal('uiux')">
<img src="https://i.pinimg.com/736x/83/b4/1c/83b41caad8b8f92639df49c6aec99fe2.jpg">
<h3>UI/UX Design</h3>
<p>Desain aplikasi dan website modern.</p>


<div class="action-btn">

<a href="paket.php?layanan=uiux" class="btn-primary">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=UI%2FUX%20Design&harga=250000&gambar=uiux.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>

</div>
</div>
<?php endif; ?>

<?php if($kategori == 'semua' || $kategori == 'branding'): ?>
<div class="layanan-card branding"
onclick="openModal('branding')">
<img src="https://i.pinimg.com/736x/21/0a/b5/210ab53bbd9d48baa15548658da82af1.jpg">
<h3>Branding Kit</h3>
<p>Identitas visual lengkap untuk bisnis.</p>


<div class="action-btn">
<a href="paket.php?layanan=branding" class="btn-pesan">
<i class="fa-solid fa-layer-group"></i>
Lihat Paket
</a>

<a href="tambah_keranjang.php?layanan=Branding%20Kit&harga=300000&gambar=branding.png"
class="btn-cart">
    <i class="fa-solid fa-cart-shopping"></i>
</a>
</div>
</div>
<?php endif; ?>
</section>
<?php include "footer.php"; ?>
</body>
</html>
