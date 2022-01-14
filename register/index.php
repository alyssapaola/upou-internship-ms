<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		$rolename = $_SESSION['role'];
		header("location: ../$rolename/index.php");
		exit;
	}
	
	if(!empty($_POST["register"])) {

		//variable initialization
		$stud_num = mysqli_real_escape_string($con, $_POST["stud_num"]);
		$college = mysqli_real_escape_string($con, $_POST["college"]);
		$course = mysqli_real_escape_string($con, $_POST["course"]);
		$year_level = mysqli_real_escape_string($con, $_POST["year_level"]);
		
		$first_name = ucwords(mysqli_real_escape_string($con, $_POST["first_name"]));  
		$last_name = ucwords(mysqli_real_escape_string($con, $_POST["last_name"]));  
		
		$user_name = mysqli_real_escape_string($con, $_POST["user_name"]);  
		
		//check if username exists
		$user_qry = "SELECT userid FROM tbl_user  WHERE username = '".$user_name."' AND delete_flag = '0'"; 
		$user_rslt = mysqli_query($con, $user_qry);
		if(mysqli_num_rows($user_rslt) > 0){
			echo "<script language='JavaScript'>
					alert('Username is already registered. Forgotten password?');
				</script>";
		}
		
		//proceed
		else{
			
			//get role id
			$acct_type_qry = "SELECT role_id FROM tbl_role WHERE role_name LIKE '%student%'";
			$acct_type_rslt = mysqli_query($con, $acct_type_qry);
			if(mysqli_num_rows($acct_type_rslt) > 0){
				while($row = mysqli_fetch_assoc($acct_type_rslt)){
					$acct_type = $row['role_id'];
				}
			}
			
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
			
			//get user_id
			$cntuser_qry = "SELECT userid, COUNT(*) as total FROM tbl_user";
			$cntuser_rslt = mysqli_query($con, $cntuser_qry);
			if(mysqli_num_rows($cntuser_rslt) > 0){
				while($row = mysqli_fetch_assoc($cntuser_rslt)){
					$total = $row['total'];
					$total = $total+1;
					$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
					$user_id_db = "USER".$counter;
				}
			}
			
			//get user_id
			$cnteduc_qry = "SELECT userid, COUNT(*) as total FROM tbl_user";
			$cnteduc_rslt = mysqli_query($con, $cnteduc_qry);
			if(mysqli_num_rows($cnteduc_rslt) > 0){
				while($row = mysqli_fetch_assoc($cnteduc_rslt)){
					$total = $row['total'];
					$total = $total+1;
					$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
					$educ_info_id_db = "EDUC".$counter;
				}
			}
			
			$query = "INSERT INTO tbl_user (userid, username, password, role_id, attempts, activetime, firstname, lastname, forgotpass_flag, active_flag, delete_flag) 
					VALUES ('$user_id_db', '$user_name', '$user_pass_md5', '$acct_type', '0', '$time', '$first_name', '$last_name', '1', '1','0')";
			$query1 = "INSERT INTO tbl_student_educ_info (educ_info_id, userid, student_number, college_id, course_id, year_level_id, current_flag) 
					VALUES ('$educ_info_id_db', '$user_id_db', '$stud_num', '$college', '$course', '$year_level', '1' )";
			
			if(mysqli_query($con, $query) && mysqli_query($con, $query1) ){  
			
				require_once "../components/login/send-mail.php";
				
				if($error == "0"){
					echo "<script language='JavaScript'>
						window.location = \"confirm.php\";
					</script>";	
				}
				else{
					echo "<script language='JavaScript'>
						alert('Mailer Error');
					</script>";
				}
			}
			
		}
	}

	require_once "register-view.php";
?>