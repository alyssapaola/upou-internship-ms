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


function fetch_data()  { 
	$output = '';  
	
	include '../../connect.php';
	include 'app-success-view-sql.php';

    return $output;  
}

function fetch_data_cr()  { 
	$output_cr = '';  
	
	include '../../connect.php';
	include 'app-success-view-sql.php';

    return $output_cr;  
}    

function fetch_data_user()  { 
	$output_user = '';  
	
	include '../../connect.php';
	include 'app-success-view-sql.php';

    return $output_user;  
}  

if(isset($_POST["application_id"])){

// Include the main TCPDF library (search for installation path).
require_once('../../lib/tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $this->SetFont('Times', '', 11);
	
	$html = <<<EOD
			T-CSI-02C 
EOD;
		$html1 = <<<EOD
			LPU Center for Career Services and Industry Relations 
EOD;

		// Print text using writeHTMLCell()
								//top
		$this->writeHTMLCell(0, 0, 30, 10, $html, 0, 1, 0, true, 'L', true);
		$this->writeHTMLCell(0, 0, 30, 10, $html1, 0, 1, 0, true, 'R', true);
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
$pdf->SetTitle('Internship Application');
$pdf->SetSubject('Internship Application');
$pdf->SetKeywords('Internship, Application, PDF');

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
$pdf->SetFont('times', '', 11);

// add a page
$pdf->AddPage('P');

// Set some content to print
$title = '<h2 align="center">Internship Application </h2>';
	 
$data_sql = fetch_data();  
$data_sql_cr = fetch_data_cr();  
$data_sql_user = fetch_data_user();  

$statement = <<<EOD
<p align="justify">By affixing my signature on this form, I hereby acknowledge and certify that I have carefully read and understood the terms and conditions of the Data Privacy Policy of the Lyceum of the Philippines University (LPU). By providing personal information to LPU, I am confirming that the data is true and correct. I understand that LPU reserves the right to revise any decision made on the basis of the information I provided should the information be found to be untrue or incorrect. I likewise agree that any issue that may arise in connection with processing of my personal information will be settled amicably with LPU before resorting to appropriate arbitration or court proceedings within the Philippine jurisdiction. Finally, I am providing my voluntary consent and authorization to LPU and its duly authorized representatives to lawfully process my/my child’s data/Information.</p>
EOD;

$fullName = $_SESSION['fullName'];
$student_sgd = <<<EOD
<p style="text-indent:510px; line-height:10%;" ><b>sgd.</b></p>
<p style="text-indent:450px; line-height:10%; " >$fullName</p>
<p style="text-indent:500px; line-height:10%;" >Student </p>
EOD;

$line = <<<EOD
<hr style="border: 1px dotted;">
EOD;


$dir = $_SESSION['dir1'];
$photo .= '<img src="'.$dir.'"  width="150" height="100">';

$pdf->writeHTMLCell(0, 0, '', 43, $photo, 0, 1, 0, true, 'R', true);
$pdf->writeHTMLCell(0, 0, '', 20, $title, 0, 1, 0, true, '', true);
$pdf->writeHTML($data_sql);
$pdf->writeHTMLCell(0, 0, '', 125, $statement, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 175, $student_sgd, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 195, $line, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 205, $data_sql_cr, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', 205, $data_sql_user, 0, 1, 0, true, '', true);


// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$student_number = $_SESSION['student_number'];
$pdf->Output('InternshipApplication_'.$student_number.'.pdf', 'I');

}
//============================================================+
// END OF FILE
//============================================================+