<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["venue_id"])){  
		$query = "SELECT * FROM tbl_venue WHERE venue_id = '".$_POST["venue_id"]."'";  
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>