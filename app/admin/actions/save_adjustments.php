<?php
require '../../config/database.php';

$user_id = $_POST['user_id'] ?? null; // Fallback in case session variable is not set
$tax_year = $_POST['tax_year'] ?? date('Y');

// Validate user_id
if (!$user_id) {
    echo json_encode(['status' => 'error', 'message' => 'User not authenticated.']);
    exit;
}

// Retrieve form data
$education_expenses = $_POST['education_expenses'] ?? '';
$education_expenses_spouse = $_POST['education_expenses_spouse'] ?? '';
$student_loan_interest = $_POST['student_loan_interest'] ?? '';
$student_loan_interest_spouse = $_POST['student_loan_interest_spouse'] ?? '';
$ira_contribution = $_POST['ira_contribution'] ?? '';
$ira_contribution_type = $_POST['ira_contribution_type'] ?? '';
$ira_contribution_spouse = $_POST['ira_contribution_spouse'] ?? '';
$ira_contribution_spouse_type = $_POST['ira_contribution_spouse_type'] ?? '';
$hsa_contribution = $_POST['hsa_contribution'] ?? '';
$hsa_contribution_spouse = $_POST['hsa_contribution_spouse'] ?? '';

$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');

// Check if adjustments record already exists
$query = "SELECT adjustment_id FROM adjustments_to_income WHERE user_id = $user_id AND tax_year = '$tax_year'";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
    exit;
}

if ($result->num_rows > 0) {
    // Update existing record
    $query = "UPDATE adjustments_to_income SET 
              education_expenses = '$education_expenses', 
              education_expenses_spouse = '$education_expenses_spouse', 
              student_loan_interest = '$student_loan_interest', 
              student_loan_interest_spouse = '$student_loan_interest_spouse', 
              ira_contribution = '$ira_contribution', 
              ira_contribution_type = '$ira_contribution_type', 
              ira_contribution_spouse = '$ira_contribution_spouse', 
              ira_contribution_spouse_type = '$ira_contribution_spouse_type', 
              hsa_contribution = '$hsa_contribution', 
              hsa_contribution_spouse = '$hsa_contribution_spouse', 
              updated_at = '$updated_at' 
              WHERE user_id = $user_id AND tax_year = '$tax_year'";

    if (!$conn->query($query)) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
        exit;
    }
} else {
    // Insert new record
    $query = "INSERT INTO adjustments_to_income 
              (user_id, tax_year, education_expenses, education_expenses_spouse, 
               student_loan_interest, student_loan_interest_spouse, ira_contribution, 
               ira_contribution_type, ira_contribution_spouse, 
               ira_contribution_spouse_type, hsa_contribution, 
               hsa_contribution_spouse, created_at, updated_at) 
              VALUES ($user_id, '$tax_year', '$education_expenses', '$education_expenses_spouse', 
                      '$student_loan_interest', '$student_loan_interest_spouse', '$ira_contribution', 
                      '$ira_contribution_type', '$ira_contribution_spouse', 
                      '$ira_contribution_spouse_type', '$hsa_contribution', 
                      '$hsa_contribution_spouse', '$created_at', '$updated_at')";

    if (!$conn->query($query)) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
        exit;
    }
}

// Response based on success
if ($conn->affected_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Adjustments saved successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No changes were made to the adjustments.']);
}

// Close connections
$conn->close();
?>
