<?php

use setasign\Fpdi\Fpdi;

require_once('vendor/autoload.php');
include 'config/init.php';

$query = "SELECT resident_id, lastname, firstname, middlename, qualifier, gender, address, birthdate, civil_status, occupation, employment_status, sector_code FROM residents WHERE 1=1";
$filterDescription = '';

if (!empty($_POST['sector'])) {
    $sector = $_POST['sector'];
    $query .= " AND sector_code = :sector";
    $filterDescription .= "Sector: $sector ";
}

if (!empty($_POST['employment_status'])) {
    $employment_status = $_POST['employment_status'];
    $query .= " AND employment_status = :employment_status";
    $filterDescription .= "Employment Status: $employment_status ";
}

if (!empty($_POST['age'])) {
    $age = $_POST['age'];
    if ($age == 'senior') {
        $query .= " AND TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) >= 60";
        $filterDescription .= "Age Group: Senior (60+) ";
    }
}

$stmt = $db->prepare($query);

if (!empty($sector)) {
    $stmt->bindParam(':sector', $sector, PDO::PARAM_STR);
}

if (!empty($employment_status)) {
    $stmt->bindParam(':employment_status', $employment_status, PDO::PARAM_STR);
}

$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDI();
$pdf->AddPage('L', 'A4');

$logo = 'lgu.jpg';
$pdf->Image($logo, 50, 8, 28);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 15, 'Republic of the Philippines', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(0, 15, 'Municipality of Salcedo', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 18);
$pdf->Ln(5);
$pdf->Cell(0, 15, 'Resident Information Report', 0, 0, 'C');

if (!empty($filterDescription)) {
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, "$filterDescription", 0, 1, 'C');
}

$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 10);

$headers = [
    'ID', 'Full Name', 'gender', 'Address', 'Birthdate', 
    'Civil Status', 'Occupation', 'Employment Status', 'Sector Code'
];

$widths = [10, 55, 13, 50, 20, 22, 50, 35, 25];

foreach ($headers as $i => $header) {
    $pdf->Cell($widths[$i], 10, $header, 1);
}
$pdf->Ln();

$pdf->SetFont('Arial', '', 9);

foreach ($rows as $row) {
    $fullName = trim($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['qualifier']);
    $data = [
        $row['resident_id'],
        $fullName,
        $row['gender'],
        $row['address'],
        $row['birthdate'],
        $row['civil_status'],
        $row['occupation'],
        $row['employment_status'],
        $row['sector_code']
    ];
    
    foreach ($data as $i => $cell) {
        $pdf->Cell($widths[$i], 10, $cell, 1);
    }
    $pdf->Ln();
}

$pdf->Output();
