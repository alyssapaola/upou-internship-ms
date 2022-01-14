<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$c_shortname = mysqli_real_escape_string($con, $_POST["cshortname"]);  
		
		//if existing college record
		if($_POST["college_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT college_id FROM tbl_college  
							WHERE college_shortname = '".$c_shortname."' AND college_id != '".$_POST["college_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT college_shortname FROM tbl_college  WHERE college_shortname = '".$c_shortname."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>