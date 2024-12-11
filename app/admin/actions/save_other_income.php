<?php
require '../../config/database.php';

$user_id = $_POST['user_id'];
$tax_year = $_POST['tax_year'] ?? date('Y');



// Income fields
$sold_stocks = $_POST['sold_stocks'] ?? 'no';
$interest_income = $_POST['interest_income'] ?? 'no';
$dividend_income = $_POST['dividend_income'] ?? 'no';
$rental_income = $_POST['rental_income'] ?? 'no';
$ira_distributions = $_POST['ira_distributions'] ?? 'no';
$foreign_income = $_POST['foreign_income'] ?? 'no';
$foreign_income_nature = $_POST['foreign_income_nature'] ?? '';
$hsa_distributions = $_POST['hsa_distributions'] ?? 'no';

try {
    // Check if income record already exists
    $query = "SELECT income_id FROM other_income WHERE user_id = ? AND tax_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $user_id, $tax_year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing income record
        $query = "UPDATE other_income SET sold_stocks = ?, interest_income = ?, dividend_income = ?, 
                  rental_income = ?, ira_distributions = ?, foreign_income = ?, foreign_income_nature = ?, 
                  hsa_distributions = ? 
                  WHERE user_id = ? AND tax_year = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            'ssssssssii',
            $sold_stocks,
            $interest_income,
            $dividend_income,
            $rental_income,
            $ira_distributions,
            $foreign_income,
            $foreign_income_nature,
            $hsa_distributions,
            $user_id,
            $tax_year
        );
        $stmt->execute();
    } else {
        // Insert new income record
        $query = "INSERT INTO other_income (user_id, tax_year, sold_stocks, interest_income, dividend_income, 
                  rental_income, ira_distributions, foreign_income, foreign_income_nature, hsa_distributions) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            'iissssssss',
            $user_id,
            $tax_year,
            $sold_stocks,
            $interest_income,
            $dividend_income,
            $rental_income,
            $ira_distributions,
            $foreign_income,
            $foreign_income_nature,
            $hsa_distributions
        );
        $stmt->execute();
    }

    // Fetch user's first name and DOB for file naming
    $userQuery = "SELECT first_name, taxpayer_dob FROM personal_information WHERE user_id = ?";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bind_param('i', $user_id);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    $userInfo = $userResult->fetch_assoc();
    $first_name = htmlspecialchars($userInfo['first_name'], ENT_QUOTES, 'UTF-8');
    $dob_formatted = date('Ymd', strtotime($userInfo['taxpayer_dob']));

    // File uploads with update or insert based on document type
    $uploadFields = [
        'upload_1099B' => '1099B',
        'upload_1099INT' => '1099INT',
        'upload_1099DIV' => '1099DIV'
    ];

    foreach ($uploadFields as $field => $documentType) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $originalFileName = basename($_FILES[$field]['name']);
            $tempPath = $_FILES[$field]['tmp_name'];
            //  $targetDir = $_SERVER['DOCUMENT_ROOT'] . BASE_URL . 'assets/uploads/documents/';
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/hnitax/assets/uploads/documents/';


            $file_name = $first_name . '_' . $dob_formatted . '_' . $user_id . '_' . time() . '_' . $originalFileName;
            $targetFile = $targetDir . $file_name;

            if (move_uploaded_file($tempPath, $targetFile)) {
                // Check if the document type already exists
                $docQuery = "SELECT document_id FROM documents WHERE user_id = ? AND tax_year = ? AND document_type = ?";
                $docStmt = $conn->prepare($docQuery);
                $docStmt->bind_param('iis', $user_id, $tax_year, $documentType);
                $docStmt->execute();
                $docResult = $docStmt->get_result();

                if ($docResult->num_rows > 0) {
                    // Update existing document path and file name
                    $updateQuery = "UPDATE documents SET file_path = ?, file_name = ? WHERE user_id = ? AND tax_year = ? AND document_type = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param('ssiis', $targetFile, $file_name, $user_id, $tax_year, $documentType);
                    $updateStmt->execute();
                } else {
                    // Insert new document record with file name
                    $insertQuery = "INSERT INTO documents (user_id, tax_year, document_type, file_path, file_name) VALUES (?, ?, ?, ?, ?)";
                    $insertStmt = $conn->prepare($insertQuery);
                    $insertStmt->bind_param('iisss', $user_id, $tax_year, $documentType, $targetFile, $file_name);
                    $insertStmt->execute();
                }
            }
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Record saved successfully!']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error saving record: ' . $e->getMessage()]);
}
