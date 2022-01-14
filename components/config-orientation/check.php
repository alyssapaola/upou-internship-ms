<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	//some basic validation
	if(!empty($_POST)){ 
		
		$or_date = $_POST["or_date"];
		$or_start_time = $_POST["or_start_time"];
		
		$or_date_db = date('m/d/Y',strtotime($or_date));
		//$time_db = date('h:i A',strtotime($datetime));
		
		//if existing section record
		if($_POST["orientation_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT orientation_id FROM tbl_orientation  
							WHERE orientation_date = '".$or_date_db."' AND orientation_start_time = '".$or_start_time."'
							AND orientation_id != '".$_POST["orientation_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT orientation_date, orientation_start_time FROM tbl_orientation 
							WHERE orientation_date = '".$or_date_db."' AND orientation_start_time = '".$or_start_time."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>