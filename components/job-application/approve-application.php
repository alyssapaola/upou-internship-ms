<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$timenow=time();	
	$time_now = date("m/d/Y",$timenow);
	
	$userid = $_SESSION['userid'];
	
	if(isset($_POST["id"])){
		$query = "UPDATE tbl_job_application 
				SET status_flag = '1', date_confirmed = '$time_now', employer_confirmed = '$userid'
				WHERE job_application_id = '".$_POST["id"]."'";
		mysqli_query($con, $query);
	}
?>