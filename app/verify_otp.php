<?php
require 'config/database.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['otp'])) {
        $email = $_POST['email'];
        $otp = $_POST['otp'];

        // Retrieve the user and their OTP info
        $stmt = $conn->prepare("SELECT user_id, otp_code, otp_expiry FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        // Check if OTP is valid and not expired
        $current_time = date("Y-m-d H:i:s");
        if ($user && $user['otp_code'] == $otp && $user['otp_expiry'] > $current_time) {
            // OTP is correct, allow login

            // Clear OTP fields in the database
            $stmt = $conn->prepare("UPDATE users SET otp_code = NULL, otp_expiry = NULL WHERE user_id = ?");
            $stmt->bind_param("i", $user['user_id']);
            $stmt->execute();
            $stmt->close();

            // Set session variables for the user
            $_SESSION['user_id'] = $user['user_id'];

            $response['status'] = 'success';
            $response['message'] = 'OTP verified, you are logged in!';
        } else {
            // OTP is invalid or expired
            $response['status'] = 'error';
            $response['message'] = 'Invalid or expired OTP. Please try again.';
        }

        echo json_encode($response);
        exit();
    }
}

