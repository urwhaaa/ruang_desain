<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

include "koneksi.php";

$jumlah_notif = 0;
$jumlah_chat = 0;

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    // Jumlah chat dari admin yang belum dibaca user
    $chat = mysqli_query($koneksi,"
    SELECT COUNT(*) AS total
    FROM chat
    WHERE user_id='$user_id'
    AND pengirim='admin'
    AND dibaca='0'
    ");

    if($chat){
        $jumlah_chat = mysqli_fetch_assoc($chat)['total'];
    }

    // Jumlah notifikasi
    $notif = mysqli_query($koneksi,"
    SELECT COUNT(*) AS total
    FROM notifikasi
    WHERE user_id='$user_id'
    AND status='belum_dibaca'
    ");

    if($notif){
        $jumlah_notif = mysqli_fetch_assoc($notif)['total'];
    }

}

?>

<header>

    <div class="logo">
        <a href="index.php">RUANG DESAIN</a>
    </div>

    <nav>
        <a href="index.php">Beranda</a>
        <a href="layanan.php">Layanan</a>
        <a href="portofolio.php">Portofolio</a>
        <a href="paket.php">Paket</a>
        <a href="tentang.php">Tentang Kami</a>
    </nav>

   <div class="icons">

    <a href="chat.php" class="notif-icon">

        <i class="fa-regular fa-message"></i>

        <?php if($jumlah_chat > 0){ ?>
            <span class="notif-badge">
                <?= $jumlah_chat ?>
            </span>
        <?php } ?>

    </a>

 <a href="notifikasi.php" class="notif-icon">

    <i class="fa-regular fa-bell"></i>

    <?php if($jumlah_notif > 0){ ?>
        <span class="notif-badge">
            <?= $jumlah_notif ?>
        </span>
    <?php } ?>

</a>

    <a href="keranjang.php">
        <i class="fa-solid fa-cart-shopping"></i>
    </a>

    <a href="profil.php">
        <i class="fa-regular fa-user"></i>
    </a>

</div>
</header>