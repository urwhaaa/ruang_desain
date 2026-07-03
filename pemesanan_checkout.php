<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if(!isset($_SESSION['checkout'])){
    header("Location: keranjang.php");
    exit;
}

$dataCheckout = $_SESSION['checkout'];
$totalHarga = $_SESSION['total_harga'];

$user_id = $_SESSION['user_id'];

$user = mysqli_query($koneksi,"
SELECT *
FROM users
WHERE id='$user_id'
");

$userData = mysqli_fetch_assoc($user);

if(!$userData){
    die("Data user tidak ditemukan");
}

if(isset($_POST['kirim'])){

    $user_id = $_SESSION['user_id'];
    $user = mysqli_query($koneksi,"
SELECT nama, email
FROM users
WHERE id='$user_id'
");

$userData = mysqli_fetch_assoc($user);

    $nama = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $email = mysqli_real_escape_string($koneksi,$_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi,$_POST['no_hp']);

    $deskripsi = implode("\n\n",$_POST['deskripsi']);
    $deskripsi = mysqli_real_escape_string($koneksi,$deskripsi);

    $pembayaran = mysqli_real_escape_string($koneksi,$_POST['pembayaran']);

    $file="";

    if(isset($_FILES['referensi']) && $_FILES['referensi']['name']!=""){

        if(!is_dir("uploads")){
            mkdir("uploads");
        }

        $file=time()."_".$_FILES['referensi']['name'];

        move_uploaded_file(
            $_FILES['referensi']['tmp_name'],
            "uploads/".$file
        );
    }

    $layanan=[];

    foreach($dataCheckout as $item){

        $layanan[]=$item['layanan'];

    }

    $namaLayanan=implode(", ",$layanan);

    mysqli_query($koneksi,"
    INSERT INTO pesanan(
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
    )VALUES(
        '$user_id',
        '$nama',
        '$email',
        '$no_hp',
        '$namaLayanan',
        '-',
        '$totalHarga',
        '$deskripsi',
        '$file',
        '$pembayaran'
    )
    ");
foreach($dataCheckout as $item){

    mysqli_query($koneksi,"
    DELETE FROM keranjang
    WHERE id='".$item['id']."'
    AND user_id='$user_id'
    ");

}

unset($_SESSION['checkout_id']);

    unset($_SESSION['checkout']);
    unset($_SESSION['total_harga']);

    echo "<script>
    alert('Pesanan berhasil dikirim');
    location='pesanan_saya.php';
    </script>";

    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Checkout Layanan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="assets/css/style.css">

</head>

<body>

<?php include "navbar.php"; ?>

<section class="page-title">

<div class="order-banner">

<i class="fa-solid fa-cart-shopping"></i>

<div>

<h3>Checkout Layanan</h3>

<p>Lengkapi data berikut untuk menyelesaikan pesanan Anda.</p>

</div>

</div>

</section>

<section class="order-container">

<form
class="order-form"
method="POST"
enctype="multipart/form-data">
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

<div class="form-group">
    <label>No HP / WhatsApp</label>
    <input
        type="text"
        name="no_hp"
        placeholder="08***"
        required>
</div>

<div class="form-group">

<label>Detail Layanan</label>

<div class="checkout-detail">

<?php foreach($dataCheckout as $item){ ?>

<div class="checkout-item">

<div class="checkout-left">

<h4><?= $item['layanan']; ?></h4>

<small>
Jumlah : <?= $item['jumlah']; ?>
</small>

</div>

<div class="checkout-right">

Rp <?= number_format($item['subtotal'],0,",","."); ?>

</div>

</div>

<?php } ?>

<hr>

<div class="checkout-total">

<span>Total Harga</span>

<strong>

Rp <?= number_format($totalHarga,0,",","."); ?>

</strong>

</div>

</div>

</div>

<div class="form-group">

<label>Deskripsi Pesanan</label>

<p style="font-size:13px;color:#777;margin-bottom:15px;">
Silakan isi detail kebutuhan untuk setiap layanan di bawah ini.
</p>

<?php foreach($dataCheckout as $item){ ?>

<div class="deskripsi-box">

<label style="font-weight:600;color:#6c63ff;">

# <?= $item['layanan']; ?>

</label>

<textarea
name="deskripsi[]"
rows="4"
placeholder="Contoh:
- Warna yang diinginkan
- Konsep desain
- Ukuran
- Referensi lainnya"
required></textarea>

</div>

<?php } ?>

</div>

<div class="form-group">

<label>Upload Referensi</label>

<input
type="file"
name="referensi">

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