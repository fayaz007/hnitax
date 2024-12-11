<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dependent_id'])) {
        $dependent_id = intval($_POST['dependent_id']);

        // Prepare and execute the delete statement
        $sql = "DELETE FROM dependents WHERE dependent_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $dependent_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting the dependent.']);
        }

        $stmt->close();
    }
}
$conn->close();
?>
