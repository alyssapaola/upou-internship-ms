<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('department_id','department_name','department_id');
	
	$query = "SELECT * FROM tbl_company_dept WHERE delete_flag='0' ";
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND department_name LIKE "%'.$_POST["search"]["value"].'%"';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY department_name ASC ';
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
		
		$sub_array[] = '<div data-id="'.$row["department_id"].'" data-column="department_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["department_id"].'" data-column="department_name "'.$style.'">' . $row["department_name"] . '</div>';
		$sub_array[] = '<button type="button" name="edit"  class="edit btn btn-danger btn-xs active_flg"  id="'.$row["department_id"].'">Edit</button>
						<button type="button" name="delete" class="delete btn btn-danger btn-xs active_flg" id="'.$row["department_id"].'">Delete</button>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_company_dept WHERE delete_flag='0' ";
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