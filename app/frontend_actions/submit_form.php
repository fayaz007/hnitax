<?php
require '../config/database.php'; // Include your database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $fullPhone = trim($_POST['fullPhone']); // Get full phone number (includes country code)
    $password = trim($_POST['password']);
    $captcha = trim($_POST['captcha']);

    // Validate CAPTCHA
    if ($captcha != $_SESSION['captcha']) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid CAPTCHA. Please try again.']);
        exit;
    }

    // Sanitize user input to prevent SQL injection
    $fullName = mysqli_real_escape_string($conn, $fullName);
    $email = mysqli_real_escape_string($conn, $email);
    $fullPhone = mysqli_real_escape_string($conn, $fullPhone); // Sanitize the full phone number
    $hashedPassword = mysqli_real_escape_string($conn, password_hash($password, PASSWORD_DEFAULT));

    // Check if email already exists
    $checkEmailQuery = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmailQuery);
    if (!$result) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)]);
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email is already registered.']);
        mysqli_free_result($result);
        mysqli_close($conn);
        exit;
    }
    mysqli_free_result($result);

    // Insert user data into the database
    $insertUserQuery = "INSERT INTO users (username, email, password, phone, created_at) VALUES ('$fullName', '$email', '$hashedPassword', '$fullPhone', NOW())";
    if (mysqli_query($conn, $insertUserQuery)) {
        echo json_encode(['status' => 'success', 'message' => 'Registration successful! Welcome, ' . htmlspecialchars($fullName) . '.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error occurred while registering. Please try again.']);
    }

    mysqli_close($conn);
}
?>
