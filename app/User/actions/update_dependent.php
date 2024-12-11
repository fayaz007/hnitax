<?php
// Include your database connection file
require '../../config/database.php';

// Check if request is POST and the necessary fields are present
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dependent_id'])) {
    // Collect form data safely
    $dependent_id = intval($_POST['dependent_id']);
    $first_name = isset($_POST['dependent_first_name_modal']) ? trim($_POST['dependent_first_name_modal']) : '';
    $last_name = isset($_POST['dependent_last_name_modal']) ? trim($_POST['dependent_last_name_modal']) : '';
    $dob = isset($_POST['dependent_dob_modal']) ? $_POST['dependent_dob_modal'] : ''; // Date format validation might be needed
    $ssn = isset($_POST['dependent_ssn_modal']) ? trim($_POST['dependent_ssn_modal']) : ''; // Corrected to use the proper field name
    $ssn_select = isset($_POST['dependent_ssn_select']) ? trim($_POST['dependent_ssn_select']) : ''; // Added ssn_select field
    $relationship = isset($_POST['dependent_relationship_modal']) ? trim($_POST['dependent_relationship_modal']) : ''; // Corrected to use the proper field name
    $entry_date = isset($_POST['dependent_entry_date_modal']) ? $_POST['dependent_entry_date_modal'] : ''; // Added entry date
    $tax_year = isset($_POST['tax_year']) ? intval($_POST['tax_year']) : ((date("m") <= 4) ? date("Y") - 1 : date("Y"));

    // Validate that fields are not empty (You can add more validation here if needed)
    if (empty($first_name) || empty($last_name) || empty($dob) || empty($ssn) || empty($relationship) || empty($ssn_select)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Check if SSN/ITIN is unique, excluding the current record
    $checkQuery = "SELECT * FROM dependents WHERE ssn = '$ssn' AND dependent_id != $dependent_id";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo json_encode(['success' => false, 'message' => 'SSN/ITIN must be unique.']);
        exit;
    }

    // Update query
    $query = "UPDATE dependents SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                dob = '$dob', 
                ssn = '$ssn', 
                ssn_select = '$ssn_select', 
                relationship = '$relationship', 
                entry_date = '$entry_date'
              WHERE dependent_id = $dependent_id";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Dependent details updated successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating dependent.']);
    }
} else {
    // Invalid request
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

// Close the database connection
$conn->close();
?>
