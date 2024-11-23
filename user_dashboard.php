<?php
session_start(); // Mulai session

// Cek apakah pengguna sudah login dan merupakan user
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.html"); // Arahkan ke halaman login jika bukan user
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard User</title>
</head>
<body>
    <div class="container">
        <h2>Dashboard User</h2>
        <p>Selamat datang User, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

        <h3>Daftar Materi:</h3>
        <?php
        include 'db.php'; // Menghubungkan ke database
        
        // Query untuk mengambil semua materi yang telah di-upload
        $sql = "SELECT * FROM materi"; // Anda bisa menambahkan kondisi jika diperlukan
        $result = $conn->query($sql); // Eksekusi query

        if ($result->num_rows > 0) {
            echo "<ul>";
            while($row = $result->fetch_assoc()) { // Mengambil setiap baris data
                echo "<li><a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>" . htmlspecialchars($row['title']) . "</a> - Di-upload oleh: " . htmlspecialchars($row['uploaded_by']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Belum ada materi yang di-upload.";
        }
        
        $conn->close(); // Menutup koneksi database
        ?>
        
        <a href="logout.php">Logout</a> <!-- Tambahkan link logout -->
    </div>
</body>
</html>