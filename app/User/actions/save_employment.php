<?php
require '../../config/database.php';

$user_id = $_SESSION['user_id'] ?? null;

function respond($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employer_name = $_POST['employer_name_modal'] ?? null;
    $employment_start_date = $_POST['employment_start_date_modal'] ?? null;
    $employment_end_date = $_POST['employment_end_date_modal'] ?? null;
    $employment_id = $_POST['employment_id'] ?? null;
    $tax_year = $_POST['tax_year'] ?? (date("Y") - 1);

    if (!$employer_name || !$employment_start_date) {
        respond('error', 'Employer name and start date are required.');
    }

    // SQL statements for insert and update
    if ($employment_id) {
        // Update existing employment record
        $query = "UPDATE employment_details 
                  SET employer_name = ?, employment_start_date = ?, employment_end_date = ?, tax_year = ? 
                  WHERE employment_id = ? AND user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssiii", $employer_name, $employment_start_date, $employment_end_date, $tax_year, $employment_id, $user_id);
    } else {
        // Insert new employment record
        $query = "INSERT INTO employment_details (user_id, employer_name, employment_start_date, employment_end_date, tax_year) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssi", $user_id, $employer_name, $employment_start_date, $employment_end_date, $tax_year);
    }

    if (!$stmt) {
        respond('error', 'Database preparation error.');
    }

    if ($stmt->execute()) {
        respond('success', 'Employment details saved successfully.');
    } else {
        respond('error', 'Failed to save employment details.');
    }

    $stmt->close();
}

$conn->close();
