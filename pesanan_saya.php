<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
if(isset($_GET['detail_id'])){

    $id = $_GET['detail_id'];

    $q = mysqli_query($koneksi,"
    SELECT *
    FROM pesanan
    WHERE id='$id'
    ");

    $data = mysqli_fetch_assoc($q);

?>

<div class="detail-wrapper">

    <h2>
        <i class="fa-solid fa-file-circle-check"></i>
        Detail Pesanan
    </h2>

    <div class="detail-item">
        <span>Layanan</span>
        <strong><?= htmlspecialchars($data['layanan']); ?></strong>
    </div>

    <div class="detail-item">
        <span>Tanggal</span>
        <strong><?= date("d F Y",strtotime($data['created_at'])); ?></strong>
    </div>

    <div class="detail-item">
    <span>Paket</span>
    <strong>
        <?= htmlspecialchars($data['paket']); ?>
    </strong>
</div>
    <div class="detail-item">
        <span>Harga</span>
        <strong>
            Rp <?= number_format($data['harga'],0,",","."); ?>
        </strong>
    </div>

    <div class="detail-item">
        <span>Metode Bayar</span>
        <strong><?= htmlspecialchars($data['pembayaran']); ?></strong>
    </div>

    <div class="detail-item">
        <span>Status Pesanan</span>

        <span class="badge <?= strtolower(str_replace(' ','-',$data['status'])) ?>">
            <?= htmlspecialchars($data['status']); ?>
        </span>

    </div>

    <div class="detail-item">
        <span>Status Pembayaran</span>

        <span class="badge bayar">
            <?= htmlspecialchars($data['status_pembayaran']); ?>
        </span>

    </div>

    <?php if(!empty($data['file_referensi'])){ ?>

    <div class="detail-item">

        <span>File Referensi</span>

        <a href="uploads/<?= $data['file_referensi']; ?>"
        target="_blank"
        class="detail-link">

            Lihat File

        </a>

    </div>

    <?php } ?>

    <?php if(!empty($data['hasil_desain'])){ ?>

    <div class="detail-item">

        <span>Hasil Desain</span>

        <a
        href="uploads/hasil/<?= $data['hasil_desain']; ?>"
        download
        class="detail-link">

            Download

        </a>

    </div>

    <?php } ?>

</div>

<?php

exit;

}
$query = mysqli_query($koneksi,"
SELECT *
FROM pesanan
WHERE user_id='$user_id'
ORDER BY created_at DESC
");
?>

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

<?php include "navbar.php"; ?>

<section class="page-title">
    <h1>Pesanan Saya</h1>
    <p>Daftar seluruh pesanan yang pernah dibuat</p>
</section>

<section class="orders-container">

<?php if(mysqli_num_rows($query) > 0){ ?>

<?php while($row = mysqli_fetch_assoc($query)){

    $class = "pending";

    if($row['status']=="Diproses"){
        $class="proses";
    }elseif($row['status']=="Revisi"){
        $class="revisi";
    }elseif($row['status']=="Selesai"){
        $class="selesai";
    }
?>

<div class="order-card">

    <div class="order-header">
        <h3><?= htmlspecialchars($row['layanan']); ?></h3>

        <span class="status <?= $class; ?>">
            <?= htmlspecialchars($row['status']); ?>
        </span>
    </div>

    <p>
        <i class="fa-solid fa-hashtag"></i>
        #<?= $row['id']; ?>
    </p>

    <p>
        <i class="fa-regular fa-calendar"></i>
        <?= date("d F Y",strtotime($row['created_at'])); ?>
    </p>

    <a href="#" class="detail-btn" onclick="openModal(<?= $row['id']; ?>)">
        <i class="fa-solid fa-eye"></i> Lihat Detail
    </a>

    <?php if(trim($row['status_pembayaran'])=="Belum Bayar"){ ?>

        <a href="upload_pembayaran.php?id=<?= $row['id']; ?>" class="upload-btn">
            <i class="fa-solid fa-upload"></i> Upload Bukti Pembayaran
        </a>

    <?php }elseif(trim($row['status_pembayaran'])=="Menunggu Verifikasi"){ ?>

        <div class="info-box">
            🟡 Bukti sedang diverifikasi admin
        </div>

    <?php }elseif(trim($row['status_pembayaran'])=="Lunas"){ ?>

        <div class="info-box success">
            🟢 Pembayaran sudah diverifikasi
        </div>

    <?php } ?>

</div>

<?php } ?>

<?php }else{ ?>

<div class="order-card">
    <h3 style="text-align:center;">Belum ada pesanan.</h3>
</div>

<?php } ?>

</section>

</section>
<div id="modalDetail" class="modal">

    <div class="modal-content">

        <span class="close" onclick="closeModal()">&times;</span>

        <div id="modalBody">
            <!-- isi akan di-load via JS -->
        </div>

    </div>

</div>
<script>
function openModal(id){

    document.getElementById("modalDetail").style.display = "flex";

    fetch("?detail_id=" + id)
    .then(res => res.text())
    .then(data => {
        document.getElementById("modalBody").innerHTML = data;
    });

}

function closeModal(){
    document.getElementById("modalDetail").style.display = "none";
}

// klik luar modal untuk tutup
window.onclick = function(event){
    let modal = document.getElementById("modalDetail");
    if(event.target == modal){
        modal.style.display = "none";
    }
}
</script>
</body>
</html>