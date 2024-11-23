<?php
        include 'db.php';
        
        $sql = "SELECT * FROM materi";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while($row = $result->fetch_assoc()) {
                echo "<li><a href='" . $row['file_path'] . "' target='_blank'>" . $row['title'] . "</a> - Di-upload oleh: " . $row['uploaded_by'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Belum ada materi yang di-upload.";
        }
        
        $conn->close();
        ?>