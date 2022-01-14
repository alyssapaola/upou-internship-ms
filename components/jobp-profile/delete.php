<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){
		$query = "UPDATE tbl_company SET delete_flag='1' WHERE company_id = '".$_POST["id"]."'";
		
		$company_id = $_POST["id"];
		$queryGet = "SELECT userid FROM tbl_company_employee WHERE company_id='$company_id' ";
		$resultGet = mysqli_query($con, $queryGet);
		while($rowGet = mysqli_fetch_array($resultGet)){
			$userid = $rowGet["userid"];
		}
		
		$queryDel = "UPDATE tbl_user SET delete_flag='1' WHERE userid = '$userid'";
		
		if(mysqli_query($con, $query) & mysqli_query($con, $queryDel)){
			echo 'Company deleted and its affiliates';
		}
	}
?>