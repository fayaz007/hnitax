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

    // Add logout log
    addLoginLog($user_id, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);

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

function addLoginLog($user_id, $ip_address, $user_agent)
{
    global $conn;

    $action = "Logout";
    $kolkataTimezone = new DateTimeZone('Asia/Kolkata');

    // Get the current timestamp in Kolkata timezone
    $timestamp = new DateTime('now', $kolkataTimezone);
    $formattedTimestamp = $timestamp->format('Y-m-d H:i:s');

    $sql = "INSERT INTO login_logs (user_id, action, ip_address, user_agent, login_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $action, $ip_address, $user_agent, $formattedTimestamp);

    if (!$stmt->execute()) {
        // Handle the error or log it
    }
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
