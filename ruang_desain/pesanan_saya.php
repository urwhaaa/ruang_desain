<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesanan Saya</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <h1>Pesanan Saya</h1>
    <p>Daftar seluruh pesanan yang pernah dibuat</p>
</section>

<section class="orders-container">

    <div class="order-card">

        <div class="order-header">
            <h3>Desain Logo</h3>
            <span class="status proses">
                Sedang Diproses
            </span>
        </div>

        <p><b>ID Pesanan :</b> #ORD001</p>
        <p><b>Tanggal :</b> 20 Juni 2026</p>
        <p><b>Total :</b> Rp 90.000</p>

        <div class="order-footer">
            <a href="#">Lihat Detail</a>
        </div>

    </div>

    <div class="order-card">

        <div class="order-header">
            <h3>Desain Poster</h3>
            <span class="status selesai">
                Selesai
            </span>
        </div>

        <p><b>ID Pesanan :</b> #ORD002</p>
        <p><b>Tanggal :</b> 18 Juni 2026</p>
        <p><b>Total :</b> Rp 100.000</p>

        <div class="order-footer">
            <a href="#">Download File</a>
        </div>

    </div>

</section>

</body>
</html>