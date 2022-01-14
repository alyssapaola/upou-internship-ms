<?php
	// Initialize the session
	include '../connect.php';
	include '../components/student/get-details.php';
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
	
	$queryUser = "SELECT firstname, lastname, username, password FROM tbl_user WHERE userid = '$user_id'";
	$rsltUser = mysqli_query($con, $queryUser);
	while($row = mysqli_fetch_assoc($rsltUser)){
		$firstname_db = $row['firstname'];
		$lastname_db = $row['lastname'];
		$username_db = $row['username'];
		$old_pass_db = $row['password'];
	}
	
	$queryEduc = "SELECT tbl_student_educ_info.student_number, tbl_student_educ_info.college_id, tbl_student_educ_info.course_id, tbl_student_educ_info.year_level_id,
					tbl_college.college_fullname, tbl_course.course_fullname, tbl_year_level.year_level_desc
				FROM tbl_student_educ_info 
					JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
					JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
					JOIN tbl_year_level ON tbl_student_educ_info.year_level_id = tbl_year_level.year_level_id
				WHERE tbl_student_educ_info.userid = '$user_id' AND tbl_student_educ_info.current_flag = '1' ";
	$rsltEduc = mysqli_query($con, $queryEduc);
	while($row = mysqli_fetch_assoc($rsltEduc)){
		$student_number_db = $row['student_number'];
		$college_id_db = $row['college_id'];
		$course_id_db = $row['course_id'];
		$year_level_db = $row['year_level_id'];
		
		$college_fullname_db = $row['college_fullname'];
		$course_fullname_db = $row['course_fullname'];
		
		$year_level_desc_db = $row['year_level_desc'];
	}
	
	$queryContact = "SELECT contact_num, contact_email, contact_add FROM tbl_student_contact_info WHERE userid = '$user_id' AND current_flag = '1' ";
	$rsltContact = mysqli_query($con, $queryContact);
	while($row = mysqli_fetch_assoc($rsltContact)){
		$contact_num_db = $row['contact_num'];
		$contact_email_db = $row['contact_email'];
		$contact_add_db = $row['contact_add'];
		
	}
	
	$queryEmer = "SELECT emergency_name, emergency_rel, emergency_num, emergency_add FROM tbl_student_emergency_info WHERE userid = '$user_id' AND current_flag = '1' ";
	$rsltEmer = mysqli_query($con, $queryEmer);
	while($row = mysqli_fetch_assoc($rsltEmer)){	
		$emergency_name_db = $row['emergency_name'];
		$emergency_rel_db = $row['emergency_rel'];
		$emergency_num_db = $row['emergency_num'];
		$emergency_add_db = $row['emergency_add'];
	}
	
	require_once "prof-view.php";
	
	if(isset($_POST["save_basic_info"])) {
		require_once "../components/student/prof-basic-info.php";
	}
	
	else if(isset($_POST["save_educ_info"])) {
		require_once "../components/student/prof-educ-info.php";
	}
	
	else if(isset($_POST["save_contact_info"])) {
		require_once "../components/student/prof-contact-info.php";
	}
	
	else if(isset($_POST["save_emergency_info"])) {
		require_once "../components/student/prof-emergency-info.php";
	}
	
	else if(isset($_POST["save_emergency_info"])) {
		require_once "../components/student/prof-emergency-info.php";
	}
	
	else if(isset($_POST["save_change_pass"])) {
		require_once "../components/student/prof-change-pass.php";
	}
	
	else{
		header("location: profile.php");
		exit;
	}
	
	
?>