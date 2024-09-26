<?php
use setasign\Fpdi\Fpdi;

// setup the autoload function
require_once('vendor/autoload.php');

// initiate FPDI
// Initialize the FPDI object
$pdf = new Fpdi();
$pdf->AddPage('P', 'A4');



$type = "certification_low_income_level";
// $type = $_POST['type'];

switch ($type) {
    case 'barangay_clearance':
        break;
    case 'indigency':
        break;
    case 'certification_low_income_level':

    $timestamp = strtotime(date('Y-m-d h:i:s'));

    // Get the day, month, and year
    $day = date('j', $timestamp); 
    $month = date('F', $timestamp); 
    $year = date('Y', $timestamp); 

    // Determine the ordinal suffix for the day
    if ($day % 10 == 1 && $day != 11) {
        $suffix = 'st';
    } elseif ($day % 10 == 2 && $day != 12) {
        $suffix = 'nd';
    } elseif ($day % 10 == 3 && $day != 13) {
        $suffix = 'rd';
    } else {
        $suffix = 'th';
    }




        // Set the source file and import the page
        $pdf->setSourceFile("forms/CERTIFICATION.pdf");
        $tplId = $pdf->importPage(1);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplId);

        // Calculate scale factors to fit the imported page into A4
        $scale = min(210 / $size['width'], 297 / $size['height']);

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
        $pdf->setXY(50, 144);
        $pdf->SetFontSize('11');
        $pdf->Write(0, $day . $suffix);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(75, 144);
        $pdf->SetFontSize('11');
        $pdf->Write(0,  $month );


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(98, 144);
        $pdf->SetFontSize('11');
        $pdf->Write(0, $year);


        break;
    default:
        # code...
        break;
}



$pdf->Output();            