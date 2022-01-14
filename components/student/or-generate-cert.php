<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

error_reporting (E_ALL ^ E_NOTICE);
session_start();
include '../../connect.php';

$userid = $_SESSION['userid'];
$firstname = $_SESSION['fname'];
$lastname = $_SESSION['lname'];

if(isset($_POST["registration_id"])){
$registration_id = $_POST['registration_id'];

$query = "SELECT tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year, tbl_orientation_registration.student_number 
		FROM tbl_orientation_registration
			JOIN tbl_orientation ON tbl_orientation.orientation_id = tbl_orientation_registration.orientation_id
				JOIN tbl_acad_term ON tbl_acad_term.term_id = tbl_orientation.term_id
		WHERE tbl_orientation_registration.registration_id = '$registration_id' ";
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)){		
	$term_name = $row["term_name"];
	$term_from_year = $row["term_from_year"];
	$term_to_year = $row["term_to_year"];
	
	$termdesc = $term_name." AY ".$term_from_year." - ".$term_to_year;
	$studnum = $row["student_number"];
}

// Include the main TCPDF library (search for installation path).
require_once('../../lib/tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'../../img/logo-pdf.jpg';
		
								//left, top, width
        $this->Image($image_file, 40, 9, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('Times', '', 20);
		
        // Title
       // $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$html = <<<EOD
			<p style="line-height:120%;">
			Lyceum of the Philippines University – Cavite Campus <br>
			Center for Career Services and Industry Relations <br>
			<span style=" letter-spacing: 10px;"><b>INTERNSHIP ORIENTATION</b></span><br>
			<b>Certificate of Attendance</b>
			</p>
EOD;

		// Print text using writeHTMLCell()
								//top
		$this->writeHTMLCell(0, 0, 30, 10, $html, 0, 1, 0, true, 'C', true);

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CCSIR');
$pdf->SetTitle('Orientation Certificate');
$pdf->SetSubject('Orientation Certificate');
$pdf->SetKeywords('Orientation, Certificate, PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 16);

// add a page
$pdf->AddPage('L');

// Set some content to print
$html = <<<EOD
<p style="line-height:300%;  text-indent: 50px;">This certifies that <u><b> $firstname $lastname </b></u> attended the Internship Orientation conducted by the Center for Career Services & Industry Relations in preparation for Internship Program for <u><b> $termdesc. </b></u> </p>
EOD;

$html_1 = <<<EOD

<p style="text-indent:750px; line-height:10%;" ><b>sgd.</b></p>
<p style="text-indent:700px; line-height:10%; " >Lizandro O. Ferrer </p>
<p style="text-indent:730px; line-height:10%;" >Director </p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', 60, $html, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 120, $html_1, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('CertificateOrientation_'.$studnum.'.pdf', 'I');

}
//============================================================+
// END OF FILE
//============================================================+