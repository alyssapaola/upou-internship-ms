<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//check if there's a current:
	$current_qry = "SELECT term_id FROM tbl_acad_term WHERE current_flag = '1'";
	$current_rslt = mysqli_query($con, $current_qry);

	$columns = array('term_id','term_name', 'term_id');
	
	$query = "SELECT * FROM tbl_acad_term WHERE delete_flag='0' ";
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (term_name LIKE "%'.$_POST["search"]["value"].'%" 
					OR term_from_year LIKE "%'.$_POST["search"]["value"].'%" 
					OR term_to_year LIKE "%'.$_POST["search"]["value"].'%" 
		)';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY current_flag DESC, term_from_year DESC ';
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
		$current = $row["current_flag"];
		
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
		
		if($current == '1'){
			$current_style = "";
			$current_value = "Unset to Current";
			$current_name = "unset";
			$style = "style='color:#b30000;  font-weight: bold'";
		}
		else{
			
			//if there's a current flag, button wont be displayed for others
			if(mysqli_num_rows($current_rslt) > 0){ 
				$current_style = "style='display: none;'";
			}
			
			$current_value = "Set to Current";
			$current_name = "set";
		}
		
		$term_name = $row["term_name"];
		$term_from_year = $row["term_from_year"];
		$term_to_year = $row["term_to_year"];
		
		$term_desc = $term_name." AY ".$term_from_year." - ".$term_to_year;
		
		$sub_array[] = '<div data-id="'.$row["term_id"].'" data-column="term_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["term_id"].'" data-column="term_desc "'.$style.'">' . $term_desc . '</div>';
		$sub_array[] = '<button type="button" name="edit"  class="edit '.$flag.'"  id="'.$row["term_id"].'">Edit</button>
						<button type="button" name="current "'.$current_style.'"  class="'.$current_name." ".$flag.'"  id="'.$row["term_id"].'">'.$current_value.'</button> 
						<button type="button name="'.$name.'" class="'.$name." ".$flag.'" id="'.$row["term_id"].'">'.$value.'</button>
						<button type="button" name="delete" class="delete '.$flag.'" id="'.$row["term_id"].'">Delete</button>';
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_acad_term WHERE delete_flag='0' ";
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