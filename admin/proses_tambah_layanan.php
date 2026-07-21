<?php
include "auth.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $kategori      = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $nama_layanan  = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $basic   = (int) $_POST['basic'];
    $standar = (int) $_POST['standar'];
    $premium = (int) $_POST['premium'];

    // ==========================
    // Upload Gambar
    // ==========================

    $gambar = "";

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {

        $folder = "../assets/css/img/layanan/";

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        $namaFile = "layanan_" . time() . "." . $ext;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $namaFile)) {

            // path yang disimpan ke database
            $gambar = "uploads/layanan/" . $namaFile;

        } else {

            echo "<script>
                    alert('Upload gambar gagal!');
                    window.history.back();
                  </script>";
            exit;
        }
    }

    // ==========================
    // Simpan Layanan
    // ==========================

    $insert = mysqli_query($koneksi, "
        INSERT INTO layanan
        (kategori,nama_layanan,deskripsi,gambar)
        VALUES
        (
            '$kategori',
            '$nama_layanan',
            '$deskripsi',
            '$gambar'
        )
    ");

    if (!$insert) {
        die("Error layanan : " . mysqli_error($koneksi));
    }

    $layanan_id = mysqli_insert_id($koneksi);

    // ==========================
    // Simpan Paket
    // ==========================

    mysqli_query($koneksi,"
        INSERT INTO paket(layanan_id,nama_paket,harga)
        VALUES('$layanan_id','Basic','$basic')
    ");

    mysqli_query($koneksi,"
        INSERT INTO paket(layanan_id,nama_paket,harga)
        VALUES('$layanan_id','Standar','$standar')
    ");

    mysqli_query($koneksi,"
        INSERT INTO paket(layanan_id,nama_paket,harga)
        VALUES('$layanan_id','Premium','$premium')
    ");

    echo "<script>
            alert('Layanan berhasil ditambahkan');
            window.location='layanan.php';
          </script>";

    exit;
}

header("Location: layanan.php");
exit;
?>