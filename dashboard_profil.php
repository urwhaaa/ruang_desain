<?php
session_start();
include "koneksi.php";

// cek login (konsisten pakai user_id)
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* ambil data user */
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query);

/* total pesanan */
$total = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT COUNT(*) as total
FROM pesanan
WHERE user_id='$user_id'
"))['total'];

/* diproses */
$diproses = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT COUNT(*) as total
FROM pesanan
WHERE user_id='$user_id'
AND status='Diproses'
"))['total'];

/* selesai */
$selesai = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT COUNT(*) as total
FROM pesanan
WHERE user_id='$user_id'
AND status='Selesai'
"))['total'];

/* belum bayar */
$belum = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT COUNT(*) as total
FROM pesanan
WHERE user_id='$user_id'
AND status_pembayaran='Belum Bayar'
"))['total'];

/* aktivitas */
$aktivitas = mysqli_query($koneksi,"
SELECT layanan, status, created_at
FROM pesanan
WHERE user_id='$user_id'
ORDER BY created_at DESC
LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Profil</title>

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<?php include "navbar.php"; ?>

<section class="dashboard-profile">

<div class="profile-header">

<div class="profile-left">

<?php
$foto = !empty($user['foto']) ? $user['foto'] : 'user.png';
?>

<img
src="assets/css/img/profile/<?= htmlspecialchars($foto); ?>"
alt="User">

<div>

<h2><?= htmlspecialchars($user['nama']); ?></h2>

<p><?= htmlspecialchars($user['email']); ?></p>

<p>
Bergabung :
<?= date("d F Y",strtotime($user['created_at'])); ?>
</p>

</div>

</div>

<a href="edit_profil.php" class="edit-profile-btn">
<i class="fa-solid fa-user-pen"></i>
Edit Profil
</a>

</div>


<div class="dashboard-grid">

<div class="dash-card">
<i class="fa-solid fa-box"></i>
<h2><?= $total ?></h2>
<p>Total Pesanan</p>
</div>

<div class="dash-card">
<i class="fa-solid fa-spinner"></i>
<h2><?= $diproses ?></h2>
<p>Diproses</p>
</div>

<div class="dash-card">
<i class="fa-solid fa-circle-check"></i>
<h2><?= $selesai ?></h2>
<p>Selesai</p>
</div>

<div class="dash-card">
<i class="fa-solid fa-credit-card"></i>
<h2><?= $belum ?></h2>
<p>Belum Bayar</p>
</div>

</div>


<div class="activity-card">

<h3>
<i class="fa-solid fa-clock-rotate-left"></i>
Aktivitas Terbaru
</h3>

<?php
if(mysqli_num_rows($aktivitas)>0){

while($a=mysqli_fetch_assoc($aktivitas)){
?>

<div class="activity-item">

<div>

<b><?= htmlspecialchars($a['layanan']); ?></b>

<br>

<small>
<?= date("d M Y",strtotime($a['created_at'])); ?>
</small>

</div>

<span class="status">
<?= htmlspecialchars($a['status']); ?>
</span>

</div>

<?php
}
}else{
echo "<p>Belum ada aktivitas.</p>";
}
?>

</div>

</section>

</body>
</html>