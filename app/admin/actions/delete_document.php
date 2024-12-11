<?php
require '../../config/database.php';


if (isset($_POST['document_id'])) {
    $document_id = intval($_POST['document_id']);
    
    // Define the target directory using DOCUMENT_ROOT and BASE_URL
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . BASE_URL . 'assets/uploads/documents/';
    
    // Fetch the file path from the database
    $sql = "SELECT file_name FROM documents WHERE document_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $document_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $targetDir . $row['file_name']; // Full file path

        // Check if the file exists and delete it
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        // Delete the record from the database
        $delete_sql = "DELETE FROM documents WHERE document_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $document_id);
        
        if ($delete_stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
        $delete_stmt->close();
    } else {
        echo "error"; // Document not found
    }

    $stmt->close();
}
?>
