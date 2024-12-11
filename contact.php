<?php include 'includes/header.php'; ?>

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

    <!-- Page Header Start -->
    <div class="page-header light-bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">Contact us</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a> / <a href="#">contact us</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Information Section Start -->
    <div class="contact-information">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <!-- Contact Info Item Start -->
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.25s">
                        <!-- Contact Image Start -->
                        <div class="contact-image">
                            <figure class="image-anime">
                                <img src="images/location-img.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Contact Image End -->

                        <!-- Contact Info Box Start -->
                        <div class="contact-info-box">
                            <div class="icon-box">
                                <img src="images/icon-location.svg" alt="">
                            </div>
                            <div class="contact-info-content">
                                <p>5900 Balcones Drive STE Austin TX 78731</p>
                            </div>
                        </div>
                        <!-- Contact Info Box End -->
                    </div>
                    <!-- Contact Info Item End -->
                </div>

                <div class="col-md-3">
                    <!-- Contact Info Item Start -->
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.5s">
                        <!-- Contact Image Start -->
                        <div class="contact-image">
                            <figure class="image-anime">
                                <img src="images/email-img.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Contact Image End -->

                        <!-- Contact Info Box Start -->
                        <div class="contact-info-box">
                            <div class="icon-box">
                                <img src="images/icon-email.svg" alt="">
                            </div>
                            <div class="contact-info-content">
                                <p><a href="mailto:contact@hnitax.com">contact@hnitax.com</a></p>
                                <!-- <p><a href="#">info@domainname.com</a></p> -->
                            </div>
                        </div>
                        <!-- Contact Info Box End -->
                    </div>
                    <!-- Contact Info Item End -->
                </div>

                <div class="col-md-3">
                    <!-- Contact Info Item Start -->
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.75s">
                        <!-- Contact Image Start -->
                        <div class="contact-image">
                            <figure class="image-anime">
                                <img src="images/phone-img.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Contact Image End -->

                        <!-- Contact Info Box Start -->
                        <div class="contact-info-box">
                            <div class="icon-box">
                                <img src="images/icon-phone.svg" alt="">
                            </div>
                            <div class="contact-info-content">
                                <p><a href="tel:+1(312)788-8232">+1 (312)788-8232</a></p>
                                <!-- <p><a href="#">(+0)-123-456-789</a></p> -->
                            </div>
                        </div>
                        <!-- Contact Info Box End -->
                    </div>
                    <!-- Contact Info Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Information Section End -->

    <!-- Contact Us Section Start -->
    <div class="contact-us light-bg-section">
        <div class="container">
            <div class="row section-row align-items-center">
       
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">get in touch</h3>
                        <h2 class="text-anime-style-3">Needs help? let's get in touch</h2>
                    </div>
                    <!-- Section Title End -->
                </div>


            </div>

            <div class="row">

                <div class="col-lg-6">
                    <!-- Google Map Start -->
                    <div class="google-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45060306.91979327!2d-129.94270855!3d46.423669000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9770834f3045%3A0x62f75682d2f665f7!2sHNI%20TAX%20FILER!5e0!3m2!1sen!2sin!4v1733370367111!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <!-- Google Map End -->
                </div>
                <div class="col-lg-6">
                    <!-- Contact Form Start -->
                    <div class="contact-form wow fadeInUp" data-wow-delay="0.25s">
                        <form id="contactForm" action="#" method="POST" data-toggle="validator">
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="first name" required="">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="lname" class="form-control" id="lname" placeholder="last name" required="">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="email" required="">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required="">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <textarea name="msg" class="form-control" id="msg" rows="7" placeholder="write a message" required=""></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn-default">submit now</button>
                                    <div id="msgSubmit" class="h3 hidden"></div>
                                </div>
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