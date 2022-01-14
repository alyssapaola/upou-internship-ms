<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$stud_num = mysqli_real_escape_string($con, $_POST["stud_num"]);  
		
		//check if stud num exists
		$user_qry = "SELECT student_number FROM tbl_student_educ_info  WHERE student_number = '".$stud_num."'"; 
		$user_rslt = mysqli_query($con, $user_qry);
		
		if(mysqli_num_rows($user_rslt) > 0){
			echo 1;
		}
		
	}
?>