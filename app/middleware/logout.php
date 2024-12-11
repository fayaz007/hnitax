<?php
require 'config/database.php';

// Define your functions first
function logoutUser($conn)
{
    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];

    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Clear the session cookie
    setcookie(session_name(), '', time() - 3600, '/');

    // Clear the auth_token in the database
    clearAuthToken($conn, $user_id);

    // Clear the auth_token cookie
    setcookie('remember_user', '', time() - 3600, '/');

    // Redirect the user to the login page or any other desired page
    header('Location: login.php');
    exit();
}

function clearAuthToken($conn, $user_id)
{
    // Clear the auth_token in the database
    $stmt = $conn->prepare("UPDATE users SET auth_token = NULL WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

// Check if the user is logged in (you may customize this condition)
if (isset($_SESSION['user_id'])) {
    logoutUser($conn);
} else {
    // If the user is not logged in, you can redirect them to the login page or any other page
    header('Location: login.php');
    exit();
}
