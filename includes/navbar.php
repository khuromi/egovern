<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
            </a>
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Home</div>
            <!-- Sidenav Accordion (Dashboard)-->
            <a class="nav-link" href="index.php">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>

            <?php
                if($user_obj->adminAccessOnly()):
            ?>
            
<!-- 
            <a class="nav-link" href="streamlit-visualization.php">
                <div class="nav-link-icon"><i data-feather="bar-chart-2"></i></div>
                Exploratory Data Visualization
                </a> -->

            <a class="nav-link" href="residents-information.php">
                <div class="nav-link-icon"><i data-feather="users"></i></div>
                Residents Information
            </a>
            
            <a class="nav-link" href="manage-residents.php">
                <div class="nav-link-icon"><i data-feather="users"></i></div>
                Manage Residents Information
            </a>
            
            <a class="nav-link" href="reports.php">
                <div class="nav-link-icon"><i data-feather="book"></i></div>
                Reports
            </a>

            <a class="nav-link" href="requested-documents.php">
                <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                Requested Documents
            </a>

        
            <?php else: ?>

                <a class="nav-link" href="request-document.php">
                <div class="nav-link-icon"><i data-feather="file"></i></div>
                Request Document
            </a>
          

            <?php endif; ?>




    
            <!-- Sidenav Heading (Addons)-->
            <div class="sidenav-menu-heading">System</div>
            <!-- Sidenav Link (Charts)-->

            <a class="nav-link" href="account-settings.php">
                <div class="nav-link-icon"><i data-feather="user"></i></div>
                Account Settings
            </a>

            <?php
                if($user_obj->adminAccessOnly()):
            ?>

            <a class="nav-link" href="manage-users.php">
                <div class="nav-link-icon"><i class="fa fa-user-cog"></i></div>
                Manage Users
            </a>

            <?php endif; ?>

          
          
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">
                    <?= Session::getSession('username') ?>                </div>
            </div>
        </div>

</nav>