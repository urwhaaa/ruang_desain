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
</head>
<body>

<?php include 'navbar.php'; ?>

<section class="page-title">
    <h1>Chat Customer Service</h1>
    <p>Konsultasikan kebutuhan desain Anda</p>
</section>

<section class="chat-container">

    <div class="chat-box">

        <div class="chat-message admin">
            Halo, ada yang bisa kami bantu?
        </div>

        <div class="chat-message user">
            Saya ingin pesan desain logo.
        </div>

        <div class="chat-message admin">
            Baik, silakan jelaskan konsep yang diinginkan.
        </div>

    </div>

    <div class="chat-input">

        <input type="text" placeholder="Tulis pesan...">

        <button>
            <i class="fa-solid fa-paper-plane"></i>
        </button>

    </div>

</section>

</body>
</html>