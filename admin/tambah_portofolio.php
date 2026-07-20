<?php
include "../koneksi.php";

if(isset($_POST['simpan'])){

    $judul = mysqli_real_escape_string($koneksi,$_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi,$_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($koneksi,$_POST['deskripsi']);

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if($gambar != ""){

        $namaBaru = time()."_".$gambar;

       if(move_uploaded_file($tmp, "../assets/css/img/portofolio/".$namaBaru)){

    mysqli_query($koneksi,"
    INSERT INTO portofolio
    (judul,kategori,deskripsi,gambar)
    VALUES
    (
    '$judul',
    '$kategori',
    '$deskripsi',
    '$namaBaru'
    )
    ");

    header("Location: portofolio.php");
    exit;

}else{

    die("Upload gambar gagal!");

}
        header("Location: portofolio.php");
        exit;

    }else{

        echo "<script>alert('Silakan pilih gambar');</script>";

    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Portofolio</title>

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

.btn{

background:#ff8c00;
color:#fff;
border:none;
padding:12px 25px;
border-radius:8px;
cursor:pointer;
font-size:15px;

}

.btn:hover{

background:#e67e00;

}

</style>

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main">

<div class="top-bar">

<h1>Tambah Portofolio</h1>

</div>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">

<label>Judul</label>

<input
type="text"
name="judul"
required>

</div>

<div class="form-group">

<label>Kategori</label>

<select name="kategori" required>

<option value="">Pilih Kategori</option>

<option>Logo</option>

<option>Poster</option>

<option>Banner</option>

<option>Feed Instagram</option>

<option>UI/UX</option>

<option>Lainnya</option>

</select>

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="deskripsi"></textarea>

</div>

<div class="form-group">

<label>Upload Gambar</label>

<input
type="file"
name="gambar"
accept="image/*"
required>

</div>

<button
type="submit"
name="simpan"
class="btn">

<i class="fa-solid fa-floppy-disk"></i>

Simpan

</button>

</form>

</div>

</div>

</body>
</html>