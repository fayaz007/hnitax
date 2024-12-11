<?php
require 'config/database.php';
require 'middleware/login_auth.php';
require 'config/theme_settings.php';





// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Define an associative array for dashboard URLs
    $dashboardUrls = [
         'Admin' => 'admin/index.php',
        'Artist' => 'artist/index.php',
        'Production Head' => 'productionHead/index.php',
        'Manager' => 'manager/index.php',
        'Accountant' => 'accountant/index.php'
    ];
    // Determine the user's dashboard URL based on their user type
    $userType = $_SESSION['user_type'];
    $dashboardUrl = isset($dashboardUrls[$userType]) ? $dashboardUrls[$userType] : '';

    if (!empty($dashboardUrl)) {
        // Redirect the user to their dashboard
        header('Location: ' . BASE_URL . $dashboardUrl);
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?> | Log in</title>
    <link rel="shortcut icon" href="assets/uploads/logos/<?= !empty(APP_LOGO_PATH) ? APP_LOGO_PATH : "logo-placeholder.png" ?>" type="image/x-icon">
    <link rel="icon" href="assets/uploads/logos/<?= !empty(APP_LOGO_PATH) ? APP_LOGO_PATH : "logo-placeholder.png" ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                            <p class="login-box-msg">Sign in to start your session</p>

                            <form id="loginForm" method="post">
                                <div class="form-group m-0">
                                    <label for="email"><span class="required"></span></label>
                                    <input type="email" name="email" class="form-control curve-card" id="email" placeholder="Enter email" required>
                                </div>

                                <div class="form-group">
                                    <label for="password"> <span class="required"></span></label>
                                    <input type="password" name="password" class="form-control curve-card" id="password" placeholder="Enter Password" required>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me" value="1">
                                    <label class="form-check-label" for="remember_me">Remember Me</label>
                                </div>
                                <div id="messageContainer" class="text-center mb-2"></div>

                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <button type="submit" class="btn my-btn-primary-color btn-block curve-card" id="loginBtn">
                                            <span id="loginText">Sign In</span>
                                            <span id="loginLoader" class="d-none">
                                                <i class="fas fa-spinner fa-spin"></i> Logging in...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <p class="m-3 text-center">
                                <!-- <a href="forgot_password_form.php">Forgot password?</a> -->
                                <button id="forgotPasswordButton" class="btn btn-link" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</button>

                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- The modal for password reset -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content card card-outline card-primary card-outline curve-card">



                    <div class="modal-header card-header text-center">
                        <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="card-body">


                        <div class="modal-body">
                            <form id="forgotPasswordForm" method="post">


                                <div class="form-group m-0">
                                    <label for="email"><span class="required"></span></label>
                                    <input type="email" name="email" class="form-control curve-card" id="forgotPasswordEmail" placeholder="Enter email" required>
                                </div>


                                <div id="forgotPasswordMessage" class="text-center mb-2"></div>

                            </form>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary  curve-card" data-dismiss="modal">Close</button>
                            <button type="submit" form="forgotPasswordForm" class="btn my-btn-primary-color curve-card" id="resetPasswordBtn">
                                <span id="resetPasswordText">Reset Password</span>
                                <span id="resetPasswordLoader" class="d-none">
                                    <i class="fas fa-spinner fa-spin"></i> Resetting...
                                </span>
                            </button>
                        </div>
                    </div>

                </div>
                <script src="assets/plugins/jquery/jquery.min.js"></script>
                <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="assets/dist/js/adminlte.min.js"></script>

                <!-- jquery-validation -->
                <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
                <script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#loginForm').validate({
                            rules: {
                                email: {
                                    required: true,
                                    email: true
                                },
                                password: {
                                    required: true
                                }
                            },
                            messages: {
                                email: {
                                    required: "Please enter your email address",
                                    email: "Please enter a valid email address"
                                },
                                password: {
                                    required: "Please enter your password"
                                }
                            },
                            errorElement: 'span',
                            errorPlacement: function(error, element) {
                                error.addClass('text-danger');
                                error.insertAfter(element);
                            },
                            submitHandler: function(form) {
                                // Show loader
                                $('#loginText').addClass('d-none');
                                $('#loginLoader').removeClass('d-none');

                                // Serialize form data
                                var formData = $(form).serialize();

                                // Send an AJAX request to your login_process.php script
                                $.ajax({
                                    type: 'POST',
                                    url: 'login_process.php',
                                    data: formData,
                                    success: function(response) {
                                        // Handle the response from login_process.php
                                        if (response.status === 'success') {
                                            // Redirect based on user type
                                            window.location.href = response.redirectUrl;
                                        } else {
                                            // Hide loader and display an error message
                                            $('#loginLoader').addClass('d-none');
                                            $('#loginText').removeClass('d-none');

                                            $('#messageContainer').html('<span class="text-danger">' + response.message + '</span>');
                                        }
                                    },
                                    dataType: 'json', // Expect JSON response
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.error('AJAX Error: ' + textStatus, errorThrown);
                                    }
                                });
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        // Initialize the Bootstrap modal
                        $('#forgotPasswordModal').modal({
                            backdrop: 'static', // Prevent closing on outside click
                            show: false // Hide the modal by default
                        });

                        // Show the modal when the "Forgot Password" button is clicked
                        $('#forgotPasswordButton').on('click', function() {
                            $('#forgotPasswordModal').modal('show');
                        });

                        // Handle form submission using AJAX
                        $('#forgotPasswordForm').validate({
                            rules: {
                                email: {
                                    required: true,
                                    email: true // Use the email validation rule
                                }
                            },
                            messages: {
                                email: {
                                    required: "Please enter your email address",
                                    email: "Please enter a valid email address"
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

                                // Send an AJAX request to your forgot_password.php script
                                $.ajax({
                                    type: 'POST',
                                    url: 'forgot_password.php',
                                    data: formData,
                                    success: function(response) {
                                        $('#resetPasswordLoader').addClass('d-none');
                                        $('#resetPasswordText').removeClass('d-none');
                                        $('#resetPasswordBtn').prop('disabled', false);

                                        $('#forgotPasswordMessage').html(response);
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