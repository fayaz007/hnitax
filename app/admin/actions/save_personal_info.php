<?php
require '../../config/database.php'; 

// Retrieve form data
$user_id = $_POST['user_id'];
$tax_year = $_POST['tax_year'];


$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$marital_status = $_POST['marital_status'];
$filing_status = $_POST['filing_status'];
$marriage_date = $_POST['marriage_date'];
$taxpayer_dob = $_POST['taxpayer_dob'];
$current_occupation = $_POST['current_occupation'];
$taxpayer_ssn_input = $_POST['taxpayer_ssn_input'];
$taxpayer_ssn_select = $_POST['taxpayer_ssn_select'];
$taxpayer_entry_date = $_POST['taxpayer_entry_date'];

// Spouse Information (optional, only if marital status is not single)
$spouse_first_name = $_POST['spouse_first_name'] ?? null;
$spouse_middle_name = $_POST['spouse_middle_name'] ?? null;
$spouse_last_name = $_POST['spouse_last_name'] ?? null;
$spouse_dob = $_POST['spouse_dob'] ?? null;
$spouse_visa_category = $_POST['spouse_visa_category'] ?? null;
$spouse_itin = $_POST['spouse_itin'] ?? null;
$spouse_ssn = $_POST['spouse_ssn'] ?? null;
$spouse_entry_date = $_POST['spouse_entry_date'] ?? null;

// Contact Information
$street_address = $_POST['street_address'];
$apartment_number = $_POST['apartment_number'] ?? null;
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$email_id = $_POST['email_id'];
$mobile_number = $_POST['mobile_number'];
$work_number = $_POST['work_number'] ?? null;

// Input validation (expand as needed)
if (empty($first_name) || empty($last_name) || empty($tax_year) || empty($marital_status) || empty($taxpayer_dob) || empty($current_occupation) || empty($filing_status)) {
    echo json_encode(['error' => 'Required fields are missing.']);
    exit;
}

// Get current timestamp for created_at and updated_at fields
$current_timestamp = date('Y-m-d H:i:s');

// Check if record already exists for the user and tax year
$sql = "SELECT * FROM personal_information WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $tax_year);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Record exists, update it
    $updateSql = "UPDATE personal_information SET 
        first_name = ?, middle_name = ?, last_name = ?, marital_status = ?, filing_status = ?, marriage_date = ?, taxpayer_dob = ?, current_occupation = ?, taxpayer_ssn_select = ?, taxpayer_ssn_input = ?, taxpayer_entry_date = ?, updated_at = ?
        WHERE user_id = ? AND tax_year = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssssssssssis", $first_name, $middle_name, $last_name, $marital_status, $filing_status, $marriage_date, $taxpayer_dob, $current_occupation, $taxpayer_ssn_select, $taxpayer_ssn_input, $taxpayer_entry_date, $current_timestamp, $user_id, $tax_year);
    $updateStmt->execute();

    // Check if Spouse Information needs to be updated or inserted based on marital status
    if ($marital_status == "Married") {
        $spouseCheckSql = "SELECT * FROM spouse_information WHERE user_id = ? AND tax_year = ?";
        $spouseCheckStmt = $conn->prepare($spouseCheckSql);
        $spouseCheckStmt->bind_param("is", $user_id, $tax_year);
        $spouseCheckStmt->execute();
        $spouseResult = $spouseCheckStmt->get_result();

        if ($spouseResult->num_rows > 0) {
            // Spouse information exists, update it
            $updateSpouseSql = "UPDATE spouse_information SET 
                spouse_first_name = ?, spouse_middle_name = ?, spouse_last_name = ?, spouse_dob = ?, spouse_visa_category = ?, spouse_itin = ?, spouse_ssn = ?, spouse_entry_date = ?, updated_at = ?
                WHERE user_id = ? AND tax_year = ?";
            $updateSpouseStmt = $conn->prepare($updateSpouseSql);
            $updateSpouseStmt->bind_param("sssssssssis", $spouse_first_name, $spouse_middle_name, $spouse_last_name, $spouse_dob, $spouse_visa_category, $spouse_itin, $spouse_ssn, $spouse_entry_date, $current_timestamp, $user_id, $tax_year);
            $updateSpouseStmt->execute();
        } else {
            // No spouse information, insert a new record
            $insertSpouseSql = "INSERT INTO spouse_information (user_id, tax_year, spouse_first_name, spouse_middle_name, spouse_last_name, spouse_dob, spouse_visa_category, spouse_itin, spouse_ssn, spouse_entry_date, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertSpouseStmt = $conn->prepare($insertSpouseSql);
            $insertSpouseStmt->bind_param("isssssssssss", $user_id, $tax_year, $spouse_first_name, $spouse_middle_name, $spouse_last_name, $spouse_dob, $spouse_visa_category, $spouse_itin, $spouse_ssn, $spouse_entry_date, $current_timestamp, $current_timestamp);
            $insertSpouseStmt->execute();
        }
    }

    // Update Contact Information
    $updateContactSql = "UPDATE contact_information SET 
        street_address = ?, apartment_number = ?, city = ?, state = ?, zip_code = ?, email_id = ?, mobile_number = ?, work_number = ?, updated_at = ?
        WHERE user_id = ? AND tax_year = ?";
    $updateContactStmt = $conn->prepare($updateContactSql);
    $updateContactStmt->bind_param("sssssssssis", $street_address, $apartment_number, $city, $state, $zip_code, $email_id, $mobile_number, $work_number, $current_timestamp, $user_id, $tax_year);
    $updateContactStmt->execute();

    echo json_encode(['message' => 'Record updated successfully']);
} else {
    // No record exists, insert a new one
    $insertSql = "INSERT INTO personal_information (user_id, tax_year, first_name, middle_name, last_name, marital_status, filing_status, marriage_date, taxpayer_dob, current_occupation, taxpayer_ssn_select, taxpayer_ssn_input, taxpayer_entry_date, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("issssssssssssss", $user_id, $tax_year, $first_name, $middle_name, $last_name, $marital_status, $filing_status, $marriage_date, $taxpayer_dob, $current_occupation, $taxpayer_ssn_select, $taxpayer_ssn_input, $taxpayer_entry_date, $current_timestamp, $current_timestamp);
    $insertStmt->execute();

    // Insert Spouse Information if marital status is "Married"
    if ($marital_status == "Married") {
        $insertSpouseSql = "INSERT INTO spouse_information (user_id, tax_year, spouse_first_name, spouse_middle_name, spouse_last_name, spouse_dob, spouse_visa_category, spouse_itin, spouse_ssn, spouse_entry_date, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertSpouseStmt = $conn->prepare($insertSpouseSql);
        $insertSpouseStmt->bind_param("isssssssssss", $user_id, $tax_year, $spouse_first_name, $spouse_middle_name, $spouse_last_name, $spouse_dob, $spouse_visa_category, $spouse_itin, $spouse_ssn, $spouse_entry_date, $current_timestamp, $current_timestamp);
        $insertSpouseStmt->execute();
    }

    echo json_encode(['message' => 'Record saved successfully']);
}
?>
