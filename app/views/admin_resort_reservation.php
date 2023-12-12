<?php 
date_default_timezone_set('Asia/Singapore');
$tomorrow = new DateTime('tomorrow');
    if(!isset($_SESSION['token'])) {
        redirect(site_url().'/login');
    } else {
        if(isset($_SESSION['role'])) {
            if($_SESSION['role'] == "ADMIN") {
                
            } else {
                redirect(site_url().'/account');
            }
        } else {
            redirect(site_url().'/');
        }
    }
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?php echo site_url();?>/public/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>BookEase Admin Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo site_url();?>/public/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php echo site_url();?>/public/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo site_url();?>/public/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo site_url();?>/public/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo site_url();?>/public/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo site_url();?>/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?php echo site_url();?>/public/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php echo site_url();?>/public/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo site_url();?>/public/assets/js/config.js"></script>

    <!-- AlertJs -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    <!-- Jquery -->
    <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/admin" class="app-brand-link">
              <span class="app-brand-logo demo">
              
              </span>
              <span class="app-brand-text demo brand-color fw-bolder ms-2">BookEase</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="<?php echo site_url().'/'; ?>admin" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- SERVICES OFFERED -->

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Services</span>
            </li>

            <!-- APARTMENT -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-building-house"></i>
                <div data-i18n="Layouts">Apartment</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_apartment_reports" class="menu-link">
                    <div data-i18n="Container">Reports</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_apartment_manage" class="menu-link">
                    <div data-i18n="Without menu">Manage</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_apartment_reservations" class="menu-link">
                    <div data-i18n="Without navbar">Reservations</div>
                  </a>
                </li>

              </ul>

            </li>
            <!-- END -->
            <!-- RESORT -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-hotel"></i>
                <div data-i18n="Layouts">Resort</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_resort_reports" class="menu-link">
                    <div data-i18n="Container">Reports</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_resort_manage" class="menu-link">
                    <div data-i18n="Without menu">Manage</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_resort_reservations" class="menu-link">
                    <div data-i18n="Without navbar">Reservations</div>
                  </a>
                </li>

              </ul>

            </li>
            <!-- END -->
            <!-- SPA -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-spa"></i>
                <div data-i18n="Layouts">Spa</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_spa_reports" class="menu-link">
                    <div data-i18n="Container">Reports</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_spa_manage" class="menu-link">
                    <div data-i18n="Without menu">Manage</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_spa_reservations" class="menu-link">
                    <div data-i18n="Without navbar">Reservations</div>
                  </a>
                </li>

              </ul>

            </li>
            <!-- END -->
            <!-- END OF SERVICES -->

            <!-- Manage Users -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Users</span>
            </li>

            <li class="menu-item">

              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Account Settings">Tourists</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_tourists_manage" class="menu-link">
                    <div data-i18n="Account">Manage</div>
                  </a>
                </li>

              </ul>

            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                <div data-i18n="Authentications">Admin</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_admin_manage" class="menu-link">
                    <div data-i18n="Basic">Manage</div>
                  </a>
                </li>

              </ul>

            </li>

            <!-- manage mail -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">mailing</span>
            </li>

            <li class="menu-item">

              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Account Settings">Emails</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_emails_send" class="menu-link">
                    <div data-i18n="Notifications">Send</div>
                  </a>
                </li>

              </ul>

            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-shape-polygon"></i>
                <div data-i18n="Authentications">Subscription</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="<?php echo site_url().'/'; ?>admin_subscription_subscribers" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Manage Subscribers</div>
                  </a>
                </li>

              </ul>

            </li>
        </aside>
        <!-- / Menu -->


        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <h5 class="mt-3">Welcome<?php if(isset($_SESSION['name'])): ?>, <?= $_SESSION['name']; endif; ?></h5>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php if(isset($_SESSION['img'])): ?><?= site_url().'/'.$_SESSION['img']; ?><?php else: ?>public/img/user-1.jpg<?php endif; ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php if(isset($_SESSION['img'])): ?><?= site_url().'/'.$_SESSION['img']; ?><?php else: ?>public/img/user-1.jpg<?php endif; ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php if(isset($_SESSION['name'])): ?><?= $_SESSION['name']; endif; ?></span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    
                    <li>
                      <a class="dropdown-item" href="<?php echo site_url().'/'; ?>admin_account">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>

                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Resort /</span> Reservations</h4>

              <div class="card">
                <div class="table-responsive text-nowrap rounded-3 h-px-500 invisible-scrollbar">
                  <table class="table table-hover text-center h-px-500">
                  <caption class="ms-4 position-sticky bottom-0">
                      List of Reservations
                    </caption>
                    <thead class="table-custom border-top-0 position-sticky top-0">
                      <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Room Name</th>
                        <th class="text-white">Price</th>
                        <th class="text-white">No. of Rooms</th>
                        <th class="text-white">Booked By</th>
                        <th class="text-white">Guest Contact</th>
                        <th class="text-white">Pax</th>
                        <th class="text-white">Booked for</th>
                        <th class="text-white">Check-in</th>
                        <th class="text-white">Check-out</th>
                        <th class="text-white">Total</th>
                        <th class="text-white">Booking Code</th>
                        <th class="text-white">Reference Code</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Note</th>
                        <th class="text-white">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach($reservations as $reservation): ?>
                      <tr>
                        <td><?php if(isset($reservation['resid'])): ?><?= $reservation['resid']; ?><?php endif; ?></td>
                        <td><i class="fab fa-angular fa-lg text-danger"></i> <strong><?php if(isset($reservation['name'])): ?><?= $reservation['name']; ?><?php endif; ?></strong></td>
                        <td>&#8369; <?php if(isset($reservation['actual_price'])): ?><?= $reservation['actual_price']; ?><?php endif; ?></td>
                        <td><?php if(isset($reservation['qty'])): ?><?= $reservation['qty']; ?><?php endif; ?></td>
                        <td><strong><?php if(isset($reservation['firstname'])): ?><?= $reservation['firstname']; ?><?php endif; ?> <?php if(isset($reservation['middlename'])): ?><?= $reservation['middlename']; ?><?php endif; ?> <?php if(isset($reservation['lastname'])): ?><?= $reservation['lastname']; ?><?php endif; ?> </strong></td>
                        <td><?php if(isset($reservation['phone'])): ?><?= $reservation['phone']; ?><?php endif; ?></td>
                        <td><span class="badge bg-label-primary me-1"><?php if(isset($reservation['pax'])): ?><?= $reservation['pax']; ?><?php endif; ?></span></td>
                        <td><?php if(isset($reservation['days'])): ?><?= $reservation['days']; ?><?php endif; ?> Day/s</td>
                        <td><?php if(isset($reservation['check_in'])): ?><?= $reservation['check_in']; ?><?php endif; ?></td>
                        <td><?php if(isset($reservation['check_out'])): ?><?= $reservation['check_out']; ?><?php endif; ?></td>
                        <td>&#8369; <?php if(isset($reservation['total'])): ?><?= $reservation['total']; ?><?php endif; ?></td>
                        <td><strong><?php if(isset($reservation['code'])): ?><?= $reservation['code']; ?><?php endif; ?></strong></td>
                        <td><strong><?php if(isset($reservation['reference'])): ?><?= $reservation['reference']; ?><?php endif; ?></strong></td>
                        <td><?php if(isset($reservation['status'])): ?><?= $reservation['status']; ?><?php endif; ?></td>
                        <td class="notes"><?php if(isset($reservation['note'])): ?><?= $reservation['note']; ?><?php endif; ?></td>
                        <?php if(isset($reservation['status'])): ?>
                        <?php if($reservation['status'] == 'COMPLETED' || $reservation['status'] == 'CANCELLED'): ?>
                        <?php else: ?>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo site_url();?>/editres_res/<?php if(isset($reservation['resid'])): ?><?= $reservation['resid']; ?><?php endif; ?>"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                            </div>
                          </div>
                        </td>
                        <?php endif; endif; ?>
                      </tr>
                    <?php endforeach; ?>

                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card mt-4">
                <div class="table-responsive text-nowrap rounded-3 h-px-300 invisible-scrollbar">
                  <table class="table table-hover text-center h-px-300">
                  <caption class="ms-4 position-sticky bottom-0">
                      List of Payment Submissions
                    </caption>
                    <thead class="table-custom border-top-0 position-sticky top-0">
                      <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Reference</th>
                        <th class="text-white">Photo</th>
                        <th class="text-white">Downpayment</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach($payment as $pay): ?>
                      <tr>
                        <td><?php if(isset($pay['id'])): ?><?= $pay['id']; ?><?php endif; ?></td>
                        <td><strong><?php if(isset($pay['reference'])): ?><?= $pay['reference']; ?><?php endif; ?></strong></td>
                          <td><img src="<?php if(isset($pay['photo'])): ?><?= site_url().'/'.$pay['photo']; ?><?php else: ?>public/default.jpg<?php endif; ?>" class="rounded-3 image cursor-pointer" height="100" width="100" /></td>
                        <td>&#8369;<?php if(isset($pay['downpayment'])): ?><?= $pay['downpayment']; ?><?php endif; ?></td>
                      </tr>
                    <?php endforeach; ?>

                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card my-4">
                <h5 class="card-header">Edit Reservations</h5>
                <hr class="my-0">
                <form action="<?php echo site_url();?>/manageres_res" method="POST" enctype="multipart/form-data">
                    <div class="card-body d-flex row">
                        <div class="col-sm-12 col-md-12 d-sm-block d-md-block ps-2">
                            <div class="row">
                              <?php if(isset($selected['id'])): ?>
                              <input type="hidden" value="<?php if(isset($selected['id'])): echo $selected['id']; endif; ?>" name="id"/>
                              <?php endif; ?>
                                <div class="mb-2 col-md-6">
                                    <label for="reference" class="form-label">Reference Code</label>
                                    <input
                                    class="form-control"
                                    type="text"
                                    id="reference"
                                    name="reference"
                                    value="<?php if(isset($selected['reference'])): echo $selected['reference']; endif; ?>"
                                    autofocus
                                    readonly
                                    />
                                </div>

                                <div class="mb-2 col-md-2">
                                    <label for="qty" class="form-label">No. of Rooms</label>
                                    <input
                                    class="form-control"
                                    type="number"
                                    id="qty"
                                    name="qty"
                                    min="1"
                                    value="<?php if(isset($selected['qty'])): echo $selected['qty']; endif; ?>"
                                    autofocus
                                    required
                                    />
                                </div>

                                <div class="mb-2 col-md-2">
                                    <label for="pax" class="form-label">Pax</label>
                                    <input
                                    class="form-control"
                                    type="number"
                                    id="pax"
                                    name="pax"
                                    min="1"
                                    value="<?php if(isset($selected['pax'])): echo $selected['pax']; endif; ?>"
                                    autofocus
                                    required
                                    />
                                </div>

                                <div class="mb-2 col-md-2">
                                    <label for="days" class="form-label">Booked for in Day/s</label>
                                    <input
                                    class="form-control"
                                    type="number"
                                    id="days"
                                    name="days"
                                    min="1"
                                    value="<?php if(isset($selected['days'])): echo $selected['days']; endif; ?>"
                                    autofocus
                                    required
                                    />
                                </div>

                                <div class="mb-2 col-md-3">
                                  <label for="html5-date-input" class="form-label">Check-in Date</label>
                                    <div class="col-md-12">
                                      <input class="form-control check_in cursor-pointer" type="text" min="<?=$tomorrow->format('Y-m-d')?>" value="<?php if(isset($selected['check_in'])): echo $selected['check_in']; endif; ?>" name="check_in" id="html5-date-input" placeholder="Date" required/>
                                    </div>
                                </div>

                                <div class="mb-2 col-md-3">
                                  <label for="html5-date-input" class="form-label">Check-out Date</label>
                                    <div class="col-md-12">
                                      <input class="form-control" type="date" value="<?php if(isset($selected['check_out'])): echo $selected['check_out']; endif; ?>" name="check_out" id="html5-date-input" readonly/>
                                    </div>
                                </div>

                                <div class="mb-2 col-md-6">
                                    <label for="total" class="form-label">Total Amount to be Paid</label>
                                    <input
                                    class="form-control"
                                    type="number"
                                    min="0"
                                    id="total"
                                    name="total"
                                    value="<?php if(isset($selected['total'])): echo $selected['total']; endif; ?>"
                                    autofocus
                                    readonly
                                    />
                                </div>

                                <div class="mb-2 col-md-6">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea class="form-control" id="note" name="note" style="resize:none" rows="4"><?php if(isset($selected['note'])): echo $selected['note']; endif; ?></textarea>
                                </div>

                                <div class="mb-2 col-md-6">
                                  <div class="row">
                                    <div class= "col-md-6">
                                      <label for="room" class="form-label">Room</label>
                                      <select
                                        class="form-select"
                                        id="room"
                                        name="room"
                                        aria-label="Multiple select example"
                                        required
                                        <?php if(isset($selected['room'])):?>
                                        disabled
                                        <?php endif; ?>
                                      > <?php if(isset($selected['room_id'])): ?>
                                        <option value="<?= $selected['room_id']?>" selected><?= $selected['name']?></option>
                                        <?php else: ?>
                                        <option selected>Choose an option</option>
                                        <?php endif; ?>
                                        <?php foreach($rooms as $room): ?>
                                        <?php if(isset($selected['room_id'])): ?>
                                        <?php if($room['id'] == $selected['room_id']): continue; endif; endif; ?>
                                        <option value="<?= $room['id']?>"><?= $room['name'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>

                                    <div class="col-md-6">
                                    <label for="user" class="form-label">User</label>
                                      <select
                                        class="form-select"
                                        id="user"
                                        name="user"
                                        aria-label="Multiple select example"
                                        required
                                        <?php if(isset($selected['user_id'])):?>
                                        disabled
                                        <?php endif; ?>
                                      > <?php if(isset($selected['user_id'])): ?>
                                        <option value="<?= $selected['user_id']?>" selected><?= $selected['firstname'].' '.$selected['middlename'].' '.$selected['lastname']?></option>
                                        <?php else: ?>
                                        <option selected>Choose an option</option>
                                        <?php endif; ?>
                                        <?php foreach($account as $acc): ?>
                                        <?php if(isset($selected['user_id'])): ?>
                                        <?php if($acc['id'] == $selected['user_id']): continue; endif; endif; ?>
                                        <option value="<?= $acc['id']?>"><?= $acc['firstname'].' '.$acc['middlename'].' '.$acc['lastname'] ?> <?= $acc['id']?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                  </div>

                                    <label for="status" class="form-label">Status</label>
                                    <select
                                      class="form-select"
                                      id="status"
                                      name="status"
                                      aria-label="Multiple select example"
                                      required
                                    >
                                    <?php if(isset($selected['status'])): ?>
                                      <?php if($selected['status'] == "APPLIED"): ?>
                                        <option value="<?= $selected['status'] ?>" selected><?= $selected['status'] ?></option>
                                        <option value="PROCESSING">PROCESSING</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                      <?php elseif($selected['status'] == "REAPPLIED"): ?>
                                        <option value="<?= $selected['status'] ?>" selected><?= $selected['status'] ?></option>
                                        <option value="PROCESSING">PROCESSING</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                      <?php elseif($selected['status'] == "PROCESSING"): ?>
                                        <option value="<?= $selected['status'] ?>" selected><?= $selected['status'] ?></option>
                                        <option value="ACCEPTED">ACCEPTED</option>
                                        <option value="PAYMENT FAILED">PAYMENT FAILED</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                      <?php elseif($selected['status'] == "ACCEPTED"): ?>
                                        <option value="<?= $selected['status'] ?>" selected><?= $selected['status'] ?></option>
                                        <option value="CANCELLED">CANCELLED</option>
                                      <?php elseif($selected['status'] == "PAYMENT FAILED"): ?>
                                        <option value="<?= $selected['status'] ?>" selected><?= $selected['status'] ?></option>
                                        <option value="PROCESSING">PROCESSING</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                      <?php else:?>
                                        <option selected>Choose an option</option>
                                        <option value="APPLIED">APPLIED</option>
                                        <option value="PROCESSING">PROCESSING</option>
                                      <?php endif; else: ?>
                                        <option selected>Choose an option</option>
                                        <option value="APPLIED">APPLIED</option>
                                        <option value="PROCESSING">PROCESSING</option>
                                      <?php endif; ?>
                                    </select>
                                </div>

                                <div class="mb-2 col-md-12">
                                <label for="code" class="form-label">Booking Code</label>
                                    <input
                                    class="form-control"
                                    type="text"
                                    id="code"
                                    <?php if(isset($selected['code'])): ?>
                                    name="code"
                                    <?php endif; ?>
                                    value="<?php if(isset($selected['code'])): echo $selected['code']; endif; ?>"
                                    autofocus
                                    readonly
                                    />
                                </div>

                                <div class="mt-2">
                                <?php if(isset($selected['id'])): ?>
                                <a href="<?= site_url()?>/admin_apartment_reservations" class="btn btn-primary float-start" >Back to Insert</a>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary float-end ms-2">Save changes</button>
                                <button type="button" id="clear" onclick="event.preventDefault();" class="btn btn-primary float-end" >Clear</button>
                                </div>
                            </div>
                      </div>
                    </form>
              </div>

            </div>

            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <!--<script src="<?php echo site_url();?>/public/assets/vendor/libs/jquery/jquery.js"></script>-->
    <script src="<?php echo site_url();?>/public/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo site_url();?>/public/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo site_url();?>/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?php echo site_url();?>/public/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo site_url();?>/public/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?php echo site_url();?>/public/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?php echo site_url();?>/public/assets/js/dashboards-analytics.js"></script>

    <!-- AlertJs -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Custom Js -->
    <script>
        //clear
    const clrbtn = document.getElementById('clear');
    const qty = document.getElementById('qty');
    const pax = document.getElementById('pax');
    const days = document.getElementById('days');
    const note = document.getElementById('note');

    const clear = function () {
      qty.value = null;
      pax.value = null;
      days.value = null;
      note.value = null;
    }

    clrbtn.addEventListener('click', clear);

    //date
    var dateRange = [];

    var avail = {
    <?php foreach($rooms as $room): ?>
      "<?=$room['id'] ?>":[
        <?php foreach($check as $chk): ?>
        <?php if($chk['qty'] == $room['quantity'] && $chk['room_id'] == $room['id']): ?>
          "<?=$chk['date'] ?>",
        <?php endif; endforeach; ?>
      ], 
    <?php endforeach; ?>
    };

    var roomqty = {
    <?php foreach($rooms as $room): ?>
      "<?=$room['id'] ?>":{
        <?php foreach($check as $chk): ?>
        <?php if($chk['room_id'] == $room['id']): ?>
          "<?=date('m/d/Y', strtotime($chk['date'])) ?>" : <?= $room['quantity'] - $chk['qty'] ?>,
        <?php endif; endforeach; ?>
        }, 
    <?php endforeach; ?>
    };

    var quan = {
      <?php foreach($rooms as $room): ?>
      "<?=$room['id'] ?>": <?=$room['quantity']?>,
    <?php endforeach; ?>
    };

    $("#room").change(function() {
      let val = $(this).val();

      for (var d = new Date(avail[val][0]); d <= new Date(avail[val][avail[val].length - 1]); d.setDate(d.getDate() + 1)) {
        dateRange.push($.datepicker.formatDate('mm-dd-yy', d));
      }

      var disableDates = function(dt) {
      var dateString = jQuery.datepicker.formatDate('mm-dd-yy', dt);
      return [dateRange.indexOf(dateString) == -1];
      }

      $(".check_in").datepicker({
        minDate: new Date(),
        beforeShowDay: disableDates,
      });

      $(".check_in").change(function () {
        let datesel = $(this).val();
        let attr = roomqty[val][datesel];
        if(attr) {
          qty.setAttribute("max", attr);
        } else {
          qty.setAttribute("max", quan[val]);
        }

      });

    });

    //////////////////////////////////////////////////////////////

      $(document).ready(function(){
        const arr =document.getElementsByClassName("notes");

        for (let i = 0; i < arr.length; i++) {
          arr[i].innerText = arr[i].innerText.replace(/\. /g, "\n");
        }

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
