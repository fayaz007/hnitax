<?php
require 'config/database.php'; // Include your database connection here
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Validate the email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format.';
            exit();
        }

        // Check if the email exists in your database
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            echo 'Email not found in our records.';
            exit();
        }

        // Generate a unique token for the password reset link
        $token = bin2hex(random_bytes(32));

        // Calculate the expiration time (e.g., 1 hour from now)
        $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store the token and its expiration time in the database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiration = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expirationTime, $email);
        $stmt->execute();
        $stmt->close();

        // Send an email with the password reset link
        $resetLink = BASE_URL . 'reset_password.php?token=' . $token;

        // Send the email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'trilokbuildcon23@gmail.com'; // Replace with your Gmail email address
            $mail->Password = 'yaesgbfttwvzqvom'; // Replace with your Gmail password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // Port for TLS

            $mail->setFrom('trilokbuildcon23@gmail.com', ''); // Replace with your details
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = 'Click the following link to reset your password: ' . $resetLink;

            $mail->send();
            echo 'Password reset instructions sent to your email.';
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
        exit();
    }
}
