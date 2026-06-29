<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Saya</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <h1>Profil Saya</h1>
    <p>Kelola akun dan pesanan Anda</p>
</section>

<section class="profile-container">

    <div class="profile-card">

        <img src="assets/img/user.png" alt="User">

        <h2>Urwaaa</h2>

        <p>urwaaa@gmail.com</p>

        <a href="edit_profil.php" class="profile-btn">
            Edit Profil
        </a>

    </div>

    <div class="profile-menu">

<a href="dashboard_profil.php">
    <i class="fa-solid fa-user"></i>
    Profil Saya
</a>

        <a href="pesanan_saya.php">
            <i class="fa-solid fa-receipt"></i>
            Riwayat Pesanan
        </a>

        <a href="ganti_password.php">
            <i class="fa-solid fa-lock"></i>
            Ganti Password
        </a>

        <a href="logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</section>

</body>
</html>
