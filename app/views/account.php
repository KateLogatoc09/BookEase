<?php 
    if(!isset($_SESSION['token'])) {
        redirect(site_url().'/login');
    } else {

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
    <link href="public/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="public/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="public/css/style.css" rel="stylesheet">
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

        <div class="container-fluid bg-primary py-5 mb-5 hero-header cover">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Account Settings</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Account</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

<!-- Contact Start -->
<div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center green px-3">Account Settings</h6>
                <h1 class="mb-5">Profile Information</h1>
            </div>
            <div class="row g-4"  id="classy2">

                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-float w-100 h-80" src='public/img/user-1.jpg' alt="" style="object-fit: cover;">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-id-badge text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Username</h6>
                            <h6><?= $username ?></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Email</h6>
                            <h6><?= $email ?></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Mobile</h6>
                            <h6><?= $phone ?></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-map-marker text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Address</h6>
                            <h6><?= $address ?></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-male text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Gender</h6>
                            <h6><?= $gender ?></h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-calendar-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Birthdate</h6>
                            <h6><?= $birthdate ?></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-id-card text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">First Name: </h6>
                            <h6><?= $firstname ?></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-id-card-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Middle Name: </h6>
                            <h6><?= $middlename ?></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 75px; height: 75px;">
                            <i class="fa fa-id-card text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="green">Last Name: </h6>
                            <h6><?= $lastname ?></h6>
                        </div>
                    </div>
                    <button class="btn main-btn py-3 px-5 mt-2">Edit Details</button>
                </div>
            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    
    <div class="back3">
                <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container">
                        <div>
                            <h1 class="text-white mb-4 text-center" id="classy">Update Information</h1>
                                <form>
                                    <div class="row g-5 align-items-center">
                                        <!-- image -->
                                        <div>
                                        <img class="img-fluid2 center2" src='public/img/user-1.jpg' alt="" style="object-fit: cover;">
                                        </div>

                                        <div class="col-md-6 text-white" id="classy2">
                                            <div class="row g-3">

                                                <div class="col-md-12"  id="color">
                                                    <div class="form-floating">
                                                        <input type="email" class="form-control bg-transparent" id="email" placeholder="Email" required>
                                                        <label for="email">Email</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control bg-transparent" id="username" placeholder="Username" required>
                                                        <label for="username">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <input type="date" minlength="8" class="form-control bg-transparent" id="birthdate" placeholder="Birthdate" required>
                                                        <label for="birthdate">Birthdate</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <select id="gender" class="form-control bg-transparent" name="gender" required>
                                                            <option value="Female">Female</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                        <label for="gender">Gender</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"  id="color">
                                                    <div class="form-floating">
                                                        <input type="tel" maxlength="11" class="form-control bg-transparent" placeholder="Number" id="phone" required>
                                                        <label for="number">Phone Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row g-3">

                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control bg-transparent" id="first_name" placeholder="First Name" required>
                                                        <label for="fname">First Name</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control bg-transparent" id="middle_name" placeholder="Middle Name">
                                                        <label for="mname">Middle Name</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control bg-transparent" id="last_name" placeholder="Last Name" required>
                                                        <label for="lname">Last Name</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control bg-transparent" id="address" placeholder="Address" required>
                                                        <label for="address">Address</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" id="color">
                                                    <div class="form-floating">
                                                        <input type="file" class="form-control bg-transparent" id="photo" placeholder="Photo">
                                                        <label for="photo" class="pad">Upload New Photo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-12">
                                        <button class="btn btn-outline-light w-50 py-3 center" type="submit">Update Info</button>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-outline-light w-50 py-3 center">Go Back</button>
                                    </div>
                                </div>
                            </form>
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
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
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
    <script src="public/lib/wow/wow.min.js"></script>
    <script src="public/lib/easing/easing.min.js"></script>
    <script src="public/lib/waypoints/waypoints.min.js"></script>
    <script src="public/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="public/lib/tempusdominus/js/moment.min.js"></script>
    <script src="public/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="public/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="public/js/main.js"></script>
</body>

</html>