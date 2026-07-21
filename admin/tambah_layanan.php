<?php
include "auth.php";
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Layanan</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

<style>

.form-card{
    background:#fff;
    margin-top:30px;
    padding:35px;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.form-group{
    margin-bottom:22px;
}

.form-group label{
    display:block;
    font-weight:600;
    color:#333;
    margin-bottom:8px;
}

.form-group input,
.form-group select,
.form-group textarea{

    width:100%;
    padding:14px 18px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:15px;
    transition:.3s;
    box-sizing:border-box;
    outline:none;

}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{

    border-color:#6c5ce7;
    box-shadow:0 0 8px rgba(108,92,231,.2);

}

textarea{

    resize:none;

}

.judul-paket{

    display:flex;
    align-items:center;
    gap:10px;
    margin:35px 0 20px;
    color:#6c5ce7;

}

.judul-paket h2{

    font-size:23px;

}

.paket-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
    margin-top:20px;
}

.paket-item{
    background:#fff;
    border:1px solid #ebe8ff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 8px 20px rgba(0,0,0,.06);
    transition:.3s;
}

.paket-item:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 30px rgba(108,92,231,.18);
}

.paket-item h3{
    text-align:center;
    color:#6c5ce7;
    margin-bottom:20px;
    font-size:20px;
}

.paket-item label{
    display:block;
    margin-bottom:8px;
    color:#666;
    font-weight:600;
}

.input-rp{
    display:flex;
    align-items:center;
    border:1px solid #ddd;
    border-radius:12px;
    overflow:hidden;
    background:#fff;
}

.input-rp span{
    background:#6c5ce7;
    color:#fff;
    padding:14px 18px;
    font-weight:bold;
    font-size:15px;
}

.input-rp input{
    width:100%;
    border:none;
    outline:none;
    padding:14px;
    font-size:15px;
}

.upload-box{

    margin-top:35px;
    border:2px dashed #bfb3ff;
    border-radius:18px;
    padding:35px;
    text-align:center;
    background:#faf9ff;

}

.upload-box i{

    font-size:50px;
    color:#6c5ce7;
    margin-bottom:15px;

}

.upload-box h3{

    color:#444;
    margin-bottom:8px;

}

.upload-box p{

    color:#777;
    margin-bottom:20px;

}

.upload-box input{

    border:none;

}

.button-area{

    margin-top:35px;
    display:flex;
    justify-content:flex-end;
    gap:15px;

}

.btn-kembali{

    padding:13px 28px;
    background:#ddd;
    color:#333;
    text-decoration:none;
    border-radius:10px;
    font-weight:600;

}

.btn-simpan{

    background:#6c5ce7;
    color:white;
    border:none;
    padding:13px 30px;
    border-radius:10px;
    cursor:pointer;
    font-size:15px;
    font-weight:600;
    transition:.3s;

}

.btn-simpan:hover{

    background:#5848c2;

}

@media(max-width:900px){

.paket-grid{

grid-template-columns:1fr;

}

}

</style>

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main">

<h1>Tambah Layanan</h1>

<div class="form-card">

<form
action="proses_tambah_layanan.php"
method="POST"
enctype="multipart/form-data">

<div class="form-group">

<label>Kategori</label>

<select name="kategori" required>

<option value="">-- Pilih Kategori --</option>

<option value="Logo">Logo</option>

<option value="Poster">Poster</option>

<option value="Feed Instagram">Feed Instagram</option>

<option value="Banner">Banner</option>

<option value="UI/UX">UI/UX Design</option>

</select>

</div>

<div class="form-group">

<label>Nama Layanan</label>

<input
type="text"
name="nama_layanan"
placeholder="Masukkan nama layanan"
required>

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="deskripsi"
rows="5"
placeholder="Masukkan deskripsi layanan..."
required></textarea>

</div>

<div class="judul-paket">
    <i class="fa-solid fa-layer-group"></i>
    <h2>Harga Paket</h2>
</div>

<div class="paket-grid">

    <div class="paket-item">
        <h3>Basic</h3>

        <label>Harga Paket</label>

        <div class="input-rp">
            <span>Rp</span>
            <input type="number" name="basic" placeholder="Contoh 90000" required>
        </div>

    </div>

    <div class="paket-item">
        <h3>Standar</h3>

        <label>Harga Paket</label>

        <div class="input-rp">
            <span>Rp</span>
            <input type="number" name="standar" placeholder="Contoh 150000" required>
        </div>

    </div>

    <div class="paket-item">
        <h3>Premium</h3>

        <label>Harga Paket</label>

        <div class="input-rp">
            <span>Rp</span>
            <input type="number" name="premium" placeholder="Contoh 250000" required>
        </div>

    </div>

</div>

<div class="upload-box">

<i class="fa-solid fa-cloud-arrow-up"></i>

<h3>Upload Gambar Layanan</h3>

<p>Pilih gambar dengan format JPG, JPEG atau PNG</p>

<input
type="file"
name="gambar"
accept=".jpg,.jpeg,.png"
required>

</div>


<div class="button-area">

<a href="layanan.php" class="btn-kembali">

<i class="fa-solid fa-arrow-left"></i>

Kembali

</a>

<button
type="submit"
class="btn-simpan">

<i class="fa-solid fa-floppy-disk"></i>

Simpan Layanan

</button>

</div>

</form>

</div>

</div>

</body>
</html>