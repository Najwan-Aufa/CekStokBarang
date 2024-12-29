<?php
// Cek login admin
include 'admin/cek_login.php';

// Hubungkan ke database
include 'includes/koneksi.php';

// Proses pencarian
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM barang WHERE nama_barang LIKE '%$search%'";
} else {
    $query = "SELECT * FROM barang";
}

// Ambil semua data barang
$result = mysqli_query($koneksi, $query);
$total_rows = mysqli_num_rows($result);

// Batasi jumlah barang yang ditampilkan awalnya (15)
$limit = 15;

// Ambil parameter halaman
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Query dengan LIMIT
$query .= " LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Stok Gudang</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Data Stok Barang di Gudang</h1>

    <!-- Form Pencarian -->
    <form method="GET" action="" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Cari barang..." value="<?php echo $search; ?>" />
        <button type="submit">Cari</button>
    </form>

    <!-- Header dengan tombol sejajar -->
    <div class="header">
        <!-- Tombol Tambah Barang -->
        <a href="tambah_barang.php" class="btn-tambah">Tambah Barang</a>

        <!-- Tombol Logout -->
        <a href="admin/logout.php" class="btn-logout">Logout</a>
    </div>


    <!-- Tabel Data Barang -->
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = $offset + 1; // Nomor urut dimulai dari offset + 1
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['nama_barang'] . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>
                        <a href='kurangi_barang.php?id=" . $row['id'] . "'>Kurangi</a> |
                        <a href='hapus_barang.php?id=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus barang ini?\");'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Tombol Load More -->
    <?php if (($limit * $page) < $total_rows): ?>
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>" class="load-more">Load More</a>
        </div>
    <?php endif; ?>
</body>
</html>
