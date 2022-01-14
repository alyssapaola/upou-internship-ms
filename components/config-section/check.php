<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$section_name = mysqli_real_escape_string($con, $_POST["section_name"]);  
		
		//if existing section record
		if($_POST["section_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT section_id FROM tbl_section  
							WHERE section_name = '".$section_name."' AND section_id != '".$_POST["section_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT section_name FROM tbl_section WHERE section_name = '".$section_name."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>