<?php
$kategori = $_GET['kategori'] ?? 'semua';
?>
<?php
include "koneksi.php";

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

<a href="layanan.php?kategori=semua"
class="<?= $kategori=='semua'?'aktif':'' ?>">
Semua
</a>

<?php

$qKategori=mysqli_query($koneksi,"
SELECT DISTINCT kategori
FROM layanan
ORDER BY kategori
");

while($k=mysqli_fetch_assoc($qKategori)){

?>

<a
href="layanan.php?kategori=<?= urlencode($k['kategori']); ?>"
class="<?= $kategori==$k['kategori']?'aktif':'' ?>">

<?= $k['kategori']; ?>

</a>

<?php } ?>

</div>

<section class="layanan-grid">
<?php

$sql="SELECT * FROM layanan";

if($kategori!="semua"){

$sql.=" WHERE kategori='$kategori'";

}

$sql.=" ORDER BY id DESC";

$data=mysqli_query($koneksi,$sql);

while($row=mysqli_fetch_assoc($data)){

?>

<div class="layanan-card">

<img src="<?= $row['gambar']; ?>">

<h3><?= $row['nama_layanan']; ?></h3>

<p><?= $row['deskripsi']; ?></p>

<div class="action-btn">

<a
href="paket.php?id=<?= $row['id']; ?>"
class="btn-primary">

<i class="fa-solid fa-layer-group"></i>

Lihat Paket

</a>

</div>

</div>

<?php } ?>
</section>
<?php include "footer.php"; ?>
</body>
</html>
