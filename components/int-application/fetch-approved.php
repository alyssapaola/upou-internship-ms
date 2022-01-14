<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('application_id', 'application_id', 'student_number', 'college_shortname', 'term_name','application_id');
	
	$query = "SELECT tbl_internship_application.application_id, tbl_internship_application.status_flag, tbl_internship_application.userid, 
				tbl_student_educ_info.student_number, tbl_student_educ_info.course_id, tbl_college.college_shortname,
				tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year 
			FROM tbl_internship_application 
			JOIN tbl_acad_term ON tbl_internship_application.term_id = tbl_acad_term.term_id
			JOIN tbl_student_educ_info ON tbl_internship_application.educ_info_id = tbl_student_educ_info.educ_info_id
				JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
				JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
			WHERE tbl_internship_application.status_flag = '1' ";
	
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_acad_term.term_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST['filter_role_1']) && $_POST['filter_role_1'] != ''){
		$query .= 'AND tbl_college.college_id = "'.$_POST['filter_role_1'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_internship_application.application_id LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_internship_application.userid LIKE "%'.$_POST["search"]["value"].'%")';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_internship_application.application_id ASC ';
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
		
		$userid = $row['userid'];
		
		$sec_qry = "SELECT * FROM tbl_student_section WHERE user_id = '$userid'";
		$sec_rslt = mysqli_query($con, $sec_qry);
		if(mysqli_num_rows($sec_rslt) > 0){
			$style = "style='display:none'";		//ia
		}
		
		$application_id = $row["application_id"];
		
		$student_number = $row['student_number'];
		$college_shortname = $row['college_shortname'];
		
		$term_name = $row["term_name"];
		$term_from_year = $row["term_from_year"];
		$term_to_year = $row["term_to_year"];
		$term_desc = $term_name.", AY ".$term_from_year." - ".$term_to_year;
		
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="id">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="application_id ">' . $application_id . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="student_number ">' . $student_number . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="college_shortname ">' . $college_shortname . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="term_desc ">' . $term_desc . '</div>';
		$sub_array[] = '<button type="submit" name="view"  class="view btn btn-danger btn-xs active_flg" id="'.$application_id.'">View</button>
						<button type="submit" name="edit"  class="edit btn btn-danger btn-xs active_flg "'.$style.'" id="'.$application_id.'">Set Section</button>';
		
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_internship_application WHERE status_flag = '2'";
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