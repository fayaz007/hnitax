<?php
// download_all_documents.php
require '../../config/database.php';

if (isset($_GET['user_id'], $_GET['tax_year'])) {
    $user_id = (int) $_GET['user_id'];
    $tax_year = (int) $_GET['tax_year'];

    // Set the directory for document files
    $file_path = '../assets/uploads/documents/';
    $zip_file_name = "FileNo_{$user_id}_TY{$tax_year}.zip";

    // Initialize ZipArchive
    $zip = new ZipArchive();
    if ($zip->open($zip_file_name, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        exit("Cannot open <$zip_file_name>\n");
    }

    // Query to fetch documents
    $sql = "SELECT file_name FROM documents WHERE user_id = ? AND tax_year = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $tax_year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $file = $file_path . $row['file_name'];
            if (file_exists($file)) {
                $zip->addFile($file, basename($file));
            }
        }
    } else {
        exit("No documents found for the specified user and tax year.");
    }

    // Close the zip file
    $zip->close();
    $stmt->close();

    // Set headers to initiate download
    header('Content-Type: application/zip');
    header("Content-Disposition: attachment; filename=\"$zip_file_name\"");
    header('Content-Length: ' . filesize($zip_file_name));
    readfile($zip_file_name);

    // Delete the zip file after download
    unlink($zip_file_name);
}
?>
