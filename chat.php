<?php
session_start();

include "koneksi.php";


if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}


$user_id = $_SESSION['user_id'];



// saat membuka chat, pesan admin dianggap sudah dibaca

mysqli_query($koneksi,"
UPDATE chat
SET dibaca='1'
WHERE user_id='$user_id'
AND pengirim='admin'
");




// kirim pesan

if(isset($_POST['kirim'])){


    $pesan = mysqli_real_escape_string(
        $koneksi,
        $_POST['pesan']
    );


    mysqli_query($koneksi,"
    INSERT INTO chat
    (
        user_id,
        pengirim,
        pesan,
        dibaca
    )
    VALUES
    (
        '$user_id',
        'user',
        '$pesan',
        '0'
    )
    ");



    header("Location: chat.php");
    exit;

}



// hitung pesan belum dibaca untuk badge

$badgeChat = mysqli_fetch_assoc(
mysqli_query($koneksi,"
SELECT COUNT(*) AS jumlah
FROM chat
WHERE user_id='$user_id'
AND pengirim='admin'
AND dibaca='0'
")
);


$jumlahChat = $badgeChat['jumlah'];

?>



<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Chat</title>


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<link rel="stylesheet" href="assets/css/style.css">


<style>


.chat-badge{

position:absolute;
top:-8px;
right:-10px;

background:red;
color:white;

width:20px;
height:20px;

border-radius:50%;

font-size:12px;
font-weight:bold;

display:flex;
align-items:center;
justify-content:center;

}


.chat-icon{

position:relative;

}



</style>


</head>


<body>



<?php include 'navbar.php'; ?>





<section class="page-title">

<h1>Chat Customer Service</h1>

<p>Konsultasikan kebutuhan desain Anda</p>

</section>





<section class="chat-page">





<div class="chat-sidebar">


<h2>Ruang Chat</h2>



<div class="chat-user active">


<img src="assets/img/logo.png">



<div>


<h3>RUANG DESAIN</h3>


<p>Customer Service</p>


</div>


</div>



</div>







<div class="chat-content">





<div class="chat-header">


<img src="assets/img/logo.png">



<div>


<h3>RUANG DESAIN</h3>


<span>Online</span>


</div>



</div>







<div class="chat-box" id="chatBox">



<?php


$chat = mysqli_query($koneksi,"
SELECT *
FROM chat
WHERE user_id='$user_id'
ORDER BY id ASC
");



while($c=mysqli_fetch_assoc($chat)){



if($c['pengirim']=="user"){


?>



<div class="chat-message user">


<div class="bubble">


<?= htmlspecialchars($c['pesan']); ?>


<br>


<small>

<?= date("H:i",strtotime($c['created_at'])); ?>

</small>



</div>


</div>



<?php



}else{



?>



<div class="chat-message admin">


<div class="bubble">


<?= htmlspecialchars($c['pesan']); ?>


<br>


<small>

<?= date("H:i",strtotime($c['created_at'])); ?>

</small>



</div>


</div>



<?php


}



}


?>



</div>







<form method="POST" class="chat-input">



<input

type="text"

name="pesan"

placeholder="Ketik pesan..."

required>




<button

type="submit"

name="kirim">


<i class="fa-solid fa-paper-plane"></i>


</button>



</form>







</div>




</section>






<script>

let box = document.getElementById("chatBox");

if(box){

box.scrollTop = box.scrollHeight;

}

</script>




</body>

</html>