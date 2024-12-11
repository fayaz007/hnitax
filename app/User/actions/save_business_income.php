<?php
require '../../config/database.php';

$tax_year = (date('Y') - 1);
$user_id = $_SESSION['user_id']; // Retrieve user_id from session
$business_income = isset($_POST['business_income']) ? $_POST['business_income'] : '';

// Check if the business income record exists for the user and tax year
$query = "SELECT * FROM business_income WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $tax_year);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing record
    $query = "UPDATE business_income SET has_business_income = ? WHERE user_id = ? AND tax_year = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $business_income, $user_id, $tax_year);
    $stmt->execute();
    $response = ['status' => 'success', 'message' => 'Business income status updated successfully.'];
} else {
    // Insert new record
    $query = "INSERT INTO business_income (user_id, tax_year, has_business_income) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $user_id, $tax_year, $business_income);
    $stmt->execute();
    $response = ['status' => 'success', 'message' => 'Business income status saved successfully.'];
}

$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
