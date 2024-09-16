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
    <style>
    #datasetDropdown {
        width: 150px; /* Reduce width */
        font-size: 12px; /* Smaller font size */
        padding: 5px; /* Smaller padding */
    }
</style>
    
    <body class="nav-fixed">
        <?php include 'includes/topbar.php'; ?>
      
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php include 'includes/navbar.php'; ?>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Heatmap 
                                        </h1>
                                        <div class="page-header-subtitle"> Visualization</div>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-n10">
                        <div class="card mb-4">
                            <div class="card-header">Heatmap</div>
                            <div class="card-body">
                            <div class="col-12 col-xl-auto mt-4">
                                        <!-- Dropdown for selecting datasets -->
                                        <select id="datasetDropdown" class="form-select">
                                            <option value="dataset1">Dataset 1</option>
                                            <option value="dataset2">Dataset 2</option>
                                            <option value="dataset3">Dataset 3</option>
                                        </select>
                                    </div>
                                <div id="chart"></div>
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
        
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>

        <script>
            function generateData(count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var x = (i + 1).toString();
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                    series.push({ x: x, y: y });
                    i++;
                }
                return series;
            }

            // Initial data
            var datasets = {
                dataset1: [
                    {
                        name: "Metric1",
                        data: generateData(18, { min: 0, max: 90 })
                    },
                    {
                        name: "Metric2",
                        data: generateData(18, { min: 91, max: 180 })
                    }
                ],
                dataset2: [
                    {
                        name: "Metric3",
                        data: generateData(18, { min: 181, max: 270 })
                    },
                    {
                        name: "Metric4",
                        data: generateData(18, { min: 271, max: 360 })
                    }
                ],
                dataset3: [
                    {
                        name: "Metric5",
                        data: generateData(18, { min: 361, max: 450 })
                    },
                    {
                        name: "Metric6",
                        data: generateData(18, { min: 451, max: 540 })
                    }
                ]
            };

            // Initial heatmap setup
            var options = {
                series: datasets.dataset1,  // Initial dataset
                chart: {
                    height: 350,
                    type: "heatmap"
                },
                dataLabels: {
                    enabled: false
                },
                colors: ["#ea4444"],
                title: {
                    text: ""
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            // Function to update heatmap based on dropdown selection
            document.getElementById("datasetDropdown").addEventListener("change", function() {
                var selectedDataset = this.value;
                chart.updateSeries(datasets[selectedDataset]);
            });
        </script>

        <script src="https://assets.startbootstrap.com/js/sb-customizer.js"></script>
    </body>
</html>
