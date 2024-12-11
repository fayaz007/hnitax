<?php
require '../../config/database.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estimate_id = $_POST['estimate_id'] ?? null;
    $user_id = $_POST['user_id'];
    $tax_year = $_POST['tax_year'];
    $federal_refund = $_POST['federal_refund'];
    $state_refund = $_POST['state_refund'];
    $city_refund = $_POST['city_refund'];

    // Calculate total refund
    $total = $federal_refund + $state_refund + $city_refund;

    try {
        if ($estimate_id) {
            // Update existing tax estimate
            $stmt = $conn->prepare("UPDATE tax_estimates SET federal_refund = ?, state_refund = ?, city_refund = ?, total = ?, updated_at = NOW() WHERE estimate_id = ? AND user_id = ? AND tax_year = ?");
            $stmt->bind_param("dddiiis", $federal_refund, $state_refund, $city_refund, $total, $estimate_id, $user_id, $tax_year);
        } else {
            // Insert new tax estimate
            $stmt = $conn->prepare("INSERT INTO tax_estimates (user_id, tax_year, federal_refund, state_refund, city_refund, total, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
            $stmt->bind_param("isdddd", $user_id, $tax_year, $federal_refund, $state_refund, $city_refund, $total);
        }

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = $estimate_id ? 'Tax estimate updated successfully' : 'Tax estimate inserted successfully';
        } else {
            $response['message'] = 'Database error: ' . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
