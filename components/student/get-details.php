<?php
	// Initialize the session
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	$user_id = $_SESSION['userid'];
	$student_details_flag = 0;
	
	//get the details for application table
	$query_stud_details = "SELECT tbl_user.firstname, tbl_user.lastname, tbl_user.username, tbl_user.password,
				tbl_student_educ_info.student_number, tbl_student_educ_info.college_id, tbl_student_educ_info.course_id, tbl_student_educ_info.year_level_id, tbl_student_educ_info.educ_info_id,
				tbl_college.college_fullname,
				tbl_course.course_fullname,
				tbl_year_level.year_level_desc,
				tbl_student_contact_info.contact_num, tbl_student_contact_info.contact_email, tbl_student_contact_info.contact_add, tbl_student_contact_info.contact_info_id, 
				tbl_student_emergency_info.emergency_name, tbl_student_emergency_info.emergency_rel, tbl_student_emergency_info.emergency_num, tbl_student_emergency_info.emergency_add, tbl_student_emergency_info.emergency_info_id 
			FROM tbl_user 
			JOIN tbl_student_educ_info ON tbl_user.userid = tbl_student_educ_info.userid
				JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
				JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
				JOIN tbl_year_level ON tbl_student_educ_info.year_level_id = tbl_year_level.year_level_id
			JOIN tbl_student_contact_info ON tbl_user.userid = tbl_student_contact_info.userid
			JOIN tbl_student_emergency_info ON tbl_user.userid = tbl_student_emergency_info.userid
			WHERE tbl_user.userid = '$user_id' AND tbl_student_educ_info.current_flag = '1' AND tbl_student_contact_info.current_flag = '1' AND tbl_student_emergency_info.current_flag = '1' ";
	$rslt_stud_details = mysqli_query($con, $query_stud_details);
	if(mysqli_num_rows($rslt_stud_details) > 0){
		while($row = mysqli_fetch_array($rslt_stud_details)){
			
			$username = $row['username'];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];	
			$fullName = $firstname." ".$lastname;
			
			$course_fullname = $row["course_fullname"];	
			$course_id = $row['course_id'];
			$college_id = $row['college_id'];
			$student_number = $row['student_number'];
			
			$year_level_desc = $row['year_level_desc'];
			
			$contact_num = $row['contact_num'];
			$contact_email = $row['contact_email'];
			$contact_add = $row['contact_add'];
			
			$emergency_name = $row['emergency_name'];
			$emergency_rel = $row['emergency_rel'];
			$emergency_num = $row['emergency_num'];
			$emergency_add = $row['emergency_add'];
			
			$educ_info_id = $row['educ_info_id'];
			$contact_info_id = $row['contact_info_id'];
			$emergency_info_id = $row['emergency_info_id'];
			
		}
		
		$student_details_flag = 1;
	}
	
?>