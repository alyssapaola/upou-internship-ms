<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$job_id = $_SESSION['job_id'];
	$status = $_SESSION['status'];
	
	$columns = array('job_application_id', 'job_application_id', 'firstname', 'course_fullname', 'job_application_id' );
	
	$query = "SELECT tbl_job_application.job_application_id, tbl_job_application.term_id, tbl_job_application.userid, 
				tbl_user.firstname, tbl_user.lastname,  
				tbl_course.course_fullname 
			FROM tbl_job_application 
			JOIN tbl_user ON tbl_user.userid = tbl_job_application.userid
			JOIN tbl_student_educ_info ON tbl_student_educ_info.userid = tbl_job_application.userid
				JOIN tbl_course ON tbl_course.course_id = tbl_student_educ_info.course_id
			WHERE tbl_student_educ_info.current_flag = '1' AND tbl_job_application.job_id = '$job_id' AND tbl_job_application.status_flag = '$status' ";
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND ( tbl_job_application.job_application_id LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_user.firstname LIKE "%'.$_POST["search"]["value"].'%"
					OR tbl_user.lastname LIKE "%'.$_POST["search"]["value"].'%"
				)';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_job_application.job_application_id ASC ';
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
		
		$job_application_id = $row["job_application_id"];
		
		$userid = $row['userid'];
		$term_id = $row['term_id'];
		
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$name = $firstname." ".$lastname;
		
		$course_fullname = $row['course_fullname'];
		
		$sub_array[] = '<div data-id="'.$job_application_id.'" data-column="id">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$job_application_id.'" data-column="job_application_id ">' . $job_application_id . '</div>';
		$sub_array[] = '<div data-id="'.$job_application_id.'" data-column="firstname ">' . $name . '</div>';
		$sub_array[] = '<div data-id="'.$job_application_id.'" data-column="course_fullname ">' . $course_fullname . '</div>';
		$sub_array[] = '<button type="submit" name="view"  class="view btn btn-danger btn-xs active_flg" id="'.$job_application_id.'">View</button>
						<input type="hidden" value="'.$userid.'" id="userid" />	
						<input type="hidden" value="'.$term_id.'" id="termid" />	
						';
		
		$data[] = $sub_array;
		
	}
	
	function get_all_data($con){
		$query = "SELECT tbl_job_application.job_application_id, tbl_job_application.term_id, tbl_job_application.userid, 
				tbl_user.firstname, tbl_user.lastname,  
				tbl_course.course_fullname 
			FROM tbl_job_application 
			JOIN tbl_user ON tbl_user.userid = tbl_job_application.userid
			JOIN tbl_student_educ_info ON tbl_student_educ_info.userid = tbl_job_application.userid
				JOIN tbl_course ON tbl_course.course_id = tbl_student_educ_info.course_id
			WHERE tbl_student_educ_info.current_flag = '1' AND tbl_job_application.job_id = '$job_id' AND tbl_job_application.status_flag = '$status' ";
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