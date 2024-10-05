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
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title text-light">
                                    <div class="page-header-icon text-light"><i data-feather="user"></i></div>
                                    Manage Residents
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-fluid px-4">
                <div class="card">
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Resident Name</th>
                                <th>Sex</th>
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

                                    <td><?= $row['resident_id'] ?></td>
                                    <td><?= $row['firstname'] ?> <?= $row['middlename'] ?> <?= $row['lastname'] ?></td>
                                    <td><?= $row['sex'] ?></td>
                                    <td><?= $row['birthdate'] ?></td>
                                    <td>
                                        <div class="flex align-center text-center">
                                            <a class="btn btn-outline-primary btn-sm edit" href="#" data-id="<?= $row['resident_id'] ?>"><i data-feather="edit"></i></a>
                                            <a class="btn btn-outline-danger btn-sm delete" href="#" data-id="<?= $row['resident_id'] ?>"><i data-feather="trash-2"></i></a>
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
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section>
                    <div class="container">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                <div class="card h-100 ">
                                    <div class="card-body">
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h5 class="mb-2 text-danger">Resident Information</h5>
                                            </div>

                                          <form>

                                            <div class="col-md-8 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Resident's Name</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-name" id="edit-resident-name" >
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Birthdate</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-birthdate" id="edit-resident-birthdate" >
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Sex</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-sex" id="edit-resident-sex" >
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Birthplace</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-birthplace" id="edit-resident-birthplace" >
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-4 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Civil Status</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-civil-status" id="edit-resident-civil-status" >
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-4 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Citizenship</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-citizenship" id="edit-resident-citizenship" >
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-4 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Religion</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-religion" id="edit-resident-religion" >
                                                </div>
                                            </div>


                                            <div class="col-md-3 col-3 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Highest Educational Attainment</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-education" id="edit-resident-education" >
                                                </div>
                                            </div>



                                            <div class="col-md-3 col-4 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Annual Income</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-annual-income" id="edit-resident-annual-income" >
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-4 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Occupation</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-occupation" id="edit-resident-occupation" >
                                                </div>
                                            </div>


                                            <div class="col-md-3 col-4 mb-3">
                                                <div class="form-group">
                                                    <label class="label" for="view-child-name">Household Head Relationship</label>
                                                    <input type="text" class="form-control form-control-sm" name="edit-resident-head-relationship" id="edit-resident-head-relationship" >
                                                </div>
                                            </div>

                                           <div class="col-md-3 col-4 mb-3">
                                             <button type="submit" id="editResident" name="editResident" class="btn btn-primary">Edit Resident</button>
                                            </div>

                                          </form>





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


    $(".edit").on('click', function(){


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

          $("#edit-resident-name").val(res.firstname + ' ' + res.middlename + ' ' + res.lastname + ' ' + res.qualifier)
          $("#edit-resident-birthdate").val(res.birthdate)
          $("#edit-resident-sex").val(res.sex)
          $("#edit-resident-birthplace").val(res.birthplace)
          $("#edit-resident-civil-status").val(res.civil_status)
          $("#edit-resident-citizenship").val(res.citizenship)
          $("#edit-resident-religion").val(res.religion)
          $("#edit-resident-education").val(res.highest_educational_attainment)
          $("#edit-resident-annual-income").val(res.annual_income)
          $("#edit-resident-occupation").val(res.occupation)
          $("#edit-resident-head-relationship").val(res.household_head_relationship)


          const myModal = new bootstrap.Modal(document.getElementById('viewModal'))
          myModal.show();



        }
      })





    })


  })
</script>

</body>
</html>
