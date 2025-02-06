<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once 'Configuration.php';
include_once __DIR__ .'/../vendor/autoload.php';
include_once __DIR__ . '/../fpdf/fpdf.php';

spl_autoload_register(function ($class) {

    $file = __DIR__. '/../E/'. $class .'.php';
    $db = __DIR__. '/../db/'. $class .'.php';

    if(file_exists($file)){
        include_once $file;

    } 
    
     if (file_exists($db)){
            include_once $db;
        }
});

session_start();
Cookie::init();
$db = Database::getInstance();

$login = new Login();

if($login->isLoggedIn()){
    $user_obj = new User();
    $user = $user_obj->getUserDetails();
}

