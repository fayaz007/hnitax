<?php include 'includes/header.php'; ?>

<body class="tt-magic-cursor">


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


    <!-- Page Header Start -->
    <div class="page-header light-bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">Individual Services</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">home</a>/<a href="#">Individual Services</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Services Section Start -->
    <div class="page-services">
        <div class="container">
         
        <div class="row">
                <!-- Service Item Start -->
                <div class="col-md-4">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="service-image">
                            <figure class="image-anime">
                                <a href="individual-tax-filing.php"><img src="images/TaxFiling.jpg" alt="Individual Tax Filing"></a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>Individual Tax Filing</h3>
                            <div class="service-readmore-btn">
                                <a href="individual-tax-filing.php" class="btn-default" style="font-size:larger">read more</a>
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
                                <a href="tax-planning.php"><img src="images/2655.jpg" alt="Tax Planning"></a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>Tax Planning</h3>
                            <div class="service-readmore-btn">
                                <a href="tax-planning.php" class="btn-default">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Item End -->

                <!-- Service Item Start -->
                <div class="col-md-4">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.45s">
                        <div class="service-image">
                            <figure class="image-anime">
                                <a href="amendment-filing.php"><img src="images/Filing.jpg" alt="Amendment Filing"></a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>Amendment Filing</h3>
                            <div class="service-readmore-btn">
                                <a href="amendment-filing.php" class="btn-default">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Item End -->

                <!-- Service Item Start -->
                <div class="col-md-4">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.55s">
                        <div class="service-image">
                            <figure class="image-anime">
                                <a href="itin-assistance.php"><img src="images/ITINapplication.jpg" alt="ITIN Assistance"></a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>ITIN Assistance</h3>
                            <div class="service-readmore-btn">
                                <a href="itin-assistance.php" class="btn-default">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Item End -->
                <!-- Service Item Start -->
                <div class="col-md-4">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.65s">
                        <div class="service-image">
                            <figure class="image-anime">
                                <a href="w4-planning.php"><img src="images/W4.jpg" alt="W4 Planning"></a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>W4 Planning</h3>
                            <div class="service-readmore-btn">
                                <a href="w4-planning.php" class="btn-default">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Item End -->

                <!-- Service Item Start -->
                <div class="col-md-4">
                    <div class="service-item wow fadeInUp" data-wow-delay="0.75s">
                        <div class="service-image">
                            <figure class="image-anime">
                                <a href="tax-audit-representation.php"><img src="images/AUDIT.jpg" alt="Tax Audit Representation"></a>
                            </figure>
                        </div>
                        <div class="service-content">
                            <h3>Tax Audit Representation</h3>
                            <div class="service-readmore-btn">
                                <a href="tax-audit-representation.php" class="btn-default">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Service Item End -->
            </div>
        </div>
    </div>
    <!-- Page Services Section End -->

    <!-- Cta Box Section Start -->
    <div class="cta-box service-cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2 class="text-anime-style-3">Get your max refund with our 100%
                            Accuracy Guarantee
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-4">
                    <!-- Section Btn Start -->
                    <div class="section-btn wow fadeInUp" data-wow-delay="0.25s">
                        <a href="contact.php" class="btn-default btn-highlighted btn-large">Know More</a>
                    </div>
                    <!-- Section Btn End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Cta Box Section End -->


    <!-- Footer Start -->
    <?php include 'includes/footer.php'; ?>

    <!-- Footer End -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var heroSwiper = new Swiper('.hero-slider', {
                effect: 'cube',
                cubeEffect: {
                    shadow: false,
                    slideShadows: true,
                    shadowOffset: 20,
                    shadowScale: 0.94,
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.hero-slider-next',
                    prevEl: '.hero-slider-prev',
                },
                loop: true,
            });
        });
    </script>