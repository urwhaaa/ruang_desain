<?php
include "../koneksi.php";

/* =========================
   VERIFIKASI PEMBAYARAN
========================= */
if(isset($_GET['verifikasi'])){

    $id = $_GET['verifikasi'];

    mysqli_query($koneksi,"
        UPDATE pesanan
        SET status_pembayaran='Lunas'
        WHERE id='$id'
    ");

    $ambil = mysqli_fetch_assoc(mysqli_query($koneksi,"
        SELECT user_id FROM pesanan WHERE id='$id'
    "));

    $user_id = $ambil['user_id'];

    mysqli_query($koneksi,"
        INSERT INTO notifikasi
        (user_id, tujuan, pesanan_id, jenis, pesan, status)
        VALUES
        ('$user_id','user','$id','Pembayaran',
        '💳 Pembayaran Anda telah diverifikasi.','belum_dibaca')
    ");

    echo "<script>
        alert('Pembayaran berhasil diverifikasi');
        location='pesanan.php';
    </script>";
    exit;
}

/* =========================
   TOLAK PEMBAYARAN
========================= */
if(isset($_GET['tolak'])){

    $id = $_GET['tolak'];

    $ambil = mysqli_fetch_assoc(mysqli_query($koneksi,"
        SELECT user_id FROM pesanan WHERE id='$id'
    "));

    $user_id = $ambil['user_id'];

    mysqli_query($koneksi,"
        UPDATE pesanan
        SET status_pembayaran='Belum Bayar',
            bukti_pembayaran=NULL
        WHERE id='$id'
    ");

    mysqli_query($koneksi,"
        INSERT INTO notifikasi
        (user_id, tujuan, pesanan_id, jenis, pesan, status)
        VALUES
        ('$user_id','user','$id','Pembayaran',
        '❌ Bukti pembayaran ditolak. Silakan upload ulang.','belum_dibaca')
    ");

    echo "<script>
        alert('Pembayaran ditolak');
        location='pesanan.php';
    </script>";
    exit;
}

/* =========================
   DATA PESANAN
========================= */
$query = mysqli_query($koneksi,"
    SELECT * FROM pesanan
    ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pesanan</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">

<h1>Data Pesanan</h1>

<div class="table-container">

<table>

<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Layanan</th>
<th>Tanggal</th>
<th>Status</th>
<th>Pembayaran</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($query)) { ?>

<tr>

<td><?= $row['id']; ?></td>
<td><?= $row['nama_lengkap']; ?></td>
<td><?= $row['layanan']; ?></td>
<td><?= date('d/m/Y',strtotime($row['created_at'])); ?></td>

<!-- STATUS -->
<td>
<?php if($row['status']=="Menunggu"){ ?>
<span class="status pending">Menunggu</span>

<?php }elseif($row['status']=="Diproses"){ ?>
<span class="status proses">Diproses</span>

<?php }elseif($row['status']=="Revisi"){ ?>
<span class="status revisi">Revisi</span>

<?php }else{ ?>
<span class="status selesai">Selesai</span>
<?php } ?>
</td>

<!-- PEMBAYARAN -->
<td>
<?php
if($row['status_pembayaran']=="Belum Bayar"){
    echo "<span class='status pending'>Belum Bayar</span>";

}elseif($row['status_pembayaran']=="Menunggu Verifikasi"){
    echo "<span class='status revisi'>Menunggu Verifikasi</span>";

}else{
    echo "<span class='status selesai'>Lunas</span>";
}
?>
</td>

<!-- AKSI -->
<td>

<div class="action-box">

    <div class="action-row">
        <a href="edit_pesanan.php?id=<?= $row['id']; ?>" class="btn edit-btn">
            ✏ Edit
        </a>

        <?php if(!empty($row['bukti_pembayaran'])) { ?>
        <a href="../uploads/pembayaran/<?= $row['bukti_pembayaran']; ?>"
           target="_blank"
           class="btn view-btn">
           👁 Bukti
        </a>
        <?php } ?>
    </div>

    <div class="action-row">

        <!-- VERIFIKASI -->
        <a href="?verifikasi=<?= $row['id']; ?>"
           class="btn ok-btn"
           onclick="return confirm('Verifikasi pembayaran ini?')"
           <?php if($row['status_pembayaran']=="Lunas") echo "style='pointer-events:none;opacity:0.5;'"; ?>>
           ✔ Verifikasi
        </a>

        <!-- TOLAK -->
        <a href="?tolak=<?= $row['id']; ?>"
           class="btn no-btn"
           onclick="return confirm('Tolak pembayaran ini?')"
           <?php if($row['status_pembayaran']=="Belum Bayar") echo "style='pointer-events:none;opacity:0.5;'"; ?>>
           ✖ Tolak
        </a>

    </div>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>