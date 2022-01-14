<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$company_id = $_SESSION['company_id'];
	
	date_default_timezone_set('Asia/Manila');
	
	$columns = array('job_id','job_name', 'num_vacancy', 'active_flag', 'job_id');
	
	$query = "SELECT * FROM  tbl_job WHERE company_id ='$company_id' AND delete_flag = '0' AND active_flag = '1' ";
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND job_name LIKE "%'.$_POST["search"]["value"].'%"';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY active_flag DESC, job_name ASC ';
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
		
		//check if item is active or not
		if($active == '0'){
			$style = "style='color:#878787'";		//ia
			$value = "Publish";
			$name = "restore";
			$flag = "btn btn-default btn-xs inactive_flg";
			$status = "Expired";
		}
		else{
			//$style = "style='color:#121212'";	  
			$style = "style='color:#121212'";	//active
			$value = "Unpublish";
			$name = "archive";
			$flag = "btn btn-danger btn-xs active_flg";
			$status = "Active";
		}
		
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="job_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="job_name "'.$style.'">' .  $row['job_name'] . '</div>';
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="num_vacancy "'.$style.'">' . $row['num_vacancy'] . '</div>';
		$sub_array[] = '<button type="button" name="view"  class="view '.$flag.'"  id="'.$row["job_id"].'">View</button>
						<button type="button" name="edit"  class="edit '.$flag.'"  id="'.$row["job_id"].'">Edit</button>
						<button type="button name="'.$name.'" class="'.$name." ".$flag.'" id="'.$row["job_id"].' "'.$current.'">'.$value.'</button>
						<button type="button" name="delete" class="delete '.$flag.'" id="'.$row["job_id"].'">Delete</button>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM  tbl_job WHERE company_id ='$company_id' AND delete_flag = '0' AND active_flag = '1' ";
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