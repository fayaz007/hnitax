<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $primary_phone = $_POST['primary_phone'];
    $mobile_number = $_POST['mobile_number'];
    
    $conn->begin_transaction();

    try {
        // Update `personal_information` table
        $sql1 = "UPDATE personal_information SET first_name = ?, middle_name = ?, last_name = ? WHERE user_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("sssi", $first_name, $middle_name, $last_name, $user_id);
        
        // Check for errors in execution
        if (!$stmt1->execute()) {
            throw new Exception("Failed to update personal information.");
        }

        // Update `contact_information` table
        $sql2 = "UPDATE contact_information SET email_id = ?, mobile_number = ?, work_number = ? WHERE user_id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("sssi", $email, $primary_phone, $mobile_number, $user_id);
        
        if (!$stmt2->execute()) {
            throw new Exception("Failed to update contact information.");
        }
        
        $conn->commit();
        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>