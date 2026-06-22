<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pemesanan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <div class="order-banner">

    <i class="fa-solid fa-pen-ruler"></i>

    <div>
        <h3>Pesan Layanan Desain</h3>
        <p>Isi data berikut untuk memulai proyek desain Anda.</p>
    </div>

</div>
</section>

<section class="order-container">

<form class="order-form" action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" placeholder="Masukkan nama lengkap">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" placeholder="Masukkan email">
    </div>

    <div class="form-group">
        <label>No HP / WhatsApp</label>
        <input type="text" placeholder="08xxxxxxxxxx">
    </div>

    <div class="form-group">
        <label>Jenis Layanan</label>
        <select>
            <option>Desain Logo</option>
            <option>Desain Poster</option>
            <option>Feed Instagram</option>
            <option>Banner</option>
        </select>
    </div>

    <div class="form-group">
        <label>Deskripsi Pesanan</label>
        <textarea rows="5" placeholder="Jelaskan kebutuhan desain Anda"></textarea>
    </div>

    <div class="form-group">
        <label>Upload Referensi</label>
        <input type="file">
    </div>

    <div class="form-group">
        <label>Metode Pembayaran</label>

        <div class="payment-method">
            <label><input type="radio" name="bayar"> Transfer Bank</label>
            <label><input type="radio" name="bayar"> E-Wallet</label>
        </div>
    </div>

    <button type="submit" class="order-btn">
        Kirim Pesanan
    </button>

</form>

</section>

</body>
</html>