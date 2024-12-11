<?php
require '../../config/database.php'; // Include your database connection here

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    $check_email_query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        echo "false"; // Email already exists
    } else {
        echo "true"; // Email is available
    }
} else {
    echo "false"; // Invalid request
}
