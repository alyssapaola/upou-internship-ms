<?php
	// Initialize the session
	include '../../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	
	$word = "student";
	
	/*
	$_SESSION["loggedin"] = true;
	$_SESSION['userid'] = $db_userid;
	$_SESSION['role'] = $db_rolename;
	$_SESSION['fname'] = $db_fname;
	*/
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== $word ){
		header("location: ../login/index.php");
		exit;	
	}
	
	$user_id = $_SESSION['userid'];
		
	// Define variables and initialize with empty values
	$new_password = $confirm_password = "";
	$new_password_err = $confirm_password_err = "";
	
	$old_pass = trim($_POST["old_pass"]);
	$new_pass = trim($_POST["new_pass"]);
	$confirm_pass = trim($_POST["confirm_pass"]);
	
	if($new_pass != "" && $confirm_pass != "" && $old_pass != ""){
		
		$new_pass_md5 = md5($new_pass);	
		
		$sql = "UPDATE tbl_user SET password='$new_pass_md5', forgotpass_flag='0', attempts='0' WHERE userid='$user_id'";
		if (mysqli_query($con, $sql)) {
		
			echo "<script language='JavaScript'>
					alert('Change Password Successful!');
					window.location = \"../student/profile.php\";
			</script>";
		} 
		
	}
	else{
		echo "<script language='JavaScript'>
			alert('Please supply necessary fields');
		</script>";
		
	}

?>
