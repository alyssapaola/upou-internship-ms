<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$staff_userid = $_SESSION['userid'];
	
	$columns = array('application_id', 'student_number', 'firstname', 'course_shortname', 'section_name', 'application_id');
	
	$query = "SELECT tbl_student_educ_info.student_number, tbl_course.course_shortname, tbl_section.section_name, 
				tbl_user.firstname, tbl_user.lastname,
				tbl_internship_application.application_id, tbl_internship_application.term_id, tbl_internship_application.userid
			FROM tbl_internship_application 
			JOIN tbl_acad_term ON tbl_internship_application.term_id = tbl_acad_term.term_id
			JOIN tbl_user ON tbl_internship_application.userid = tbl_user.userid
			JOIN tbl_student_educ_info ON tbl_internship_application.educ_info_id = tbl_student_educ_info.educ_info_id
				JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
				JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
			JOIN tbl_student_section ON tbl_internship_application.userid = tbl_student_section.user_id
				JOIN tbl_section ON tbl_student_section.section_id = tbl_section.section_id
				JOIN tbl_section_assignment ON tbl_student_section.section_id = tbl_section_assignment.section_id
			WHERE tbl_internship_application.status_flag = '1' AND tbl_section_assignment.user_id = '$staff_userid' AND tbl_section_assignment.delete_flag = '0' ";
	
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_acad_term.term_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST['filter_role_1']) && $_POST['filter_role_1'] != ''){
		$query .= 'AND tbl_student_section.section_id = "'.$_POST['filter_role_1'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_user.firstname LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_user.lastname LIKE "%'.$_POST["search"]["value"].'%"
					OR tbl_student_educ_info.student_number LIKE "%'.$_POST["search"]["value"].'%"
					)';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_student_educ_info.student_number ASC ';
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
		$term_id = $row['term_id'];
		
		$application_id = $row["application_id"];
		
		$student_number = $row['student_number'];
		$course_shortname = $row['course_shortname'];
		$section_name = $row['section_name'];
		
		$firstname = $row["firstname"];
		$lastname = $row["lastname"];
		$name = $firstname." ".$lastname;
		
		//check job application
		$job_qry = "SELECT tbl_company.company_name FROM tbl_job_application 
					JOIN tbl_job ON tbl_job.job_id =  tbl_job_application.job_id
					JOIN tbl_company ON tbl_company.company_id = tbl_job.company_id
				WHERE tbl_job_application.userid = '$userid' AND tbl_job_application.term_id = '$term_id' AND tbl_job_application.status_flag = '1' ";
		$job_rslt = mysqli_query($con, $job_qry);
		if(mysqli_num_rows($job_rslt) > 0){
			while($job_row = mysqli_fetch_array($job_rslt)){
				$company_name = $job_row['company_name'];
			}
			$status = "Approved Application: ".$company_name;
		}
		else{
			$status = "Pending Application";
		}
		
		
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="id">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="student_number ">' . $student_number . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="firstname ">' . $name . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="course_shortname ">' . $course_shortname . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="section_name ">' . $section_name . '</div>';
		$sub_array[] = '<div data-id="'.$application_id.'" data-column="application_id ">' . $status . '</div>';
		
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT tbl_student_educ_info.student_number, tbl_course.course_shortname, tbl_section.section_name, 
				tbl_user.firstname, tbl_user.lastname,
				tbl_internship_application.application_id
			FROM tbl_internship_application 
			JOIN tbl_acad_term ON tbl_internship_application.term_id = tbl_acad_term.term_id
			JOIN tbl_user ON tbl_internship_application.userid = tbl_user.userid
			JOIN tbl_student_educ_info ON tbl_internship_application.educ_info_id = tbl_student_educ_info.educ_info_id
				JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
				JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
			JOIN tbl_student_section ON tbl_internship_application.userid = tbl_student_section.user_id
				JOIN tbl_section ON tbl_student_section.section_id = tbl_section.section_id
				JOIN tbl_section_assignment ON tbl_student_section.section_id = tbl_section_assignment.section_id
			WHERE tbl_internship_application.status_flag = '1' AND tbl_section_assignment.user_id = '$staff_userid' AND tbl_section_assignment.delete_flag = '0' ";
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