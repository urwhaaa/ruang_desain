<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Portofolio</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
<style>
/* PORTFOLIO MODERN */

.portfolio-item{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    transition:.3s;
}

.portfolio-item:hover{
    transform:translateY(-8px);
    box-shadow:0 12px 25px rgba(0,0,0,.15);
}

.portfolio-item img{
    width:100%;
    height:250px;
    object-fit:cover;
}

.portfolio-info{
    padding:20px;
}

.portfolio-info h3{
    margin-bottom:8px;
    font-size:22px;
}

.portfolio-info p{
    color:#777;
}

.filter{
    margin-bottom:40px;
}

.filter button{
    transition:.3s;
}

.filter button:hover{
    background:#6d46d6;
    color:white;
}
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f8f9fc;
}

/* ========================= */
/* JUDUL */
/* ========================= */

.page-title{
    text-align:center;
    padding:80px 20px 50px;
}

.page-title h1{
    font-size:64px;
    font-weight:700;
    color:#333;
    margin-bottom:15px;
}

.page-title p{
    font-size:22px;
    color:#666;
}

/* ========================= */
/* FILTER */
/* ========================= */

.filter{
    display:flex;
    justify-content:center;
    align-items:center;
    flex-wrap:wrap;
    gap:18px;
    margin-bottom:55px;
}

.filter button{

    padding:16px 34px;
    border:none;
    outline:none;

    border-radius:18px;

    background:#fff;
    color:#444;

    font-size:18px;
    font-weight:500;

    cursor:pointer;

    box-shadow:0 6px 18px rgba(0,0,0,.08);

    transition:.3s;
}

.filter button:hover{

    background:#7B4DFF;
    color:#fff;
    transform:translateY(-3px);

}

.filter button.active{

    background:#7B4DFF;
    color:#fff;

    box-shadow:0 10px 30px rgba(123,77,255,.35);

}

/* ========================= */
/* GRID */
/* ========================= */

.portfolio-grid{

    width:90%;
    max-width:1400px;

    margin:auto;

    display:grid;

    grid-template-columns:repeat(4,1fr);

    gap:28px;

    padding-bottom:90px;

}

/* ========================= */
/* CARD */
/* ========================= */

.portfolio-item{

    background:#fff;

    border-radius:22px;

    overflow:hidden;

    box-shadow:0 8px 25px rgba(0,0,0,.08);

    transition:.35s;

}

.portfolio-item:hover{

    transform:translateY(-10px);

    box-shadow:0 20px 45px rgba(123,77,255,.18);

}

/* ========================= */
/* GAMBAR */
/* ========================= */

.portfolio-item img{

    width:100%;

    height:210px;

    object-fit:cover;

    transition:.4s;

    display:block;

}

.portfolio-item:hover img{

    transform:scale(1.06);

}

/* ========================= */
/* INFO */
/* ========================= */

.portfolio-info{

    padding:20px;

    text-align:center;

}

.portfolio-info h3{

    font-size:22px;

    color:#333;

    margin-bottom:8px;

}

.portfolio-info p{

    color:#777;

    font-size:15px;

    line-height:1.6;

}

/* ========================= */
/* FILTER HIDE */
/* ========================= */

.hide{

    display:none;

}

/* ========================= */
/* RESPONSIVE */
/* ========================= */

@media(max-width:1200px){

    .portfolio-grid{

        grid-template-columns:repeat(3,1fr);

    }

}

@media(max-width:900px){

    .portfolio-grid{

        grid-template-columns:repeat(2,1fr);

    }

    .page-title h1{

        font-size:48px;

    }

    .page-title p{

        font-size:18px;

    }

}
.popup{

display:none;
justify-content:center;
align-items:center;

position:fixed;
left:0;
top:0;

width:100%;
height:100%;

background:rgba(0,0,0,.6);

z-index:999;

}

.popup-content{

width:500px;
max-width:90%;

background:#fff;

padding:25px;

border-radius:20px;

position:relative;

text-align:center;

}

