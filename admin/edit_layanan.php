<?php
include "../koneksi.php";

$id = (int)$_GET['id'];

$data = mysqli_query($koneksi,"SELECT * FROM layanan WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(!$row){
    header("Location: layanan.php");
    exit;
}

if(isset($_POST['update'])){

    $kategori = mysqli_real_escape_string($koneksi,$_POST['kategori']);
    $nama = mysqli_real_escape_string($koneksi,$_POST['nama_layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi,$_POST['deskripsi']);

    $gambarBaru = $row['gambar'];

    if($_FILES['gambar']['name']!=""){

        $gambarBaru = time()."_".$_FILES['gambar']['name'];

        move_uploaded_file(
            $_FILES['gambar']['tmp_name'],
            "../assets/css/img/layanan/".$gambarBaru
        );

        if($row['gambar']!="" && file_exists("../assets/css/img/layanan/".$row['gambar'])){
            unlink("../assets/css/img/layanan/".$row['gambar']);
        }
    }

    mysqli_query($koneksi,"
    UPDATE layanan SET
    kategori='$kategori',
    nama_layanan='$nama',
    deskripsi='$deskripsi',
    gambar='$gambarBaru'
    WHERE id='$id'
    ");

    header("Location: layanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Layanan</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

<style>

.form-card{
max-width:700px;
margin:auto;
background:#fff;
padding:30px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.form-group{
margin-bottom:20px;
}

.form-group label{
display:block;
margin-bottom:8px;
font-weight:bold;
}

.form-group input,
.form-group select,
.form-group textarea{
width:100%;
padding:12px;
border:1px solid #ddd;
border-radius:8px;
font-size:15px;
}

.form-group textarea{
height:120px;
resize:none;
}

.preview{
width:180px;
border-radius:10px;
margin-top:10px;
}

.btn{
background:#3b82f6;
color:#fff;
padding:12px 25px;
border:none;
border-radius:8px;
cursor:pointer;
font-size:15px;
font-weight:600;
}

.btn:hover{
background:#2563eb;
}

</style>

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main">

<div class="top-bar">
<h1>Edit Layanan</h1>
</div>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">

<label>Kategori</label>

<input
type="text"
name="kategori"
value="<?= htmlspecialchars($row['kategori']); ?>"
required>

</div>

<div class="form-group">

<label>Nama Layanan</label>

<input
type="text"
name="nama_layanan"
value="<?= htmlspecialchars($row['nama_layanan']); ?>"
required>

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="deskripsi"
required><?= htmlspecialchars($row['deskripsi']); ?></textarea>

</div>

<div class="form-group">

<label>Gambar Saat Ini</label>

<br>

<img
src="../assets/css/img/layanan/<?= $row['gambar']; ?>"
class="preview">

</div>

<div class="form-group">

<label>Ganti Gambar</label>

<input
type="file"
name="gambar"
accept="image/*">

</div>

<button
type="submit"
name="update"
class="btn">

<i class="fa-solid fa-floppy-disk"></i>

Update Layanan

</button>

</form>

</div>

</div>

</body>
</html>