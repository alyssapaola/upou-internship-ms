<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){
		
		$credit_name = mysqli_real_escape_string($con, $_POST["credit_name"]);  
		$college_type = mysqli_real_escape_string($con, $_POST["college_type"]);  
		
		//if existing section record
		if($_POST["credit_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT credit_hrs_id 
						FROM tbl_internship_hours_credit  
						WHERE credit_hrs_name = '$credit_name' AND college_id = '$college_type' AND credit_hrs_id != '".$_POST["credit_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT credit_hrs_id 
						FROM tbl_internship_hours_credit 
						WHERE credit_hrs_name = '$credit_name' AND college_id = '$college_type' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>