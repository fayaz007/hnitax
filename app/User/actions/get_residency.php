<?php
require '../../config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $residency_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM residency_details WHERE residency_id = ?");
    $stmt->bind_param("i", $residency_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['success' => false, 'message' => 'No residency details found.']);
    }

    $stmt->close();
    $conn->close();
}
?>
