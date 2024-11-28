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
        <title>Exploratory Data Visualization        : eGovern</title>
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
                        <div class="container-xl px-4 bg-gradient-primary-to-secondary">
                            <div class="page-header-content ">
                                <div class="row align-items-center  justify-content-between pt-3">
                                    <div class="col-auto mb-3 ">
                                        <h1 class="page-header-title text-light">
                                            <div class="page-header-icon text-light"><i data-feather="user"></i></div>
                                            Exploratory Data Visualization
                                            </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                    <div class="ratio ratio-16x9">
      <iframe src="https://egovern.streamlit.app?embed=true" frameborder="0" allowfullscreen></iframe>
    </div>

                    </div>

                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright © eGovern:2024</div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src="js/litepicker.js"></script>
    <script>
        $(document).ready(function(){
          

          $('.print').on('click', function(){

            let id = $(this).data('id');

            $.ajax({
                url: 'sendData',
                type: 'POST',
                data: {
                  action: 'fetchResidentByID',
                  id: id
                },
                success: function(data) {
                  var res = JSON.parse(data)

                  $("#resident_name").val(res.firstname + ' ' + res.middlename + ' ' + res.lastname + ' ' + res.qualifier)
              
                  const printModal = new bootstrap.Modal(document.getElementById('printModal'))
                  printModal.show();



                }
              })


          })


            $(".view").on('click', function(){


              let id = $(this).data('id')

              $.ajax({
                url: 'sendData',
                type: 'POST',
                data: {
                  action: 'fetchResidentByID',
                  id: id
                },
                success: function(data) {
                  var res = JSON.parse(data)

                  $("#view-resident-name").val(res.firstname + ' ' + res.middlename + ' ' + res.lastname + ' ' + res.qualifier)
                  $("#view-resident-birthdate").val(res.birthdate)
                  $("#view-resident-sex").val(res.sex)
                  $("#view-resident-birthplace").val(res.birthplace)
                  $("#view-resident-civil-status").val(res.civil_status)
                  $("#view-resident-citizenship").val(res.citizenship)
                  $("#view-resident-religion").val(res.religion)
                  $("#view-resident-education").val(res.highest_educational_attainment)
                  $("#view-resident-annual-income").val(res.annual_income)
                  $("#view-resident-occupation").val(res.occupation)
                  $("#view-resident-head-relationship").val(res.household_head_relationship)

                  const myModal = new bootstrap.Modal(document.getElementById('viewModal'))
                  myModal.show();
                }
              })
            })
        })

  function toggleFields() {
    const certType = document.getElementById('certification_type').value;

    document.getElementById('resident_name_div').style.display = certType ? 'block' : 'none';
    document.getElementById('requester_name_div').style.display = certType.includes('low_income_level') ? 'block' : 'none';
    document.getElementById('clearance_purpose_div').style.display = certType === 'barangay_clearance' ? 'block' : 'none';
    document.getElementById('community_tax_cert_div').style.display = certType === 'barangay_clearance' ? 'block' : 'none';
    document.getElementById('community_tax_date_div').style.display = certType === 'barangay_clearance' ? 'block' : 'none';
  }
</script>
       
</body>
</html>
