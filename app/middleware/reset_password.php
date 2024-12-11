<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

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
} else {
    header('Location: login.php'); // Redirect to the login page if no token is provided
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <?php require('admin/includes/css/custom_styles.php') ?>
</head>

<body class="hold-transition login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="login-box">
                    <div class="side-img text-center">
                        <img src="assets/dist/img/Untitled-3.png" alt="image Untitled" class="img-fluid d-none d-md-block">
                        <img src="assets/dist/img/Untitled-3.png" width="200px" alt="image Untitled" class="img-fluid d-md-none">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="login-box">
                    <div class="card card-outline card-primary card-outline curve-card">
                        <div class="card-header text-center">
                            <img src="assets/uploads/logos/<?= !empty(LOGIN_FORM_LOGO_PATH) ? LOGIN_FORM_LOGO_PATH : "logo-placeholder.png" ?>" width="80%" class="img-fluid" alt="full-logo">
                        </div>
                        <div class="card-body">
                            <h2 class="text-center">Reset Password</h2>
                            <form id="resetPasswordForm">
                                <input type="hidden" name="token" value="<?php echo $token; ?>">
                                <div class="form-group">
                                    <label for="password">New Password:</label>
                                    <input type="password" name="password" class="form-control curve-card" id="password" placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input type="password" name="confirm_password" class="form-control curve-card" id="confirm_password" placeholder="Confirm New Password" required>
                                </div>
                                <div id="resetPasswordMessage" class="text-center mb-2"></div>
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <button type="submit" class="btn my-btn-primary-color btn-block curve-card" id="resetPasswordBtn">
                                            <span id="resetPasswordText">Reset Password</span>
                                            <span id="resetPasswordLoader" class="d-none">
                                                <i class="fas fa-spinner fa-spin"></i> Resetting Password...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#resetPasswordForm').validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8 // Adjust this as needed
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Please enter your new password",
                        minlength: "Password must be at least 8 characters long" // Customize the message
                    },
                    confirm_password: {
                        required: "Please confirm your new password",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    // Show a loading message and disable the button
                    $('#resetPasswordText').addClass('d-none');
                    $('#resetPasswordLoader').removeClass('d-none');
                    $('#resetPasswordBtn').prop('disabled', true);

                    // Serialize form data
                    var formData = $(form).serialize();

                    // Send an AJAX request to your reset_password_process.php script
                    $.ajax({
                        type: 'POST',
                        url: 'reset_password_process.php',
                        data: formData,
                        success: function(response) {
                            $('#resetPasswordLoader').addClass('d-none');
                            $('#resetPasswordText').removeClass('d-none');
                            $('#resetPasswordBtn').prop('disabled', false);

                            $('#resetPasswordMessage').html(response);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('AJAX Error: ' + textStatus, errorThrown);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>