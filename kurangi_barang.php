<?php
// Hubungkan ke database
include 'includes/koneksi.php';

// Cek apakah ID tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data barang
    $query = "SELECT * FROM barang WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // Kurangi stok barang
    if ($data['jumlah'] > 0) {
        $new_jumlah = $data['jumlah'] - 1;
        $query_update = "UPDATE barang SET jumlah = $new_jumlah WHERE id = $id";
        mysqli_query($koneksi, $query_update);
        echo "<script>alert('Stok berhasil dikurangi!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Stok sudah habis!'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='index.php';</script>";
}
?>
