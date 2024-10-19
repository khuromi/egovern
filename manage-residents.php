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
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addResidentModal">Add New Resident</button>


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
                                        <td><?= $row['firstname'] ?> <?= $row['middlename'] ?> <?= $row['lastname'] ?>
                                        </td>
                                        <td><?= $row['sex'] ?></td>
                                        <td><?= $row['birthdate'] ?></td>
                                        <td>
                                            <div class="flex align-center text-center">
                                                <a class="btn btn-outline-primary btn-sm edit" href="#"
                                                    data-id="<?= $row['resident_id'] ?>"><i data-feather="edit"></i></a>
                                                <a class="btn btn-outline-danger btn-sm delete" href="#"
                                                    data-id="<?= $row['resident_id'] ?>"><i
                                                        data-feather="trash-2"></i></a>
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
                                            <form>
                                                <input type="hidden" name="edit-resident-id" id="edit-resident-id">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="label" for="edit-resident-firstname">Resident's First Name</label>
                                                        <input type="text" class="form-control" name="edit-resident-firstname" id="edit-resident-firstname">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label" for="edit-resident-lastname">Resident's Last Name</label>
                                                        <input type="text" class="form-control" name="edit-resident-lastname" id="edit-resident-lastname">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label" for="edit-resident-middlename">Resident's Middle Name</label>
                                                        <input type="text" class="form-control" name="edit-resident-middlename" id="edit-resident-middlename">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label" for="edit-resident-qualifier">Resident's Qualifier</label>
                                                        <input type="text" class="form-control" name="edit-resident-qualifier" id="edit-resident-qualifier">
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-birthdate">Birthdate</label>
                                                            <input type="date" class="form-control" name="edit-resident-birthdate" id="edit-resident-birthdate">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-birthplace">Birthplace</label>
                                                            <input type="text" class="form-control" name="edit-resident-birthplace" id="edit-resident-birthplace">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="label" for="edit-resident-sex">Sex</label>
                                                        <input type="text" class="form-control" name="edit-resident-sex" id="edit-resident-sex">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-civil-status">Civil Status</label>
                                                            <input type="text" class="form-control" name="edit-resident-civil-status" id="edit-resident-civil-status">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-ethnicity">Ethnicity</label>
                                                            <input type="text" class="form-control" name="edit-resident-ethnicity" id="edit-resident-ethnicity">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-education">Highest Educational Attainment</label>
                                                            <input type="text" class="form-control" name="edit-resident-education" id="edit-resident-education">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-mother-name">Mother's Maiden Name</label>
                                                            <input type="text" class="form-control" name="edit-resident-mother-name" id="edit-resident-mother-name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-father-name">Father's Name</label>
                                                            <input type="text" class="form-control" name="edit-resident-father-name" id="edit-resident-father-name">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-employment-status">Employment Status</label>
                                                            <input type="text" class="form-control" name="edit-resident-employment-status" id="edit-resident-employment-status">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-occupation">Occupation</label>
                                                            <input type="text" class="form-control" name="edit-resident-occupation" id="edit-resident-occupation">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="label" for="edit-resident-monthly-income">Monthly Income</label>
                                                            <input type="text" class="form-control" name="edit-resident-monthly-income" id="edit-resident-monthly-income">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                    <label for="edit-resident-head-relationship">Head Relationship</label>
                                                    <input type="text" class="form-control" id="edit-resident-head-relationship" name="edit-resident-head-relationship">

                                                    </div>
                                                </div>


                                                <div class="col-md-3  mt-2">
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="js/litepicker.js"></script>
    <script>
   $(document).ready(function() {
    
    $("#editResident").on('click', function(e) {
        e.preventDefault();
        
        let resident_id = $("#edit-resident-id").val();
        let firstname = $("#edit-resident-firstname").val();
        let lastname = $("#edit-resident-lastname").val();
        let middlename = $("#edit-resident-middlename").val();
        let qualifier = $("#edit-resident-qualifier").val();
        let birthdate = $("#edit-resident-birthdate").val();
        let sex = $("#edit-resident-sex").val();
        let birthplace = $("#edit-resident-birthplace").val();
        let civil_status = $("#edit-resident-civil-status").val();
        let ethnicity = $("#edit-resident-ethnicity").val();
        let citizenship = $("#edit-resident-citizenship").val();
        let education = $("#edit-resident-education").val();
        let monthly_income = $("#edit-resident-monthly-income").val();
        let occupation = $("#edit-resident-occupation").val();
        let employment_status = $("#edit-resident-employment-status").val();
        let head_relationship = $("#edit-resident-head-relationship").val();
        let mother_name = $("#edit-resident-mother-name").val();
        let father_name = $("#edit-resident-father-name").val();

        $.ajax({
            url: 'sendData',
            type: 'POST',
            data: {
                action: 'editResident',
                resident_id: resident_id,
                firstname: firstname,
                lastname: lastname,
                middlename: middlename,
                qualifier: qualifier,
                birthdate: birthdate,
                sex: sex,
                birthplace: birthplace,
                civil_status: civil_status,
                ethnicity: ethnicity,
                citizenship: citizenship,
                education: education,
                monthly_income: monthly_income,
                occupation: occupation,
                employment_status: employment_status,
                head_relationship: head_relationship,
                mother_name: mother_name,
                father_name: father_name
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Resident information updated successfully!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    setTimeout(function() {
                        location.reload(); 
                    }, 500); 
                });

            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error updating the resident information. Please try again.',
                    showConfirmButton: true
                });
            }
        });
    });


    $(".edit").on('click', function() {
        let id = $(this).data('id'); 

        $.ajax({
            url: 'sendData',
            type: 'POST',
            data: {
                action: 'fetchResidentByID',
                id: id
            },
            success: function(data) {
                var res = JSON.parse(data); 

                $("#edit-resident-id").val(res.resident_id);
                $("#edit-resident-firstname").val(res.firstname);
                $("#edit-resident-lastname").val(res.lastname);
                $("#edit-resident-middlename").val(res.middlename);
                $("#edit-resident-qualifier").val(res.qualifier);
                $("#edit-resident-birthdate").val(res.birthdate);
                $("#edit-resident-sex").val(res.sex);
                $("#edit-resident-birthplace").val(res.birthplace);
                $("#edit-resident-civil-status").val(res.civil_status);
                $("#edit-resident-ethnicity").val(res.ethnicity);
                $("#edit-resident-citizenship").val(res.citizenship);
                $("#edit-resident-education").val(res.educational_attainment);
                $("#edit-resident-monthly-income").val(res.avg_monthly_income);
                $("#edit-resident-occupation").val(res.occupation);
                $("#edit-resident-employment-status").val(res.employment_status);
                $("#edit-resident-head-relationship").val(res.household_head_relationship);
                $("#edit-resident-mother-name").val(res.mothers_maiden_name);
                $("#edit-resident-father-name").val(res.fathers_name);

                // Show the modal for editing
                const myModal = new bootstrap.Modal(document.getElementById('viewModal'));
                myModal.show();
            },
            error: function(xhr, status, error) {
                console.error("Error fetching resident:", error);
                alert("Error fetching resident information. Please try again.");
            }
        });
    });
});

    </script>


</body>

</html>