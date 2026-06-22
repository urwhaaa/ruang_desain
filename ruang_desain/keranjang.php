<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keranjang Saya</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <h1>Keranjang Saya</h1>
    <p>Daftar layanan yang akan Anda pesan</p>
</section>

<section class="cart-container">
    

    <div class="cart-items">

        <div class="cart-card">

            <img src="assets/img/logo.png">

            <div class="cart-info">
                <h3>Desain Logo</h3>
                <p>Paket Basic</p>
                <span>Rp 90.000</span>
            </div>

            <div class="cart-action">
                <button class="hapus">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

        </div>

        <div class="cart-card">

            <img src="assets/img/poster.png">

            <div class="cart-info">
                <h3>Desain Poster</h3>
                <p>Paket Standar</p>
                <span>Rp 100.000</span>
            </div>

            <div class="cart-action">
                <button class="hapus">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

        </div>

    </div>

    <div class="cart-summary">

        <h2>Ringkasan Pesanan</h2>

        <div class="summary-item">
            <span>Total Layanan</span>
            <strong>2</strong>
        </div>

        <div class="summary-item">
            <span>Total Harga</span>
            <strong>Rp 190.000</strong>
        </div>

        <a href="pemesanan.php" class="checkout-btn">
            Lanjut Pemesanan
        </a>

    </div>

</section>

</body>
</html>
