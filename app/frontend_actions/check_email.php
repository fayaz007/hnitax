<?php
require '../config/database.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Prepare and execute query to check email existence
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'taken'; // Email is already registered
    } else {
        echo 'available'; // Email is available
    }

    $stmt->close();
    $conn->close();
}
?>
