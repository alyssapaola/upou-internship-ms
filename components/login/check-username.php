<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../connect.php';
	
	//check if username exists or not
	if(!empty($_POST)){ 
		$user_name = mysqli_real_escape_string($con, $_POST["username"]);  
		$user_qry = "SELECT username FROM tbl_user  WHERE username = '".$user_name."' AND delete_flag = '0'"; 
		$user_rslt = mysqli_query($con, $user_qry);
		
		//exists - proceed to reset
		if(mysqli_num_rows($user_rslt) > 0){
			echo 1;
		}
		
		//not - notify the user
		else{
			echo 0;
		}
			
	}
?>