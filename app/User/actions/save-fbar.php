<?php
require '../../config/database.php';

$user_id = $_SESSION['user_id'] ?? null;
// $tax_year = $_POST['tax_year'] ?? date('Y'); 
$tax_year = $_POST['tax_year'] ?? (date('Y') - 1);
// Check user authentication
if (!$user_id) {
    echo json_encode(['status' => 'error', 'message' => 'User not authenticated.']);
    exit;
}

// Retrieve form data
$fbar_status = $_POST['fbar_status'] ?? '';

// Set timestamps
$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');

// Check if FBAR record exists for this user and tax year
$query = "SELECT fbar_id FROM fbar WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $user_id, $tax_year); // Bind parameters (user_id as integer, tax_year as string)
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
    exit;
}

if ($result->num_rows > 0) {
    // Update existing record
    $query = "UPDATE fbar SET 
              fbar_status = ?, 
              updated_at = ? 
              WHERE user_id = ? AND tax_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssis", $fbar_status, $updated_at, $user_id, $tax_year); // Bind parameters
} else {
    // Insert a new record
    $query = "INSERT INTO fbar (user_id, tax_year, fbar_status, created_at, updated_at) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $user_id, $tax_year, $fbar_status, $created_at, $updated_at); // Bind parameters
}

// Execute the query and check for errors
if (!$stmt->execute()) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    exit;
}

// Respond with success or indicate no changes were made
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'FBAR record saved successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No changes were made to the FBAR record.']);
}

// Close the statement and database connection
$stmt->close();
$conn->close();
