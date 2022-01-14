<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('internship_hrs_id','college_fullname', 'course_fullname', 'internship_hrs', 'internship_hrs_id');
	
	$query = "SELECT tbl_internship_hours.internship_hrs_id, tbl_internship_hours.internship_hrs,
			tbl_course.course_fullname, tbl_college.college_fullname 
			FROM tbl_internship_hours 
			JOIN tbl_course ON tbl_course.course_id = tbl_internship_hours.course_id
			JOIN tbl_college ON tbl_college.college_id = tbl_course.college_id
			WHERE tbl_internship_hours.delete_flag='0' AND  tbl_course.delete_flag='0' AND tbl_college.delete_flag='0' ";
			
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_college.college_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_internship_hours.internship_hrs_id LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_college.college_fullname LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_course.course_fullname LIKE "%'.$_POST["search"]["value"].'%" 
		)';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_internship_hours.internship_hrs_id ASC ';
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
		
		$sub_array[] = '<div data-id="'.$row["internship_hrs_id"].'" data-column="internship_hrs_id ">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["internship_hrs_id"].'" data-column="college_fullname ">' . $row["college_fullname"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["internship_hrs_id"].'" data-column="course_fullname ">' . $row["course_fullname"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["internship_hrs_id"].'" data-column="internship_hrs ">' . $row["internship_hrs"] . '</div>';
		$sub_array[] = '<button type="button" name="edit"  class="edit btn btn-danger btn-xs active_flg"  id="'.$row["internship_hrs_id"].'">Edit</button>
						<button type="button" name="delete" class="delete btn btn-danger btn-xs active_flg" id="'.$row["internship_hrs_id"].'">Delete</button>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_internship_hours WHERE delete_flag='0' ";
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