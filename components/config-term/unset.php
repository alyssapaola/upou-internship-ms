<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		$query1 = "UPDATE tbl_acad_term SET current_flag='0' WHERE term_id = '".$_POST["id"]."'";
		$query2 = "UPDATE tbl_orientation SET active_flag='0' WHERE term_id = '".$_POST["id"]."'";
		
		if(mysqli_query($con, $query1) && mysqli_query($con, $query2)){
			echo 'Data Updated';
		}
	}
?>