<?php
require '../../config/database.php';

$user_id = $_POST['user_id'];
$tax_year = $_POST['tax_year'];
$document_type = $_POST['document_type'];
$from_admin = 1; // Assuming it's not uploaded by admin
$uploaded_at = date('Y-m-d H:i:s'); // Current timestamp

// Define the upload directory using the specified path
// $uploadDir = $_SERVER['DOCUMENT_ROOT'] . BASE_URL . 'assets/uploads/documents/';
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/hnitax/assets/uploads/documents/';
// File handling
if (!empty($_FILES['document']['name'])) {
    $file_name = $_FILES['document']['name'];
    $file_tmp = $_FILES['document']['tmp_name'];
    $file_size = $_FILES['document']['size'];

    // Check file size (50MB max)
    if ($file_size > 52428800) { // 50MB in bytes
        http_response_code(400);
        echo json_encode(["message" => "File size should not exceed 50MB."]);
        exit;
    }

    // Define the complete file path
    $target_file = $uploadDir . basename($file_name);

    // Move the uploaded file
    if (move_uploaded_file($file_tmp, $target_file)) {
        // Insert file details into the database using MySQLi
        $sql = "INSERT INTO documents (user_id, file_name, tax_year, uploaded_at, admin_file, from_admin) 
                VALUES ('$user_id', '$file_name', '$tax_year', '$uploaded_at', '$document_type', '$from_admin')";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["message" => "Document uploaded successfully!"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Database error: " . mysqli_error($conn)]);
        }
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to upload file."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "No file selected for upload."]);
}
?>
