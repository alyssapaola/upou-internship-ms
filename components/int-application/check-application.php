<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		
		//check if username exists
		$qry = "SELECT * FROM tbl_internship_application_credit  WHERE application_id = '".$_POST["id"]."' AND status_flag = '2'"; 
		$rslt = mysqli_query($con, $qry);
		
		if(mysqli_num_rows($rslt) > 0){
			echo 1;
		}
		
		
	}
?>