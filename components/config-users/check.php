<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$user_name = mysqli_real_escape_string($con, $_POST["username"]);  
		
		//if old account
		if($_POST["user_id"] != ''){ 
		
			//check if username exists
			$user_qry = "SELECT userid FROM tbl_user  WHERE username = '".$user_name."' AND userid != '".$_POST["user_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if username exists
			$user_qry = "SELECT username FROM tbl_user  WHERE username = '".$user_name."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>