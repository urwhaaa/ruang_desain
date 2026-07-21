<?php
include "auth.php";
include "../koneksi.php";

$cari = $_GET['cari'] ?? '';

if($cari != ''){

    $data = mysqli_query($koneksi,"
    SELECT *
    FROM portofolio
    WHERE judul LIKE '%$cari%'
    OR kategori LIKE '%$cari%'
    ORDER BY id DESC
    ");

}else{

    $data = mysqli_query($koneksi,"
    SELECT *
    FROM portofolio
    ORDER BY id DESC
    ");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Portofolio</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

<style>

.add-btn{
background:#3b82f6;
color:#fff;
padding:10px 18px;
border-radius:8px;
text-decoration:none;
font-weight:600;
display:inline-flex;
align-items:center;
gap:8px;
transition:.3s;
}

.add-btn:hover{
background:#2563eb;
}

.table-container{
margin-top:25px;
background:#fff;
padding:20px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
}

table th{
background:#ff8c00;
color:#000 !important;
padding:15px;
text-align:center;
font-weight:bold;
}

table td{
padding:15px;
border-bottom:1px solid #eee;
text-align:center;
vertical-align:middle;
color:#000 !important;
font-weight:500;
}
table tr:hover{
background:#fafafa;
}

.portfolio-img{
width:80px;
height:80px;
object-fit:cover;
border-radius:10px;
}

.edit-btn,
.delete-btn{
width:35px;
height:35px;
display:inline-flex;
align-items:center;
justify-content:center;
border-radius:8px;
text-decoration:none;
color:#fff;
margin:0 3px;
}

.edit-btn{
background:#3b82f6;
}

.edit-btn:hover{
background:#2563eb;
}

.delete-btn{
background:#ef4444;
}

.delete-btn:hover{
background:#dc2626;
}
.search-box{
    display:flex;
    gap:10px;
    align-items:center;
}

.search-box input{
    width:280px;
    padding:10px 15px;
    border:1px solid #ddd;
    border-radius:8px;
    outline:none;
    font-size:14px;
}

.search-box button{
    background:#3b82f6;
    color:#fff;
    border:none;
    padding:10px 18px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.search-box button:hover{
    background:#2563eb;
}
.table-container .search-box{
    margin-bottom:20px;
}
</style>

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main">
<div class="top-bar">

<h1>Data Portofolio</h1>

<a href="tambah_portofolio.php" class="add-btn">

<i class="fa-solid fa-plus"></i>

Tambah Portofolio

</a>

</div>

<div class="table-container">


<form method="GET" class="search-box">

<input
type="text"
name="cari"
placeholder="Cari portofolio..."
value="<?= htmlspecialchars($cari); ?>">

<button type="submit">

<i class="fa-solid fa-magnifying-glass"></i>

</button>

</form>


<table>

<thead>

<tr>

<th>No</th>
<th>Gambar</th>
<th>Judul</th>
<th>Kategori</th>
<th>Deskripsi</th>
<th>Tanggal</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no=1;
while($row=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td>

<img
src="../assets/css/img/portofolio/<?= $row['gambar']; ?>"
class="portfolio-img">

</td>

<td><?= htmlspecialchars($row['judul']); ?></td>

<td><?= htmlspecialchars($row['kategori']); ?></td>

<td><?= htmlspecialchars($row['deskripsi']); ?></td>

<td><?= date('d M Y',strtotime($row['created_at'])); ?></td>

<td>

<a
href="edit_portofolio.php?id=<?= $row['id']; ?>"
class="edit-btn">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="hapus_portofolio.php?id=<?= $row['id']; ?>"
class="delete-btn"
onclick="return confirm('Yakin ingin menghapus portofolio ini?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>