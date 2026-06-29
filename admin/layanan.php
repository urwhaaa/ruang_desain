<!DOCTYPE html>
<html>
<head>
    <title>Data Layanan</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">

    <div class="top-bar">

        <h1>Data Layanan</h1>

        <a href="tambah_layanan.php" class="add-btn">
            <i class="fa-solid fa-plus"></i>
            Tambah Layanan
        </a>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>
    <img src="https://i.pinimg.com/1200x/30/b8/0d/30b80d8b8a615602f0db851e09247c99.jpg"
    class="img-admin">
</td>
                    <td>Desain Logo</td>
                    <td>Rp 90.000</td>
                    <td>

                        <a href="#" class="edit-btn">
                            Edit
                        </a>

                        <a href="#" class="delete-btn">
                            Hapus
                        </a>

                    </td>
                </tr>

                <tr>
                    <td>2</td>
                   <td>
    <img src="https://i.pinimg.com/736x/54/d4/0a/54d40a46b7b418ba87eb4298c3e0d7ed.jpg"
    class="img-admin">
</td>
                    <td>Desain Poster</td>
                    <td>Rp 100.000</td>
                    <td>

                        <a href="#" class="edit-btn">
                            Edit
                        </a>

                        <a href="#" class="delete-btn">
                            Hapus
                        </a>

                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>