<?php
require '../../config/database.php'; // Include your database connection here

// Check if user_id and tax_year are provided in POST request
if (isset($_POST['user_id']) && isset($_POST['tax_year'])) {
    $userId = intval($_POST['user_id']);
    $taxYear = intval($_POST['tax_year']);

    // Begin transaction
    $conn->begin_transaction();

    try {
        $tables = [
            'personal_information',
            'spouse_information',
            'contact_information',
            'dependents',
            'insurance_details',
            'residency_details',
            'employment_details',
            'other_income',
            'deductions',
            'adjustments_to_income',
            'fbar',
            'business_income',
            'documents',
            'referrals',
            'tax_estimates'
        ];

        // Loop through each table and delete the records
        foreach ($tables as $table) {
            // Prepare the DELETE query with placeholders
            $query = "DELETE FROM `$table` WHERE `user_id` = ? AND `tax_year` = ?";
            $stmt = $conn->prepare($query);
            
            // Bind the parameters
            $stmt->bind_param("ii", $userId, $taxYear);
            
            // Execute the query
            if (!$stmt->execute()) {
                throw new Exception("Error deleting records from $table: " . $stmt->error);
            }
        }

        // Optionally delete from users table, if required
        // $query = "DELETE FROM `users` WHERE `user_id` = ?";
        // $stmt = $conn->prepare($query);
        // $stmt->bind_param("i", $userId);
        // if (!$stmt->execute()) {
        //     throw new Exception("Error deleting user record: " . $stmt->error);
        // }

        // Commit the transaction
        $conn->commit();

        // Return success response
        echo json_encode([
            'success' => true,
            'message' => 'Records deleted successfully for tax year ' . htmlspecialchars($taxYear)
        ]);
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $conn->rollback();

        // Return error response
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete records. Error: ' . $e->getMessage()
        ]);
    }
} else {
    // Return error response if required POST data is missing
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request. Required data missing.'
    ]);
}
?>
