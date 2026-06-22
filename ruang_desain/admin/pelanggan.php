<!DOCTYPE html>
<html>
<head>

<title>Data Pelanggan</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">

    <div class="top-bar">

        <h1>Data Pelanggan</h1>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>
    <img src="https://i.pinimg.com/736x/13/70/32/137032d11b59a13f0d9b295b64de960b.jpg" class="user-admin">
</td>
                    <td>Urwaa</td>
                    <td>urwaa@gmail.com</td>
                    <td>
                        <span class="status selesai">
                            Aktif
                        </span>
                    </td>
                    <td>
                        <a href="#" class="detail-btn">
                            Detail
                        </a>

                        <a href="#" class="delete-btn">
                            Hapus
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
       <td>
    <img src="https://i.pinimg.com/1200x/20/46/97/20469732a4932780530d26046ddd1c47.jpg" class="user-admin">
</td>
                    <td>riri</td>
                    <td>riri@gmail.com</td>
                    <td>
                        <span class="status selesai">
                            Aktif
                        </span>
                    </td>
                    <td>
                        <a href="#" class="detail-btn">
                            Detail
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