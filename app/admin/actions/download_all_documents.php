<?php
// Include the database connection
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
    $tax_year = isset($_POST['tax_year']) ? (int)$_POST['tax_year'] : null;

    // Validate required fields
    if (!$user_id || !$tax_year) {
        echo json_encode(['success' => false, 'message' => 'Invalid user or tax year']);
        exit;
    }

    // Define the file path for document directory and zip file name
    $file_path = '../../assets/uploads/documents/';
    $zip_file_name = "FileNo_{$user_id}_TY{$tax_year}.zip";

    // Initialize ZipArchive
    $zip = new ZipArchive();
    if ($zip->open($zip_file_name, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        echo json_encode(['success' => false, 'message' => 'Could not create zip file.']);
        exit;
    }

    // Prepare the SQL query to fetch document file names
    $sql = "SELECT file_name FROM documents WHERE user_id = ? AND tax_year = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $tax_year);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if documents are found and add them to the zip file
    $files_found = false;
    while ($row = $result->fetch_assoc()) {
        $file = $file_path . $row['file_name'];
        if (file_exists($file)) {
            $zip->addFile($file, basename($file));
            $files_found = true;
        }
    }

    $stmt->close();
    $zip->close();

    // If no files were found, return an error message
    if (!$files_found) {
        unlink($zip_file_name); // Delete empty zip file
        echo json_encode(['success' => false, 'message' => 'No documents available for the specified criteria.']);
        exit;
    }

    // Set headers to trigger download
    header('Content-Type: application/zip');
    header("Content-Disposition: attachment; filename=\"$zip_file_name\"");
    header('Content-Length: ' . filesize($zip_file_name));
    readfile($zip_file_name);

    // Clean up the zip file after download
    unlink($zip_file_name);
    exit;
}
?>
