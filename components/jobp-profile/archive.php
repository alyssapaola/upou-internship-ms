<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$current_date = date("m/d/Y");

	if(isset($_POST["id"])){
		
		//get MOA ID
		$cntID_qry = "SELECT company_moa_id FROM tbl_company WHERE company_id = '".$_POST["id"]."'";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$company_moa_id = $row['company_moa_id'];
			}
		}
		
		$query = "UPDATE tbl_company_moa SET term_end='$current_date' WHERE company_moa_id = '$company_moa_id'";
		
		if(mysqli_query($con, $query)){
			echo 'Data Updated';
		}
	}
?>