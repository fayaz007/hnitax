<?php
require '../../config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $residency_id = $_POST['residency_id'];
    $residency_for = $_POST['residency_for'];
    $state_name = $_POST['state_name_modal'];
    $residency_start_date = $_POST['residency_start_date_modal'];
    $residency_end_date = $_POST['residency_end_date_modal'];
    $rent_paid = $_POST['rent_paid_modal'];
    $tax_year = $_POST['tax_year'] ?? date("Y") - 1; // Get tax year or default to current year

    $stmt = $conn->prepare("UPDATE residency_details SET residency_for = ?, state_name = ?, residency_start_date = ?, residency_end_date = ?, rent_paid = ?, tax_year = ? WHERE residency_id = ?");
    $stmt->bind_param("ssssssi", $residency_for, $state_name, $residency_start_date, $residency_end_date, $rent_paid, $tax_year, $residency_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating residency details.']);
    }

    $stmt->close();
    $conn->close();
}
