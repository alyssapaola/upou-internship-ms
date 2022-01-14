<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	
	$columns = array('orientation_id','term_name', 'venue_name', 'orientation_date', 'orientation_start_time', 'active_flag','orientation_id');
	
	$query = "SELECT tbl_orientation.orientation_id, tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year, tbl_venue.venue_name, tbl_orientation.orientation_date, tbl_orientation.orientation_start_time, tbl_orientation.orientation_end_time, tbl_orientation.active_flag, tbl_acad_term.term_id, tbl_acad_term.current_flag
			FROM  tbl_orientation 
			JOIN tbl_acad_term ON tbl_acad_term.term_id =  tbl_orientation.term_id
			JOIN tbl_venue ON  tbl_venue.venue_id = tbl_orientation.venue_id
			WHERE tbl_orientation.delete_flag='0' ";
				
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_acad_term.term_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_acad_term.term_name LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_venue.venue_name LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_orientation.orientation_date LIKE "%'.$_POST["search"]["value"].'%" 
		)';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_acad_term.current_flag DESC, tbl_orientation.active_flag DESC,  tbl_orientation.orientation_id ASC ';
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
		$current_flg = $row['current_flag'];
		
		//check if acad term is set as current
		if($current_flg == '0'){
			$current = "style='display:none'";
		}
		
		//check if item is active or not
		if($active == '0'){
			$style = "style='color:#878787'";		//ia
			$value = "Publish";
			$name = "restore";
			$flag = "btn btn-default btn-xs inactive_flg";
		}
		else{
			//$style = "style='color:#121212'";	  
			$style = "style='color:#b30000'";	//active
			$value = "Hide";
			$name = "archive";
			$flag = "btn btn-danger btn-xs active_flg";
		}
		
		$term_name = $row["term_name"];
		$term_from_year = $row["term_from_year"];
		$term_to_year = $row["term_to_year"];
		$term_desc = $term_name." AY ".$term_from_year." - ".$term_to_year;
		
		
		$date_db = $row["orientation_date"];
		$date_db = date("F d, Y", strtotime($date_db));  
		
		//$time_db = $row["orientation_time"];
		//$datetime = $date_db." / ".$time_db;
		
		$or_start_time = $row["orientation_start_time"];
		$or_end_time = $row["orientation_end_time"];
		$time_db = $or_start_time." - ".$or_end_time;
		
		
		
		$sub_array[] = '<div data-id="'.$row["orientation_id"].'" data-column="orientation_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["orientation_id"].'" data-column="term_desc "'.$style.'">' . $term_desc . '</div>';
		$sub_array[] = '<div data-id="'.$row["orientation_id"].'" data-column="term_desc "'.$style.'">' . $row['venue_name'] . '</div>';
		$sub_array[] = '<div data-id="'.$row["orientation_id"].'" data-column="date_db "'.$style.'">' . $date_db . '</div>';
		$sub_array[] = '<div data-id="'.$row["orientation_id"].'" data-column="time_db "'.$style.'">' . $time_db . '</div>';
		$sub_array[] = '<button type="button" name="edit"  class="edit '.$flag.'"  id="'.$row["orientation_id"].'">Edit</button>
						<button type="button name="'.$name.'" class="'.$name." ".$flag.'" id="'.$row["orientation_id"].' "'.$current.'">'.$value.'</button>
						<button type="button" name="delete" class="delete '.$flag.'" id="'.$row["orientation_id"].'">Delete</button>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_orientation WHERE delete_flag='0' ";
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