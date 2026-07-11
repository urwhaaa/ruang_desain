<?php
include "../koneksi.php";

// ======================
// CARD DASHBOARD
// ======================

// Total Pesanan
$qPesanan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan");
$totalPesanan = mysqli_fetch_assoc($qPesanan)['total'];

// Pesanan Diproses
$qDiproses = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan WHERE status='Diproses'");
$totalDiproses = mysqli_fetch_assoc($qDiproses)['total'];

// Pesanan Selesai
$qSelesai = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan WHERE status='Selesai'");
$totalSelesai = mysqli_fetch_assoc($qSelesai)['total'];

// Total Pelanggan
$qUser = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users");
$totalUser = mysqli_fetch_assoc($qUser)['total'];

// Pesanan Terbaru
$pesananTerbaru = mysqli_query($koneksi,"
SELECT 
    pesanan.*,
    users.nama AS nama_user
FROM pesanan
LEFT JOIN users 
ON pesanan.user_id = users.id
ORDER BY pesanan.created_at DESC
LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

<style>

.table-container{
    margin-top:35px;
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.table-container h2{
    margin-bottom:20px;
    color:#333;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#f4f4f4;
    padding:15px;
    text-align:left;
    font-weight:600;
}

table td{
    padding:15px;
    border-bottom:1px solid #eee;
}

table tr:hover{
    background:#fafafa;
}

.status{
    color:#fff;
    padding:6px 12px;
    border-radius:30px;
    font-size:13px;
    font-weight:bold;
}

.status.menunggu{
    background:#f39c12;
}

.status.diproses{
    background:#3498db;
}

.status.revisi{
    background:#9b59b6;
}

.status.selesai{
    background:#2ecc71;
}

.status.dibatalkan{
    background:#e74c3c;
}
.btn-lihat{
    display:inline-block;
    padding:12px 25px;
    background:#6c5ce7;
    color:white;
    text-decoration:none;
    border-radius:30px;
    font-weight:600;
    transition:.3s;
}

.btn-lihat:hover{
    background:#5848c2;
}
.lihat-semua-container{
    margin-top:25px;
    margin-bottom:20px;
    text-align:right;
}

.btn-lihat{
    display:inline-block;
    padding:10px 22px;
    background:#6c5ce7;
    color:white;
    text-decoration:none;
    border-radius:25px;
    font-weight:600;
    font-size:14px;
    transition:.3s;
}

.btn-lihat:hover{
    background:#5848c2;
}
</style>

</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="main">

<h1>Dashboard Admin</h1>

<div class="cards">

<div class="card">
<i class="fa-solid fa-clipboard-list"></i>
<h2><?= $totalPesanan ?></h2>
<p>Total Pesanan</p>
</div>

<div class="card">
<i class="fa-solid fa-spinner"></i>
<h2><?= $totalDiproses ?></h2>
<p>Pesanan Diproses</p>
</div>

<div class="card">
<i class="fa-solid fa-circle-check"></i>
<h2><?= $totalSelesai ?></h2>
<p>Pesanan Selesai</p>
</div>

<div class="card">
<i class="fa-solid fa-users"></i>
<h2><?= $totalUser ?></h2>
<p>Total Pelanggan</p>
</div>

</div>

<div class="lihat-semua-container">

<a href="pesanan.php" class="btn-lihat">
    Lihat Semua Pesanan
</a>

</div>


<div class="table-container">

<h2>Pesanan Terbaru</h2>

<table>

<thead>

<tr>
<th>No</th>
<th>Nama</th>
<th>Layanan</th>
<th>Paket</th>
<th>Tanggal</th>
<th>Status</th>
</tr>

</thead>

<tbody>

<?php
$no=1;
while($row=mysqli_fetch_assoc($pesananTerbaru)){

    // ambil status kecil untuk class css
    $status = strtolower($row['status']);

?>

<tr>

<td><?= $no++; ?></td>

<td>
<b><?= $row['nama_lengkap']; ?></b>
</td>

<td>
<?= $row['layanan'] ?? '-'; ?>
</td>

<td>
<?= $row['paket'] ?? '-'; ?>
</td>

<td>
<?= date('d-m-Y', strtotime($row['created_at'])); ?>
</td>

<td>
<span class="status <?= $status ?>">
<?= $row['status']; ?>
</span>
</td>

</tr>


<?php } ?>

</tbody>

</table>

</div>


</div>


</body>
</html>