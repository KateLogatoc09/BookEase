<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BookEase</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="public/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?=site_url()?>/public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?=site_url()?>/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?=site_url()?>/public/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= site_url()?>/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= site_url()?>/public/css/style.css" rel="stylesheet">

    <!-- AlertJs -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

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
                    <a href="/account" class="nav-item nav-link">Account</a>
                    <?php endif; ?>
                    <a href="/spa" class="nav-item nav-link">Spa</a>
                    <a href="/resorts" class="nav-item nav-link">Resort</a>
                    <a href="/apartments" class="nav-item nav-link active">Apartment</a>
                    <?php if(isset($_SESSION['token'])): ?>
                    <a href="/logout" class="nav-item nav-link">logout</a>
                    <?php endif; ?>
                </div>
                <?php if(!isset($_SESSION['token'])): ?>
                <a href="/login" class="btn btn-sm main-btn px-4 border-end login">Login</a>
                <a href="/register" class="btn btn-sm main-btn px-3 border-end register">Register</a>
                <?php endif; ?>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header cover">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Squares Beach Front Apartments</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Apartment</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Rooms Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Apartments</h6>
                <h1 class="mb-5">Rooms for Bookings</h1>
            </div>
            <div class="row g-4 justify-content-center">
            <div class="row g-4 justify-content-center">
                <?php foreach($rooms as $room): ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="" src="<?= site_url().'/'.$room['photo'] ?>" alt="" height="320px" width="100%">
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0"><?= $room['name'] ?></h3>
                            <hr>
                            <p><h6 class="nobr">Description: </h6><?= $room['description'] ?></p>
                            <p><h6 class="nobr">Price: </h6>&#8369; <?= $room['actual_price'] ?></p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="<?=site_url()?>/book/<?=$room['id']?>" class="btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            </div>
        </div>
    </div>
    <!-- Rooms End -->

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
                            <img class="img-fluid bg-light p-1" src="public/img/package-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="public/img/package-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="public/img/package-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="public/img/package-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="public/img/package-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="public/img/package-1.jpg" alt="">
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
    <script src="<?=site_url()?>/public/lib/wow/wow.min.js"></script>
    <script src="<?=site_url()?>/public/lib/easing/easing.min.js"></script>
    <script src="<?=site_url()?>/public/lib/waypoints/waypoints.min.js"></script>
    <script src="<?=site_url()?>/public/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?=site_url()?>/public/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?=site_url()?>/public/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?=site_url()?>/public/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- AlertJs -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Template Javascript -->
    <script src="public/js/main.js"></script>

    <!-- Custom Js -->
    <script>
        $(document).ready(function(){
            alertify.defaults = {
                // dialogs defaults
                autoReset:true,
                basic:false,
                closable:true,
                closableByDimmer:true,
                invokeOnCloseOff:false,
                frameless:false,
                defaultFocusOff:false,
                maintainFocus:true, // <== global default not per instance, applies to all dialogs
                maximizable:true,
                modal:true,
                movable:true,
                moveBounded:false,
                overflow:true,
                padding: true,
                pinnable:true,
                pinned:true,
                preventBodyShift:false, // <== global default not per instance, applies to all dialogs
                resizable:true,
                startMaximized:false,
                transition:'pulse',
                transitionOff:false,
                tabbable:'button:not(:disabled):not(.ajs-reset),[href]:not(:disabled):not(.ajs-reset),input:not(:disabled):not(.ajs-reset),select:not(:disabled):not(.ajs-reset),textarea:not(:disabled):not(.ajs-reset),[tabindex]:not([tabindex^="-"]):not(:disabled):not(.ajs-reset)',  // <== global default not per instance, applies to all dialogs

                // notifier defaults
                notifier:{
                // auto-dismiss wait time (in seconds)  
                    delay:5,
                // default position
                    position:'bottom-right',
                // adds a close button to notifier messages
                    closeButton: false,
                // provides the ability to rename notifier classes
                    classes : {
                        base: 'alertify-notifier',
                        prefix:'ajs-',
                        message: 'ajs-message',
                        top: 'ajs-top',
                        right: 'ajs-right',
                        bottom: 'ajs-bottom',
                        left: 'ajs-left',
                        center: 'ajs-center',
                        visible: 'ajs-visible',
                        hidden: 'ajs-hidden',
                        close: 'ajs-close'
                    }
                },

                // language resources 
                glossary:{
                    // dialogs default title
                    title:'Bookease',
                    // ok button text
                    ok: 'OK',
                    // cancel button text
                    cancel: 'Cancel'            
                },

                // theme settings
                theme:{
                    // class name attached to prompt dialog input textbox.
                    input:'ajs-input',
                    // class name attached to ok button
                    ok:'ajs-ok',
                    // class name attached to cancel button 
                    cancel:'ajs-cancel'
                },
                // global hooks
                hooks:{
                    // invoked before initializing any dialog
                    preinit:function(instance){},
                    // invoked after initializing any dialog
                    postinit:function(instance){},
                },
            };
            
            <?php if (isset($_SESSION['msg'])): ?>
                alertify.alert('Note: <?= $_SESSION['msg'] ?>');
            <?php endif; ?>
        });
    </script>
</body>

</html>