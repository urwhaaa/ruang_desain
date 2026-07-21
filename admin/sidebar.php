<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$admin = $_SESSION['admin_username'] ?? 'Admin';

?>

<div class="sidebar">

    <h2>RUANG DESAIN</h2>

    <div class="admin-info">

        <i class="fa-solid fa-user-shield"></i>

        <div>

            <b><?= htmlspecialchars($admin); ?></b><br>

            <small>Administrator</small>

        </div>

    </div>

    <a href="dashboard.php">
        <i class="fa-solid fa-chart-line"></i>
        Dashboard
    </a>

    <a href="pesanan.php">
        <i class="fa-solid fa-cart-shopping"></i>
        Pesanan
    </a>

    <a href="pelanggan.php">
        <i class="fa-solid fa-users"></i>
        Pelanggan
    </a>

    <a href="layanan.php">
        <i class="fa-solid fa-palette"></i>
        Layanan
    </a>

    <a href="portofolio.php">
        <i class="fa-solid fa-image"></i>
        Portofolio
    </a>

    <a href="chat.php">
        <i class="fa-solid fa-comments"></i>
        Chat
    </a>

    <a href="pengaturan.php">
        <i class="fa-solid fa-gear"></i>
        Pengaturan
    </a>

    <a href="logout.php"
       onclick="return confirm('Yakin ingin logout?')">

        <i class="fa-solid fa-right-from-bracket"></i>

        Logout

    </a>

</div>