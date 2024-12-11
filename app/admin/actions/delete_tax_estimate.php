<?php
require '../../config/database.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estimate_id'])) {
    $estimate_id = $_POST['estimate_id'];

    try {
        $stmt = $conn->prepare("DELETE FROM tax_estimates WHERE estimate_id = ?");
        $stmt->bind_param("i", $estimate_id);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Tax estimate deleted successfully';
        } else {
            $response['message'] = 'Failed to delete tax estimate: ' . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid request';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
