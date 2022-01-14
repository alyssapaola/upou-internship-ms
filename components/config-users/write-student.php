<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["user_id"])){  
		$query = "SELECT tbl_user.userid, tbl_user.firstname, tbl_user.lastname, tbl_user.username, tbl_user.active_flag,
				tbl_student_educ_info.student_number, tbl_student_educ_info.college_id, tbl_student_educ_info.course_id,  tbl_student_educ_info.year_level_id 
			FROM tbl_user 
			JOIN tbl_student_educ_info ON tbl_student_educ_info.userid = tbl_user.userid
			WHERE  tbl_user.userid = '".$_POST["user_id"]."' AND tbl_student_educ_info.current_flag = '1'";  
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>