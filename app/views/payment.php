<?php 
    if(!isset($_SESSION['token'])) {
        redirect(site_url().'/login');
    } else {
        if(isset($_SESSION['role'])) {
            if($_SESSION['role'] == "ADMIN") {
                redirect(site_url().'/admin');
            } else {
                
            }
        } else {
            redirect(site_url().'/');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BookEase</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= site_url(); ?>/public/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= site_url();?>/public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= site_url();?>/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= site_url();?>/public/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= site_url(); ?>/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= site_url(); ?>/public/css/style.css" rel="stylesheet">

    <!-- AlertJs -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
</head>

<body>

       <!-- Navbar & Hero Start -->
       <div class="container-fluid position-relative p-0">
        <nav class="sticky navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="heading m-0 green"><i class="fa fa-map-marker-alt me-3"></i>BookEase</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler main-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/" class="nav-item nav-link">Home</a>
                    <a href="/about" class="nav-item nav-link">About</a>
                    <?php if(isset($_SESSION['token'])): ?>
                    <a href="/account" class="nav-item nav-link active">Account</a>
                    <?php endif; ?>
                    <a href="/spa" class="nav-item nav-link">Spa</a>
                    <a href="/resorts" class="nav-item nav-link">Resort</a>
                    <a href="/apartments" class="nav-item nav-link">Apartment</a>
                    <?php if(isset($_SESSION['token'])): ?>
                    <a href="/logout" class="nav-item nav-link">Logout</a>
                    <?php endif; ?>
                </div>
                <?php if(!isset($_SESSION['token'])): ?>
                <a href="/login" class="btn btn-sm main-btn px-4 border-end login">Login</a>
                <a href="/register" class="btn btn-sm main-btn px-3 border-end register">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->

         <!-- Appointment Start -->
         <div class="back">
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div>
                <form action="<?=site_url()?>/pay" method="post" enctype="multipart/form-data">
                <div class="row g-5 align-items-center">
                    <div class="col-md-6 text-white" id="classy2">
                        <div class="row g-3">
                            <h2 class="text-white mb-4 text-center" id="classy">Payment Details</h2><br>
                            <h4 class="text-white mb-4 text-center" id="classy2">Payment for: <span class="green" id="classy2"><?php if(isset($selected['reference'])): echo $selected['reference']; endif; ?></span></h4>
                            <h4 class="text-white mb-4 text-center" id="classy2">Pay to this Number (Paymaya, Gcash, Shopee Pay): <span class="green" id="classy2">Ex: 09XXXXXXXXX</span></h4>
                            <h4 class="text-white mb-4 text-center" id="classy2">Amount to be Paid: <span class="green" id="classy2">&#8369; <?php if(isset($selected['total'])): echo $selected['total'] * .20; endif; ?></span></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="row g-3">
                            <h2 class="text-white mb-4 text-center" id="classy">Proof of Payment</h2><br>
                                <div class="col-md-12 my-5" id="color">
                                    <div class="form-floating">
                                        <input type="hidden" name="reference" value="<?php if(isset($selected['reference'])): echo $selected['reference']; endif; ?>" />
                                        <input type="hidden" name="downpayment" value="<?php if(isset($selected['total'])): echo $selected['total'] * .20; endif; ?>" />
                                        <input type="file" class="form-control bg-transparent" id="proof" placeholder="proof" name="proof"/>
                                        <label for="instructions">Upload your Receipt.</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100 py-3" type="submit">Pay Now</button>
                                </div>
                            </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>




    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Company</h4>
                    <a class="btn btn-link" href="/about">About Us</a>
                    <a class="btn btn-link" href="/contact">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= site_url(); ?>/public/img/package-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= site_url(); ?>/public/img/package-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= site_url(); ?>/public/img/package-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= site_url(); ?>/public/img/package-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= site_url(); ?>/public/img/package-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= site_url(); ?>/public/img/package-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <form action='subscribe' method='post'>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="email" name="subs" placeholder="Your email">
                        <button type="submit" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="/">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= site_url();?>/public/lib/wow/wow.min.js"></script>
    <script src="<?= site_url();?>/public/lib/easing/easing.min.js"></script>
    <script src="<?= site_url();?>/public/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= site_url();?>/public/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= site_url();?>/public/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?= site_url();?>/public/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= site_url();?>/public/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- AlertJs -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= site_url();?>/public/js/main.js"></script>
</body>
</html>