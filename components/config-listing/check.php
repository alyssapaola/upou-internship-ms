<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if($_POST["id"] != ''){ 
		$query = "SELECT * FROM  tbl_job WHERE job_id = '".$_POST["id"]."'";  
		$_SESSION['query'] = $query;
	}
?>