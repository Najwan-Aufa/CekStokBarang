<?php
// Hubungkan ke database
include 'includes/koneksi.php';

// Cek apakah ID tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari database
    $query = "DELETE FROM barang WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Barang berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus barang!'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='index.php';</script>";
}
?>
