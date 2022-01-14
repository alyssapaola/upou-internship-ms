<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		
		$_SESSION['job_application_id'] = $_POST["id"];
		$_SESSION['userid_student'] = $_POST["userid"];
		$_SESSION['termid'] = $_POST["termid"];
		
	}
?>