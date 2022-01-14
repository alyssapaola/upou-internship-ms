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
	
	$emer_name = ucwords(mysqli_real_escape_string($con, $_POST["emer_name"]));  
	$emer_rel = mysqli_real_escape_string($con, $_POST["emer_rel"]);
	$emer_mobilenum = mysqli_real_escape_string($con, $_POST["emer_mobilenum"]);
	$emer_address = ucwords(strtolower($_POST["emer_address"]));  
	
	if($emer_name != "" && $emer_rel != "" && $emer_mobilenum != "" && $emer_address != ""){
		
		//check if there are changes made
		$changes_qry = "SELECT emergency_info_id FROM tbl_student_emergency_info  
					WHERE emergency_name = '$emer_name' AND emergency_rel = '$emer_rel' AND emergency_num = '$emer_mobilenum' AND emergency_add = '$emer_address' AND current_flag = '1' AND userid = '$user_id'"; 
		$changes_rslt = mysqli_query($con, $changes_qry);
		
		if(mysqli_num_rows($changes_rslt) > 0){
			echo "<script language='JavaScript'>
				alert('No changes have been made');
			</script>";
		}
		
		else{
			
			//get ID
			$cntID_qry = "SELECT emergency_info_id, COUNT(*) as total FROM tbl_student_emergency_info";
			$cntID_rslt = mysqli_query($con, $cntID_qry);
			if(mysqli_num_rows($cntID_rslt) > 0){
				while($row = mysqli_fetch_assoc($cntID_rslt)){
					$total = $row['total'];
					$total = $total+1;
					$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
					$emergency_info_id_db = "EMER".$counter;
				}
			}
			
			//check if there are data available then update // else, just proceed on insert query
			$dataQry = "SELECT emergency_info_id FROM tbl_student_emergency_info WHERE userid = '$user_id'"; 
			$dataRslt = mysqli_query($con, $dataQry);
			if(mysqli_num_rows($dataRslt) > 0){
				$queryUpdate = "UPDATE tbl_student_emergency_info SET current_flag='0' WHERE userid='$user_id'";
				mysqli_query($con, $queryUpdate);
			}
			
			$queryInsert = "INSERT INTO tbl_student_emergency_info (emergency_info_id, userid, emergency_name, emergency_rel, emergency_num, emergency_add, current_flag) 
					VALUES ('$emergency_info_id_db', '$user_id', '$emer_name', '$emer_rel','$emer_mobilenum', '$emer_address', '1' )";
			
			if(mysqli_query($con, $queryInsert) ){  
				echo "<script language='JavaScript'>
						alert('Changes saved');
						window.location = \"../student/profile.php\";
					</script>";	
			}
			
		}
	}
	else{
		echo "<script language='JavaScript'>
			alert('Please supply necessary fields');
		</script>";
		
	}
	
?>