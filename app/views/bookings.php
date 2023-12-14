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

        <div class="container-fluid bg-primary py-5 mb-5 hero-header cover">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Account Settings</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item"><a href="">Pages</a></li>
                                <li class="breadcrumb-item"><a href="account">Account</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Bookings</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

<?php if(!isset($selbook) && !isset($selapp)): ?>
    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center secondary-text px-3">Booking Transactions</h6>
                <h1 class="mb-4">Bookings</h1>
            </div>

            <?php if(isset($bookings)): ?>
            <div class="row g-1">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <?php foreach($bookings as $book): ?>
                    <a href="<?=site_url()?>/booking/<?=$book['reference'];?>">
                    <div class="mb-4 w-100 bg-booking row" style="height:150px;">
                        <div class="col-md-4 col-lg-4 p-3 bg-darkgreen overflow-hidden h-100">
                            <h4 class="text-white afacad-200">Reference Code:</h4>
                            <hr class="bg-light">
                            <h4 class="text-primary secondary-text text-md-end"><?=$book['reference']?></h4>
                        </div>

                        <div class="col-md-4 col-lg-4 p-3 p-3 h-100" style="height:100%">
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Check-in:</h6>
                            <h5 class="text-white-70 secondary-text"><?=$book['check_in']?></h5>
                            </div>
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Check-out:</h6   >
                            <h5 class="text-white-70 secondary-text"><?=$book['check_out']?></h5>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 p-3 p-3 h-100" style="height:100%">
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Room:</h6>
                            <h5 class="text-white-70 secondary-text"><?=$book['name']?></h5>
                            </div>
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Booking Status:</h6   >
                            <h5 class="text-white-70 secondary-text"><?=$book['status']?></h5>
                            </div>
                        </div>
                    </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php else: ?>
            <div class="row g-1">
                <div class="text-center wow fadeInUp d-flex align-items-center justify-content-center" style="height:400px" data-wow-delay="0.1s">
                    <h1 class="text-lightgray">&#10077; No Records Found &#10078;</h1>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Booking End -->

    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center secondary-text px-3">Appointment Transactions</h6>
                <h1 class="mb-5">Appointments</h1>
            </div>

            <?php if(isset($appointments)): ?>
            <div class="row g-1">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <?php foreach($appointments as $app): ?>
                    <a href="<?=site_url()?>/booking/<?=$app['reference'];?>" class="pointer">
                    <div class="mb-4 w-100 bg-booking row position-relative" style="height:150px;">
                        <div class="col-md-4 col-lg-4 p-3 bg-darkgreen overflow-hidden h-100">
                            <h4 class="text-white afacad-200">Reference Code:</h4>
                            <hr class="bg-light">
                            <h4 class="text-primary secondary-text text-md-end"><?=$app['reference']?></h4>
                        </div>

                        <div class="col-md-4 col-lg-4 p-3 p-3 h-100" style="height:100%">
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Date:</h6>
                            <h5 class="text-white-70 secondary-text"><?=$app['date']?></h5>
                            </div>
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Time:</h6   >
                            <h5 class="text-white-70 secondary-text"><?=$app['time']?></h5>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 p-3 p-3 h-100" style="height:100%">
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Service' Applied:</h6>
                            <h5 class="text-white-70 secondary-text"><?=$app['name']?></h5>
                            </div>
                            <div class="col-md-12">
                            <h6 class="text-white afacad-200">Appointment Status:</h6   >
                            <h5 class="text-white-70 secondary-text"><?=$app['status']?></h5>
                            </div>
                        </div>
                    </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php else: ?>
            <div class="row g-1">
                <div class="text-center wow fadeInUp d-flex align-items-center justify-content-center" style="height:400px" data-wow-delay="0.1s">
                    <h1 class="text-lightgray">&#10077; No Records Found &#10078;</h1>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
    <!-- Appointment End -->

    <?php elseif(isset($selbook)): ?>

    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center secondary-text px-3">Booking Transactions</h6>
                <h1 class="mb-4">Bookings</h1>
            </div>
        
            <div class="row g-4"  id="classy2">
                <div class="col-lg-14 col-md-6 wow fadeInUp book" data-wow-delay="0.1s" id="space3">
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-building text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Place</h5>
                            <p class="mb-0"><?php if($selbook['category'] == 'APARTMENT'): ?>Squares Beach Front Apartments<?php else: ?>Simon's Heritage Resort<?php endif;?></p>
                        </div>
                    </div>          
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-building text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Room</h5>
                            <p class="mb-0"><?= $selbook['name'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-male text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Quantity</h5>
                            <p class="mb-0"><?= $selbook['qty'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-male text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Pax</h5>
                            <p class="mb-0"><?= $selbook['pax'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-calendar text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Number of Days</h5>
                            <p class="mb-0"><?= $selbook['days'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-credit-card text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Price</h5>
                            <p class="mb-0"><?= $selbook['total'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-14 col-md-6 wow fadeInUp book" data-wow-delay="0.1s" id="space3"> 
                <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-calendar-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Check In Date</h5>
                            <p class="mb-0"><?= $selbook['check_in'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-calendar-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Check Out Date</h5>
                            <p class="mb-0"><?= $selbook['check_out'] ?></p>
                        </div>
                    </div>
                        <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-comment text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Instructions</h5>
                            <p class="mb-0"><?= $selbook['note'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-book text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Reference</h5>
                            <p class="mb-0"><?= $selbook['reference'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-book text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Booking Code</h5>
                            <p class="mb-0"><?= $selbook['code'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-clipboard text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Booking Status</h5>
                            <p class="mb-0"><?= $selbook['status'] ?></p>
                        </div>
                    </div>
                    <?php if($selbook['status'] == 'APPLIED' || $selbook['status'] == 'REAPPLIED'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/payment/<?=$selbook['reference']?>">Pay</a>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selbook['reference']?>">Cancel</a>
                    <?php endif; ?>
                    <?php if($selbook['status'] == 'PAYMENT FAILED'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/reapplied/<?=$selbook['reference']?>">Reapply</a>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selbook['reference']?>">Cancel</a>
                    <?php endif; ?>
                    <?php if($selbook['status'] == 'ACCEPTED'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selbook['reference']?>">Cancel</a>
                    <?php endif; ?>
                    <?php if($selbook['status'] == 'PROCESSING'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selbook['reference']?>">Cancel</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->

    <?php else: ?>

    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center secondary-text px-3">Appointment Transactions</h6>
                <h1 class="mb-5">Appointments</h1>
            </div>
            <div class="row g-4"  id="classy2">
                <div class="col-lg-14 col-md-5 wow fadeInUp book" data-wow-delay="0.1s" id="space3"> 
                <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-list-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Service</h5>
                            <p class="mb-0"><?= $selapp['name'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-calendar-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Date</h5>
                            <p class="mb-0"><?= $selapp['date'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-clock text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Time</h5>
                            <p class="mb-0"><?= $selapp['time'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-credit-card text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Price</h5>
                            <p class="mb-0"><?= $selapp['total'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-14 col-md-5 wow fadeInUp book" data-wow-delay="0.1s" id="space3"> 
                        <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-comment text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Instructions</h5>
                            <p class="mb-0"><?= $selapp['note'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-book text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Reference</h5>
                            <p class="mb-0"><?= $selapp['reference'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-book text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Appointment Code</h5>
                            <p class="mb-0"><?= $selapp['code'] ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4" id="space2">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 main-btn" style="width: 50px; height: 50px;">
                            <i class="fa fa-clipboard text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="secondary-text">Booking Status</h5>
                            <p class="mb-0"><?= $selapp['status'] ?></p>
                        </div>
                    </div>

                    <?php if($selapp['status'] == 'APPLIED' || $selapp['status'] == 'REAPPLIED'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/payment/<?=$selapp['reference']?>">Pay</a>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selapp['reference']?>">Cancel</a>
                    <?php endif; ?>
                    <?php if($selapp['status'] == 'PAYMENT FAILED'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/reapplied/<?=$selapp['reference']?>">Reapply</a>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selapp['reference']?>">Cancel</a>
                    <?php endif; ?>
                    <?php if($selapp['status'] == 'ACCEPTED'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selapp['reference']?>">Cancel</a>
                    <?php endif; ?>
                    <?php if($selapp['status'] == 'PROCESSING'): ?>
                    <a class="btn bg-darkgreen w-50 text-white py-3 px-5 mt-2" href="<?= site_url()?>/booking/cancelled/<?=$selapp['reference']?>">Cancel</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
    <!-- Appointment End -->
<?php endif;?>

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