.popup-content img{

width:100%;

height:280px;

object-fit:cover;

border-radius:15px;

margin-bottom:20px;

}

.close{

position:absolute;

right:20px;

top:10px;

font-size:35px;

cursor:pointer;

}

#popup-rating{

color:#FFD700;

font-size:22px;

margin:15px 0;

}
@media(max-width:600px){

    .portfolio-grid{

        grid-template-columns:1fr;

    }

    .page-title{

        padding-top:50px;

    }

    .page-title h1{

        font-size:36px;

    }

    .page-title p{

        font-size:16px;

    }

    .filter{

        gap:12px;

    }

    .filter button{

        padding:12px 22px;

        font-size:15px;

    }

    .portfolio-item img{

        height:220px;

    }

}
</style>

</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
<h1>Portofolio Kami</h1>
<p>Beberapa hasil desain terbaik yang telah kami kerjakan</p>
</section>

<div class="filter">

<button class="active" data-filter="all">Semua</button>

<button data-filter="logo">Logo</button>

<button data-filter="poster">Poster</button>

<button data-filter="feed">Feed IG</button>

<button data-filter="banner">Banner</button>

</div>

<?php
$data = mysqli_query($koneksi,"SELECT * FROM portofolio ORDER BY id DESC");
?>

<section class="portfolio-grid">

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<div class="portfolio-item"
data-category="<?= strtolower($row['kategori']); ?>"

onclick="openPopup(
'assets/css/img/portofolio/<?= $row['gambar']; ?>',
'<?= htmlspecialchars($row['judul']); ?>',
'<?= htmlspecialchars($row['kategori']); ?>',
'⭐⭐⭐⭐⭐ 5.0',
'<?= htmlspecialchars($row['deskripsi']); ?>'
)">

<img src="assets/css/img/portofolio/<?= $row['gambar']; ?>">

<div class="portfolio-info">

<h3><?= htmlspecialchars($row['judul']); ?></h3>

<p><?= htmlspecialchars($row['kategori']); ?></p>

</div>

</div>

<?php } ?>

</section>

<script>

const buttons=document.querySelectorAll(".filter button");
const items=document.querySelectorAll(".portfolio-item");

buttons.forEach(button=>{

button.addEventListener("click",()=>{

buttons.forEach(btn=>btn.classList.remove("active"));

button.classList.add("active");

const filter=button.dataset.filter;

items.forEach(item=>{

if(filter==="all"){

item.classList.remove("hide");

}

else{

if(item.dataset.category===filter){

item.classList.remove("hide");

}

else{

item.classList.add("hide");

}

}

});

});

});

</script>

<div class="popup" id="popup">

    <div class="popup-content">

        <span class="close" onclick="closePopup()">&times;</span>

        <img id="popup-img">

        <h2 id="popup-title"></h2>

        <div id="popup-rating"></div>

        <p id="popup-desc"></p>

    </div>

</div>

<script>

const buttons=document.querySelectorAll(".filter button");
const items=document.querySelectorAll(".portfolio-item");

buttons.forEach(button=>{

button.addEventListener("click",()=>{

buttons.forEach(btn=>btn.classList.remove("active"));

button.classList.add("active");

const filter=button.dataset.filter;

items.forEach(item=>{

if(filter==="all"){

item.classList.remove("hide");

}else{

if(item.dataset.category===filter){

item.classList.remove("hide");

}else{

item.classList.add("hide");

}

}

});

});

});

// =================== POPUP ===================

function openPopup(img,title,desc,rating,longdesc){

document.getElementById("popup").style.display="flex";

document.getElementById("popup-img").src=img;

document.getElementById("popup-title").innerHTML=title;

document.getElementById("popup-rating").innerHTML=rating;

document.getElementById("popup-desc").innerHTML=
"<b>"+desc+"</b><br><br>"+longdesc;

}

function closePopup(){

document.getElementById("popup").style.display="none";

}

window.onclick=function(e){

if(e.target==document.getElementById("popup")){

closePopup();

}

}

</script>
<?php include "footer.php"; ?>
</body>
</html>