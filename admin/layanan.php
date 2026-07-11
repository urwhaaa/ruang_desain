<?php
include "../koneksi.php";


$cari = $_GET['cari'] ?? "";


$query = "
SELECT * FROM layanan
";


if($cari != ""){

$query .= "
WHERE 
nama_layanan LIKE '%$cari%'
OR kategori LIKE '%$cari%'
";

}


$query .= " ORDER BY id DESC";


$dataLayanan = mysqli_query($koneksi,$query);


?>


<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Data Layanan</title>


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<link rel="stylesheet" href="../assets/css/admin.css">



<style>


.table-container{

margin-top:30px;
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);

}



.top-bar{

display:flex;
justify-content:space-between;
align-items:center;

}



.add-btn{

background:#6c5ce7;
color:white;
padding:12px 20px;
border-radius:25px;
text-decoration:none;
font-weight:600;

}



.search-box{

margin:25px 0;
display:flex;
gap:10px;

}



.search-box input{

width:300px;
padding:12px 15px;
border:1px solid #ddd;
border-radius:10px;

}



.search-box button{

background:#6c5ce7;
color:white;
border:none;
padding:12px 18px;
border-radius:10px;
cursor:pointer;

}



table{

width:100%;
border-collapse:collapse;

}



th{

background:#f4f4f4;
padding:15px;
text-align:left;

}



td{

padding:15px;
border-bottom:1px solid #eee;
vertical-align:top;

}



tr:hover{

background:#fafafa;

}



.img-admin{

width:80px;
height:60px;
object-fit:cover;
border-radius:10px;

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


</style>


</head>



<body>


<?php include "sidebar.php"; ?>



<div class="main">



<div class="top-bar">

<h1>Data Layanan</h1>


<a href="tambah_layanan.php" class="add-btn">

<i class="fa-solid fa-plus"></i>

Tambah Layanan

</a>


</div>




<div class="table-container">



<form method="GET" class="search-box">


<input 
type="text"
name="cari"
placeholder="Cari layanan..."
value="<?= $cari ?>">



<button>

<i class="fa-solid fa-search"></i>

</button>


</form>




<table>


<thead>

<tr>

<th>No</th>
<th>Gambar</th>
<th>Nama Layanan</th>
<th>Deskripsi</th>
<th>Kategori</th>
<th>Harga</th>
<th>Aksi</th>

</tr>


</thead>



<tbody>


<?php


$no=1;


while($row=mysqli_fetch_assoc($dataLayanan)){


?>



<tr>


<td>

<?= $no++; ?>

</td>



<td>

<img src="../uploads/layanan/<?= $row['gambar']; ?>"
class="img-admin">

</td>



<td>

<b><?= $row['nama_layanan']; ?></b>

</td>



<td>

<?= $row['deskripsi']; ?>

</td>



<td>

<?= $row['kategori']; ?>

</td>



<td>

Rp <?= number_format($row['harga'],0,',','.'); ?>

</td>



<td>


<div class="action">


<a href="edit_layanan.php?id=<?= $row['id']; ?>"
class="btn-edit">

<i class="fa-solid fa-pen"></i>

</a>



<a href="hapus_layanan.php?id=<?= $row['id']; ?>"
class="btn-hapus"
onclick="return confirm('Hapus layanan ini?')">

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