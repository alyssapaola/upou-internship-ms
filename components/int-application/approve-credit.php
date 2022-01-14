<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		$query = "UPDATE tbl_internship_application_credit SET status_flag = '1' WHERE application_credit_id = '".$_POST["id"]."'";
		mysqli_query($con, $query);
	}
?>