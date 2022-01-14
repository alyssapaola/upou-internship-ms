<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$id = mysqli_real_escape_string($con, $_POST["id"]);  
		
		$job_qry = "SELECT * FROM tbl_job_application WHERE job_application_id = '$id'";
		$job_rslt = mysqli_query($con, $job_qry);
		if(mysqli_num_rows($job_rslt) > 0){
			while($job_row = mysqli_fetch_array($job_rslt)){
				$userid = $job_row['userid'];
				$term_id = $job_row['term_id'];
			}
		}
		
		//check if application is approved by other
		$user_qry = "SELECT * FROM tbl_job_application WHERE userid = '".$userid."' AND term_id = '".$term_id."' AND status_flag = '1'"; 
		$user_rslt = mysqli_query($con, $user_qry);
		
		if(mysqli_num_rows($user_rslt) > 0){
			echo 1;
		}

	}
?>