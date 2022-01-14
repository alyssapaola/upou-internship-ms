<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$timenow=time();	
	
	if(isset($_POST["id"])){
		
		$time_now=date("m/d/Y h:i a",$timenow);
		
		$query = "UPDATE tbl_orientation_registration SET attendance_flag='1', date_confirmed = '$time_now' WHERE registration_id = '".$_POST["id"]."'";
		
		if(mysqli_query($con, $query)){
			echo 'Data Updated';
			//echo $_POST["id"];
		}
		else {
			die(header("HTTP/1.0 404 Not Found")); //Throw an error on failure
		}
	}
?>