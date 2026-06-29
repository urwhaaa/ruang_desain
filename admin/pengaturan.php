<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pengaturan</title>

<link rel="stylesheet" href="../assets/css/admin.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">

    <div class="top-bar">

        <h1>Pengaturan Website</h1>

    </div>

    <div class="form-admin">

        <form>

            <label>Nama Website</label>
            <input type="text" value="RUANG DESAIN">

            <label>Email Website</label>
            <input type="email" value="admin@gmail.com">

            <label>Nomor WhatsApp</label>
            <input type="text" value="08123456789">

            <label>Alamat</label>
            <textarea rows="5">Mataram, Nusa Tenggara Barat</textarea>

            <button type="submit">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

</body>
</html>