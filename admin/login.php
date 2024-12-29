<?php
session_start();
include '../includes/koneksi.php'; // Menghubungkan ke database

// Cek apakah admin sudah login
if (isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash password dengan MD5

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username; // Set sesi admin
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Login Admin</h1>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
