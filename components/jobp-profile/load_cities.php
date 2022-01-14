<?php 
	// Initialize the session
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$cit_qry = "SELECT * FROM cities WHERE province_id = '".$_POST["id"]."'";
	$cit_rslt = mysqli_query($con, $cit_qry);
	if(mysqli_num_rows($cit_rslt) > 0){
		while($row = mysqli_fetch_assoc($cit_rslt)){
			echo "<option value='".$row['city_id']."'>".$row['city_name']."</option>";
		}
	}
?>