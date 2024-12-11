<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the referral ID from the POST request
    $referral_id = $_POST['id'] ?? null;

    // Validate referral ID
    if (empty($referral_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Referral ID is required.']);
        exit;
    }

    // Delete referral from the database
    $stmt = $conn->prepare("DELETE FROM referrals WHERE id = ?");
    $stmt->bind_param("i", $referral_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Referral deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete referral.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
