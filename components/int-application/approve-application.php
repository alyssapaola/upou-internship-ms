<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$timenow=time();	
	$time_now = date("m/d/Y",$timenow);
	
	$userid = $_SESSION['userid'];
	
	if(isset($_POST["id"])){
		$template_desc = $_POST['template_desc'];
		
		$query = "UPDATE tbl_internship_application 
				SET status_flag = '1', comment = '$template_desc', date_confirmed = '$time_now', staff_confirmed = '$userid'
				WHERE application_id = '".$_POST["id"]."'";
		mysqli_query($con, $query);
	}
?>