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
        <title>Dashboard - eGovern: EXPLORATORY DATA VISUALIZATION FOR ADVANCING 
        COMMUNITY GOVERNANCE IN BARANGAY CULIONG, SALCEDO,</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                    <!-- Main page content-->
                 <div class="container py-5">



                       <div class="container">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    
                    <form method="POST" action="">
                        <div class="form-group mb-3">
                            <label for="report-type" class="label">Select Report Type</label>
                            <select name="report-type" id="report-type" class="form-select" onchange="this.form.submit()">
                                <option value="">Choose a report</option>
                                <option value="report1">Report Type 1</option>
                                <option value="report2">Report Type 2</option>
                                <option value="report3">Report Type 3</option>
                            </select>
                        </div>
                    </form>

                    <!-- Table to display selected report data -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                
                                    <th>
                                        Sort By Sector:
                                        <select class="form-select" onchange="sortTable(0, this.value)">
                                            <option value="">Senior</option>
                                            <option value="asc">PWD</option>
                                            <option value="desc">Ip's</option>
                                            <option value="">4P's</option>
                                            <option value="asc">Solo Parent</option>
                                           
                                            
                                        </select>
                                    </th>
                                    <th>
                                        Sort by Employment Status: 
                                        <select class="form-select" onchange="sortTable(1, this.value)">
                                            <option value="">Employed</option>
                                            <option value="asc">Self Employed</option>
                                            <option value="desc">Unemployed</option>
                                        </select>
                                    </th>
                                    <th>
                                        Sort by Age:
                                        <select class="form-select" onchange="sortTable(2, this.value)">
                                            <option value="">0-12</option>
                                            <option value="asc">13-19</option>
                                            <option value="desc">20-30</option>
                                            <option value="asc">31-59</option>
                                            <option value="desc">serior</option>
                                        </select>
                                    </th>
                                    
                                    <th> 
                                      <button class="btn btn-success" onclick="window.print()">
                                                     <i class="fas fa-print"></i> Print
                                                              </button>
                                                         
                                                        </th>
                                  
                                
                                </tr>
                            </thead>
                            <tbody id="report-table-body">
                                <?php
                                // Example PHP logic to fetch report data based on selection
                                $data = []; // Assume this array is filled with data based on report type
                                // Your logic for fetching data goes here...

                                // Example data (replace with your data fetching logic)
                                if (isset($_POST['report-type'])) {
                                    $reportType = $_POST['report-type'];

                                    switch ($reportType) {
                                        case 'report1':
                                            $data = [
                                                ['id' => 1, 'name' => 'John Doe', 'details' => 'Detail 1', 'date' => '2024-10-01'],
                                                // More rows...
                                            ];
                                            break;
                                        case 'report2':
                                            $data = [
                                                ['id' => 2, 'name' => 'Jane Smith', 'details' => 'Detail 2', 'date' => '2024-10-02'],
                                                // More rows...
                                            ];
                                            break;
                                        case 'report3':
                                            $data = [
                                                ['id' => 3, 'name' => 'Alice Johnson', 'details' => 'Detail 3', 'date' => '2024-10-03'],
                                                // More rows...
                                            ];
                                            break;
                                        default:
                                            break;
                                    }

                                    // Display the report data in the table
                                    foreach ($data as $row) {
                                        echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['name']}</td>
                                                <td>{$row['details']}</td>
                                                <td>{$row['date']}</td>
                                            </tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function sortTable(columnIndex, order) {
    const table = document.getElementById('report-table-body');
    const rows = Array.from(table.rows);
    
    rows.sort((a, b) => {
        const aText = a.cells[columnIndex].innerText;
        const bText = b.cells[columnIndex].innerText;

        if (order === 'asc') {
            return aText > bText ? 1 : -1;
        } else if (order === 'desc') {
            return aText < bText ? 1 : -1;
        }
        return 0;
    });

    // Clear the table and append the sorted rows
    table.innerHTML = '';
    rows.forEach(row => table.appendChild(row));
}
</script>


                      
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

</html>
