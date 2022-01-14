<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		$query = "UPDATE tbl_college SET active_flag='1' WHERE college_id = '".$_POST["id"]."'";
		
		if(mysqli_query($con, $query)){
			echo 'Data Updated';
		}
	}
?>