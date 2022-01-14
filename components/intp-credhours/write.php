<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){  
		$query = "SELECT * FROM tbl_internship_hours_credit 
			JOIN tbl_college ON tbl_college.college_id = tbl_internship_hours_credit.college_id
			WHERE tbl_internship_hours_credit.credit_hrs_id = '".$_POST['id']."' ";
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>