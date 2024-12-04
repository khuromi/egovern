<?php
use setasign\Fpdi\Fpdi;

// setup the autoload function
require_once('vendor/autoload.php');

// initiate FPDI
// Initialize the FPDI object
$pdf = new Fpdi();
$pdf->AddPage('P', 'A4');


$type = $_POST['certification_type'];

$resident_name = isset($_POST['resident_name']) ? $_POST['resident_name'] : null;
$requester_name = isset($_POST['requester_name']) ? $_POST['requester_name'] : null;
$clearance_purpose = isset($_POST['clearance_purpose']) ? $_POST['clearance_purpose'] : null;
$community_tax_cert_number = isset($_POST['community_tax_cert_number']) ? $_POST['community_tax_cert_number'] : null;
$community_tax_cert_date = isset($_POST['community_tax_cert_date']) ? $_POST['community_tax_cert_date'] : null;


switch ($type) {
    case 'barangay_clearance':

        $timestamp = strtotime(date('Y-m-d h:i:s'));


        $ctday = date('j', strtotime($community_tax_cert_date)); 
        $ctmonth = date('F', strtotime($community_tax_cert_date)); 
        $ctyear = date('Y', strtotime($community_tax_cert_date)); 


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
        $pdf->setSourceFile("forms/CLEARANCE 1.pdf");
        $tplId = $pdf->importPage(1);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplId);

        // Calculate scale factors to fit the imported page into A4
        $scale = min(210 / $size['width'], 297 / $size['height']);

        $pdf->useTemplate($tplId, 0, 0, $size['width'] * $scale, $size['height'] * $scale);


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(74, 89);
        $pdf->SetFontSize('11');
        $pdf->Write(0, $resident_name);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(85, 155);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $clearance_purpose);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(50, 163);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $community_tax_cert_number);
   
        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(100, 163);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $ctmonth);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(117, 163);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $ctday);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(135, 163);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $ctyear);



        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(93, 148);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $day . $suffix);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(118, 148);
        $pdf->SetFontSize('9');
        $pdf->Write(0,  $month );


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(150, 148);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $year);


        break;

    case 'indigency':

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
        $pdf->setSourceFile("forms/INDIGENCY1.pdf");
        $tplId = $pdf->importPage(1);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplId);

        // Calculate scale factors to fit the imported page into A4
        $scale = min(210 / $size['width'], 297 / $size['height']);

        $pdf->useTemplate($tplId, 0, 0, $size['width'] * $scale, $size['height'] * $scale);


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(90, 120);
        $pdf->SetFontSize('10');
        $pdf->Write(0, $resident_name);


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(115, 155);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $resident_name);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(78, 179);
        $pdf->SetFontSize('9');
        $pdf->Write(0, $day . $suffix);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(105, 179);
        $pdf->SetFontSize('9');
        $pdf->Write(0,  $month );


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(120, 179);
        $pdf->SetFontSize('9');
        $pdf->Write(0, ' ,' . $year);

        break;
    case 'low_income_level':

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
        $pdf->setSourceFile("forms/CERTIFICATION1.pdf");
        $tplId = $pdf->importPage(1);

        // Get the size of the imported page
        $size = $pdf->getTemplateSize($tplId);

        // Calculate scale factors to fit the imported page into A4
        $scale = min(210 / $size['width'], 297 / $size['height']);

        $pdf->useTemplate($tplId, 0, 0, $size['width'] * $scale, $size['height'] * $scale);


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(65, 99);
        $pdf->SetFontSize('14');
        $pdf->Write(0, $resident_name);


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(50, 130);
        $pdf->SetFontSize('14');
        $pdf->Write(0, $requester_name);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(51, 144);
        $pdf->SetFontSize('11');
        $pdf->Write(0, $day . $suffix);

        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(80, 144);
        $pdf->SetFontSize('11');
        $pdf->Write(0,  $month );


        $pdf->SetFont('Arial', '', 14);
        $pdf->setXY(106, 144);
        $pdf->SetFontSize('11');
        $pdf->Write(0, $year);


        break;
    default:
        # code...
        break;
}



$pdf->Output();            