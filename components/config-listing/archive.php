<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';

	if(isset($_POST["id"])){
		$query = "UPDATE tbl_job SET active_flag='0' WHERE job_id = '".$_POST["id"]."'";
		
		if(mysqli_query($con, $query)){
			echo 'Data Updated';
		}
	}
?>