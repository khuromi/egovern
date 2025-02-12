<?php
header('Content-Type: application/json');
include_once 'config/init.php';
$residents = new Resident();
echo $residents->jsonResidents();