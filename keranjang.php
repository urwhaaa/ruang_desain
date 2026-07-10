<?php
session_start();
include "koneksi.php";

$user_id = $_SESSION['user_id'];

$query = mysqli_query($koneksi,"
SELECT *
FROM keranjang
WHERE user_id='$user_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keranjang Saya</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<?php include "navbar.php"; ?>

<section class="page-title">
    <h1>Keranjang Saya</h1>
    <p>Daftar layanan yang akan Anda pesan</p>
</section>

<section class="cart-container">

<form action="checkout.php" method="POST">

<div class="cart-items">

<div class="cart-top">
<input type="checkbox" id="checkAll">
<label for="checkAll">Pilih Semua</label>
</div>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<div class="cart-card">

<div class="cart-check">

<input
type="checkbox"
name="keranjang[]"
value="<?= $row['id']; ?>"
class="item-check"
data-id="<?= $row['id']; ?>"
data-harga="<?= $row['harga']; ?>"
data-jumlah="<?= $row['jumlah']; ?>">
</div>

<img src="<?= $row['gambar']; ?>" class="cart-img">

<div class="cart-info">

<h3><?= $row['layanan']; ?></h3>

<p class="cart-paket">
    Paket : <strong><?= $row['paket']; ?></strong>
</p>

<span>
Rp <?= number_format($row['harga'],0,',','.'); ?>
</span>

<div class="qty-box">

<button
type="button"
class="minus"
data-id="<?= $row['id']; ?>">
-
</button>

<span class="jumlah">
<?= $row['jumlah']; ?>
</span>

<button type="button" class="plus" data-id="<?= $row['id']; ?>">
+
</button>

</div>

</div>

<div class="cart-action">

<a
href="hapus_keranjang.php?id=<?= $row['id']; ?>"
onclick="return confirm('Hapus layanan ini?')">

<i class="fa-solid fa-trash"></i>

</a>

</div>

</div>

<?php } ?>

</div>

<div class="cart-summary">

<h2>Ringkasan Pesanan</h2>

<div class="summary-item">
<span>Total Layanan</span>
<strong id="totalItem">0</strong>
</div>

<div class="summary-item">
<span>Total Harga</span>
<strong id="totalHarga">Rp 0</strong>
</div>

<button type="submit" class="checkout-btn">
Lanjut Pemesanan
</button>

</div>

</form>

</section>
<script>
const checkAll = document.getElementById("checkAll");
const items = document.querySelectorAll(".item-check");

function hitungTotal(){

    let totalItem = 0;
    let totalHarga = 0;

    items.forEach(item=>{

        if(item.checked){

            totalItem++;

            totalHarga +=
                Number(item.dataset.harga) *
                Number(item.dataset.jumlah);

        }

    });

    document.getElementById("totalItem").innerHTML = totalItem;

    document.getElementById("totalHarga").innerHTML =
    "Rp " + totalHarga.toLocaleString("id-ID");

}

checkAll.onclick = function(){

    items.forEach(item=>{

        item.checked = this.checked;

    });

    hitungTotal();

}

items.forEach(item=>{

    item.onclick = function(){

        let semua = true;

        items.forEach(i=>{

            if(!i.checked){
                semua = false;
            }

        });

        checkAll.checked = semua;

        hitungTotal();

    }

});

hitungTotal();

</script>
<script>

document.querySelectorAll(".plus").forEach(function(btn){

btn.onclick=function(){

let card=this.closest(".cart-card");

let jumlah=card.querySelector(".jumlah");

fetch("update_jumlah.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"id="+this.dataset.id+"&aksi=plus"

})

.then(r=>r.json())

.then(data=>{

jumlah.innerHTML=data.jumlah;

let cek=card.querySelector(".item-check");

cek.dataset.jumlah=data.jumlah;

hitungTotal();

});

}

});

document.querySelectorAll(".minus").forEach(function(btn){

btn.onclick=function(){

let card=this.closest(".cart-card");

let jumlah=card.querySelector(".jumlah");

fetch("update_jumlah.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"id="+this.dataset.id+"&aksi=minus"

})

.then(r=>r.json())

.then(data=>{

jumlah.innerHTML=data.jumlah;

let cek=card.querySelector(".item-check");

cek.dataset.jumlah=data.jumlah;

hitungTotal();

});

}

});

</script>

</body>
</html