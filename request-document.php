<?php
include_once 'config/init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - eGovern: EXPLORATORY DATA VISUALIZATION FOR ADVANCING COMMUNITY GOVERNANCE IN BARANGAY CULIONG, SALCEDO,</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    <body class="nav-fixed">
        <?php include 'includes/topbar.php'; ?>
      
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
               <?php include 'includes/navbar.php'; ?>
            </div>

            <div id="layoutSidenav_content">
                <main>
                <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                    <div class="container-fluid px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i class="fa-light fa-monitor-waveform"></i></div>
                                        Request Document
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="container-xl px-4">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="documentType" class="form-label">Document</label>
                                    <select class="form-control" name="certification_type" id="certification_type" onchange="toggleFields()">
                                        <option selected disabled>Select document</option>
                                        <?php
                                            $rd = new RequestDocument();
                                            $res = $rd->getDocuments();
                                            foreach ($res as $row): ?>
                                                <option value="<?= $row['document_id'] ?>"><?= $row['document_name'] ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3" id="resident_name_div" >
                                    <label>Resident Name</label>
                                    <select class="form-control select2" name="resident_name" id="resident_name">
                                        <option selected disabled>Select Resident</option>
                                        <option value="1">Joanna Baylen</option>
                                    </select>                        
                                </div>

                                <div class="mb-3" id="requester_name_div" >
                                    <label>Who is requesting the certification?</label>
                                    <input type="text" name="requester_name" id="requester_name" class="form-control"/>
                                </div>

                                <div class="mb-3" id="clearance_purpose_div" >
                                    <label>What is the purpose of the clearance?</label>
                                    <input type="text" name="clearance_purpose" id="clearance_purpose" class="form-control"/>
                                </div>

                                <div class="mb-3" id="community_tax_cert_div" >
                                    <label>Community Tax Certificate Number</label>
                                    <input type="text" name="community_tax_cert_number" id="community_tax_cert_number" class="form-control"/>
                                </div>

                                <div class="mb-3" id="community_tax_date_div" >
                                    <label>When was the Community Tax Certificate Number issued?</label>
                                    <input type="date" name="community_tax_cert_date" id="community_tax_cert_date" class="form-control"/>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
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
        <script src="js/scripts.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    width: 'resolve'
                });
            });

           

        </script>
    </body>
</html>
