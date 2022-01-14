<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		$query = "UPDATE tbl_course SET delete_flag='1' WHERE course_id = '".$_POST["id"]."'";
		
		if(mysqli_query($con, $query)){
			echo 'Data Deleted';
		}
	}
?>