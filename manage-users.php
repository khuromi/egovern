<?php
include_once 'config/init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}


$user_obj = new User();
$users = $user_obj->getAllUser();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Settings | E-Basura Monitoring System</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
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
                                        User Settings
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                            </div>
                            <table class="table table-striped" id="user_accounts_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr data-user-id="<?php echo $user['user_id']; ?>">
                                            <td><?php echo $user['user_id']; ?></td>
                                            <td><?php echo $user['username']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td>
                                            <div class="btn-group">
                                                    <button class="btn btn-datatable btn-icon btn-outline-primary me-2 edit-user-btn" data-user-id="<?php echo $user['user_id']; ?>"><i class="fa-solid fa-pencil"></i></button>
                                                    <button class="btn btn-datatable btn-icon btn-outline-danger delete-user-btn" data-user-id="<?php echo $user['user_id']; ?>"><i class="fa-regular fa-trash-can"></i></button>
                                                </div>   
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                  <!-- Add User Modal -->
                  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="addUserForm">
                                <div class="modal-body">
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username"  placeholder="Enter username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="user_role">User Role</label>
                                    <select id="user_role" name="user_role" class="form-control">
                                        <option selected disabled>Choose User Role</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Staff</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" placeholder="Enter password" name="confirm_password" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="register_button" name="register" class="btn btn-primary btn-block">Add User</button>
                                    </div>
                                </div>

                             
                               
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit User Modal -->
                <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editUserForm">
                                <div class="modal-body">
                                    <input type="hidden" id="editUserId" name="user_id">
                                    <div class="mb-3">
                                        <label for="editUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="editUsername" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="editEmail" name="email" required>
                                    </div>

                                    <div class="mb-3">
                                    <label for="user_role">User Role</label>
                                    <select id="edit_user_role" name="user_role" class="form-control">
                                        <option selected disabled>Choose User Role</option>
                                        <option value="1">Administrator</option>
                                        <option value="2">Staff</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="edit_password" placeholder="Enter password" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="edit_confirm_password" placeholder="Enter password" name="confirm_password" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="button" id="edit_button" name="register" class="btn btn-primary btn-block">Save changes</button>
                                    </div>
                                </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
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
                </footer>        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="js/litepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="assets/js/sha512.min.js"></script>
    <script src="assets/js/register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#user_accounts_table");
        var notyf = new Notyf({duration: 1000, position: {x: 'right', y: 'top',}});

        // Handle edit button click
        $(document).on('click', '.edit-user-btn', function () {
            const userId = $(this).data('user-id');

            $.ajax({
                type: 'POST',
                url: 'sendData',
                data: {
                    action: 'fetchUser',
                    user_id: userId
                },
                success: function(data){
                    var res = JSON.parse(data)

                    $("#editUserId").val(res.user_id)
                    $("#editUsername").val(res.username)
                    $("#editEmail").val(res.email)
                    $("#edit_user_role").val(res.user_role);


                }
            })


            $('#editUserModal').modal('show');
        });



        $('#edit_button').click(function(e) {
            e.preventDefault();

            // Get form values
            var userId = $('#editUserId').val();
            var username = $('#editUsername').val();
            var email = $('#editEmail').val();
            var role = $('#edit_user_role').val();
            var password = $('#edit_password').val();
            var confirm_password = $('#edit_confirm_password').val();

            if(username.trim() === "" && password.trim() === "" && email.trim() === "" && confirm_password.trim() === ""){
            notyf.error("All fields are required");
            return;
        }

        if (username.trim() === ""){
            notyf.error("Username is required");
            return;
        }

        if (email.trim() === ""){
            notyf.error("Email is required");
            return;
        }

        if (!validateEmail(email)){
            notyf.error("Email is not valid");
            return;
        }

        if(password.trim() === ""){
            notyf.error("Password is required");
            return;
        }

        if(confirm_password.trim() === ""){
            notyf.error("Confirm Password is required");
            return;
        }

        if(password.trim() !== confirm_password.trim()){
            notyf.error("Password does not match");
            return;
        }

            password = CryptoJS.SHA512(password).toString();

            // Ajax request to update user
            $.ajax({
                type: 'POST',
                url: 'sendData',
                data: {
                    action: 'editUser',
                    user_id: userId,
                    username: username,
                    email: email,
                    role: role,
                    password: password
                },
                success: function(response) {
                    // Handle success response with SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'User updated successfully.',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        location.reload(); // Reload the page after successful update
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response with SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error updating user: ' + error
                    });
                }
            });
        });

        // Handle delete button click with SweetAlert
        $(document).on('click', '.delete-user-btn', function () {
            const userId = $(this).data('user-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'sendData', // Handle the user deletion in your server-side script
                        method: 'POST',
                        data: { user_id: userId, action: 'deleteUser' },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the user.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>