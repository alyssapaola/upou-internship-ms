<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	if(isset($_POST["id"])){
		$query = "UPDATE tbl_user SET attempts = '0', activetime = '$time', active_flag='1' WHERE userid = '".$_POST["id"]."'";
		if(mysqli_query($con, $query)){
			echo 'Data Updated';
		}
	}
?>