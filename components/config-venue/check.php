<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$venue_name = mysqli_real_escape_string($con, $_POST["venue_name"]);  
		
		//if existing term record
		if($_POST["venue_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT venue_id FROM tbl_venue  
							WHERE venue_name = '".$venue_name."' AND venue_id != '".$_POST["venue_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT venue_name FROM tbl_venue WHERE venue_name = '".$venue_name."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>