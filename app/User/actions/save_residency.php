<?php
require '../../config/database.php'; // Include your database connection here



// Get POST data
$residency_for = $_POST['residency_for'] ?? '';
$state_name_modal = $_POST['state_name_modal'] ?? '';
$residency_start_date_modal = $_POST['residency_start_date_modal'] ?? '';
$residency_end_date_modal = $_POST['residency_end_date_modal'] ?? '';
$rent_paid_modal = $_POST['rent_paid_modal'] ?? '';
$tax_year = $_POST['tax_year'] ?? (date("Y") - 1);


// Validate required fields
if (empty($residency_for) || empty($state_name_modal) || empty($residency_start_date_modal) || empty($residency_end_date_modal) || empty($rent_paid_modal)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

$user_id = $_SESSION['user_id'] ?? null; // Adjust as per your session handling

if (!$user_id) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated.']);
    exit;
}

try {
    // Prepare SQL statement to insert data into the residency table
    $stmt = $conn->prepare("INSERT INTO residency_details (user_id, residency_for, state_name, residency_start_date, residency_end_date, rent_paid, tax_year) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters (assuming rent_paid is an integer; adjust as necessary)
    $stmt->bind_param("issssii", $user_id, $residency_for, $state_name_modal, $residency_start_date_modal, $residency_end_date_modal, $rent_paid_modal, $tax_year);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Residency details saved successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save residency details.']);
    }

    // Close the statement
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

// Close the connection
$conn->close();
?>
