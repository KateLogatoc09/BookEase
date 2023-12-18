<?php 
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
            <li class="menu-item">
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

            <li class="menu-item active">

              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Account Settings">Tourists</div>
              </a>

              <ul class="menu-sub">

                <li class="menu-item active">
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tourists /</span> Manage</h4>

              <div class="card col-md-12">
                <div class="table-responsive text-nowrap rounded-3 overflow-y-scroll h-px-500 invisible-scrollbar">
                  <table class="table table-hover text-center h-px-500">
                  <caption class="ms-4 position-sticky bottom-0">
                      List of Tourists
                    </caption>
                    <thead class="table-custom border-top-0 position-sticky top-0">
                      <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Username</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Phone</th>
                        <th class="text-white">Address</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach($account as $acc): ?>
                      <tr>
                        <td><?php if(isset($acc['id'])): ?><?= $acc['id']; ?><?php endif; ?></td>
                        <td><strong><?php if(isset($acc['username'])): ?><?= $acc['username']; ?><?php endif; ?></strong></td>
                        <td><strong><?php if(isset($acc['email'])): ?><?= $acc['email']; ?><?php endif; ?></strong></td>
                        <td><?php if(isset($acc['phone'])): ?><?= $acc['phone']; ?><?php endif; ?></td>
                        <td><?= $acc['street']; ?>, <?= $acc['barangay']; ?>, <?= $acc['municipality']; ?>, <?= $acc['province']; ?>, REGION <?= $acc['region']; ?>, <?= $acc['zipcode']; ?></td>
                        <td><?php if(isset($acc['status'])): ?><?= $acc['status']; ?><?php endif; ?></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo site_url();?>/active/<?php if(isset($acc['id'])): ?><?= $acc['id']; ?><?php endif; ?>"
                                ><i class="bx bx-edit-alt me-1"></i> Active</a
                              >
                              <a class="dropdown-item" href="<?php echo site_url();?>/ban/<?php if(isset($acc['id'])): ?><?= $acc['id']; ?><?php endif; ?>"
                                ><i class="bx bx-minus me-1"></i> Ban</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>

                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row my-4" >
                <div class="col-md-6">
                  <div class="card">
                    <div class="table-responsive text-nowrap rounded-3 overflow-y-scroll h-px-500 invisible-scrollbar">
                      <table class="table table-hover text-center h-px-500">
                      <caption class="ms-4 position-sticky bottom-0">
                          List of Booking Transactions
                        </caption>
                        <thead class="table-custom border-top-0 position-sticky top-0">
                          <tr>
                            <th class="text-white">Transaction ID</th>
                            <th class="text-white">Username</th>
                            <th class="text-white">Reference Code</th>
                            <th class="text-white">Room Name</th>
                            <th class="text-white">Check_in</th>
                            <th class="text-white">Check_out</th>
                            <th class="text-white">Total</th>
                            <th class="text-white">Status</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <?php foreach($booking as $book): ?>
                          <tr>
                            <td><?php if(isset($book['id'])): ?><?= $book['id']; ?><?php endif; ?></td>
                            <td><strong><?php if(isset($book['username'])): ?><?= $book['username']; ?><?php endif; ?></strong></td>
                            <td><strong><?php if(isset($book['reference'])): ?><?= $book['reference']; ?><?php endif; ?></strong></td>
                            <td><?php if(isset($book['name'])): ?><?= $book['name']; ?><?php endif; ?></td>
                            <td><?php if(isset($book['check_in'])): ?><?= $book['check_in']; ?><?php endif; ?></td>
                            <td><?php if(isset($book['check_out'])): ?><?= $book['check_out']; ?><?php endif; ?></td>
                            <td><?php if(isset($book['total'])): ?><?= $book['total']; ?><?php endif; ?></td>
                            <td><?php if(isset($book['status'])): ?><?= $book['status']; ?><?php endif; ?></td>
                          </tr>
                        <?php endforeach; ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="table-responsive text-nowrap rounded-3 overflow-y-scroll h-px-500 invisible-scrollbar">
                      <table class="table table-hover text-center h-px-500">
                      <caption class="ms-4 position-sticky bottom-0">
                          List of Appointment Transactions
                        </caption>
                        <thead class="table-custom border-top-0 position-sticky top-0">
                          <tr>
                            <th class="text-white">Transaction ID</th>
                            <th class="text-white">Username</th>
                            <th class="text-white">Reference Code</th>
                            <th class="text-white">Service Name</th>
                            <th class="text-white">Appointment Date</th>
                            <th class="text-white">Appointment Time</th>
                            <th class="text-white">Total</th>
                            <th class="text-white">Status</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <?php foreach($appointment as $app): ?>
                          <tr>
                          <tr>
                            <td><?php if(isset($app['id'])): ?><?= $app['id']; ?><?php endif; ?></td>
                            <td><strong><?php if(isset($app['username'])): ?><?= $app['username']; ?><?php endif; ?></strong></td>
                            <td><strong><?php if(isset($app['reference'])): ?><?= $app['reference']; ?><?php endif; ?></strong></td>
                            <td><?php if(isset($app['name'])): ?><?= $app['name']; ?><?php endif; ?></td>
                            <td><?php if(isset($app['date'])): ?><?= $app['date']; ?><?php endif; ?></td>
                            <td><?php if(isset($app['time'])): ?><?= $app['time']; ?><?php endif; ?></td>
                            <td><?php if(isset($app['total'])): ?><?= $app['total']; ?><?php endif; ?></td>
                            <td><?php if(isset($app['status'])): ?><?= $book['status']; ?><?php endif; ?></td>
                          </tr>
                          </tr>
                        <?php endforeach; ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card col-md-12">
                <div class="table-responsive text-nowrap rounded-3 overflow-y-scroll h-px-500 invisible-scrollbar">
                  <table class="table table-hover text-center h-px-500">
                  <caption class="ms-4 position-sticky bottom-0">
                      List of Cancelled Reservations
                    </caption>
                    <thead class="table-custom border-top-0 position-sticky top-0">
                      <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Reference</th>
                        <th class="text-white">Date</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach($cancelled as $cld): ?>
                      <tr>
                        <td><?php if(isset($cld['id'])): ?><?= $cld['id']; ?><?php endif; ?></td>
                        <td><strong><?php if(isset($cld['reference'])): ?><?= $cld['reference']; ?><?php endif; ?></strong></td>
                        <td><strong><?php if(isset($cld['date'])): ?><?= $cld['date']; ?><?php endif; ?></strong></td>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
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
    <script src="<?php echo site_url();?>/public/assets/vendor/libs/jquery/jquery.js"></script>
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
