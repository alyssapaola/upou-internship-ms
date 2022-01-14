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
	
	$educ_stud_num = mysqli_real_escape_string($con, $_POST["educ_stud_num"]);
	$educ_college = mysqli_real_escape_string($con, $_POST["educ_college"]);
	$educ_course = mysqli_real_escape_string($con, $_POST["educ_course"]);
	$educ_year = mysqli_real_escape_string($con, $_POST["educ_year"]);
	
	if($educ_stud_num != "" && $educ_college != "" && $educ_course != "" && $educ_year != ""){
		
		//check if there are changes made
		$changes_qry = "SELECT educ_info_id FROM tbl_student_educ_info  
					WHERE student_number = '$educ_stud_num' AND college_id = '$educ_college' AND course_id	= '$educ_course' AND year_level_id = '$educ_year' AND current_flag = '1' AND userid = '$user_id'"; 
		$changes_rslt = mysqli_query($con, $changes_qry);
		
		if(mysqli_num_rows($changes_rslt) > 0){
			echo "<script language='JavaScript'>
				alert('No changes have been made');
			</script>";
		}
		
		else{
			
			//get ID
			$cntID_qry = "SELECT educ_info_id, COUNT(*) as total FROM tbl_student_educ_info";
			$cntID_rslt = mysqli_query($con, $cntID_qry);
			if(mysqli_num_rows($cntID_rslt) > 0){
				while($row = mysqli_fetch_assoc($cntID_rslt)){
					$total = $row['total'];
					$total = $total+1;
					$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
					$educ_info_id_db = "EDUC".$counter;
				}
			}
			
			//check if there are data available then update // else, just proceed on insert query
			$dataQry = "SELECT educ_info_id FROM tbl_student_educ_info WHERE userid = '$user_id'"; 
			$dataRslt = mysqli_query($con, $dataQry);
			if(mysqli_num_rows($dataRslt) > 0){
				$queryUpdate = "UPDATE tbl_student_educ_info SET current_flag='0' WHERE userid='$user_id'";
				mysqli_query($con, $queryUpdate);
			}
			
			$queryInsert = "INSERT INTO tbl_student_educ_info (educ_info_id, userid, student_number, college_id, course_id, year_level_id, current_flag) 
					VALUES ('$educ_info_id_db', '$user_id', '$educ_stud_num', '$educ_college','$educ_course', '$educ_year', '1' )";
			
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