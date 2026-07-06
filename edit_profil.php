<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($query);

if(isset($_POST['simpan'])){

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    $cek = mysqli_query($koneksi,"
        SELECT * FROM users
        WHERE (username='$username' OR email='$email')
        AND id != '$id'
    ");

    if(mysqli_num_rows($cek) > 0){

        $error = "Username atau Email sudah digunakan!";

    }else{

        // Foto lama
        $foto = $user['foto'];

// Upload foto baru
if(!empty($_FILES['foto']['name'])){

    $ekstensi = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $boleh = ['jpg','jpeg','png','webp'];

    if(in_array($ekstensi, $boleh)){

        $namaFoto = time().".".$ekstensi;

        // Lokasi penyimpanan foto
        $uploadPath = __DIR__ . "/assets/css/img/profile/" . $namaFoto;

        if(move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath)){

            // Hapus foto lama (kecuali foto default)
            if(
                $foto != "user.png" &&
                file_exists(__DIR__ . "/assets/css/img/profile/" . $foto)
            ){
                unlink(__DIR__ . "/assets/css/img/profile/" . $foto);
            }

            $foto = $namaFoto;

        }else{

            $error = "Upload foto gagal!";

        }

    }else{

        $error = "Format foto harus JPG, JPEG, PNG, atau WEBP.";

    }

}

        if(!isset($error)){

            $update = mysqli_query($koneksi,"
                UPDATE users
                SET
                    nama='$nama',
                    username='$username',
                    email='$email',
                    foto='$foto'
                WHERE id='$id'
            ");

            if($update){

                echo "<script>
                    alert('Profil berhasil diperbarui');
                    window.location='dashboard_profil.php';
                </script>";
                exit;

            }else{

                $error = "Gagal memperbarui profil!";

            }

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profil</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <h1>Edit Profil</h1>
    <p>Perbarui data akun Anda</p>
</section>

<section class="edit-profile">

<form method="POST" enctype="multipart/form-data">

<?php
if(isset($error)){
    echo "<p class='error'>$error</p>";
}
?>
<div class="foto-edit">

<?php
$foto = !empty($user['foto']) ? $user['foto'] : 'user.png';
?>

<img
src="assets/css/img/profile/<?= htmlspecialchars($foto); ?>"
alt="Foto Profil">

<label for="foto">
    <i class="fa-solid fa-camera"></i> Ganti Foto
</label>

<input
type="file"
name="foto"
id="foto"
accept=".jpg,.jpeg,.png,.webp"
hidden>

<script>
document.getElementById("foto").addEventListener("change", function(e){

    if(e.target.files.length > 0){

        document.querySelector(".foto-edit img").src =
            URL.createObjectURL(e.target.files[0]);

    }

});
</script>

</div>
<input
type="text"
name="nama"
value="<?= htmlspecialchars($user['nama']); ?>"
placeholder="Nama Lengkap"
required>

<input
type="text"
name="username"
value="<?= htmlspecialchars($user['username']); ?>"
placeholder="Username"
required>

<input
type="email"
name="email"
value="<?= htmlspecialchars($user['email']); ?>"
placeholder="Email"
required>

<button
type="submit"
name="simpan">

Simpan Perubahan

</button>

</form>

</section>

</body>
</html>