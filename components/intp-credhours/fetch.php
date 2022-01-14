<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('credit_hrs_id','credit_hrs_name', 'credit_hrs', 'college_fullname', 'credit_hrs_id');
	
	$query = "SELECT * FROM tbl_internship_hours_credit 
			JOIN tbl_college ON tbl_college.college_id = tbl_internship_hours_credit.college_id
			WHERE tbl_internship_hours_credit.delete_flag='0' ";
	
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_college.college_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_internship_hours_credit.credit_hrs_name LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_internship_hours_credit.credit_hrs LIKE "%'.$_POST["search"]["value"].'%")';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_internship_hours_credit.credit_hrs_id ASC ';
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
		
		$sub_array[] = '<div data-id="'.$row["credit_hrs_id"].'" data-column="credit_hrs_id ">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["credit_hrs_id"].'" data-column="credit_hrs_name ">' . $row["credit_hrs_name"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["credit_hrs_id"].'" data-column="credit_hrs ">' . $row["credit_hrs"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["credit_hrs_id"].'" data-column="college_fullname ">' . $row["college_fullname"] . '</div>';
		$sub_array[] = '<button type="button" name="edit"  class="edit btn btn-danger btn-xs active_flg"  id="'.$row["credit_hrs_id"].'">Edit</button>
						<button type="button" name="delete" class="delete btn btn-danger btn-xs active_flg" id="'.$row["credit_hrs_id"].'">Delete</button>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_internship_hours_credit WHERE delete_flag='0' ";
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