<?php
use setasign\Fpdi\Fpdi;

// setup the autoload function
require_once('vendor/autoload.php');

// initiate FPDI
// Initialize the FPDI object
$pdf = new Fpdi();
$pdf->AddPage('P', 'A4');

// Set the source file and import the page
$pdf->setSourceFile("certificates/CERTIFICATION.pdf");
$tplId = $pdf->importPage(1);

// Get the size of the imported page
$size = $pdf->getTemplateSize($tplId);

// Calculate scale factors to fit the imported page into A4
$scale = min(210 / $size['width'], 297 / $size['height']);

// Use the template, scaled to fit A4
$pdf->useTemplate($tplId, 0, 0, $size['width'] * $scale, $size['height'] * $scale);



$pdf->SetFont('Arial', '', 14);
$pdf->setXY(70, 99);
$pdf->SetFontSize('11');
$pdf->Write(0, 'Mark Ghenly Murao');


$pdf->SetFont('Arial', '', 14);
$pdf->setXY(110, 128);
$pdf->SetFontSize('11');
$pdf->Write(0, 'request here');

$pdf->SetFont('Arial', '', 14);
$pdf->setXY(75, 144);
$pdf->SetFontSize('11');
$pdf->Write(0, 'September');


$pdf->SetFont('Arial', '', 14);
$pdf->setXY(50, 144);
$pdf->SetFontSize('11');
$pdf->Write(0, '26th');

$pdf->Output();            