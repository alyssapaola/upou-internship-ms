<?php
	// Initialize the session
	include '../../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	$timenow=time();	
	$time_now = date("m/d/Y h:i a",$timenow);
	
	$user_id = $_SESSION['userid'];
	$term_id = $_SESSION['term_id'];
	
	if(!empty($_POST)){ 
	
		$message = "";
		
		$applicant_skill = ucwords($_POST["skill"]);
		$applicant_skill = str_replace("x ", ",", $applicant_skill);
		$applicant_skill = preg_replace("/\s+/", "", $applicant_skill);
		$applicant_skill = rtrim($applicant_skill, ", ");
		
		$applicant_desc = ucwords(mysqli_real_escape_string($con, $_POST["desc"]));
		
		$job_application_id = $_POST["id"];
		$job_id = $_POST["job_id"];
		
		$queryJobApp = "INSERT INTO tbl_job_application (job_application_id, job_id, userid, term_id, date_applied, date_confirmed, employer_confirmed, status_flag) 
			VALUES ('$job_application_id', '$job_id', '$user_id', '$term_id', '$time_now', '', '', '2')";
		
		$queryJobDesc = "INSERT INTO tbl_job_application_desc (job_application_id, skills, description) VALUES ('$job_application_id', '$applicant_skill', '$applicant_desc')";
		
		if( !mysqli_query($con, $queryJobApp) || !mysqli_query($con, $queryJobDesc) ){  
			$message = "Error description: " . mysqli_error($con);
		}
		
		echo $message;
		
	}
?>