<?php include 'includes/header.php'; ?>

<body class="tt-magic-cursor">
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

    <!-- Our Services Start -->
    <div class="our-service light-bg-section">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-5">
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our services</h3>
                        <h2 class="text-anime-style-3">Services We provide</h2>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.25s">
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Service Item Start -->
                <div class="col-md-4">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="service-image">
                            <figure class="image-anime">
                                <a href="individual-tax-filing.php">
                                    <img src="images/TaxFiling.jpg" alt="Individual Tax Filing">
                                </a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>Individual Services</h3>
                            <div class="service-readmore-btn">
                                <a href="individual-services.php" class="btn-default service-button" data-target="#individualModal">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Item End -->

                <!-- Service Item Start -->
                <div class="col-md-4">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.35s">
                        <div class="service-image">
                            <figure class="image-anime">
                                <a href="tax-planning.php">
                                    <img src="images/2655.jpg" alt="Tax Planning">
                                </a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>Business Services</h3>
                            <div class="service-readmore-btn">
                                <a href="business-services.php" class="btn-default service-button" data-target="#businessModal">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Item End -->
            </div>

            <!-- Modals -->
            <div id="individualModal" class="custom-modal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <p>Discover our individual tax services!</p>
                </div>
            </div>

            <div id="businessModal" class="custom-modal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <p>Explore our business tax solutions!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services End -->

    <!-- CSS Code for Hover Modal Effect -->
    <style>
        /* Modal Styles */
        .custom-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            z-index: 1000;
            border-radius: 8px;
        }

        .modal-content {
            position: relative;
        }


   

    
    </style>

    <!-- JavaScript Code for Hover Modal Effect -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewButtons = document.querySelectorAll('.service-readmore-btn a');
            const modals = {
                '#individualModal': document.getElementById('individualModal'),
                '#businessModal': document.getElementById('businessModal')
            };

            // Show modal on button hover
            viewButtons.forEach(button => {
                button.addEventListener('mouseover', function () {
                    const targetModal = button.getAttribute('data-target');
                    if (modals[targetModal]) {
                        modals[targetModal].style.display = 'block';
                    }
                });

                button.addEventListener('mouseout', function () {
                    const targetModal = button.getAttribute('data-target');
                    if (modals[targetModal]) {
                        modals[targetModal].style.display = 'none';
                    }
                });
            });

            // Close modal when clicking the close button
            document.querySelectorAll('.close-modal').forEach(closeBtn => {
                closeBtn.addEventListener('click', function () {
                    closeBtn.parentElement.parentElement.style.display = 'none';
                });
            });
        });
    </script>

</body>
