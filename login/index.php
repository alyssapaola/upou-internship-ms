<?php
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();

	// login instruction:
	//	thrice incorrect password = suspended account -> reset password
	
	// Processing form data when form is submitted
	if(!empty($_POST["login"])) {
		
		$user_name = trim($_POST["user_name"]);
		$user_pass = trim($_POST["user_pass"]);
		$user_pass = md5($user_pass);
		
		//check username existence
		$login_qry = "SELECT * FROM tbl_user WHERE username='$user_name' AND delete_flag = '0'";
		$cntuser_rslt = mysqli_query($con, $login_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$db_userid = $row['userid'];
				$db_password = $row['password'];
				$db_attempts = $row['attempts'];
				$db_roleid = $row['role_id'];
				$db_active = $row['active_flag'];
				$db_delete = $row['delete_flag'];
				$db_fname = $row['firstname'];
				$db_lname = $row['lastname'];
				$db_forgot = $row['forgotpass_flag'];
			}
			
			//check if deleted
			if ($db_delete == 0){
				
				//check if suspended
				if( $db_active != 0){
					$attempts = 0;
					
					//if pw entered correctly, pushed through
					if($user_pass==$db_password){
						
						$attempts_qry = "UPDATE tbl_user SET attempts='$attempts' WHERE userid='$db_userid'";
						
						//redirect to proper path
						if (mysqli_query($con, $attempts_qry)) {
							
							// Password is correct, so start a new session
							session_start();
							
							// Store data in session variables
							$_SESSION['userid'] = $db_userid;
							$_SESSION['fname'] = $db_fname;
							$_SESSION['lname'] = $db_lname;
							
							$acctype_qry = "SELECT role_name FROM tbl_role WHERE role_id='$db_roleid'";
							$acctype_rslt = mysqli_query($con, $acctype_qry);
							if(mysqli_num_rows($acctype_rslt) > 0){
								while($row = mysqli_fetch_assoc($acctype_rslt)){
									$db_rolename = $row['role_name'];	
								}
							}
							$_SESSION['role'] = $db_rolename;
							
							//check if new user/forgotten password or NA
							if ($db_forgot == 1){
								
								$_SESSION["changed_pass"] = true;
								echo "<script language='JavaScript'>
									window.location = \"change-password.php\";
								</script>";
							}
							
							//else proceed to the main interface
							else{
								
								$_SESSION["loggedin"] = true;
								echo "<script language='JavaScript'>
									alert('Login successful!');
									window.location = \"../$db_rolename\";
								</script>";
							}
							
						}
						else {
							echo "Error: " . $attempts_qry . "<br>" . mysqli_error($con);
						}
					}
					
					//else, attempts + 1 until suspended
					else{
						$attempts = $db_attempts + 1;
						$updateinc_qry = "UPDATE tbl_user SET attempts='$attempts' WHERE userid='$db_userid'";
						
						if (mysqli_query($con, $updateinc_qry)) {
							
							if($db_attempts>=2){
								$timenow=time()+300;	
								$updateattmpt_qry = "UPDATE tbl_user SET activetime='$timenow', active_flag = '0' WHERE userid='$db_userid'";
								if (mysqli_query($con, $updateattmpt_qry)) {
								
									echo "<script language='JavaScript'>
											alert('Failed to enter correct password Thrice!');
											window.location = \"index.php\";
										</script>";
								}
								else {
									echo "Error: " . $updateattmpt_qry . "<br>" . mysqli_error($con);
								}
							}
							else{
								echo "<script language='JavaScript'>
									alert('Incorrect Password!');
									window.location = \"index.php\";
								</script>";
							}
						}
						else {
							echo "Error: " . $updateinc_qry . "<br>" . mysqli_error($con);
						}
						
						
					}
				}
				
				else{
					echo "<script language='JavaScript'>
						alert('This account has been suspended! Please contact your system admin to reset your account');
						window.location = \"index.php\";
					</script>";
				}
				
			}
			
			else{
				echo "<script language='JavaScript'>
					alert('No account found!');
					window.location = \"index.php\";
				</script>";
			}
		}
		
		else{
			echo "<script language='JavaScript'>
				alert('Username doesn\'t exists!');
			</script>";
		}
		
	}
	
	require_once "login-view.php";
?>