<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session after login
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if ($new_password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'New passwords do not match.']);
        exit;
    }

    // Fetch the user's current password
    $sql = "SELECT password FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
        exit;
    }

    $user = $result->fetch_assoc();
    
    // Verify old password
    if (!password_verify($old_password, $user['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Old password is incorrect.']);
        exit;
    }

    // Hash the new password
    $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update the password in the database
    $sql_update = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $hashed_new_password, $user_id);

    if ($stmt_update->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
    }
}
?>