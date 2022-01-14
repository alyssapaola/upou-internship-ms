<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["applicationid"])){
		//echo $_POST["id"];
		$_SESSION['applicationid'] = $_POST["applicationid"];
	}
?>