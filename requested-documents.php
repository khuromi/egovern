<?php
include_once 'config/init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}

$db = Database::getInstance();

$rd = new RequestDocument();
$document_requests = $rd->fetchRequests();


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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
                <div class="container-fluid px-4 bg-gradient-primary-to-secondary">
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title text-light">
                                    
                                    <div class=" page-header-icon text-light"><i data-feather="book-open"></i></div>
                                        Requested Documents
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-striped" id="user_accounts_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Document</th>
                                        <th>Status</th>
                                        <th>Date Requested</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($document_requests)): ?>
                                        <?php foreach ($document_requests as $request): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($request['id']) ?></td>
                                                <td><?= htmlspecialchars($request['resident_name']) ?></td>
                                                <td><?= htmlspecialchars($request['document_name']) ?></td>
                                                <td>
                                                    <?php 
                                                        $status = htmlspecialchars($request['status']); 
                                                        $badgeClass = '';

                                                        // Determine the Bootstrap badge class based on status
                                                        switch ($status) {
                                                            case 'pending':
                                                                $badgeClass = 'text-bg-warning';
                                                                break;
                                                            case 'rejected':
                                                                $badgeClass = 'text-bg-danger';
                                                                break;
                                                            case 'accepted':
                                                                $badgeClass = 'text-bg-success';
                                                                break;
                                                            default:
                                                                $badgeClass = 'text-bg-secondary'; // Default badge if status is unknown
                                                                break;
                                                        }
                                                    ?>
                                                    <span class="badge <?= $badgeClass; ?>"><?= ucfirst($status); ?></span>
                                                </td>
                                                <td><?= htmlspecialchars($request['date_requested']) ?></td>
                                                <td>
                                                <td>
                                                <div class="btn-group btn-sm">
    <!-- Delete Button with Trash Icon -->
    <button class="btn btn-danger btn-sm delete-request" data-id="<?= htmlspecialchars($request['id']) ?>"><i class="fa fa-trash"></i></button>

    <?php if ($request['status'] === 'pending'): ?>
        <!-- Show Accept and Reject Buttons if Status is Pending -->
        <button data-id="<?= htmlspecialchars($request['id']) ?>" class="btn btn-outline-success btn-sm accept">
            <i class="fas fa-square-check"></i> Accept
        </button>
        
        <button data-id="<?= htmlspecialchars($request['id']) ?>" class="btn btn-outline-warning btn-sm reject">
            <i class="fas fa-square-xmark"></i> Reject
        </button>
    <?php elseif ($request['status'] === 'accepted' && $request['active'] === 1): ?>

        <!-- Show Print Button if Status is Accepted -->
        <button data-id="<?= htmlspecialchars($request['id']) ?>" 
                class="btn btn-outline-success btn-sm" 
                onclick="window.open('request_print.php?id=<?= htmlspecialchars($request['id']) ?>', '_blank')">
            <i class="fas fa-print"></i>
        </button>
    <?php endif; ?>
</div>

                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No requests found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>

                            </table>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
                 $(document).on('click', '.delete-request', function () {
            let id = $(this).data("id"); 

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "sendData", 
                        data: {
                            action: 'deleteRequest',
                            id: id
                        },
                        success: function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your request has been deleted.',
                                'success'
                            );

                            setTimeout(function(){
                                location.reload()
                            }, 2000)
                          
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting the request.',
                                'error'
                            );
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled',
                        'Your request is safe!',
                        'info'
                    );
                }
            });
        });

            document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.accept, .reject').forEach(button => {
        button.addEventListener('click', function () {
            const requestId = this.getAttribute('data-id');
            const action = this.classList.contains('accept') ? 'accept' : 'reject';

            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: requestId,
                    status: action
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Request ${action}ed successfully!`);
                    location.reload();
                } else {
                    alert('Failed to update the status.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

        </script>
    </body>
</html>
