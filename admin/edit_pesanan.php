<?php
include "auth.php";
include "../koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi,"
SELECT * FROM pesanan
WHERE id='$id'
");

$row = mysqli_fetch_assoc($data);

if(isset($_POST['simpan'])){

    $status = $_POST['status'];

    $hasil_desain = "";

    // Upload hasil desain jika ada
    if($_FILES['hasil_desain']['name'] != ""){

        $hasil_desain = time()."_".$_FILES['hasil_desain']['name'];

        move_uploaded_file(
            $_FILES['hasil_desain']['tmp_name'],
            "../uploads/hasil/".$hasil_desain
        );

    }

    // Update pesanan
    if($hasil_desain != ""){

        mysqli_query($koneksi,"
        UPDATE pesanan
        SET
            status='$status',
            hasil_desain='$hasil_desain'
        WHERE id='$id'
        ");

    }else{

        mysqli_query($koneksi,"
        UPDATE pesanan
        SET
            status='$status'
        WHERE id='$id'
        ");

    }

    // Ambil user_id
    $ambil = mysqli_query($koneksi,"
    SELECT user_id
    FROM pesanan
    WHERE id='$id'
    ");

    $pesanan = mysqli_fetch_assoc($ambil);

    $user_id = $pesanan['user_id'];

    // Isi notifikasi sesuai status
    if($status=="Menunggu"){

        $jenis = "Pesanan";
        $pesan = "📋 Pesanan Anda sedang menunggu konfirmasi.";

    }elseif($status=="Diproses"){

        $jenis = "Diproses";
        $pesan = "🎨 Pesanan Anda sedang diproses.";

    }elseif($status=="Revisi"){

        $jenis = "Revisi";
        $pesan = "✏️ Revisi tersedia. Silakan cek hasil revisi Anda.";

    }elseif($status=="Selesai"){

        if($hasil_desain != ""){

            $jenis = "File";
            $pesan = "📦 File desain Anda telah dikirim.";

        }else{

            $jenis = "Selesai";
            $pesan = "✅ Pesanan Anda telah selesai.";

        }

    }elseif($status=="Dibatalkan"){

        $jenis = "Dibatalkan";
        $pesan = "❌ Pesanan Anda telah dibatalkan.";

    }

    // Simpan notifikasi
    mysqli_query($koneksi,"
    INSERT INTO notifikasi
    (
        user_id,
        tujuan,
        pesanan_id,
        jenis,
        pesan,
        status
    )
    VALUES
    (
        '$user_id',
        'user',
        '$id',
        '$jenis',
        '$pesan',
        'belum_dibaca'
    )
    ");

    header("Location: pesanan.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Status Pesanan</title>

<link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<div class="edit-box">

<h2>Edit Status Pesanan</h2>

<form method="POST" enctype="multipart/form-data">

<label>Status</label>

<select name="status">

<option value="Menunggu" <?=($row['status']=="Menunggu")?'selected':'';?>>
Menunggu
</option>

<option value="Diproses" <?=($row['status']=="Diproses")?'selected':'';?>>
Diproses
</option>

<option value="Revisi" <?=($row['status']=="Revisi")?'selected':'';?>>
Revisi
</option>

<option value="Selesai" <?=($row['status']=="Selesai")?'selected':'';?>>
Selesai
</option>

<option value="Dibatalkan" <?=($row['status']=="Dibatalkan")?'selected':'';?>>
Dibatalkan
</option>

</select>

<br><br>

<label>Upload Hasil Desain</label>

<input
type="file"
name="hasil_desain">

<br><br>

<button
type="submit"
name="simpan">

Simpan

</button>

</form>

</div>

</body>
</html>