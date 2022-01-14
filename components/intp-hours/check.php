<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){
		
		$int_hours = mysqli_real_escape_string($con, $_POST["int_hours"]);  
		$course_type = mysqli_real_escape_string($con, $_POST["course_type"]);  
		
		//if existing section record
		if($_POST["int_hours_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT internship_hrs_id 
						FROM tbl_internship_hours  
						WHERE course_id = '$course_type' AND internship_hrs = '$int_hours' AND internship_hrs_id != '".$_POST["int_hours_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT internship_hrs_id 
						FROM tbl_internship_hours 
						WHERE course_id = '$course_type' AND internship_hrs = '$int_hours' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>