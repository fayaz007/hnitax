<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $residency_id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM residency_details WHERE residency_id = ?");
    $stmt->bind_param("i", $residency_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting residency details.']);
    }

    $stmt->close();
    $conn->close();
}
?>
