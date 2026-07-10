<style>
.footer{
    background:#18122B;
    color:#fff;
    margin-top:80px;
    font-family:'Poppins',sans-serif;
}

.footer-container{
    width:90%;
    max-width:1200px;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:40px;
    padding:60px 0;
}

.footer-box h2{
    color:#8B5CF6;
    margin-bottom:15px;
    font-size:28px;
}

.footer-box h3{
    margin-bottom:15px;
    font-size:20px;
}

.footer-box p{
    color:#ddd;
    line-height:1.8;
    font-size:15px;
}

.footer-box a{
    display:block;
    color:#ddd;
    text-decoration:none;
    margin-bottom:10px;
    transition:.3s;
}

.footer-box a:hover{
    color:#8B5CF6;
    padding-left:5px;
}

.footer-bottom{
    border-top:1px solid rgba(255,255,255,.15);
    text-align:center;
    padding:20px;
    color:#ccc;
    font-size:14px;
}
</style>

<footer class="footer">

    <div class="footer-container">

        <div class="footer-box">
            <h2>Ruang Desain</h2>

            <p>
                Ruang Desain adalah tempat terbaik untuk membantu
                mewujudkan ide kreatifmu menjadi desain yang menarik,
                modern, dan profesional.
            </p>
        </div>

        <div class="footer-box">
            <h3>Menu</h3>

            <a href="index.php">Beranda</a>
            <a href="layanan.php">Layanan</a>
            <a href="portofolio.php">Portofolio</a>
            <a href="tentang.php">Tentang Kami</a>
        </div>

        <div class="footer-box">
            <h3>Layanan</h3>

            <p>🎨 Desain Logo</p>
            <p>📱 Feed Instagram</p>
            <p>🖼️ Poster & Banner</p>
            <p>💻 UI / UX Design</p>
            <p>📄 Desain Brosur</p>
        </div>

        <div class="footer-box">
            <h3>Kontak</h3>

            <p>📍 Mataram, Lombok NTB</p>
            <p>📞 082146495554</p>
            <p>✉️ ruangdesain@gmail.com</p>
        </div>

    </div>

    <div class="footer-bottom">
        © <?php echo date('Y'); ?> Ruang Desain | All Rights Reserved.
    </div>

</footer>