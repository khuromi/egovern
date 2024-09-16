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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"/>

    <style>
       body, html {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, #f5f7fa, #c3cfe2);
    font-family: 'Arial', sans-serif;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.login-wrapper {
    display: flex;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.login-left, .login-right {
    padding: 50px;
}

.login-left {
    width: 60%;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.login-left img {
    width: 150px;
    margin-bottom: 20px;
    align-self: center;
}

.login-right {
    width: 40%;
    background-color: #673ab7;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 40px 30px;
}

.login-right h2 {
    margin-bottom: 20px;
    font-size: 2rem;
}

.login-right p {
    font-size: 1.1rem;
    margin-bottom: 30px;
}

.login-right button {
    background-color: white;
    color: #673ab7;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

.form-group {
    width: 100%;
    margin-bottom: 20px;
}

.form-control {
    border-radius: 5px;
    padding: 10px;
}

.form-group label {
    font-weight: 500;
}

.btn-primary {
    background-color: #673ab7;
    border-color: #673ab7;
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
}

.custom-control-label {
    margin-left: 8px;
}

.custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #673ab7;
    border-color: #673ab7;
}

.forgot-link {
    margin-left: 10px;
}

.footer {
    text-align: center;
    padding: 10px 0;
    background-color: #f5f5f5;
    width: 100%;
    margin-top: 20px;
}

input#show-password {
    border: none;
    background: none;
    color: #673ab7;
    cursor: pointer;
}

    </style>
</head>
<body>

<div class="container">
    <div class="login-wrapper">
        <div class="login-left">
            <div class="brand">
                <img src="assets/images/logo/logo_salcedo-.png" alt="logo">
            </div>
            <h4 class="card-title"> <?= APP_NAME ?> </h4>
            <form method="POST" id="login_form">
                <input type="hidden" name="token" id="token" value="<?= htmlentities(CSRF::generate("login_form")) ?>">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" value="" autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password
                      
                    </label>
                    <input id="password" type="password" class="form-control" name="password" >
                </div>

                <div class="form-group">
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                        <label for="remember" class="custom-control-label">Remember Me</label>
                    </div>
                </div>

                <div class="form-group m-0">
                    <button type="submit" id="login_button" class="btn btn-primary btn-block">
                        Log in
                    </button>
                </div>
            </form>
        </div>
        <div class="login-right">
            <h2>Welcome!</h2>
            <p>Log in with your account to use all of the system features.</p>
            <button>About</button>
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


