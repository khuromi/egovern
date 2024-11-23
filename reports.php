<?php
include_once 'config/init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}

$query = "SELECT DISTINCT TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM residents";
$stmt = $db->prepare($query);
$stmt->execute();

$ages = [];
while ($row = $stmt->fetch()) {
    $ages[] = $row['age'];
}

$ages = array_unique($ages);
sort($ages);

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
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

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
                                <h1 class="page-header-title text-light">  <div class="page-header-icon text-light"><i data-feather="book"></i></div> Reports
                            </h1>
                                    
                                    <div class="page-header-icon"><i class="fa-light fa-monitor-waveform"></i></div>
                                   
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container mt-5">
    <div class="row gutters">
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header  text-white">
                    <h5 class="mb-0">Residents Data Filters</h5>
                </div>
                <div class="card-body">
                <form method="post" action="print_residents.php">
                    <div class="row g-3">
                        <!-- Sector Filter -->
                        <div class="col-md-3">
                            <label for="sectorFilter" class="form-label">Sort By Sector:</label>
                            <select id="sectorFilter" name="sector" class="form-select">
                                <option value="">All</option>
                                <option value="Senior">Senior</option>
                                <option value="PWD">PWD</option>
                                <option value="4Ps">4P's</option>
                                <option value="Solo Parent">Solo Parent</option>
                            </select>
                        </div>
                        
                        <!-- Employment Status Filter -->
                        <div class="col-md-3">
                            <label for="employmentStatusFilter" class="form-label">Sort by Employment Status:</label>
                            <select id="employmentStatusFilter" name="employment_status" class="form-select">
                                <option value="">All</option>
                                <option value="Employed">Employed</option>
                                <option value="Self Employed">Self Employed</option>
                                <option value="Unemployed">Unemployed</option>
                                <option value="Student">Student</option>
                            </select>
                        </div>
                        
                        <!-- Age Filter -->
                        <div class="col-md-3">
                             <label for="ageFilter" class="form-label">Sort by Age:</label>
                               <select id="ageFilter" name="age" class="form-select">
                                    <option value="">All</option>
                                <option value="infants_toddlers">Infants/Toddlers (0-3)</option>
                                 <option value="children">Children (4-12)</option>
                                 <option value="teens">Teens (13-18)</option>
                               <option value="youth">Youth (18-30)</option>
                             <option value="middle_age">Middle Age (31-45)</option>
                                <option value="adults">Adults (46-59)</option>
                             <option value="seniors">Seniors (60+)</option>
                        </select>
                            </div>



                        <div class="col-md-3">
                            <label for="ethnicityFilter" class="form-label">Sort by Ethnicity:</label>
                            <select id="ethnicityFilter" name="ethnicity" class="form-select">
                                <option value="">All</option>
                                <option value="kankana-ey">Kankana-ey</option>
                                <option value="cabahug">Cabahug</option>
                                <option value="ibanag">Ibanag</option>
                                <option value="igorot">Igorot</option>
                                <option value="itneg">Itneg</option>
                            </select>
                        </div>
                        <div class="container mt-3">
                            <button class="btn btn-primary btn-block" type="submit">Download PDF</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header  text-white">
                    <h5 class="mb-0">Residents Data</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="residentsTable">
                            <thead class="table">
                                <tr>
                                    <th>Resident ID</th>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Sex</th>
                                    <th>Address</th>
                                    <th>Birthdate</th>
                                    <th>Civil Status</th>
                                    <th>Occupation</th>
                                    <th>Employment Status</th>
                                    <th>Sector Code</th>
                                </tr>
                            </thead>
                            <tbody id="report-table-body">
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
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
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

        <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#residentsTable').DataTable({
                "ajax": {
                    "url": "fetch_data.php",
                    "type": "POST",
                    "data": function(d) {
                        d.sector = $('#sectorFilter').val();
                        d.employment_status = $('#employmentStatusFilter').val();
                        d.age = $('#ageFilter').val();
                        d.ethnicity = $('#ethnicityFilter').val();
                    }
                },
                "columns": [
                    { "data": "resident_id" },
                    { "data": "lastname" },
                    { "data": "firstname" },
                    { "data": "middlename" },
                    { "data": "sex" },
                    { "data": "address" },
                    { "data": "birthdate" },
                    { "data": "civil_status" },
                    { "data": "occupation" },
                    { "data": "employment_status" },
                    { "data": "sector_code" }
                ]
            });

            // Reload table when filters change
            $('#sectorFilter, #employmentStatusFilter, #ageFilter, #ethnicityFilter').on('change', function() {
                table.ajax.reload();
            });
        });
    </script>

</html>
