<?php
require '../../config/database.php';

$user_id = $_SESSION['user_id'];
$tax_year = $_POST['tax_year'] ?? (date("Y") - 1);


// Retrieve form data
$charitable_contributions = $_POST['charitable_contributions'] ?? '';
$home_mortgage_interest = $_POST['home_mortgage_interest'] ?? '';
$hybrid_vehicle = $_POST['hybrid_vehicle'] ?? '';
$energy_equipment = $_POST['energy_equipment'] ?? '';
$medical_expenses = $_POST['medical_expenses'] ?? '';
$medical_expenses_notes = $_POST['medical_expenses_notes'] ?? '';
$car_taxes = $_POST['car_taxes'] ?? '';
$car_details = $_POST['car_details'] ?? '';
$motor_vehicle_tax = $_POST['motor_vehicle_tax'] ?? '';
$college_saving_plan = $_POST['college_saving_plan'] ?? '';
$charitable_contributions_spouse = $_POST['charitable_contributions_spouse'] ?? '';
$home_mortgage_interest_spouse = $_POST['home_mortgage_interest_spouse'] ?? '';
$hybrid_vehicle_spouse = $_POST['hybrid_vehicle_spouse'] ?? '';
$energy_equipment_spouse = $_POST['energy_equipment_spouse'] ?? '';
$medical_expenses_spouse = $_POST['medical_expenses_spouse'] ?? '';
$medical_expenses_spouse_notes = $_POST['medical_expenses_spouse_notes'] ?? '';
$car_taxes_spouse = $_POST['car_taxes_spouse'] ?? '';
$car_details_spouse = $_POST['car_details_spouse'] ?? '';
$motor_vehicle_tax_spouse = $_POST['motor_vehicle_tax_spouse'] ?? '';
$college_saving_plan_spouse = $_POST['college_saving_plan_spouse'] ?? '';

$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');

// Check if deductions record already exists
$query = "SELECT deduction_id FROM deductions WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $user_id, $tax_year);

if (!$stmt->execute()) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    exit;
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing record
    $query = "UPDATE deductions SET charitable_contributions = ?, home_mortgage_interest = ?, hybrid_vehicle = ?, 
              energy_equipment = ?, medical_expenses = ?, medical_expenses_notes = ?, car_taxes = ?, car_details = ?, 
              motor_vehicle_tax = ?, college_saving_plan = ?, charitable_contributions_spouse = ?, home_mortgage_interest_spouse = ?, 
              hybrid_vehicle_spouse = ?, energy_equipment_spouse = ?, medical_expenses_spouse = ?, medical_expenses_spouse_notes = ?, 
              car_taxes_spouse = ?, car_details_spouse = ?, motor_vehicle_tax_spouse = ?, college_saving_plan_spouse = ?, 
              updated_at = ? WHERE user_id = ? AND tax_year = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param('ssssssssssssssssssssiii', 
        $charitable_contributions, $home_mortgage_interest, $hybrid_vehicle, $energy_equipment, $medical_expenses, 
        $medical_expenses_notes, $car_taxes, $car_details, $motor_vehicle_tax, $college_saving_plan, 
        $charitable_contributions_spouse, $home_mortgage_interest_spouse, $hybrid_vehicle_spouse, 
        $energy_equipment_spouse, $medical_expenses_spouse, $medical_expenses_spouse_notes, 
        $car_taxes_spouse, $car_details_spouse, $motor_vehicle_tax_spouse, $college_saving_plan_spouse, 
        $updated_at, $user_id, $tax_year
    );

    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
        exit;
    }
} else {
    // Insert new record
    $query = "INSERT INTO deductions (user_id, tax_year, charitable_contributions, home_mortgage_interest, 
              hybrid_vehicle, energy_equipment, medical_expenses, medical_expenses_notes, car_taxes, car_details, 
              motor_vehicle_tax, college_saving_plan, charitable_contributions_spouse, home_mortgage_interest_spouse, 
              hybrid_vehicle_spouse, energy_equipment_spouse, medical_expenses_spouse, medical_expenses_spouse_notes, 
              car_taxes_spouse, car_details_spouse, motor_vehicle_tax_spouse, college_saving_plan_spouse, created_at, updated_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    $stmt->bind_param('iissssssssssssssssssssss', 
        $user_id, $tax_year, $charitable_contributions, $home_mortgage_interest, $hybrid_vehicle, $energy_equipment, 
        $medical_expenses, $medical_expenses_notes, $car_taxes, $car_details, $motor_vehicle_tax, $college_saving_plan, 
        $charitable_contributions_spouse, $home_mortgage_interest_spouse, $hybrid_vehicle_spouse, 
        $energy_equipment_spouse, $medical_expenses_spouse, $medical_expenses_spouse_notes, 
        $car_taxes_spouse, $car_details_spouse, $motor_vehicle_tax_spouse, $college_saving_plan_spouse, 
        $created_at, $updated_at
    );

    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
        exit;
    }
}

// Response based on success
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Deductions saved successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No changes were made to the deductions.']);
}

// Close connections
$stmt->close();
$conn->close();
?>
