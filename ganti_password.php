<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['ubah'])) {

    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi   = $_POST['konfirmasi'];

    $query = mysqli_query($koneksi, "SELECT password FROM users WHERE id='$user_id'");
    $data  = mysqli_fetch_assoc($query);

    if (!password_verify($password_lama, $data['password'])) {
        $error = "Password lama salah!";
    } elseif ($password_baru != $konfirmasi) {
        $error = "Konfirmasi password tidak sama!";
    } else {

        $newPass = password_hash($password_baru, PASSWORD_DEFAULT);

        mysqli_query($koneksi, "
            UPDATE users
            SET password='$newPass'
            WHERE id='$user_id'
        ");

        $success = "Password berhasil diubah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Ganti Password</title>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Poppins,sans-serif;
}

body{
    margin:0;
    background:#f3f4f8;
    font-family:Poppins,sans-serif;
}

.wrapper{
    width:100%;
    min-height:calc(100vh - 90px);
    display:flex;
    justify-content:center;
    align-items:center;
    padding:120px 20px 40px;
}

.card{
    width:100%;
    max-width:380px;   /* sebelumnya 480px */
    background:#fff;
    padding:30px;
    border-radius:16px;
    box-shadow:0 8px 20px rgba(0,0,0,.1);
}

.card h1{
    text-align:center;
    margin-bottom:25px;
    color:#222;
    font-size:30px;
    font-weight:600;
}

.input-box{
    position:relative;
    margin-bottom:15px;
}

.input-box input{
    width:100%;
    padding:14px 45px 14px 15px;
    border:1px solid #ddd;
    border-radius:12px;
    background:#edf2ff;
    font-size:15px;
    outline:none;
    transition:.3s;
}

.input-box input:focus{
    border-color:#5a45ff;
    background:#fff;
}

.input-box i{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    color:#777;
    font-size:15px;
    cursor:pointer;
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:#5145E5;
    color:#fff;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#4034d8;
}

.alert{
    padding:12px;
    border-radius:10px;
    margin-bottom:18px;
    text-align:center;
    font-weight:500;
}

.error{
    background:#ffe4e4;
    color:#d40000;
}

.success{
    background:#e5ffe7;
    color:#0d8b28;
}

</style>

</head>
<body>

<?php include "navbar.php"; ?>

<div class="wrapper">

    <div class="card">

        <h1>Ganti Password</h1>

        <?php if(!empty($error)){ ?>
            <div class="alert error"><?= $error ?></div>
        <?php } ?>

        <?php if(!empty($success)){ ?>
            <div class="alert success"><?= $success ?></div>
        <?php } ?>

        <form method="POST">

            <div class="input-box">
                <input type="password" name="password_lama" placeholder="Password Lama" required>
                <i class="fa-solid fa-eye"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password_baru" placeholder="Password Baru" required>
                <i class="fa-solid fa-eye"></i>
            </div>

            <div class="input-box">
                <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required>
                <i class="fa-solid fa-eye"></i>
            </div>

            <button type="submit" name="ubah">
                <i class="fa-solid fa-floppy-disk"></i>
                Simpan Password
            </button>

        </form>

    </div>

</div>

<script>

document.querySelectorAll(".input-box i").forEach(function(icon){

    icon.addEventListener("click",function(){

        let input = this.previousElementSibling;

        if(input.type==="password"){
            input.type="text";
            this.classList.replace("fa-eye","fa-eye-slash");
        }else{
            input.type="password";
            this.classList.replace("fa-eye-slash","fa-eye");
        }

    });

});

</script>

</body>
</html>