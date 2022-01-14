<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){  
		$query = "SELECT tbl_internship_hours.internship_hrs_id, tbl_internship_hours.internship_hrs, tbl_internship_hours.course_id, tbl_college.college_id 
				FROM tbl_internship_hours 
				JOIN tbl_course ON tbl_course.course_id = tbl_internship_hours.course_id
				JOIN tbl_college ON tbl_college.college_id = tbl_course.college_id
				WHERE internship_hrs_id = '".$_POST['id']."' ";
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>