<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//some basic validation
	if(!empty($_POST)){ 
		$term_name = mysqli_real_escape_string($con, $_POST["term_name"]);  
		$to_year = mysqli_real_escape_string($con, $_POST["to_year"]);  
		$from_year = mysqli_real_escape_string($con, $_POST["from_year"]);  
		
		//if existing term record
		if($_POST["term_id"] != ''){ 
		
			//check if shortname exists
			$user_qry = "SELECT term_id FROM tbl_acad_term  
							WHERE term_name = '".$term_name."' AND term_from_year = '".$from_year."' AND term_to_year = '".$to_year."' 
							AND term_id != '".$_POST["term_id"]."' AND delete_flag = '0'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
		//if new account
		else{
	
			//check if shortname exists
			$user_qry = "SELECT term_name FROM tbl_acad_term
							WHERE term_name = '".$term_name."' AND term_from_year = '".$from_year."' AND term_to_year = '".$to_year."' AND delete_flag = '0' "; 
			$user_rslt = mysqli_query($con, $user_qry);
			
			if(mysqli_num_rows($user_rslt) > 0){
				echo 1;
			}
		}
		
	}
?>