<?php
$servername = "localhost";
$username = "root"; // default username XAMPP
$password = ""; // default password XAMPP
$dbname = "E_learning";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>