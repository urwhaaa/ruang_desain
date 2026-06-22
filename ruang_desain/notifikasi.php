<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifikasi</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <h1>Notifikasi</h1>
    <p>Informasi terbaru mengenai akun dan pesanan Anda</p>
</section>

<section class="notif-container">

    <div class="notif-card">
        <i class="fa-solid fa-circle-check"></i>

        <div>
            <h3>Pesanan Berhasil Dibuat</h3>
            <p>Pesanan Desain Logo Anda telah diterima.</p>
            <span>5 menit lalu</span>
        </div>
    </div>

    <div class="notif-card">
        <i class="fa-solid fa-pen-ruler"></i>

        <div>
            <h3>Pesanan Sedang Diproses</h3>
            <p>Tim desainer sedang mengerjakan pesanan Anda.</p>
            <span>1 jam lalu</span>
        </div>
    </div>

    <div class="notif-card">
        <i class="fa-solid fa-download"></i>

        <div>
            <h3>Desain Selesai</h3>
            <p>File desain siap diunduh.</p>
            <span>Kemarin</span>
        </div>
    </div>

</section>

</body>
</html>