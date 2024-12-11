<?php
require '../../config/database.php';

$user_id = $_POST['user_id'];
$tax_year = $_POST['tax_year'] ?? date('Y');

// Define directory for file uploads
// $uploadDir = $_SERVER['DOCUMENT_ROOT'] . BASE_URL . 'assets/uploads/documents/';
 $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/hnitax/assets/uploads/documents/';

$maxFileSize = 50 * 1024 * 1024; // 50MB

$response = ['status' => 'error', 'message' => 'Unknown error occurred'];

// Function to save document info in the database
function saveDocument($conn, $user_id, $tax_year, $documentType, $filePath, $fileName) {
    $query = "SELECT document_id FROM documents WHERE user_id = ? AND tax_year = ? AND document_type = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $user_id, $tax_year, $documentType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing document
        $updateQuery = "UPDATE documents SET file_path = ?, file_name = ? WHERE user_id = ? AND tax_year = ? AND document_type = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('ssiis', $filePath, $fileName, $user_id, $tax_year, $documentType);
        $updateStmt->execute();
    } else {
        // Insert new document
        $insertQuery = "INSERT INTO documents (user_id, tax_year, document_type, file_path, file_name) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param('iisss', $user_id, $tax_year, $documentType, $filePath, $fileName);
        $insertStmt->execute();
    }
}

// Get user's first name and DOB for file naming
$userQuery = "SELECT first_name, taxpayer_dob FROM personal_information WHERE user_id = ?";
$userStmt = $conn->prepare($userQuery);
$userStmt->bind_param('i', $user_id);
$userStmt->execute();
$userResult = $userStmt->get_result();
$userInfo = $userResult->fetch_assoc();
$first_name = htmlspecialchars($userInfo['first_name'], ENT_QUOTES, 'UTF-8');
$dob_formatted = date('Ymd', strtotime($userInfo['taxpayer_dob']));

try {
    if (isset($_FILES['document'])) {
        // Handle document upload
        $documentType = $_POST['document_type'] ?? 'OTHERS';
        $originalFileName = basename($_FILES['document']['name']);
        $tempPath = $_FILES['document']['tmp_name'];
        $fileSize = $_FILES['document']['size'];
        
        if ($fileSize > $maxFileSize) {
            throw new Exception("File size exceeds maximum limit of 50MB.");
        }

        $fileName = "{$first_name}_{$dob_formatted}_{$user_id}_" . time() . "_{$originalFileName}";
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($tempPath, $targetFile)) {
            saveDocument($conn, $user_id, $tax_year, $documentType, $targetFile, $fileName);
            $response = ['status' => 'success', 'message' => 'Document uploaded successfully!'];
        } else {
            throw new Exception("Failed to upload document.");
        }
    } elseif (isset($_POST['signature']) || isset($_FILES['signature_upload'])) {
        // Handle signature upload or drawn signature
        $documentType = 'SIGNATURE';
        $fileName = "{$first_name}_{$dob_formatted}_{$user_id}_" . time() . "_signature.png";
        $targetFile = $uploadDir . $fileName;

        if (isset($_POST['signature']) && !empty($_POST['signature'])) {
            // Save drawn signature
            $signatureData = $_POST['signature'];
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = base64_decode($signatureData);

            if (file_put_contents($targetFile, $signatureData)) {
                saveDocument($conn, $user_id, $tax_year, $documentType, $targetFile, $fileName);
                $response = ['status' => 'success', 'message' => 'Signature saved successfully!'];
            } else {
                throw new Exception("Failed to save drawn signature.");
            }
        } elseif (isset($_FILES['signature_upload']) && $_FILES['signature_upload']['error'] === UPLOAD_ERR_OK) {
            // Save uploaded signature
            $tempPath = $_FILES['signature_upload']['tmp_name'];

            if (move_uploaded_file($tempPath, $targetFile)) {
                saveDocument($conn, $user_id, $tax_year, $documentType, $targetFile, $fileName);
                $response = ['status' => 'success', 'message' => 'Signature uploaded successfully!'];
            } else {
                throw new Exception("Failed to upload signature.");
            }
        } else {
            throw new Exception("No signature provided.");
        }
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => 'Error: ' . $e->getMessage()];
}

echo json_encode($response);
?>
