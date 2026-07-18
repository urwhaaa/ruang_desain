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
$layanan = mysqli_real_escape_string($koneksi, $_GET['layanan'] ?? '');
$paket   = mysqli_real_escape_string($koneksi, $_GET['paket'] ?? '');
$harga   = (int)($_GET['harga'] ?? 0);

if($layanan != "" && $paket != ""){

    $queryHarga = mysqli_query($koneksi,"
        SELECT paket.harga
        FROM paket
        JOIN layanan
        ON layanan.id = paket.layanan_id
        WHERE layanan.nama_layanan='$layanan'
        AND paket.nama_paket='$paket'
    ");

    if($queryHarga && mysqli_num_rows($queryHarga) > 0){

        $dataHarga = mysqli_fetch_assoc($queryHarga);
        $harga = $dataHarga['harga'];

    }

}
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
    $paket = mysqli_real_escape_string($koneksi, $_POST['paket']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $pembayaran = mysqli_real_escape_string($koneksi,$_POST['pembayaran']);



$file = "";
$bukti = "";

/* Upload Referensi */

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

/* Upload Bukti Pembayaran */

if(isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['name']!=""){

    if(!is_dir("uploads/pembayaran")){
        mkdir("uploads/pembayaran",0777,true);
    }

    $bukti=time()."_".$_FILES['bukti_pembayaran']['name'];

    move_uploaded_file(
        $_FILES['bukti_pembayaran']['tmp_name'],
        "uploads/pembayaran/".$bukti
    );
}

   $simpan = mysqli_query($koneksi,"
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
pembayaran,
bukti_pembayaran,
status_pembayaran

)VALUES(

'$user_id',
'$nama',
'$email',
'$no_hp',
'$layanan',
'$paket',
'$harga',
'$deskripsi',
'$file',
'$pembayaran',
'$bukti',
'Menunggu Verifikasi'

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
        value="Rp <?= number_format((int)$harga,0,',','.') ?>"
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

        <label class="payment-card">
            <input type="radio"
                   name="pembayaran"
                   value="Transfer Bank"
                   onclick="showPayment('bank')"
                   required>

            <div class="payment-content">
                <i class="fa-solid fa-building-columns"></i>
                <span>Transfer Bank</span>
            </div>
        </label>

        <label class="payment-card">
            <input type="radio"
                   name="pembayaran"
                   value="E-Wallet"
                   onclick="showPayment('ewallet')">

            <div class="payment-content">
                <i class="fa-solid fa-wallet"></i>
                <span>E-Wallet</span>
            </div>
        </label>

    </div>

    <!-- BANK -->
    <div id="bank-list" class="payment-list">

        <h4>Pilih Bank</h4>

        <div class="payment-option" onclick="pilihBank('BCA','1234567890','Ruang Desain')">
            🏦 Bank BCA
        </div>

        <div class="payment-option" onclick="pilihBank('BRI','9876543210','Ruang Desain')">
            🏦 Bank BRI
        </div>

        <div class="payment-option" onclick="pilihBank('BNI','4567891230','Ruang Desain')">
            🏦 Bank BNI
        </div>

        <div class="payment-option" onclick="pilihBank('Mandiri','111222333444','Ruang Desain')">
            🏦 Bank Mandiri
        </div>

    </div>

    <!-- EWALLET -->
    <div id="ewallet-list" class="payment-list">

        <h4>Pilih E-Wallet</h4>

        <div class="payment-option" onclick="pilihBank('DANA','081234567890','Ruang Desain')">
            💙 DANA
        </div>

        <div class="payment-option" onclick="pilihBank('OVO','081234567891','Ruang Desain')">
            💜 OVO
        </div>

        <div class="payment-option" onclick="pilihBank('GoPay','081234567892','Ruang Desain')">
            💚 GoPay
        </div>

        <div class="payment-option" onclick="pilihBank('ShopeePay','081234567893','Ruang Desain')">
            🧡 ShopeePay
        </div>

    </div>

    <div id="payment-info"></div>
    <div id="upload-payment" style="display:none;">

    <div class="form-group">

        <label>Upload Bukti Pembayaran</label>

        <input
            type="file"
            name="bukti_pembayaran"
            accept=".jpg,.jpeg,.png,.pdf">

        <small class="payment-text">

            Upload screenshot bukti transfer atau bukti pembayaran.

        </small>

    </div>

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
<script>

function showPayment(type){


    document.getElementById("bank-list").style.display = "none";
    document.getElementById("ewallet-list").style.display = "none";

    if(type=="bank"){
        document.getElementById("bank-list").style.display="block";
    }else{
        document.getElementById("ewallet-list").style.display="block";
    }

}

function pilihBank(nama, nomor, pemilik){

    document.getElementById("payment-info").innerHTML = `

    <div class="payment-detail">

        <div class="payment-header">
            <h3>${nama}</h3>
        </div>

        <div class="payment-box">

            <label>Nomor Rekening / Nomor Tujuan</label>

            <div class="copy-box">

                <span id="rekening">${nomor}</span>

                <button
                    type="button"
                    class="copy-btn"
                    onclick="copyRekening()">

                    <i class="fa-regular fa-copy"></i>
                    Salin

                </button>

            </div>

        </div>

        <div class="payment-box">

            <label>Atas Nama</label>

            <strong>${pemilik}</strong>

        </div>

        <div class="payment-box">

            <label>Total Pembayaran</label>

            <strong class="price">
                Rp <?= number_format($_GET['harga'] ?? 0,0,',','.'); ?>
            </strong>

        </div>

        <div class="payment-note">
            <i class="fa-solid fa-circle-info"></i>
            Silakan transfer sesuai nominal di atas, lalu upload bukti pembayaran.
        </div>

    </div>

    `;

    document.getElementById("upload-payment").style.display = "block";

}

function copyRekening(){

    const rekening = document.getElementById("rekening").innerText;

    navigator.clipboard.writeText(rekening);

    alert("Nomor rekening berhasil disalin!");

}
</script>
</body>
</html>