<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"])){  
		$query = "SELECT tbl_orientation_registration.attendance_flag, tbl_orientation_registration.student_number, tbl_orientation_registration.date_confirmed,
					tbl_orientation_registration.registration_id, 
					tbl_orientation.orientation_id, tbl_orientation.orientation_date, tbl_orientation.orientation_start_time,tbl_orientation.orientation_end_time,  
					tbl_acad_term.term_id, tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year 
			FROM tbl_orientation_registration 
				JOIN tbl_orientation ON tbl_orientation.orientation_id = tbl_orientation_registration.orientation_id
				JOIN tbl_acad_term ON tbl_acad_term.term_id = tbl_orientation.term_id
			WHERE tbl_orientation_registration.registration_id = '".$_POST["id"]."'";
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result);  									
		echo json_encode($row);  
	}  
 ?>