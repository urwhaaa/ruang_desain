<!DOCTYPE html>
<html>
<head>

<title>Data Pesanan</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="../assets/css/admin.css">

</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">

<h1>Data Pesanan</h1>

<div class="table-container">

<table>

<thead>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Layanan</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<tr>
<td>1</td>
<td>Urwaa</td>
<td>Desain Logo</td>
<td>12/08/2026</td>
<td>
<span class="status pending">
Menunggu
</span>
</td>
<td>
<button class="edit-btn">
Edit
</button>
</td>
</tr>

<tr>
<td>2</td>
<td>Budi</td>
<td>Banner</td>
<td>12/08/2026</td>
<td>
<span class="status proses">
Diproses
</span>
</td>
<td>
<a href="edit_pesanan.php?id=<?php echo $row['id']; ?>"
class="edit-btn">
Edit
</a>
</td>
</tr>

</tbody>

</table>

</div>

</div>

</body>
</html>