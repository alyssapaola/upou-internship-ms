<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('registration_id', 'registration_id', 'student_number', 'college_shortname', 'orientation_date', 'term_name', 'attendance_flag', 'registration_id');
	
	$query = "SELECT tbl_orientation_registration.registration_id, tbl_orientation_registration.student_number, tbl_orientation_registration.attendance_flag, 
				tbl_orientation.orientation_date, tbl_orientation.orientation_start_time, tbl_orientation.orientation_end_time, 
				tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year, 
				tbl_college.college_shortname 
			FROM tbl_orientation_registration 
			JOIN tbl_orientation ON tbl_orientation.orientation_id = tbl_orientation_registration.orientation_id
				JOIN tbl_acad_term ON tbl_acad_term.term_id = tbl_orientation.term_id
			JOIN tbl_student_educ_info ON tbl_student_educ_info.student_number = tbl_orientation_registration.student_number
				JOIN tbl_college ON tbl_college.college_id = tbl_student_educ_info.college_id
			WHERE tbl_orientation.delete_flag = '0' AND tbl_student_educ_info.current_flag = '1' ";
	
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_orientation.term_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST['filter_role_1']) && $_POST['filter_role_1'] != ''){
		$query .= 'AND tbl_college.college_id = "'.$_POST['filter_role_1'].'" ';
	}
	
	if(isset($_POST['filter_role_2']) && $_POST['filter_role_2'] != ''){
		$query .= 'AND tbl_orientation_registration.attendance_flag = "'.$_POST['filter_role_2'].'" ';
	}

	if(isset($_POST["search"]["value"])){
		//$query .= 'AND tbl_orientation_registration.student_number LIKE "%'.$_POST["search"]["value"].'%"';
		
		$query .= 'AND (tbl_orientation_registration.student_number LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_orientation_registration.registration_id LIKE "%'.$_POST["search"]["value"].'%")';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_orientation_registration.registration_id ASC ';
	}
	
	$query1 = '';
	
	if($_POST["length"] != -1){
		$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	
	$number_filter_row = mysqli_num_rows(mysqli_query($con, $query));
	
	$result = mysqli_query($con, $query . $query1);
	
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$sub_array = array();
		$i = $i + 1;
		
		$flag = $row["attendance_flag"];
		
		if($flag == '1'){
			$attendance = "Attended";
		}
		else{
			$attendance = "No Attendance Record";
		}
		
		$registration_id = $row["registration_id"];
		$student_number = $row["student_number"];
		
		$date_db = $row["orientation_date"];
		$date_db = date("F d, Y", strtotime($date_db));  
		
		$or_start_time = $row["orientation_start_time"];
		$or_end_time = $row["orientation_end_time"];
		$time_db = $or_start_time." - ".$or_end_time;
		$datetime = $date_db." /<br> ".$time_db;
		
		$term_name = $row["term_name"];
		$term_from_year = $row["term_from_year"];
		$term_to_year = $row["term_to_year"];
		$term_desc = $term_name." AY ".$term_from_year." - ".$term_to_year;
		
		$college_shortname = $row['college_shortname'];
		
		$sub_array[] = '<div data-id="'.$registration_id.'" data-column="id"'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$registration_id.'" data-column="registration_id "'.$style.'">' . $registration_id . '</div>';
		$sub_array[] = '<div data-id="'.$registration_id.'" data-column="student_number "'.$style.'">' . $student_number . '</div>';
		$sub_array[] = '<div data-id="'.$registration_id.'" data-column="college_shortname "'.$style.'">' . $college_shortname . '</div>';
		$sub_array[] = '<div data-id="'.$registration_id.'" data-column="datetime "'.$style.'">' . $datetime . '</div>';
		$sub_array[] = '<div data-id="'.$registration_id.'" data-column="term_desc "'.$style.'">' . $term_desc . '</div>';
		$sub_array[] = '<div data-id="'.$registration_id.'" data-column="attendance "'.$style.'">' . $attendance . '</div>';
		$sub_array[] = '<button type="button" name="view"  class="view btn btn-danger btn-xs active_flg"  id="'.$registration_id.'">View</button>
					<button type="button" name="edit"  class="edit btn btn-danger btn-xs active_flg"  id="'.$registration_id.'">Edit</button>';
		
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_orientation_registration";
		$result = mysqli_query($con, $query);
		return mysqli_num_rows($result);
	}
	
	$output = array(
		"draw"    => intval($_POST["draw"]),
		"recordsTotal"  =>  get_all_data($con),
		"recordsFiltered" => $number_filter_row,
		"data"    => $data
	);
	
	echo json_encode($output);
?>