<?php
include "../koneksi.php";


$id = $_GET['id'];


// ambil data pesanan
$data = mysqli_query($koneksi,"
SELECT *
FROM pesanan
WHERE id='$id'
");


$row = mysqli_fetch_assoc($data);



// tombol verifikasi
if(isset($_POST['verifikasi'])){

mysqli_query($koneksi,"
UPDATE pesanan 
SET status_pembayaran='Lunas'
WHERE id='$id'
");

echo "
<script>
alert('Pembayaran berhasil diverifikasi');
window.location='pesanan.php';
</script>
";

}



// tombol tolak
if(isset($_POST['tolak'])){

mysqli_query($koneksi,"
UPDATE pesanan 
SET status_pembayaran='Belum Bayar'
WHERE id='$id'
");

echo "
<script>
alert('Pembayaran ditolak');
window.location='pesanan.php';
</script>
";

}


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Verifikasi Pembayaran</title>


<link rel="stylesheet" href="../assets/css/admin.css">


<style>

.card{

background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
margin-top:30px;

}



.info{

line-height:1.8;

}



.bukti{

width:350px;
border-radius:10px;
margin-top:15px;

}



.btn{

padding:12px 25px;
border:none;
border-radius:25px;
color:white;
cursor:pointer;
font-weight:bold;

}



.btn-verif{

background:#2ecc71;

}



.btn-tolak{

background:#e74c3c;

}



</style>

</head>


<body>


<?php include "sidebar.php"; ?>


<div class="main">


<h1>Pembayaran Pesanan</h1>



<div class="card">



<h2>Detail Pembayaran</h2>



<div class="info">


<b>Nama :</b>
<?= $row['nama_lengkap']; ?>

<br>


<b>Email :</b>
<?= $row['email']; ?>


<br>


<b>Layanan :</b>
<?= $row['layanan']; ?>


<br>


<b>Total Harga :</b>
Rp <?= number_format($row['harga'],0,',','.'); ?>


<br>


<b>Status Pembayaran :</b>
<?= $row['status_pembayaran']; ?>


<br>



<b>Metode :</b>
<?= $row['pembayaran']; ?>


</div>



<hr>



<h3>Bukti Pembayaran</h3>



<?php if(!empty($row['bukti_pembayaran'])){ ?>

<img 
src="../uploads/pembayaran/<?= $row['bukti_pembayaran']; ?>"
class="bukti"
>

<?php }else{ ?>

<p>Belum upload bukti pembayaran</p>

<?php } ?>


<br><br>



<form method="POST">


<button 
name="verifikasi"
class="btn btn-verif">

<i class="fa-solid fa-check"></i>
Verifikasi Pembayaran

</button>



<button 
name="tolak"
class="btn btn-tolak">

<i class="fa-solid fa-xmark"></i>
Tolak Pembayaran

</button>


</form>



</div>



</div>


</body>

</html>