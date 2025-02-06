<?php

use setasign\Fpdi\Fpdi;

require_once('vendor/autoload.php');
include 'config/init.php';

$pdf = new Fpdi();
$pdf->AddPage('L', 'A4');  
$pdf->setSourceFile("forms/form1.pdf");
$tplId = $pdf->importPage(1);

$size = $pdf->getTemplateSize($tplId);

$scale = min(297 / $size['height'], 210 / $size['width']); 




$pdf->useTemplate($tplId, 0, 0, 297, 210);  

$pdf->SetFont('Arial', '', 11);
$pdf->setXY(92.5, 65);
$pdf->SetFontSize('7');
$pdf->Write(0,  '(mm/dd/yyyy)' );

// Loop for placing text with incremented Y positions
$y_start = 70;  // Starting Y position
$spacing = 5;   // Y position increment for each loop

for ($i = 0; $i < 10; $i++) {
    $y_position = $y_start + ($i * $spacing);

    // Adjust X and Y positions for each value dynamically
    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(8, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Cunanan' . ($i+1)); // Example dynamic text

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(29, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Ellyza' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(53, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Vilog' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(72, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'II' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(85, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, '22' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(93, $y_position);
    $pdf->SetFontSize('7');
    $pdf->Write(0, '05/21/2002' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(109, $y_position);
    $pdf->SetFontSize('5');
    $pdf->Write(0, 'Salcedo, Ilocos Sur' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(128, $y_position);
    $pdf->SetFontSize('7');
    $pdf->Write(0, 'Salcedo, Ilocos Sur' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(154, $y_position);
    $pdf->SetFontSize('7');
    $pdf->Write(0, '0.00' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(174, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'M' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(181, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Single' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(200, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Filipino' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(216, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Catholic' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(238, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Catholic' . ($i+1));

    $pdf->SetFont('Arial', '', 11);
    $pdf->setXY(260, $y_position);
    $pdf->SetFontSize('8');
    $pdf->Write(0, 'Catholic' . ($i+1));
}


$pdf->Output();
