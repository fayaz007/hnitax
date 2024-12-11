<?php

function checkLoggedInUser()
{
    global $conn;
    // Check if the user is already logged in via a session
    if (isset($_SESSION['user_id'])) {
        return;
    }

    // Check if the user has a remember_me cookie
    if (isset($_COOKIE['remember_user'])) {
        $authToken = $_COOKIE['remember_user'];

        // Verify the auth token against the database
        $stmt = $conn->prepare("SELECT user_id, user_type FROM users WHERE auth_token = ?");
        $stmt->bind_param("s", $authToken);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user) {
            // Found a valid auth token in the database
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_type'] = $user['user_type'];
            return;
        }
    }

    // Redirect the user to the login page if not logged in or no valid "Remember Me" cookie
    header('Location: ' . BASE_URL . 'login.php'); // Use BASE_URL to construct the URL
    exit();
}

function checkUserRole($allowedRoles)
{
    if (!isset($_SESSION['user_type'])) {
        // If user_type is not set, something is wrong. You might want to log this.
        error_log("User type not set in session.");

        // Redirect to an error page or display an error message.
        echo 'Access Denied: An error occurred.';
        exit();
    }

    // Check if the user's role matches one of the allowed roles
    if (!in_array($_SESSION['user_type'], $allowedRoles)) {
        // Redirect to an unauthorized page or display an error
        header('Location: ' . BASE_URL . 'unauthorized.php'); // Use BASE_URL to construct the URL
        exit();
    }
}
