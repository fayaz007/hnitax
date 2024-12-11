<?php
function checkLoggedInUser()
{
    if (isset($_SESSION['user_id'])) {
        redirectToDashboard($_SESSION['user_type']);
    }

    if (isset($_COOKIE['remember_user'])) {
        $authToken = $_COOKIE['remember_user'];
        $user = getUserByAuthToken($authToken);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_type'] = $user['user_type'];
            redirectToDashboard($user['user_type']);
        }
    }
}

function redirectToDashboard($userType)
{
    $dashboardUrls = [
        'Admin' => 'admin/index.php',
        'User' => 'User/index.php',
    ];

    $dashboardUrl = isset($dashboardUrls[$userType]) ? $dashboardUrls[$userType] : '';

    if (!empty($dashboardUrl)) {
        header('Location: ' . BASE_URL . $dashboardUrl);
        exit();
    }
}

function getUserByAuthToken($authToken)
{
    global $conn;

    $stmt = $conn->prepare("SELECT user_id, user_type FROM users WHERE auth_token = ?");
    $stmt->bind_param("s", $authToken);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user;
}

checkLoggedInUser();