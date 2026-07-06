<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($query);

if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

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

  <!-- Card User -->
<div class="profile-card">

<?php
$foto = !empty($user['foto']) ? $user['foto'] : 'user.png';
?>

<img src="assets/css/img/profile/<?= htmlspecialchars($foto); ?>" alt="User">

<h2><?= htmlspecialchars($user['nama']); ?></h2>

<p><?= htmlspecialchars($user['email']); ?></p>

<div class="join-date">
    <small>Bergabung sejak</small><br>
    <strong><?= date('d F Y', strtotime($user['created_at'])); ?></strong>
</div>

</div>

    <!-- Menu -->
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

        <a href="logout.php" onclick="return confirm('Yakin ingin logout?')">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

    </div>

</section>

</body>
</html>