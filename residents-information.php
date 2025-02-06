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
    <title>Residents Info: eGovern</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous">
    </script>
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
                                        Resident Information
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">Active Residents</div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Gender</th>
                                        <th>Birth Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $resident = new Resident();
                                        $data = $resident->fetchResidents();

                                        foreach ($data as $row):

                                        ?>
                                    <tr>

                                        <td><?= $row['Resident_ID'] ?></td>
                                        <td><?= $row['Firstname'] ?> <?= $row['Middlename'] ?> <?= $row['Lastname'] ?>
                                        </td>
                                        <td><?= $row['Gender'] ?></td>
                                        <td><?= $row['Birthdate'] ?></td>
                                        <td>
                                            <div class="flex align-center text-center">
                                                <a class="btn btn-outline-success btn-sm view" href="#"
                                                    data-id="<?= $row['Resident_ID'] ?>"><i data-feather="eye"></i></a>
                                                <a class="btn btn-outline-success btn-sm print" href="#"
                                                    data-id="<?= $row['Resident_ID'] ?>"><i
                                                        data-feather="printer"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php

                                        endforeach;

                                        ?>


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">Deactivated Residents</div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Deactivation Reason</th>
                                        <th>Date Deactivated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $resident = new Resident();
                                    $data = $resident->fetchDeactivatedResidents();

                                    foreach ($data as $row):

                                    ?>
                                    <tr>

                                        <td><?= $row['Resident_ID'] ?></td>
                                        <td><?= $row['Firstname'] ?> <?= $row['Middlename'] ?> <?= $row['Lastname'] ?>
                                        </td>
                                        <td><?= $row['deactivation_reason'] ?></td>
                                        <td><?= $row['deactivation_date'] ?></td>
                                        <td>
                                            <div class="flex align-center text-center">
                                                <a class="btn btn-outline-success btn-sm view" href="#"
                                                    data-id="<?= $row['Resident_ID'] ?>"><i data-feather="eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php

endforeach;

?>


                                </tbody>
                            </table>
                        </div>
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




    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">View Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section>
                        <div class="container">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row gutters">

                                                <div class="col-md-8 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Resident's
                                                            Name</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-name" id="view-resident-name" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Birthdate</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-birthdate" id="view-resident-birthdate"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Gender</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-sex" id="view-resident-sex" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Birthplace</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-birthplace"
                                                            id="view-resident-birthplace" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Civil Status</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-civil-status"
                                                            id="view-resident-civil-status" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Citizenship</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-citizenship"
                                                            id="view-resident-citizenship" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Religion</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-religion" id="view-resident-religion"
                                                            readonly>
                                                    </div>
                                                </div>


                                                <div class="col-md-3 col-3 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Highest Educational
                                                            Attainment</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-education" id="view-resident-education"
                                                            readonly>
                                                    </div>
                                                </div>



                                                <div class="col-md-3 col-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Estimated Monthly
                                                            Income</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-annual-income"
                                                            id="view-resident-annual-income" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Occupation</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-occupation"
                                                            id="view-resident-occupation" readonly>
                                                    </div>
                                                </div>


                                                <div class="col-md-3 col-4 mb-3">
                                                    <div class="form-group">
                                                        <label class="label" for="view-child-name">Household Head
                                                            Relationship</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="view-resident-head-relationship"
                                                            id="view-resident-head-relationship" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Print</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="print.php">
                        <div class="mb-3">
                            <select class="form-control" name="certification_type" id="certification_type"
                                onchange="toggleFields()">
                                <option disabled selected>Select</option>
                                <option value="barangay_clearance">Barangay Clearance</option>
                                <option value="indigency">Certificate of Indigency</option>
                                <option value="low_income_level">Certificate of Indigency (Low Level Income)</option>
                            </select>
                        </div>

                        <div class="mb-3" id="resident_name_div" style="display:none;">
                            <label>Resident Name</label>
                            <input type="text" name="resident_name" id="resident_name" class="form-control" />
                        </div>

                        <div class="mb-3" id="requester_name_div" style="display:none;">
                            <label>Who is requesting the certification?</label>
                            <input type="text" name="requester_name" id="requester_name" class="form-control" />
                        </div>

                        <div class="mb-3" id="clearance_purpose_div" style="display:none;">
                            <label>What is the purpose of the clearance?</label>
                            <input type="text" name="clearance_purpose" id="clearance_purpose" class="form-control" />
                        </div>

                        <div class="mb-3" id="community_tax_cert_div" style="display:none;">
                            <label>Community Tax Certificate Number</label>
                            <input type="text" name="community_tax_cert_number" id="community_tax_cert_number"
                                class="form-control" />
                        </div>

                        <div class="mb-3" id="community_tax_date_div" style="display:none;">
                            <label>When was the Community Tax Certificate Number issued?</label>
                            <input type="date" name="community_tax_cert_date" id="community_tax_cert_date"
                                class="form-control" />
                        </div>

                        <div class="mb-3 d-flex float-end">
                            <button type="submit" class="btn btn-outline-success" name="print">Print</button>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="js/litepicker.js"></script>
    <script>
    $(document).ready(function() {


        $('.print').on('click', function() {

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

                    $("#resident_name").val(res.Firstname + ' ' + res.Middlename + ' ' + res
                        .Lastname + ' ' + res.Qualifier)

                    const printModal = new bootstrap.Modal(document.getElementById(
                        'printModal'))
                    printModal.show();



                }
            })


        })


        $(".view").on('click', function() {


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

                    $("#view-resident-name").val(res.Firstname + ' ' + res.Middlename +
                        ' ' + res.Lastname + ' ' + res.Qualifier)
                    $("#view-resident-birthdate").val(res.Birthdate)
                    $("#view-resident-sex").val(res.Gender)
                    $("#view-resident-birthplace").val(res.Birthplace)
                    $("#view-resident-civil-status").val(res.Civil_Status)
                    $("#view-resident-citizenship").val(res.Citizenship)
                    $("#view-resident-religion").val(res.Religion)
                    $("#view-resident-education").val(res.Educational_Attainment)
                    $("#view-resident-annual-income").val(res.Avg_Monthly_Income)
                    $("#view-resident-occupation").val(res.Occupation)
                    $("#view-resident-head-relationship").val(res.Relation_To_Head)

                    const myModal = new bootstrap.Modal(document.getElementById(
                        'viewModal'))
                    myModal.show();
                }
            })
        })
    })

    function toggleFields() {
        const certType = document.getElementById('certification_type').value;

        document.getElementById('resident_name_div').style.display = certType ? 'block' : 'none';
        document.getElementById('requester_name_div').style.display = certType.includes('low_income_level') ? 'block' :
            'none';
        document.getElementById('clearance_purpose_div').style.display = certType === 'barangay_clearance' ? 'block' :
            'none';
        document.getElementById('community_tax_cert_div').style.display = certType === 'barangay_clearance' ? 'block' :
            'none';
        document.getElementById('community_tax_date_div').style.display = certType === 'barangay_clearance' ? 'block' :
            'none';
    }
    </script>

</body>

</html>