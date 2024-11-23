<?php
session_start(); // Mulai session

// Cek apakah pengguna sudah login dan merupakan admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php"); // Arahkan ke dashboard jika bukan admin
    exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $uploaded_by = $_SESSION['username'];

    if (isset($_FILES['file'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        if ($_FILES["file"]["size"] > 5000000000) { 
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        if ($fileType != "pdf" && $fileType != "jpg" && $fileType != "png") {
            echo "Maaf, hanya file PDF, JPG & PNG yang diizinkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO materi (title, file_path, uploaded_by) VALUES ('$title', '$target_file', '$uploaded_by')";
                if ($conn->query($sql) === TRUE) {
                    echo "Materi berhasil di-upload!";
                    header("Location: dashboard.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Maaf, terjadi kesalahan saat meng-upload file.";
            }
        }
    } else {
        echo "File tidak ditemukan.";
    }
}
$conn->close();
?>