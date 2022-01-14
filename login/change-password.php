<?php
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	$user_id = $_SESSION["userid"];
	$role_name = $_SESSION['role'];
	
	// Processing form data when form is submitted
	if(!empty($_POST["change"])) {
		
		// Define variables and initialize with empty values
		$new_password = $confirm_password = "";
		$new_password_err = $confirm_password_err = "";
		
		// Validate new password
		if(empty(trim($_POST["new_password"]))){
			$new_password_err = "Please enter the new password.";     
		} elseif(strlen(trim($_POST["new_password"])) < 6){
			$new_password_err = "Password must have atleast 6 characters.";
		} else{
			$new_password = trim($_POST["new_password"]);
			$new_password_md5 = md5($new_password);	
		}
		
		// Validate confirm password
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please confirm the password.";
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($new_password_err) && ($new_password != $confirm_password)){
				$confirm_password_err = "Password did not match.";
			}
		}
		
		// Check input errors before updating the database
		if(empty($new_password_err) && empty($confirm_password_err)){
			// Prepare an update statement
			
			$sql = "UPDATE tbl_user SET password='$new_password_md5', forgotpass_flag='0' WHERE userid='$user_id'";
			if (mysqli_query($con, $sql)) {
               
			   // Password updated successfully. Redirect to main UI				
				echo "<script language='JavaScript'>
						alert('Change Password Successful!');
						window.location = \"../$role_name\";
					</script>";
            } 
			else{
				echo "<script language='JavaScript'>
						alert('Oops! Something went wrong. Please try again');
					</script>";
            }
			
        }

	}
	
	require_once "change-password-view.php";
?>
