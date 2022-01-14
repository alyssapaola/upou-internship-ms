<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){  
			
		$query = "SELECT tbl_internship_application.userid, 
				tbl_user.firstname, tbl_user.lastname,
				tbl_student_educ_info.student_number, tbl_college.college_fullname, tbl_course.course_fullname
			FROM tbl_internship_application 
			JOIN tbl_user ON tbl_internship_application.userid = tbl_user.userid
			JOIN tbl_student_educ_info ON tbl_internship_application.educ_info_id = tbl_student_educ_info.educ_info_id
				JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
				JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
			WHERE tbl_internship_application.application_id = '".$_POST["id"]."'";
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>