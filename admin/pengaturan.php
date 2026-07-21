<?php

include "auth.php";
include "../koneksi.php";


// =======================
// AMBIL DATA WEBSITE
// =======================

$data = mysqli_query($koneksi,"
SELECT * FROM pengaturan LIMIT 1
");

$row = mysqli_fetch_assoc($data);



// =======================
// SIMPAN PENGATURAN WEBSITE
// =======================

if(isset($_POST['simpan_pengaturan'])){


    $nama = mysqli_real_escape_string($koneksi,$_POST['nama_website']);
    $email = mysqli_real_escape_string($koneksi,$_POST['email']);
    $telepon = mysqli_real_escape_string($koneksi,$_POST['telepon']);
    $alamat = mysqli_real_escape_string($koneksi,$_POST['alamat']);


    $logo = $row['logo'];



    if(!empty($_FILES['logo']['name'])){


        $logo = time()."_".$_FILES['logo']['name'];


        move_uploaded_file(
            $_FILES['logo']['tmp_name'],
            "../uploads/logo/".$logo
        );

    }



    mysqli_query($koneksi,"
    UPDATE pengaturan SET

    nama_website='$nama',
    email='$email',
    telepon='$telepon',
    alamat='$alamat',
    logo='$logo'

    WHERE id='".$row['id']."'
    ");



    echo "
    <script>
    alert('Pengaturan berhasil disimpan');
    location='pengaturan.php';
    </script>
    ";

    exit;

}




// =======================
// UBAH PASSWORD ADMIN
// =======================


if(isset($_POST['ubah_password'])){


    $lama = $_POST['password_lama'];

    $baru = $_POST['password_baru'];

    $konfirmasi = $_POST['konfirmasi'];



    // ambil admin

    $admin = mysqli_fetch_assoc(
        mysqli_query($koneksi,"
        SELECT * FROM admin WHERE id='1'
        ")
    );



    if($lama != $admin['password']){


        echo "
        <script>
        alert('Password lama salah');
        location='pengaturan.php';
        </script>
        ";

        exit;

    }



    if($baru != $konfirmasi){


        echo "
        <script>
        alert('Konfirmasi password tidak sama');
        location='pengaturan.php';
        </script>
        ";

        exit;

    }



    mysqli_query($koneksi,"
    UPDATE admin SET

    password='$baru'

    WHERE id='1'
    ");



    echo "
    <script>
    alert('Password berhasil diubah');
    location='pengaturan.php';
    </script>
    ";

    exit;


}


?>



<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Pengaturan</title>


<link rel="stylesheet" href="../assets/css/admin.css">


<style>


.card{

background:white;
padding:30px;
border-radius:18px;
margin-top:25px;
box-shadow:0 5px 15px rgba(0,0,0,.08);

}



label{

display:block;
font-weight:600;
margin-top:15px;
margin-bottom:8px;

}



input,
textarea{

width:100%;
padding:12px;

border:1px solid #ddd;

border-radius:10px;

}



button{

margin-top:20px;

background:#6c5ce7;

color:white;

padding:12px 25px;

border:none;

border-radius:25px;

cursor:pointer;

}



.logo-preview{

width:120px;

height:120px;

object-fit:cover;

border-radius:10px;

}


</style>


</head>


<body>


<?php include "sidebar.php"; ?>



<div class="main">


<h1>
⚙️ Pengaturan
</h1>




<!-- WEBSITE -->

<div class="card">


<h2>
🌐 Pengaturan Website
</h2>



<form method="POST" enctype="multipart/form-data">



<label>
Logo Website
</label>


<?php if(!empty($row['logo'])){ ?>


<img 
src="../uploads/logo/<?= $row['logo']; ?>"
class="logo-preview">


<?php } ?>


<input 
type="file"
name="logo">





<label>
Nama Website
</label>


<input
type="text"
name="nama_website"
value="<?= $row['nama_website']; ?>">





<label>
Email Website
</label>


<input
type="email"
name="email"
value="<?= $row['email']; ?>">





<label>
Nomor WhatsApp
</label>


<input
type="text"
name="telepon"
value="<?= $row['telepon']; ?>">





<label>
Alamat
</label>


<textarea
name="alamat"
rows="4"><?= $row['alamat']; ?></textarea>




<button
name="simpan_pengaturan">

💾 Simpan Pengaturan

</button>



</form>


</div>






<!-- KEAMANAN -->

<div class="card">


<h2>
🔒 Keamanan Akun
</h2>




<form method="POST">



<label>
Username Admin
</label>


<input
type="text"
value="admin"
readonly>




<label>
Password Lama
</label>


<input
type="password"
name="password_lama"
required>





<label>
Password Baru
</label>


<input
type="password"
name="password_baru"
required>





<label>
Konfirmasi Password
</label>


<input
type="password"
name="konfirmasi"
required>





<button
name="ubah_password">

🔑 Ubah Password

</button>



</form>



</div>




</div>


</body>

</html>