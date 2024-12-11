<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Validate the email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
            exit();
        }

        // Check if the email exists in your database
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email not found in our records.']);
            exit();
        }

        // Generate a unique token for the password reset link
        $token = bin2hex(random_bytes(32));

        // Store the token and its expiration time in the database
        $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiration = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expirationTime, $email);
        $stmt->execute();
        $stmt->close();

        // Send an email with the password reset link
        $resetLink = BASE_URL . 'reset_password.php?token=' . $token;

        // You can use PHPMailer or another library to send the email
        // Example using PHPMailer:
        // require 'PHPMailerAutoload.php';
        // ... (configure PHPMailer and send the email)

        echo json_encode(['status' => 'success']);
        exit();
    }
}
