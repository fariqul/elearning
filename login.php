<?php
session_start();
include 'db.php'; // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Log informasi login
    error_log("Username: $username"); // Log username
    error_log("Password: $password"); // Log password (hati-hati, jangan log password asli di produksi)
    
    // Query untuk mengecek username dan password
    $sql = "SELECT * FROM users WHERE username='$username'";
    error_log("Query: $sql"); // Log query yang dijalankan

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // Set session username
            $_SESSION['role'] = $row['role']; // Set session role

            // Arahkan ke halaman sesuai role
            if ($row['role'] == 'admin') {
                header("Location: dashboard.php"); // Arahkan ke dashboard admin
            } else {
                header("Location: user_dashboard.php"); // Arahkan ke dashboard user
            }
            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
$conn->close();
?>