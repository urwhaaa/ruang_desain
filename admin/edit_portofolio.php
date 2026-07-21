<?php
include "auth.php";
include "../koneksi.php";

$id = (int)$_GET['id'];

$data = mysqli_query($koneksi,"SELECT * FROM portofolio WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(!$row){
    header("Location: portofolio.php");
    exit;
}

if(isset($_POST['update'])){

    $judul = mysqli_real_escape_string($koneksi,$_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi,$_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($koneksi,$_POST['deskripsi']);

    $gambarLama = $row['gambar'];

    if($_FILES['gambar']['name']!=""){

        $gambarBaru = time()."_".$_FILES['gambar']['name'];

        move_uploaded_file(
            $_FILES['gambar']['tmp_name'],
            "../assets/css/img/portofolio/".$gambarBaru
        );

        if(file_exists("../assets/css/img/portofolio/".$gambarLama)){
            unlink("../assets/css/img/portofolio/".$gambarLama);
        }

    }else{

        $gambarBaru = $gambarLama;

    }

    mysqli_query($koneksi,"
    UPDATE portofolio SET
    judul='$judul',
    kategori='$kategori',
    deskripsi='$deskripsi',
    gambar='$gambarBaru'
    WHERE id='$id'
    ");

    header("Location: portofolio.php");
    exit;

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Portofolio</title>

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
width:150px;
border-radius:10px;
margin-top:10px;
}

.btn{
background:#3b82f6;
color:#fff;
border:none;
padding:12px 25px;
border-radius:8px;
cursor:pointer;
font-size:15px;
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
<h1>Edit Portofolio</h1>
</div>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">

<label>Judul</label>

<input
type="text"
name="judul"
value="<?= htmlspecialchars($row['judul']); ?>"
required>

</div>

<div class="form-group">

<label>Kategori</label>

<select name="kategori" required>

<option <?= $row['kategori']=="Logo"?"selected":""; ?>>Logo</option>

<option <?= $row['kategori']=="Poster"?"selected":""; ?>>Poster</option>

<option <?= $row['kategori']=="Banner"?"selected":""; ?>>Banner</option>

<option <?= $row['kategori']=="Feed Instagram"?"selected":""; ?>>Feed Instagram</option>

<option <?= $row['kategori']=="UI/UX"?"selected":""; ?>>UI/UX</option>

<option <?= $row['kategori']=="Lainnya"?"selected":""; ?>>Lainnya</option>

</select>

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="deskripsi"><?= htmlspecialchars($row['deskripsi']); ?></textarea>

</div>

<div class="form-group">

<label>Gambar Saat Ini</label>

<br>

<img
src="../assets/css/img/portofolio/<?= $row['gambar']; ?>"
class="preview">

</div>

<div class="form-group">

<label>Ganti Gambar (Opsional)</label>

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

Update Portofolio

</button>

</form>

</div>

</div>

</body>
</html>