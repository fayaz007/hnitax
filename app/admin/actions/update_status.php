<?php
// Database connection
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the request
    $field = $_POST['field'];
    $user_id = $_POST['user_id'];
    $tax_year = $_POST['tax_year'];
    $status = $_POST['status'];

    // Prepare the SQL update query
    $stmt = $conn->prepare("UPDATE personal_information SET $field = ? WHERE user_id = ? AND tax_year = ?");
    $stmt->bind_param('sii', $status, $user_id, $tax_year);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status.";
    }
    $stmt->close();
}
?>