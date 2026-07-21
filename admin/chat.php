<?php
include "auth.php";
include "../koneksi.php";


$user = mysqli_query($koneksi,"
SELECT DISTINCT
users.id,
users.nama
FROM chat
JOIN users
ON chat.user_id = users.id
ORDER BY users.nama ASC
");


$id_user = $_GET['user'] ?? 0;



if(isset($_POST['balas']) && $id_user != 0){


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
'$id_user',
'admin',
'$pesan',
'0'
)
");


header("Location: chat.php?user=$id_user");
exit;


}



// ambil data user

$detail_user = null;


if($id_user){

$detail_user = mysqli_fetch_assoc(
mysqli_query($koneksi,"
SELECT * FROM users
WHERE id='$id_user'
")
);


// tandai chat user sudah dibaca admin

mysqli_query($koneksi,"
UPDATE chat
SET dibaca='1'
WHERE user_id='$id_user'
AND pengirim='user'
");

}


?>


<!DOCTYPE html>
<html>
<head>

<title>Chat Admin</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

</head>


<body>


<?php include 'sidebar.php'; ?>


<div class="main">


<h1>
<i class="fa-solid fa-comments"></i>
Chat Pelanggan
</h1>



<div class="chat-container">



<div class="chat-user">


<h3>Pelanggan</h3>



<ul>


<?php while($u=mysqli_fetch_assoc($user)){ ?>


<li>

<a href="?user=<?= $u['id']; ?>">

<?= htmlspecialchars($u['nama']); ?>

</a>

</li>


<?php } ?>


</ul>



</div>






<div class="chat-box">



<div class="chat-header">


<?= $detail_user['nama'] ?? "Pilih Pelanggan"; ?>


</div>




<div class="chat-body" id="chatBody">


<?php


if($id_user){


$chat=mysqli_query($koneksi,"
SELECT *
FROM chat
WHERE user_id='$id_user'
ORDER BY id ASC
");



while($c=mysqli_fetch_assoc($chat)){



if($c['pengirim']=="user"){


echo "

<div class='msg-user'>

".htmlspecialchars($c['pesan'])."

</div>

";



}else{


echo "

<div class='msg-admin'>

".htmlspecialchars($c['pesan'])."

</div>

";


}


}



}


?>


</div>





<div class="chat-footer">


<form method="POST">


<input

type="text"

name="pesan"

placeholder="Ketik pesan..."

required>



<button type="submit" name="balas">

<i class="fa-solid fa-paper-plane"></i>

</button>



</form>


</div>




</div>


</div>


</div>



<script>

let chat=document.getElementById("chatBody");

if(chat){

chat.scrollTop=chat.scrollHeight;

}

</script>



</body>

</html>