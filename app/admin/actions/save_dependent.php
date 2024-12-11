<?php
require '../../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input data
    $user_id =$_POST['user_id'];
    $first_name = isset($_POST['dependent_first_name_modal']) ? trim($_POST['dependent_first_name_modal']) : '';
    $last_name = isset($_POST['dependent_last_name_modal']) ? trim($_POST['dependent_last_name_modal']) : '';
    $dob = isset($_POST['dependent_dob_modal']) ? $_POST['dependent_dob_modal'] : ''; // Date format validation might be needed
    $ssn = isset($_POST['dependent_ssn_modal']) ? trim($_POST['dependent_ssn_modal']) : '';
    $ssn_select = isset($_POST['dependent_ssn_select']) ? trim($_POST['dependent_ssn_select']) : ''; // New field for SSN/ITIN selection
    $relationship = isset($_POST['dependent_relationship_modal']) ? trim($_POST['dependent_relationship_modal']) : '';
    $entry_date = isset($_POST['dependent_entry_date_modal']) ? $_POST['dependent_entry_date_modal'] : '';
    $tax_year = isset($_POST['tax_year']) ? intval($_POST['tax_year']) : date('Y');

    // Validate inputs (basic validation, extend as needed)
    if (empty($first_name) || empty($last_name) || empty($dob) || empty($relationship) || empty($entry_date) || empty($ssn_select) || $tax_year <= 0) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // Check if SSN/ITIN already exists
    $checkSql = "SELECT dependent_id FROM dependents WHERE ssn = ? LIMIT 1";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $ssn);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // SSN/ITIN already exists
        echo json_encode(['success' => false, 'message' => 'The SSN/ITIN already exists. Please enter a unique SSN/ITIN.']);
        exit;
    }

    $stmt->close();

    // Prepare the SQL statement to insert dependent
    $sql = "INSERT INTO dependents (user_id, first_name, last_name, dob, ssn, ssn_select, relationship, entry_date, tax_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("isssssssi", $user_id, $first_name, $last_name, $dob, $ssn, $ssn_select, $relationship, $entry_date, $tax_year);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Dependent saved successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error saving dependent: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
