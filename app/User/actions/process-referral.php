<?php
require '../../config/database.php';

// Get user_id from session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $referral_name = $_POST['referral_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $tax_year = $_POST['tax_year'] ?? date("Y");

    // Validate required fields
    if (empty($user_id) || empty($referral_name) || empty($phone) || empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Insert referral data into the database
    $stmt = $conn->prepare("INSERT INTO referrals (user_id, referral_name, phone, email, tax_year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $user_id, $referral_name, $phone, $email, $tax_year);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Referral added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add referral. Please try again.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
