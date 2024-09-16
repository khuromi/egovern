<?php

include_once "config/init.php";

if (isset($_GET["ref"])) {
    Session::unsetSession("tfaChallenge");
    Session::unsetSession("uid");
}

if (isset($_GET["ref_"])) {
    Cookie::clear("remember_me");
    Cookie::clear("uid");
}

if ($login->isLoggedIn()) {
    header("Location: index.php");
    die();
}

if ($login->isTfaLoggedIn()) {
    header("Location: challenge.php");
}

if ($login->isRememberSet()) {
    $user = new User();
    $user_id = Cookie::get("uid");
    $uid = Others::decryptData($user_id, ENCRYPTION_KEY);
    $row = $user->getUserData($uid);

    if(empty($row)){
        Cookie::clear("remember_me");
        Cookie::clear("uid");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | <?= APP_NAME ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/my-login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!--    Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"/>


    
</head>





<body class="my-login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-md-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img src="assets/images/logo/logo_salcedo-.png" alt="logo">
                </div>
                <div class="card fat">
                    <div class="card-body">
                        <?php if (!$login->isRememberSet()): ?>
                        <h4 class="card-title"> <?= APP_NAME ?> </h4>
                        <?php else: ?>
                            <h4 class="card-title">Login as <?= htmlentities(
                                $row["username"]
                            ) ?></h4>
                        <?php endif; ?>
                        <form method="POST" id="login_form" >
                            <input type="hidden" name="token" id="token" value="<?= htmlentities(
                                CSRF::generate("login_form")
                            ) ?>">

                            <?php if (!$login->isRememberSet()): ?>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" value="" autofocus>
                            </div>
                            <?php else: ?>
                                <input id="username" type="hidden" class="form-control" name="username" value="<?= $row[
                                    "username"
                                ] ?>" autofocus>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="password">Password
                                    <a href="#" data-toggle="modal" data-target="#forgotPasswordModal" class="float-right">
                                        Forgot Password?
                                    </a>
                                </label>
                                <input id="password" type="password" class="form-control" name="password" data-eye>
                            </div>

                            <?php if (!$login->isRememberSet()): ?>
                            <div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>
                            <?php endif; ?>
                            <div class="form-group m-0">
                                <button type="submit" id="login_button" class="btn btn-primary btn-block">
                                     Log in
                                </button>
                            </div>
                            <div class="mt-4 text-center">
                            <?php if (!$login->isRememberSet()): ?>
                                <?php else: ?>
                                    Not your account? <a href="login.php?ref_">Log in</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="footer">
                    Copyright &copy; <?= date("Y") ?> &mdash; <?= APP_NAME ?>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- Forgot Password Modal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot my Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p class="mb-1">To continue, please enter your email for recovery.</p>
                        <div class="form-group">
                            <label for="forgotPasswordEmail">Email</label>
                            <input type="email" id="forgotPasswordEmail" class="form-control" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="forgotPasswordBtn" data-bs-dismiss="modal" class="btn btn-primary">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sha512.min.js"></script>
<script src="assets/js/login.js"></script>
</body>
</html>
