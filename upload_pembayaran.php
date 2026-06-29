<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data pesanan
$data = mysqli_query($koneksi,"
SELECT *
FROM pesanan
WHERE id='$id'
AND user_id='$user_id'
");

if(mysqli_num_rows($data) == 0){
    die("Pesanan tidak ditemukan.");
}

$pesanan = mysqli_fetch_assoc($data);

if(isset($_POST['upload'])){

    if(isset($_FILES['bukti']) && $_FILES['bukti']['error']==0){

        if(!is_dir("uploads/pembayaran")){
            mkdir("uploads/pembayaran",0777,true);
        }

        $ext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
        $nama_file = "PAY_".time().".".$ext;

        $tujuan = "uploads/pembayaran/".$nama_file;

        if(move_uploaded_file($_FILES['bukti']['tmp_name'], $tujuan)){

            $update = mysqli_query($koneksi,"
            UPDATE pesanan
            SET
                bukti_pembayaran='$nama_file',
                status_pembayaran='Menunggu Verifikasi'
            WHERE
                id='$id'
            ");

            if(!$update){
                die("Update gagal : ".mysqli_error($koneksi));
            }

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
                'Pembayaran',
                '💳 Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.',
                'belum_dibaca'
            )
            ");

            echo "
            <script>
            alert('Bukti pembayaran berhasil dikirim');
            window.location='pesanan_saya.php';
            </script>
            ";
            exit;

        }else{

            die("Upload file gagal.");

        }

    }else{

        die("Silakan pilih file pembayaran.");

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Upload Pembayaran</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include "navbar.php"; ?>

<div class="order-container">

<h2>Upload Bukti Pembayaran</h2>

<p>
<b>Layanan :</b>
<?= htmlspecialchars($pesanan['layanan']); ?>
</p>

<p>
<b>Metode Pembayaran :</b>
<?= htmlspecialchars($pesanan['pembayaran']); ?>
</p>

<form method="POST" enctype="multipart/form-data">

<label>Bukti Pembayaran</label>

<input
type="file"
name="bukti"
accept=".jpg,.jpeg,.png,.pdf"
required>

<br><br>

<button
type="submit"
name="upload"
class="order-btn">

Upload Bukti

</button>

</form>

</div>

</body>
</html>