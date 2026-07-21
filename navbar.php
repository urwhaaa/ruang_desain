<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

include "koneksi.php";


// ambil pengaturan website
$setting = mysqli_fetch_assoc(
    mysqli_query($koneksi,"
    SELECT * FROM pengaturan LIMIT 1
    ")
);



$halaman = basename($_SERVER['PHP_SELF']);

$jumlah_notif = 0;
$jumlah_chat = 0;



if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];


    // jumlah chat admin yang belum dibaca
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



    // jumlah notifikasi

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

        <a href="index.php">


        <?php if(!empty($setting['logo'])){ ?>

            <img 
            src="uploads/logo/<?= $setting['logo']; ?>"
            width="45"
            height="45"
            style="object-fit:cover;border-radius:50%;vertical-align:middle;"
            >

        <?php } ?>


        <?= $setting['nama_website'] ?? 'RUANG DESAIN'; ?>


        </a>


    </div>





    <nav>

        <a href="index.php" class="<?= ($halaman == 'index.php') ? 'active' : '' ?>">
            Beranda
        </a>


        <a href="layanan.php" class="<?= ($halaman == 'layanan.php' || $halaman == 'pemesanan.php') ? 'active' : '' ?>">
            Layanan
        </a>


        <a href="portofolio.php" class="<?= ($halaman == 'portofolio.php') ? 'active' : '' ?>">
            Portofolio
        </a>


        <a href="paket.php" class="<?= ($halaman == 'paket.php') ? 'active' : '' ?>">
            Paket
        </a>


        <a href="tentang.php" class="<?= ($halaman == 'tentang.php') ? 'active' : '' ?>">
            Tentang Kami
        </a>


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







<?php

$jumlahKeranjang = 0;


if(isset($_SESSION['user_id'])){


    $user_id = $_SESSION['user_id'];


    $q = mysqli_query($koneksi,"
    SELECT COUNT(*) AS total
    FROM keranjang
    WHERE user_id='$user_id'
    ");



    if($q){

        $d = mysqli_fetch_assoc($q);

        $jumlahKeranjang = $d['total'];

    }


}


?>




<a href="keranjang.php" class="notif-icon">


<i class="fa-solid fa-cart-shopping"></i>


<?php if($jumlahKeranjang > 0){ ?>

<span class="notif-badge">

<?= $jumlahKeranjang > 99 ? '99+' : $jumlahKeranjang; ?>

</span>

<?php } ?>


</a>





<a href="profil.php">

<i class="fa-regular fa-user"></i>

</a>



</div>



</header>