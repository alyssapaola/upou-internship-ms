<?php
	// Initialize the session
	include '../connect.php';
	include '../components/student/get-details.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	$current = date("F d, Y");
	$year_now = date("Y");
	
	$word = "student";
	
	$_SESSION['app-records'] = "0";
	
	/*
	$_SESSION["loggedin"] = true;
	$_SESSION['userid'] = $db_userid;
	$_SESSION['role'] = $db_rolename;
	$_SESSION['fname'] = $db_fname;
	*/
	
	// Checks if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== $word ){
		header("location: ../login/index.php");
		exit;	
	}
	
	// checks if user completed already his profile. otherwise, send to profile
	if ($student_details_flag == 0){
		header("location: ../student/profile.php");
		exit;
	}
	
	$user_id = $_SESSION['userid'];
	
	//check if attended on orientation:
	$query_or = "SELECT tbl_orientation_registration.userid
				FROM tbl_orientation_registration 
					JOIN tbl_orientation
						ON tbl_orientation_registration.orientation_id = tbl_orientation.orientation_id
					JOIN tbl_acad_term
						ON tbl_orientation.term_id = tbl_acad_term.term_id
				WHERE tbl_orientation_registration.userid ='$user_id' AND tbl_orientation_registration.attendance_flag = '1' AND tbl_acad_term.current_flag = '1' ";
	$result_or = mysqli_query($con, $query_or);
	if(mysqli_num_rows($result_or) > 0){
		
		//check if application is existing:
		$query = "SELECT tbl_internship_application.status_flag, tbl_internship_application.application_id, tbl_internship_application.date_applied, tbl_internship_application.comment,
					tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year,
					tbl_status.status_name,
					tbl_student_educ_info.student_number 
		FROM tbl_internship_application 
				JOIN tbl_acad_term ON tbl_internship_application.term_id = tbl_acad_term.term_id
				JOIN tbl_status ON tbl_internship_application.status_flag = tbl_status.status_id
				JOIN tbl_student_educ_info ON tbl_internship_application.userid = tbl_student_educ_info.userid
				WHERE tbl_internship_application.userid ='$user_id' AND tbl_internship_application.active_flag ='1' AND tbl_acad_term.current_flag = '1' ";
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$status_flag = $row['status_flag'];
				$status_name = $row['status_name'];
				
				$application_id = $row['application_id'];
				$date_applied = $row['date_applied'];
				$date_db = date("F d, Y", strtotime($date_applied));
				$comment = $row['comment'];
				
				$student_number = $row['student_number'];
				
				$term_name = $row["term_name"];
				$term_from_year = $row["term_from_year"];
				$term_to_year = $row["term_to_year"];
				$term_desc = $term_name.", AY ".$term_from_year." - ".$term_to_year;
			}
			require_once "app-success.php";
		}
		
		//else, proceed with the application
		else{
			require_once "app-view.php";
		}
	}
	
	//else, no data yet:
	else{
		require_once "app-err.php";
	}
	
?>