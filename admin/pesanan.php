<?php
include "auth.php";
include "../koneksi.php";

$keyword = $_GET['cari'] ?? '';

$query = "
SELECT * FROM pesanan
";

if($keyword != ''){
    $query .= "
    WHERE 
    nama_lengkap LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    layanan LIKE '%$keyword%' OR
    status LIKE '%$keyword%'
    ";
}

$query .= "
ORDER BY created_at DESC
";


$dataPesanan = mysqli_query($koneksi,$query);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Pesanan</title>


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<link rel="stylesheet" href="../assets/css/admin.css">


<style>


.container{
    margin-top:30px;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}



.header-page{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}



.header-page h2{
    margin:0;
    color:#333;
}



.search-box{
    display:flex;
    gap:10px;
    margin-bottom:20px;
}



.search-box input{
    width:300px;
    padding:12px 15px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
}



.search-box button{

    border:none;
    background:#6c5ce7;
    color:white;
    padding:12px 18px;
    border-radius:10px;
    cursor:pointer;

}




table{

    width:100%;
    border-collapse:collapse;

}



table th{

    background:#f6f6f6;
    padding:15px;
    text-align:left;

}



table td{

    padding:15px;
    border-bottom:1px solid #eee;

}



table tr:hover{

    background:#fafafa;

}



small{

    color:#777;

}



.status{

    color:white;
    padding:7px 15px;
    border-radius:20px;
    font-size:13px;
    font-weight:bold;

}



.menunggu{

background:#f39c12;

}


.diproses{

background:#3498db;

}


.revisi{

background:#9b59b6;

}


.selesai{

background:#2ecc71;

}


.dibatalkan{

background:#e74c3c;

}



.action{

display:flex;
gap:10px;

}



.btn-edit,
.btn-hapus{

width:35px;
height:35px;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
color:white;
text-decoration:none;

}



.btn-edit{

background:#3498db;

}



.btn-hapus{

background:#e74c3c;

}



.btn-edit:hover{

background:#2980b9;

}



.btn-hapus:hover{

background:#c0392b;

}
.action{
    display:flex;
    gap:10px;
}


.btn-edit,
.btn-bayar,
.btn-hapus{

    width:35px;
    height:35px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    color:white;
    text-decoration:none;

}


.btn-edit{
    background:#3498db;
}


.btn-bayar{
    background:#2ecc71;
}


.btn-hapus{
    background:#e74c3c;
}



.btn-edit:hover{
    background:#2980b9;
}


.btn-bayar:hover{
    background:#27ae60;
}


.btn-hapus:hover{
    background:#c0392b;
}


</style>

</head>


<body>


<?php include "sidebar.php"; ?>


<div class="main">


<h1>Data Pesanan</h1>


<div class="container">



<div class="header-page">

<h2>Semua Pesanan</h2>

</div>



<form method="GET" class="search-box">

<input 
type="text"
name="cari"
placeholder="Cari pesanan..."
value="<?= $keyword ?>">


<button>
<i class="fa-solid fa-search"></i>
</button>


</form>



<table>


<thead>

<tr>

<th>No</th>
<th>Nama</th>
<th>Layanan</th>
<th>Paket</th>
<th>Harga</th>
<th>Pembayaran</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>



<tbody>


<?php

$no=1;

while($row=mysqli_fetch_assoc($dataPesanan)){


?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>

<b><?= $row['nama_lengkap']; ?></b>


<td>

<?= $row['layanan']; ?>

</td>


<td>

<?= $row['paket'] ?? '-'; ?>

</td>


<td>

Rp <?= number_format($row['harga'],0,',','.'); ?>

</td>


<td>

<?= $row['status_pembayaran']; ?>

</td>


<td>

<span class="status <?= strtolower($row['status']); ?>">

<?= $row['status']; ?>

</span>

</td>

<td>

<div class="action">


<!-- Edit Status Pesanan -->
<a href="edit_pesanan.php?id=<?= $row['id']; ?>"
class="btn-edit"
title="Edit Status">

<i class="fa-solid fa-pen"></i>

</a>


<!-- Detail Pembayaran -->
<a href="pembayaran.php?id=<?= $row['id']; ?>"
class="btn-bayar"
title="Pembayaran">

<i class="fa-solid fa-money-bill-transfer"></i>

</a>


<!-- Hapus -->
<a href="hapus_pesanan.php?id=<?= $row['id']; ?>"
class="btn-hapus"
title="Hapus"
onclick="return confirm('Hapus pesanan ini?')">

<i class="fa-solid fa-trash"></i>

</a>


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