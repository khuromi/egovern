
<?php

include_once 'config/init.php';

if (!$login->isLoggedIn()) {
        header('Location: login.php' );

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
    <style>
    #datasetDropdown {
        width: 150px; /* Reduce width */
        font-size: 12px; /* Smaller font size */
        padding: 5px; /* Smaller padding */
    }
</style>

    
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
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                                            Dashboard 
                                        </h1>
                                       
                                    </div>
                                    <div class="col-12 col-xl-auto mt-4">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>


                    
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-n10">

                    <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 1-->
                                <div class="card border-start-lg border-start-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-primary mb-1">Population</div>
                                                <div class="h5">$4,390</div>
                                                <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                                    <i class="me-1" data-feather="trending-up"></i>
                                                    12%
                                                </div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 2-->
                                <div class="card border-start-lg border-start-secondary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-secondary mb-1">Households                                                                                                                                            </div>
                                                <div class="h5">$27.00</div>
                                                <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                                    <i class="me-1" data-feather="trending-down"></i>
                                                    3%
                                                </div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 3-->
                                <div class="card border-start-lg border-start-success h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-success mb-1">Clicks</div>
                                                <div class="h5">11,291</div>
                                                <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                                    <i class="me-1" data-feather="trending-up"></i>
                                                    12%
                                                </div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-mouse-pointer fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <!-- Dashboard info widget 4-->
                                <div class="card border-start-lg border-start-info h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-info mb-1">Conversion rate</div>
                                                <div class="h5">1.23%</div>
                                                <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                                    <i class="me-1" data-feather="trending-down"></i>
                                                    1%
                                                </div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-percentage fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </div>

                        <!-- Example Colored Cards for Dashboard Demo-->
                         

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

                            <div class="container py-3">
                            <div class="col-12 col-xl-auto mt-4">
                   <div class="card mb-4 col-12 col-xl-auto mt-4">
                             <div class="card-header">Scatter plot</div>
                             <div class="card-body">
                             <div id="scatter"></div>
 
                             </div>
                             </div>
                             </div>

                             <div class="container py-3">
                    
                    
                             <div class="col-12 col-xl-auto mt-4">
                    <div class="card mb-4 col-12 col-xl-auto mt-4">
                              <div class="card-header">treemap</div>
                              <div class="card-body">
                              <div id="ggfgf"></div>
  
                              </div>
                              </div>
                              </div>
                                     

                        <!-- Example DataTable for Dashboard Demo-->
                      
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4 col-12 col-xl-auto mt-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright © eGovern: Website 2024</div>
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
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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


        <!--scatter-->

<script> 
             var options = {
          series: [{
          name: "SAMPLE A",
          data: [
          [16.4, 5.4], [21.7, 2], [25.4, 3], [19, 2], [10.9, 1], [13.6, 3.2], [10.9, 7.4], [10.9, 0], [10.9, 8.2], [16.4, 0], [16.4, 1.8], [13.6, 0.3], [13.6, 0], [29.9, 0], [27.1, 2.3], [16.4, 0], [13.6, 3.7], [10.9, 5.2], [16.4, 6.5], [10.9, 0], [24.5, 7.1], [10.9, 0], [8.1, 4.7], [19, 0], [21.7, 1.8], [27.1, 0], [24.5, 0], [27.1, 0], [29.9, 1.5], [27.1, 0.8], [22.1, 2]]
        },{
          name: "SAMPLE B",
          data: [
          [36.4, 13.4], [1.7, 11], [5.4, 8], [9, 17], [1.9, 4], [3.6, 12.2], [1.9, 14.4], [1.9, 9], [1.9, 13.2], [1.4, 7], [6.4, 8.8], [3.6, 4.3], [1.6, 10], [9.9, 2], [7.1, 15], [1.4, 0], [3.6, 13.7], [1.9, 15.2], [6.4, 16.5], [0.9, 10], [4.5, 17.1], [10.9, 10], [0.1, 14.7], [9, 10], [12.7, 11.8], [2.1, 10], [2.5, 10], [27.1, 10], [2.9, 11.5], [7.1, 10.8], [2.1, 12]]
        },{
          name: "SAMPLE C",
          data: [
          [21.7, 3], [23.6, 3.5], [24.6, 3], [29.9, 3], [21.7, 20], [23, 2], [10.9, 3], [28, 4], [27.1, 0.3], [16.4, 4], [13.6, 0], [19, 5], [22.4, 3], [24.5, 3], [32.6, 3], [27.1, 4], [29.6, 6], [31.6, 8], [21.6, 5], [20.9, 4], [22.4, 0], [32.6, 10.3], [29.7, 20.8], [24.5, 0.8], [21.4, 0], [21.7, 6.9], [28.6, 7.7], [15.4, 0], [18.1, 0], [33.4, 0], [16.4, 0]]
        }],
          chart: {
          height: 350,
          type: 'scatter',
          zoom: {
            enabled: true,
            type: 'xy'
          }
        },
        xaxis: {
          tickAmount: 10,
          labels: {
            formatter: function(val) {
              return parseFloat(val).toFixed(1)
            }
          }
        },
        yaxis: {
          tickAmount: 7
        }
        };

        var chart = new ApexCharts(document.querySelector("#scatter"), options);
        chart.render();
        </script>


      <!--treemap-->

      <script> 
             var options = {
          series: [
          {
            data: [
              {
                x: 'Household 29',
                y: 35000
              },
              {
                x: 'Household 18',
                y: 32000
              },
              {
                x: 'Household 35',
                y: 29000
              },
              {
                x: 'Household 72',
                y: 28000
              },
              {
                x: 'Household 82',
                y: 26000
              },
              {
                x: 'Household 45',
                y: 24000
              },
              {
                x: 'Household 51',
                y: 23000
              },
              {
                x: 'Household 9',
                y: 21000
              },
              {
                x: 'Household 7',
                y: 20000
              },
              {
                x: 'Household 21',
                y: 18000
              },
              {
                x: 'Household 11',
                y: 17000
              },
              {
                x: 'Household 33',
                y: 15000
              },
              {
                x: 'Household 75',
                y: 12000
              }
            ]
          }
        ],
          legend: {
          show: false
        },
        chart: {
          height: 350,
          type: 'treemap'
        },
        
        title: {
          text: ''
          
          
        }
        
        };

        var chart = new ApexCharts(document.querySelector("#ggfgf"), options);
        chart.render();
        </script>



<script src="https://assets.startbootstrap.com/js/sb-customizer.js"></script>
</html>
