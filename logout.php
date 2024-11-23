<?php
session_start(); // Mulai session

// Hapus semua data session
session_unset(); // Menghapus semua variabel session
session_destroy(); // Menghancurkan session

// Arahkan kembali ke halaman login
header("Location: login.html");
exit();
?>