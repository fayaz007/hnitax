<?php
require '../../config/database.php';

function respond($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employmentId = intval($_POST['id'] ?? 0);

    if ($employmentId === 0) {
        respond('error', 'Invalid employment ID.');
    }

    $stmt = $conn->prepare("DELETE FROM employment_details WHERE employment_id = ?");
    if (!$stmt) {
        respond('error', 'Error preparing the delete statement.');
    }

    $stmt->bind_param("i", $employmentId);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        respond('success', 'Employment record deleted successfully.');
    } else {
        respond('error', 'No employment record found with that ID.');
    }

    $stmt->close();
}

$conn->close();
