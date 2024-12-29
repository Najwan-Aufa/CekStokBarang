<?php
// Cek login admin
include 'admin/cek_login.php';

// Hubungkan ke database
include 'includes/koneksi.php';

// Proses tambah barang
if (isset($_POST['submit'])) {
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $jumlah = intval($_POST['jumlah']);

    // Validasi input
    if ($nama_barang == '' || $jumlah == '') {
        echo "<script>alert('Semua kolom harus diisi!'); window.location='tambah_barang.php';</script>";
    } else {
        // Tambahkan data ke database
        $query = "INSERT INTO barang (nama_barang, jumlah) VALUES ('$nama_barang', $jumlah)";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Barang berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan barang!'); window.location='tambah_barang.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Tambah Barang</h1>
    <form method="POST" action="">
        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required><br><br>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required><br><br>
        <button type="submit" name="submit">Tambah Barang</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
