<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('sec_assign_id', 'firstname', 'section_name', 'sec_assign_id');
	
	$query = "SELECT tbl_section_assignment.sec_assign_id, tbl_user.firstname, tbl_user.lastname, tbl_section.section_name
			FROM  tbl_section_assignment 
			JOIN tbl_user ON tbl_user.userid = tbl_section_assignment.user_id
			JOIN tbl_section ON tbl_section.section_id = tbl_section_assignment.section_id
			WHERE tbl_section_assignment.delete_flag = '0' ";
	
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_section_assignment.user_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_user.firstname LIKE "%'.$_POST["search"]["value"].'%"
					OR tbl_user.lastname LIKE "%'.$_POST["search"]["value"].'%"
					OR tbl_section.section_name  LIKE "%'.$_POST["search"]["value"].'%" )';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_user.firstname ASC ';
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
		
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$name = $firstname." ".$lastname;
		$section_name = $row['section_name'];
		
		$sub_array[] = '<div data-id="'.$row["sec_assign_id"].'" data-column="sec_assign_id ">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["sec_assign_id"].'" data-column="firstname ">' .  $name. '</div>';
		$sub_array[] = '<div data-id="'.$row["sec_assign_id"].'" data-column="section_name ">' . $section_name. '</div>';
		$sub_array[] = '<button type="button" name="delete" class="delete btn btn-danger btn-xs active_flg" id="'.$row["sec_assign_id"].'">Delete</button>';
		
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT tbl_section_assignment.sec_assign_id, tbl_user.firstname, tbl_user.lastname, tbl_section.section_name
			FROM  tbl_section_assignment 
			JOIN tbl_user ON tbl_user.userid = tbl_section_assignment.user_id
			JOIN tbl_section ON tbl_section.section_id = tbl_section_assignment.section_id
			WHERE tbl_section_assignment.delete_flag = '0' ";
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