<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		$query = "UPDATE tbl_job SET delete_flag='1' WHERE job_id = '".$_POST["id"]."'";
		$query1 = "UPDATE tbl_job_category SET delete_flag='1' WHERE job_id = '".$_POST["id"]."'";
		if(mysqli_query($con, $query) && mysqli_query($con, $query1)){
			echo 'Data Deleted';
		}
	}
?>