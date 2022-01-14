<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('college_id','college_shortname', 'college_fullname', 'college_id');
	
	$query = "SELECT * FROM tbl_college WHERE delete_flag='0' ";
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (college_shortname LIKE "%'.$_POST["search"]["value"].'%" 
					OR college_fullname LIKE "%'.$_POST["search"]["value"].'%" 
		)';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY college_shortname ASC ';
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
	
		$sub_array[] = '<div data-id="'.$row["college_id"].'" data-column="college_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["college_id"].'" data-column="college_shortname "'.$style.'">' . $row["college_shortname"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["college_id"].'" data-column="college_fullname "'.$style.'">' . $row["college_fullname"] . '</div>';
		$sub_array[] = '<button type="button" name="edit"  class="edit '.$flag.'"  id="'.$row["college_id"].'">Edit</button>
						<button type="button name="'.$name.'" class="'.$name." ".$flag.'" id="'.$row["college_id"].'">'.$value.'</button>
						<button type="button" name="delete" class="delete '.$flag.'" id="'.$row["college_id"].'">Delete</button>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_college WHERE delete_flag='0' ";
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