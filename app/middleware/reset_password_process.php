<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'], $_POST['password'], $_POST['confirm_password'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate the token
    $stmt = $conn->prepare("SELECT email, reset_token_expiration FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows === 0) {
        echo 'Invalid or expired token.';
        exit();
    }

    $row = $result->fetch_assoc();
    $email = $row['email'];
    $tokenExpiration = strtotime($row['reset_token_expiration']);

    // Check if the token has expired
    if ($tokenExpiration < time()) {
        echo 'Token has expired.';
        exit();
    }

    // Validate the new password and confirm password
    if ($password !== $confirmPassword) {
        echo 'Passwords do not match.';
        exit();
    }

    // Validate the new password (e.g., minimum length)
    if (strlen($password) < 8) {
        echo 'Password must be at least 8 characters long.';
        exit();
    }

    // Hash and update the new password in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiration = NULL WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    if ($stmt->execute()) {
        echo 'Password reset successfully. You can now <a href="login.php">login</a> with your new password.';
    } else {
        echo 'Password reset failed.';
    }
    $stmt->close();
} else {
    header('Location: login.php'); // Redirect to the login page if the form was not submitted properly
    exit();
}
