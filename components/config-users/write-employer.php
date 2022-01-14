<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["user_id"])){  
		$query = "SELECT * FROM tbl_user 
				JOIN tbl_company_employee ON tbl_company_employee.userid = tbl_user.userid
		WHERE tbl_user.userid = '".$_POST["user_id"]."'";  
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>