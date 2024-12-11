<?php
require '../../config/database.php';

if (isset($_GET['dependent_id'])) {
    $dependent_id = intval($_GET['dependent_id']);

    $sql = "SELECT * FROM dependents WHERE dependent_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $dependent_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $dependent = $result->fetch_assoc();
        echo json_encode($dependent);
    } else {
        echo json_encode(['error' => 'Dependent not found.']);
    }

    $stmt->close();
}
$conn->close();
?>
