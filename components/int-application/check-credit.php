<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		
		$approved_credit_hours = 0;
		//check if username exists
		//$qry = "SELECT * FROM tbl_internship_application_credit  WHERE application_id = '".$_POST["id"]."' AND status_flag = '2'"; 
		$qry = "SELECT tbl_internship_hours.internship_hrs, tbl_internship_hours_credit.credit_hrs 
			FROM tbl_internship_application_credit 
			JOIN tbl_internship_hours_credit ON tbl_internship_hours_credit.credit_hrs_id = tbl_internship_application_credit.credit_hrs_id
			JOIN tbl_internship_application ON tbl_internship_application.application_id = tbl_internship_application_credit.application_id
			JOIN tbl_internship_hours ON tbl_internship_hours.internship_hrs_id = tbl_internship_application.internship_hrs_id
			WHERE tbl_internship_application_credit.application_credit_id = '".$_POST["id"]."'";
		$rslt = mysqli_query($con, $qry);
		
		if(mysqli_num_rows($rslt) > 0){
			while($row = mysqli_fetch_array($rslt)){
				$credit_hrs = $row["credit_hrs"];
				$approved_credit_hours = $approved_credit_hours + $credit_hrs;
				
				$internship_hrs = $row["internship_hrs"];
			}
			
			$internship_hrs = $internship_hrs / 2;
			//300 / 2 = 150
			
			//75 < 300
			if ($internship_hrs < $approved_credit_hours){
				echo 1;
			}
		
			
		}
		
		
	}
?>