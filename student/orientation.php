<?php
	// Initialize the session
	include '../connect.php';
	include '../components/student/get-details.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	$current = date("Y-m-d H:i");
	$current_date = date("Y-m-d");
	
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
	
	// checks if user completed already his profile. otherwise, send to profile
	if ($student_details_flag == 0){
		header("location: ../student/profile.php");
		exit;
	}
	
	$user_id = $_SESSION['userid'];
	
	//check if user is already registered on the orientation
	
	//if yes, attedance panel will be shown:
	$query_att = "SELECT tbl_orientation_registration.registration_id, tbl_orientation_registration.attendance_flag,
					tbl_orientation.orientation_date, tbl_orientation.orientation_start_time, tbl_orientation.orientation_end_time,
					tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year,
					tbl_venue.venue_name
				FROM tbl_orientation_registration 
					JOIN tbl_orientation ON tbl_orientation.orientation_id = tbl_orientation_registration.orientation_id
						JOIN tbl_acad_term ON tbl_acad_term.term_id = tbl_orientation.term_id
						JOIN tbl_venue ON tbl_venue.venue_id = tbl_orientation.venue_id
				WHERE tbl_orientation_registration.userid ='$user_id' AND tbl_acad_term.current_flag = '1' AND tbl_orientation.active_flag = '1' ";
	$result_att = mysqli_query($con, $query_att);
	if(mysqli_num_rows($result_att) > 0){
		while($row = mysqli_fetch_array($result_att)){	
		
		//get orientation details
			$registration_id_db = $row['registration_id'];
			
			// 0 - not yet attended; 1 - attended
			$attendance_flag_db = $row['attendance_flag'];
			
			$or_date = $row["orientation_date"];
			
			//for displaying of date in formal way
			$date_db = date("F d, Y", strtotime($or_date));
			
			$or_start_time = $row["orientation_start_time"];
			$or_end_time = $row["orientation_end_time"];
			$time_db = $or_start_time." - ".$or_end_time;
			
			//used for datetime checking
			$date_database = date("Y-m-d", strtotime($or_date));
			$time_database = date("H:i", strtotime($or_end_time));
			$time_database_one = date("H:i", strtotime($or_end_time)+ 60*60);
			
			//used for when should the button will display
			$datetime_database = $date_database." ".$time_database;
			$datetime_database_one = $date_database." ".$time_database_one;
			
			$term_name = $row["term_name"];
			$term_from_year = $row["term_from_year"];
			$term_to_year = $row["term_to_year"];
			
			$term_desc_db = $term_name." AY ".$term_from_year." - ".$term_to_year;
			
			$venue_name_db = $row['venue_name'];
			
		}
	
		require_once "or-attendance.php";
	}
	
	//else, registration panel will be shown:
	else{
		
		//get every orientation details that is active
		$query_reg = "SELECT tbl_orientation.orientation_id, tbl_orientation.orientation_date, tbl_orientation.orientation_start_time, 
						tbl_orientation.orientation_end_time,
						tbl_venue.venue_name,
						tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year
				FROM tbl_orientation 
					JOIN tbl_venue ON tbl_venue.venue_id = tbl_orientation.venue_id
					JOIN tbl_acad_term ON tbl_acad_term.term_id = tbl_orientation.term_id
			WHERE tbl_orientation.active_flag = '1' AND tbl_acad_term.current_flag = '1' ";
		$result_reg = mysqli_query($con, $query_reg);
	
		require_once "or-registration.php";
	}
	
?>