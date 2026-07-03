<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$user = mysqli_query($koneksi,"
SELECT *
FROM users
WHERE id='$user_id'
");

$userData = mysqli_fetch_assoc($user);
if(isset($_POST['kirim'])){

    $user_id = $_SESSION['user_id'];
    $user = mysqli_query($koneksi,"
SELECT nama, email
FROM users
WHERE id='$user_id'
");

$userData = mysqli_fetch_assoc($user);

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $layanan = mysqli_real_escape_string($koneksi, $_POST['layanan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $pembayaran = mysqli_real_escape_string($koneksi, $_POST['pembayaran']);

    $harga = $_POST['harga'];
    $paket = $_POST['paket'];

    $file = "";

    if(isset($_FILES['referensi']) && $_FILES['referensi']['name'] != ""){

        if(!is_dir("uploads")){
            mkdir("uploads");
        }

        $file = time()."_".$_FILES['referensi']['name'];

        move_uploaded_file(
            $_FILES['referensi']['tmp_name'],
            "uploads/".$file
        );
    }

    $simpan = mysqli_query($koneksi,"INSERT INTO pesanan(
user_id,
nama_lengkap,
email,
no_hp,
layanan,
paket,
harga,
deskripsi,
file_referensi,
pembayaran
) VALUES(
'$user_id',
'$nama',
'$email',
'$no_hp',
'$layanan',
'$paket',
'$harga',
'$deskripsi',
'$file',
'$pembayaran'
)");

    if($simpan){

        echo "<script>
        alert('Pesanan berhasil dikirim');
        window.location='pesanan_saya.php';
        </script>";

        exit;

    }else{

        echo mysqli_error($koneksi);

    }

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pemesanan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <div class="order-banner">

    <i class="fa-solid fa-pen-ruler"></i>

    <div>
        <h3>Pesan Layanan Desain</h3>
        <p>Isi data berikut untuk memulai proyek desain Anda.</p>
    </div>

</div>
</section>

<section class="order-container">

<form class="order-form" action="" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="paket"
    value="<?= $_GET['paket'] ?? ''; ?>">

    <input type="hidden" name="harga"
    value="<?= $_GET['harga'] ?? 0; ?>">

    <div class="form-group">
        <label>Nama Lengkap</label>
       <input
type="text"
name="nama"
value="<?= htmlspecialchars($userData['nama']); ?>"
readonly
required>
    </div>

    <div class="form-group">
        <label>Email</label>
       <input
type="email"
name="email"
value="<?= htmlspecialchars($userData['email']); ?>"
readonly
required>
    </div>
    <input
type="hidden"
name="layanan"
value="<?= $_GET['layanan'] ?? ''; ?>">

<div class="form-group">
    <label>No HP / WhatsApp</label>
    <input
        type="text"
        name="no_hp"
        value="<?= htmlspecialchars($userData['no_hp'] ?? ''); ?>"
        placeholder="08***"
        required>
</div>

<div class="form-group">
    <label>Jenis Layanan</label>
    <input
        type="text"
        value="<?= $_GET['layanan'] ?? ''; ?>"
        readonly>
</div>

<div class="form-group">
    <label>Paket</label>
    <input
        type="text"
        value="<?= $_GET['paket'] ?? ''; ?>"
        readonly>
</div>

<div class="form-group">
    <label>Harga</label>
    <input
        type="text"
        value="Rp <?= number_format($_GET['harga'] ?? 0,0,',','.'); ?>"
        readonly>
</div>

    <div class="form-group">
        <label>Deskripsi Pesanan</label>

        <textarea
            name="deskripsi"
            rows="5"
            placeholder="Jelaskan kebutuhan desain Anda"
            required></textarea>
    </div>

    <div class="form-group">
        <label>Upload Referensi</label>
        <input type="file" name="referensi">
    </div>

    <div class="form-group">
        <label>Metode Pembayaran</label>

        <div class="payment-method">

            <label>
                <input
                    type="radio"
                    name="pembayaran"
                    value="Transfer Bank"
                    required>

                Transfer Bank
            </label>

            <label>
                <input
                    type="radio"
                    name="pembayaran"
                    value="E-Wallet">

                E-Wallet
            </label>

        </div>
    </div>

    <button
        type="submit"
        name="kirim"
        class="order-btn">

        Kirim Pesanan

    </button>

</form>
</section>

</body>
</html>