<?php
    include_once 'config/init.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - eGovern: EXPLORATORY DATA VISUALIZATION FOR ADVANCING 
        COMMUNITY GOVERNANCE IN BARANGAY CULIONG, SALCEDO,</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            let id = <?= Session::getSession("uid") ?>
        </script>
        
    </head>
    
    <body class="nav-fixed">

        <?php

            include 'includes/topbar.php';
        ?>
      
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
               <?php

               include 'includes/navbar.php';
               ?>
            </div>


            <div id="layoutSidenav_content">
            <main>
            <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                <div class="container-fluid px-4 bg-gradient-primary-to-secondary">
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title text-light">
                                    <div class="page-header-icon"><i class="fa-light fa-monitor-waveform"></i></div>
                                    Account Settings
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main page content-->
            <div class="container px-4">
                <div class="row">
                    <div class="col-md-6">

                        <div class="card mb-3">
                            <div class="card-header bg-gradient-primary-to-secondary text-white">
                        Change Profile
                            </div>
                            <div class="card-body">
                        <form enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control" id="avatar">
                            </div>
                            <div class="mb-3">
                                <label for="firstname-input">First Name</label>
                                <input type="text" class="form-control" value="<?= !empty($user['first_name']) ? htmlentities($user['first_name']) : '' ?>" id="firstname-input">
                            </div>

                            <div class="mb-3">
                                <label for="lastname-input">Last Name</label>
                                <input type="text" class="form-control" value="<?= !empty($user['last_name']) ? htmlentities($user['last_name']) : '' ?>" id="lastname-input">
                            </div>

                            <div class="mb-3">
                                <button type="button" id="changeProfileBtn" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-6">

                        <div class="card mb-3">
                            <div class="card-header bg-gradient-primary-to-secondary text-white">
                                Change Password
                            </div>
                            <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" value="" id="old_password">
                            </div>
                            <div class="mb-3">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" value="" id="new_password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" value="" id="confirm_password">
                            </div>
                            <div class="mb-3">
                                <button type="button" id="changePasswordBtn" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                            </div>
                        </div>


                    </div>

            </div>


        

      
        </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright © Your Website 2021</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                ·
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script src="assets/js/register.js"></script>
        <script src="assets/js/sha512.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="assets/js/index.js"></script>
</body>
</html>
