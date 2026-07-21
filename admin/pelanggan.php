<?php
include "auth.php";
include "../koneksi.php";


$cari = $_GET['cari'] ?? '';


if($cari != ''){

$data = mysqli_query($koneksi,"
SELECT
    users.*,
    COUNT(pesanan.id) AS total_pesanan
FROM users

LEFT JOIN pesanan
ON users.id = pesanan.user_id

WHERE 
users.nama LIKE '%$cari%'
OR users.email LIKE '%$cari%'

GROUP BY users.id
ORDER BY users.id DESC
");


}else{


$data = mysqli_query($koneksi,"
SELECT
    users.*,
    COUNT(pesanan.id) AS total_pesanan
FROM users

LEFT JOIN pesanan
ON users.id = pesanan.user_id

GROUP BY users.id
ORDER BY users.id DESC
");


}

?>

<!DOCTYPE html>
<html>
<head>

<title>Data Pelanggan</title>


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<link rel="stylesheet" href="../assets/css/admin.css">


<style>


.badge-total{
    background:#ff8c42;
    color:#fff;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}


.user-admin{
    width:45px;
    height:45px;
    border-radius:50%;
    object-fit:cover;
}



/* SEARCH */

.search-box{
    display:flex;
    gap:10px;
    align-items:center;
    margin-bottom:20px;
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




.detail-btn,
.delete-btn{

    width:35px;
    height:35px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    text-decoration:none;

}



.detail-btn{

    background:#4f7cff;
    color:#fff;

}



.delete-btn{

    background:#ff5b5b;
    color:#fff;

}



.detail-btn:hover{

    background:#3965db;

}



.delete-btn:hover{

    background:#e44343;

}



</style>


</head>


<body>


<?php include 'sidebar.php'; ?>



<div class="main">



<div class="top-bar">


<h1>
<i class="fa-solid fa-users"></i>
Data Pelanggan
</h1>


</div>





<div class="table-container">



<form method="GET" class="search-box">


<input

type="text"

name="cari"

placeholder="Cari pelanggan..."

value="<?= htmlspecialchars($cari); ?>">



<button type="submit">

<i class="fa-solid fa-magnifying-glass"></i>

</button>


</form>





<table>



<thead>

<tr>

<th>ID</th>
<th>Foto</th>
<th>Nama</th>
<th>Email</th>
<th>No HP</th>
<th>Total Pesanan</th>
<th>Bergabung</th>
<th>Status</th>
<th>Aksi</th>


</tr>

</thead>




<tbody>



<?php while($row=mysqli_fetch_assoc($data)){ ?>



<tr>



<td>

<?= $row['id']; ?>

</td>




<td>


<?php if(!empty($row['foto'])){ ?>


<img

src="../assets/img/profile/<?= $row['foto']; ?>"

class="user-admin">


<?php }else{ ?>


<img

src="../assets/img/default.png"

class="user-admin">


<?php } ?>


</td>




<td>

<?= htmlspecialchars($row['nama']); ?>

</td>




<td>

<?= htmlspecialchars($row['email']); ?>

</td>




<td>

<?= !empty($row['no_hp']) ? $row['no_hp'] : '-'; ?>

</td>




<td>


<span class="badge-total">

<?= $row['total_pesanan']; ?>

</span>


</td>




<td>


<?= date('d M Y',strtotime($row['created_at'])); ?>


</td>




<td>


<span class="status selesai">

Aktif

</span>


</td>




<td>



<a

href="detail_pelanggan.php?id=<?= $row['id']; ?>"

class="detail-btn">


<i class="fa-solid fa-eye"></i>


</a>





<a

href="hapus_pelanggan.php?id=<?= $row['id']; ?>"

class="delete-btn"

onclick="return confirm('Hapus pelanggan?')">


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