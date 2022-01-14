<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$dept_name = mysqli_real_escape_string($con, $_POST["dept_name"]);  
		
		//if existing term record
		if($_POST["dept_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT department_id FROM tbl_company_dept  
							WHERE department_name = '".$dept_name."' AND department_id != '".$_POST["dept_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT department_name FROM tbl_company_dept WHERE department_name = '".$dept_name."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>