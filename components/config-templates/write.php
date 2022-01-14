<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["temp_id"])){  
		$query = "SELECT * FROM tbl_template 
			JOIN tbl_template_category ON tbl_template_category.temp_category_id = tbl_template.temp_category_id 
			WHERE tbl_template.template_id = '".$_POST["temp_id"]."'";  
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>