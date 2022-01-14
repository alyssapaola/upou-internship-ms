<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	$time = time();
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		//variable initialization
		$output = '';  
		$message = '';  
		
		$user_name = mysqli_real_escape_string($con, $_POST["uname"]);  
		
		//random password generator
		$comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_.!';
		$pass = array(); 
		$combLen = strlen($comb) - 1; 
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $combLen);
			$pass[] = $comb[$n];
		}
		
		$user_pass = implode($pass);
		$user_pass_md5 = md5($user_pass);
		
		$query = " UPDATE tbl_user 
					SET password = '$user_pass_md5', forgotpass_flag = '1', activetime = '$time', attempts = '0', active_flag = '1' 
					WHERE username='".$user_name."' AND delete_flag = '0'"; 
		if(mysqli_query($con, $query) ){  
			require_once "send-mail.php";
		}
		
	}  
?>