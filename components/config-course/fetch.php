<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('course_id','course_shortname', 'course_fullname', 'college_fullname','course_id');
	
	$query = "SELECT tbl_course.course_id, tbl_course.course_shortname, tbl_course.course_fullname, tbl_college.college_fullname, tbl_course.active_flag
				FROM tbl_course JOIN tbl_college ON tbl_course.college_id = tbl_college.college_id
				WHERE tbl_course.delete_flag='0' ";
				
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_college.college_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_course.course_shortname LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_course.course_fullname LIKE "%'.$_POST["search"]["value"].'%" 
		)';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_course.course_shortname ASC ';
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
		$active = $row["active_flag"];
	
		if($active == '0'){
			$style = "style='color:#878787'";		//ia
			$value = "Restore";
			$name = "restore";
			$flag = "btn btn-default btn-xs inactive_flg";
		}
		else{
			$style = "style='color:#121212'";	  //active
			$value = "Hide";
			$name = "archive";
			$flag = "btn btn-danger btn-xs active_flg";
		}
	
		$sub_array[] = '<div data-id="'.$row["course_id"].'" data-column="course_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["course_id"].'" data-column="course_shortname "'.$style.'">' . $row["course_shortname"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["course_id"].'" data-column="course_fullname "'.$style.'">' . $row["course_fullname"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["course_id"].'" data-column="college_fullname "'.$style.'">' . $row["college_fullname"] . '</div>';
		$sub_array[] = '<button type="button" name="edit"  class="edit '.$flag.'"  id="'.$row["course_id"].'">Edit</button>
						<button type="button name="'.$name.'" class="'.$name." ".$flag.'" id="'.$row["course_id"].'">'.$value.'</button>
						<button type="button" name="delete" class="delete '.$flag.'" id="'.$row["course_id"].'">Delete</button>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_course WHERE delete_flag='0' ";
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