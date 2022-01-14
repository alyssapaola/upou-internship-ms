<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		$query = "SELECT * FROM tbl_company 
					JOIN tbl_company_moa ON tbl_company_moa.company_moa_id = tbl_company.company_moa_id
				WHERE tbl_company.company_id = '".$_POST["id"]."'";  
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>