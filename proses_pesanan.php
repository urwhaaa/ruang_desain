<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ambil data form
$layanan   = $_POST['layanan'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$file      = $_POST['file_referensi'] ?? null;

// validasi
if ($layanan == '' || $deskripsi == '') {
    echo "Data tidak lengkap!";
    exit;
}

// ambil data user (biar nama/email otomatis masuk)
$user = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$user_id'");
$data = mysqli_fetch_assoc($user);

$nama  = $data['nama_lengkap'];
$email = $data['email'];
$no_hp = $data['no_hp'];

// insert pesanan
$query = mysqli_query($koneksi, "
INSERT INTO pesanan (
    user_id,
    nama_lengkap,
    email,
    no_hp,
    layanan,
    deskripsi,
    file_referensi,
    status,
    created_at
) VALUES (
    '$user_id',
    '$nama',
    '$email',
    '$no_hp',
    '$layanan',
    '$deskripsi',
    '$file',
    'Menunggu',
    NOW()
)
");

if ($query) {

    $pesanan_id = mysqli_insert_id($koneksi);

    // NOTIFIKASI
    $pesan = "📋 Pesanan berhasil dibuat dan sedang menunggu konfirmasi.";

    mysqli_query($koneksi, "
    INSERT INTO notifikasi (
    user_id,
    pesanan_id,
    jenis,
    pesan,
    status,
    created_at
)
VALUES (
    '$user_id',
    '$pesanan_id',
    'Pesanan',
    '$pesan',
    'belum_dibaca',
    NOW()
)
    ");

    header("Location: riwayat_pesanan.php");
    exit;

} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>