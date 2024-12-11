<?php
require '../../config/database.php';

// Check if the user is logged in
$user_id = $_POST['user_id'] ?? null;
$tax_year = $_POST['tax_year'] ?? null;


if (!$user_id) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Fetch user's first name and date of birth from personal_information table
$query = "SELECT first_name, taxpayer_dob FROM personal_information WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'User information not found']);
    exit;
}

$user_info = $result->fetch_assoc();
$first_name = htmlspecialchars($user_info['first_name'], ENT_QUOTES, 'UTF-8');
$taxpayer_dob = $user_info['taxpayer_dob'];

// Initialize variables and sanitize inputs
$health_insurance = htmlspecialchars($_POST['health_insurance'] ?? '', ENT_QUOTES, 'UTF-8');
$coverage_duration = htmlspecialchars($_POST['coverage_duration'] ?? '', ENT_QUOTES, 'UTF-8');
$insurance_provider = htmlspecialchars($_POST['insurance_provider'] ?? '', ENT_QUOTES, 'UTF-8');
$form_1095a_upload = null;

$document_type = 'Form_1095A';
$previous_file = null;
$query = "SELECT file_name FROM documents WHERE user_id = ? AND document_type = ? AND tax_year =?";
$stmt = $conn->prepare($query);
$stmt->bind_param('iss', $user_id, $document_type, $tax_year);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $document = $result->fetch_assoc();
    $previous_file = $document['file_name'];
}
$stmt->close();

// Handle file upload if the insurance provider is 'Market' and file is uploaded
if ($insurance_provider === 'Market' && isset($_FILES['form_1095a_upload']) && $_FILES['form_1095a_upload']['size'] > 0) {
    $file = $_FILES['form_1095a_upload'];
    //  $target_dir = $_SERVER['DOCUMENT_ROOT'] . BASE_URL . 'assets/uploads/documents/';
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/hnitax/assets/uploads/documents/';

    $dob_formatted = date('Ymd', strtotime($taxpayer_dob));
    $file_name = $first_name . '_' . $dob_formatted . '_' . $user_id . '_' . time() . '_' . basename($file["name"]);
    $target_file = $target_dir . $file_name;

    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'pdf', 'zip', 'doc', 'docx'];
    $max_file_size = 50 * 1024 * 1024;

    if ($file['size'] > $max_file_size) {
        echo json_encode(['error' => 'File size exceeds 50 MB limit.']);
        exit;
    }

    if (!in_array($file_type, $allowed_types)) {
        echo json_encode(['error' => 'Invalid file type. Allowed types: ' . implode(', ', $allowed_types)]);
        exit;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $form_1095a_upload = $file_name;
    } else {
        echo json_encode(['error' => 'There was an error uploading your file.']);
        exit;
    }
} else {
    $form_1095a_upload = $previous_file;
}

$tax_year = $_POST['tax_year'] ?? null;
$query = "SELECT * FROM insurance_details WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $user_id, $tax_year);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $query = "UPDATE insurance_details SET health_insurance = ?, coverage_duration = ?, insurance_provider = ?, form_1095a_upload = ? 
              WHERE user_id = ? AND tax_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssii', $health_insurance, $coverage_duration, $insurance_provider, $form_1095a_upload, $user_id, $tax_year);
} else {
    $query = "INSERT INTO insurance_details (user_id, health_insurance, coverage_duration, insurance_provider, form_1095a_upload, tax_year) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssi', $user_id, $health_insurance, $coverage_duration, $insurance_provider, $form_1095a_upload, $tax_year);
}

if ($stmt->execute()) {
    // Only proceed with document insertion if a new file was uploaded
    if ($form_1095a_upload) {
        $document_query = "SELECT * FROM documents WHERE user_id = ? AND tax_year = ? AND document_type = ?";
        $doc_stmt = $conn->prepare($document_query);
        $doc_stmt->bind_param('iis', $user_id, $tax_year, $document_type);
        $doc_stmt->execute();
        $doc_result = $doc_stmt->get_result();

        if ($doc_result->num_rows > 0) {
            // Update existing document record
            $document_query = "UPDATE documents SET document_type = ?, file_name = ?, file_path = ?, uploaded_at = NOW() 
                               WHERE user_id = ? AND tax_year = ? AND document_type = ?";
            $doc_stmt = $conn->prepare($document_query);
            $doc_stmt->bind_param('sssiii', $document_type, $form_1095a_upload, $target_file, $user_id, $tax_year, $document_type);
        } else {
            // Insert new document record
            $document_query = "INSERT INTO documents (user_id, document_type, file_name, file_path, tax_year, uploaded_at) 
                               VALUES (?, ?, ?, ?, ?, NOW())";
            $doc_stmt = $conn->prepare($document_query);
            $doc_stmt->bind_param('isssi', $user_id, $document_type, $form_1095a_upload, $target_file, $tax_year);
        }

        if ($doc_stmt->execute()) {
            echo json_encode(['success' => 'Insurance details and document submitted successfully']);
        } else {
            echo json_encode(['error' => 'Failed to save document: ' . $conn->error]);
        }

        $doc_stmt->close();
    } else {
        echo json_encode(['success' => 'Insurance details submitted successfully without document']);
    }
} else {
    echo json_encode(['error' => 'Error: ' . $conn->error]);
}

$stmt->close();
$conn->close();
