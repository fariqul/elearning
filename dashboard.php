<?php
session_start();

// Cek apakah pengguna sudah login dan merupakan admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html"); // Arahkan ke halaman login jika bukan admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <div class="container">
        <h2>Dashboard Admin</h2>
        <p>Selamat datang Admin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

        <!-- Tautan untuk upload materi -->
        <a href="upload_materi.html">Upload Materi</a>

        <!-- Tautan logout -->
        <a href="logout.php">Logout</a>
    </div>
</body><br><br/>
</html>