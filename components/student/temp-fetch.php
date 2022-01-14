<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('template_id','template_name', 'template_desc', 'temp_category_name');
	
	$query = "SELECT * FROM tbl_template 
			JOIN tbl_template_category ON tbl_template_category.temp_category_id = tbl_template.temp_category_id
			WHERE tbl_template.delete_flag = '0' AND active_flag = '1' ";
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND tbl_template.template_name LIKE "%'.$_POST["search"]["value"].'%"';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_template.active_flag DESC, tbl_template.template_name ASC ';
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
		}
		else{
			$style = "style='color:#121212'";	  //active
			$value = "Hide";
			$name = "archive";
			$flag = "btn btn-danger btn-xs active_flg";
		}
		
		$template_name	 = $row["template_name"];
		$template_desc = $row["template_desc"];
		$template_dir = $row["template_dir"];
		$temp_category_name = $row["temp_category_name"];
		
		$sub_array[] = '<div data-id="'.$row["template_id"].'" data-column="template_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["template_id"].'" data-column="template_name "'.$style.'"> <u><a href="../upload/admin/'.$template_dir.'" '.$style.'" download>' . $template_name	 . '</u></a></div>';
		$sub_array[] = '<div data-id="'.$row["template_id"].'" data-column="template_desc "'.$style.'">' . $template_desc	 . '</div>';
		$sub_array[] = '<div data-id="'.$row["template_id"].'" data-column="temp_category_name "'.$style.'">' . $temp_category_name	 . '</div>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_template WHERE delete_flag='0' ";
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