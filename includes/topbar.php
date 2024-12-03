


<style>

.jumbotron {
            background-image: url("assets/img/y-so-serious-white.png");
        }

</style>





<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white jumbotron" id="sidenavAccordion">
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.php">eGovern </a>
            <ul class="navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= $user['avatar'] ?>" /></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="<?= $user['avatar'] ?>" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?= Session::getSession('username') ?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="logout.php">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>