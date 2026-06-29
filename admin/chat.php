<?php
include "../koneksi.php";

$user = mysqli_query($koneksi,"
SELECT DISTINCT
users.id,
users.nama
FROM chat
JOIN users
ON chat.user_id = users.id
");
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

<h1>Chat Pelanggan</h1>

<div class="chat-container">

<div class="chat-user">

<h3>Pelanggan</h3>

<ul>

<?php
while($u=mysqli_fetch_assoc($user)){
?>

<li>
<a href="?user=<?=$u['id'];?>">

<?=$u['nama'];?>

</a>
</li>

<?php } ?>

</ul>

</div>

<div class="chat-box">
<?php

$id_user = isset($_GET['user'])
? $_GET['user']
: 0;

?>
<?php

$detail_user = mysqli_fetch_assoc(
mysqli_query(
$koneksi,
"SELECT * FROM users
WHERE id='$id_user'"
)
);

?>

<div class="chat-header">

<?= $detail_user['nama'] ?? 'Pilih Pelanggan'; ?>

</div>

<div class="chat-body">

<?php

$chat = mysqli_query($koneksi,"
SELECT *
FROM chat
WHERE user_id='$id_user'
ORDER BY id ASC
");

while($c=mysqli_fetch_assoc($chat)){

if($c['pengirim']=='user'){

echo "
<div class='msg-user'>
".$c['pesan']."
</div>
";

}else{

echo "
<div class='msg-admin'>
".$c['pesan']."
</div>
";

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

<button
type="submit"
name="balas">

Kirim

</button>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['balas'])){

$pesan = $_POST['pesan'];

mysqli_query($koneksi,"
INSERT INTO chat
(user_id,pengirim,pesan)
VALUES
(
'$id_user',
'admin',
'$pesan'
)
");



echo "
<script>
location='chat.php?user=$id_user';
</script>
";

}
?>
</body>
</html>