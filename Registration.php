<?php include 'includes/header.php'; ?>
<!-- Custom CSS for Error Messages -->
<style>
    .error {
        color: red;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    .email-checking {
        color: orange;
        font-size: 0.9em;
    }

    .email-taken {
        color: red;
    }

    .email-available {
        color: green;
    }
    
</style>

<!-- Bootstrap CSS and Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">


<!-- intl-tel-input CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<!-- SweetAlert CSS and JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="tt-magic-cursor">
    <!-- WhatsApp Floating Chat Button with Pulse Effect -->
    <!-- <a href="https://api.whatsapp.com/send?phone=15557111382" class="btn-whatsapp-pulse" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a> -->

    <!-- Preloader Start -->
    <!-- <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="images/favicon.png" alt=""></div>
        </div>
    </div> -->
    <!-- Preloader End -->

    <!-- Magic Cursor Start -->
    <div id="magic-cursor">
        <div id="ball">
            <div class="circle"></div>
        </div>
    </div>
    <!-- Magic Cursor End -->

    <!-- Header Start -->
    <?php include 'includes/navbar.php'; ?>
    <!-- Header End -->


    <!-- Contact Us Section Start -->
    <div class="contact-us light-bg-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-12 text-center">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">User Registration</h3>
                        <h2 class="text-anime-style-3">Create your account</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <!-- Contact Form Start -->
                    <div class="contact-form wow fadeInUp" data-wow-delay="0.25s">
                        <form id="registrationForm" method="POST">
                            <!-- Full Name and Email in Two Columns -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name" required minlength="3">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                    <small id="emailStatus" class="form-text"></small>
                                </div>
                            </div>

                            <!-- Phone and Password in Two Columns -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required minlength="6">
                                </div>
                            </div>

                            <!-- Confirm Password and CAPTCHA in Two Columns -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
                                </div>
                                <div class="col-md-6">
                                    <!-- CAPTCHA Section -->
                                    <div class="d-flex align-items-center">
                                        <!-- CAPTCHA Text -->
                                        <span class="bg-light border p-2" id="captcha-text">
                                            <?php
                                            if (empty($_SESSION['captcha'])) {
                                                $_SESSION['captcha'] = rand(1000, 9999);
                                            }
                                            echo $_SESSION['captcha'];
                                            ?>
                                        </span>
                                        <!-- Refresh Icon -->
                                        <i class="bi bi-arrow-clockwise ms-2" style="font-size: 24px; cursor: pointer;" onclick="refreshCaptcha()"></i>
                                        <!-- CAPTCHA Input -->
                                        <input type="text" class="form-control ms-2 mt-2 mt-sm-0" id="captcha" name="captcha" placeholder="Enter CAPTCHA" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Fields for Full Phone Number and Country Code -->
                            <input type="hidden" id="fullPhone" name="fullPhone">
                            <input type="hidden" id="phoneCountryCode" name="phoneCountryCode">

                            <div class="col-md-12">
                                <button type="submit" class="btn-default">submit now</button>
                                <div id="msgSubmit" class="h3 hidden"></div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Us Section End -->


    <!-- Footer Start -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        function refreshCaptcha() {
            fetch('app/frontend_actions/refresh_captcha.php')
                .then(response => response.text())
                .then(data => {
                    $('#captcha-text').text(data);
                });
        }

        $(document).ready(function() {
            var input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "us",
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            // Live email validation
            $("#email").on('blur', function() {
                let email = $(this).val();
                let emailStatus = $("#emailStatus");

                if (email.length > 0) {
                    emailStatus.text("Checking email...").addClass("email-checking").removeClass("email-taken email-available");

                    $.ajax({
                        url: 'app/frontend_actions/check_email.php',
                        type: 'POST',
                        data: {
                            email: email
                        },
                        success: function(response) {
                            if (response == 'taken') {
                                emailStatus.text("Email is already registered").addClass("email-taken").removeClass("email-checking email-available");
                                $('#submitBtn').prop('disabled', true);
                            } else {
                                emailStatus.text("Email is available").addClass("email-available").removeClass("email-checking email-taken");
                                $('#submitBtn').prop('disabled', false);
                            }
                        }
                    });
                }
            });

            // jQuery Validation setup
            $("#registrationForm").validate({
                rules: {
                    fullName: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password"
                    },
                    captcha: {
                        required: true
                    }
                },
                messages: {
                    fullName: {
                        required: "Please enter your full name",
                        minlength: "Full name must be at least 3 characters long"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email"
                    },
                    phone: {
                        required: "Please enter your phone number"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Password must be at least 6 characters long"
                    },
                    confirmPassword: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    captcha: {
                        required: "Please enter the CAPTCHA"
                    }
                },
                errorClass: "error",
                submitHandler: function(form) {
                    $('#submitBtn').prop('disabled', true);
                    $('#fullPhone').val(iti.getNumber());
                    $('#phoneCountryCode').val(iti.getSelectedCountryData().dialCode);

                    // Submit the form using AJAX
                    $.ajax({
                        url: 'app/frontend_actions/submit_form.php', // Corrected to point to the register.php file
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            let data = JSON.parse(response);
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registration Successful!',
                                    text: data.message
                                }).then(() => {
                                    window.location.href = 'login.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message
                                });
                                $('#submitBtn').prop('disabled', false);
                            }
                        },
                        error: function(xhr) {
                            $('#submitBtn').prop('disabled', false);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.'
                            });
                        }
                    });
                }
            });
        });
    </script>