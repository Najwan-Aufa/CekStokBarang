<?php
// Koneksi ke database MySQL
$host = "localhost";       // Host database (biasanya localhost)
$user = "root";            // Nama pengguna MySQL
$pass = "";                // Password MySQL (kosong jika menggunakan XAMPP/MAMP default)
$db   = "gudang";          // Nama database

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
