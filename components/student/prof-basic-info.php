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
	
	$basic_firstname = ucwords(mysqli_real_escape_string($con, $_POST["basic_firstname"]));  
	$basic_lastname = ucwords(mysqli_real_escape_string($con, $_POST["basic_lastname"]));  
	$basic_email = mysqli_real_escape_string($con, $_POST["basic_email"]);  
	
	//check if username exists
	$user_qry = "SELECT userid FROM tbl_user  WHERE username = '".$basic_email."' AND delete_flag = '0' AND userid != '$user_id'"; 
	$user_rslt = mysqli_query($con, $user_qry);
	if(mysqli_num_rows($user_rslt) > 0){
		echo "<script language='JavaScript'>
			alert('Email/Username is already taken');
		</script>";
	}
	
	//proceed
	else{
	
		$query = "UPDATE tbl_user SET username ='$basic_email', firstname = '$basic_firstname', lastname = '$basic_lastname' WHERE userid = '".$user_id."'";
		
		if(mysqli_query($con, $query) ){  
			echo "<script language='JavaScript'>
					alert('Changes saved');
					window.location = \"../student/profile.php\";
				</script>";	
		}
		
	}
	
?>