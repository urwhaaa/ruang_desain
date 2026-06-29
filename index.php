<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RUANG DESAIN</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



</head>
<body>

<?php include 'navbar.php'; ?>

<section class="hero">

    <div class="hero-text">

        <h1>
            Desain Profesional <br>
            untuk Brand Anda
        </h1>

        <p>
            Kami menyediakan berbagai layanan desain grafis
            kreatif untuk kebutuhan bisnis promosi dan
            personal anda.
        </p>

        <div class="btn-group">

           <a href="cek_login.php" class="btn-pesan">
    Pesan Sekarang
</a>

            <a href="portofolio.php" class="btn-outline">
                Lihat Portofolio
            </a>

        </div>

    </div>

    <div class="hero-image">

        <img src="https://i.pinimg.com/736x/da/92/f4/da92f4af481c962f005941649354887d.jpg">

    </div>

</section>

<section class="layanan">

    <div class="judul">

        <h2>Layanan Populer</h2>

        <a href="layanan.php">
            Lihat semua
        </a>

    </div>

    <div class="card-container">

        <div class="card">
            <a href="layanan.php?kategori=logo">
                <img src="https://i.pinimg.com/736x/2a/14/21/2a14215d7becdcf5668f97736ddd6cff.jpg">
                <h3>Desain Logo</h3>
                <p>Mulai dari Rp 90.000</p>
            </a>
        </div>

        <div class="card">
            <a href="layanan.php?kategori=poster">
                <img src="https://i.pinimg.com/736x/63/a6/b5/63a6b5f37cef65e7504dbf510a4ed6fe.jpg">
                <h3>Desain Poster</h3>
                <p>Mulai dari Rp 100.000</p>
            </a>
        </div>

        <div class="card">
            <a href="layanan.php?kategori=feed">
                <img src="https://i.pinimg.com/1200x/57/f7/c0/57f7c01a4dfdfba3ef5487b020c007a6.jpg">
                <h3>Desain Feed IG</h3>
                <p>Mulai dari Rp 70.000</p>
            </a>
        </div>

        <div class="card">
            <a href="layanan.php?kategori=banner">
                <img src="https://i.pinimg.com/736x/6c/01/5b/6c015b4ee758a3c11f69c67cb8b74965.jpg">
                <h3>Desain Banner</h3>
                <p>Mulai dari Rp 60.000</p>
            </a>
        </div>

    </div>

</section>

</body>
</html>