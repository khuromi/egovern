<?php
include_once 'config/init.php';

if (!$login->isLoggedIn()) {
    header("Location: login.php");
    die();
}

$db = Database::getInstance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $resident_id = $_POST['resident_name'];
    $document_type = $_POST['certification_type'];
    $requester = isset($_POST['requester_name']) ? $_POST['requester_name'] : null;
    $clearance_purpose = isset($_POST['clearance_purpose']) ? $_POST['clearance_purpose'] : null;
    $community_tax_cert_number = isset($_POST['community_tax_cert_number']) ? $_POST['community_tax_cert_number'] : null;
    $community_tax_cert_date = !empty($_POST['community_tax_cert_date']) ? $_POST['community_tax_cert_date'] : null;

    $date_requested = date('Y-m-d H:i:s');
  

    try {

    $query = "INSERT INTO document_requests 
                    (resident_id, document_type, requester, clearance_purpose, community_tax_cert_number, community_tax_cert_date, date_requested) 
                  VALUES 
                    (:resident_id, :document_type, :requester, :clearance_purpose, :community_tax_cert_number, :community_tax_cert_date, :date_requested)";

        $stmt = $db->prepare($query);

        $stmt->bindParam(':resident_id', $resident_id);
        $stmt->bindParam(':document_type', $document_type);
        $stmt->bindParam(':requester', $requester);
        $stmt->bindParam(':clearance_purpose', $clearance_purpose);
        $stmt->bindParam(':community_tax_cert_number', $community_tax_cert_number);
        $stmt->bindParam(':community_tax_cert_date', $community_tax_cert_date);
        $stmt->bindParam(':date_requested', $date_requested);

        // Execute the statement
        $stmt->execute();

        echo "Record successfully inserted!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
        <title>Dashboard - eGovern: EXPLORATORY DATA VISUALIZATION FOR ADVANCING COMMUNITY GOVERNANCE IN BARANGAY CULIONG, SALCEDO,</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                    <div class="page-header-icon"><i class="fa-light fa-monitor-waveform"></i></div>
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
                                                <td><?= htmlspecialchars($request['date_requested']) ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        <button class="btn btn-success btn-sm"><i class="fa fa-print"></i></button>
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

      
    </body>
</html>
