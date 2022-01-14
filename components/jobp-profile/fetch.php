<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$current_date = date("Y-m-d");
	
	
	$columns = array('company_id', 'company_name', 'city_name', 'active_flag', 'company_id');
	
	$query = "SELECT tbl_company.company_id, tbl_company.company_name, 
					provinces.province_name, cities.city_name,
					tbl_company_moa.term_end 
			FROM tbl_company
			JOIN tbl_company_address1 ON tbl_company_address1.company_address_id = tbl_company.company_address_id
				JOIN provinces ON provinces.province_id = tbl_company_address1.province_id
				JOIN cities ON cities.city_id = tbl_company_address1.city_id
			JOIN tbl_company_moa ON tbl_company_moa.company_moa_id = tbl_company.company_moa_id
			WHERE tbl_company.delete_flag = '0' AND tbl_company.company_id != '' 
			";
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_company.company_name LIKE "%'.$_POST["search"]["value"].'%" 
					OR cities.city_name LIKE "%'.$_POST["search"]["value"].'%") ';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_company.company_name ASC ';
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
		
		$company_id = $row["company_id"];
		$company_name = $row["company_name"];
		
		$city = $row["city_name"];
		$province = $row["province_name"];
		$address = $city.", ".$province;

		$term_end = $row['term_end'];
		
		$term_end_db = date("Y-m-d", strtotime($term_end));
		
		if ($current_date >= $term_end_db) {
			$style = "style='color:#878787'";		//ia
			$value = "Renew";
			$name = "restore";
			$flag = "btn btn-default btn-xs inactive_flg";
			$status = "For Renewal";
		}
		else {
			$style = "style='color:#121212'";	  //active
			$value = "End Agreement";
			$name = "archive";
			$flag = "btn btn-danger btn-xs active_flg";
			$status = "Active";
		}
		
		$sub_array[] = '<div data-id="'.$company_id.'" data-column="company_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$company_id.'" data-column="company_name "'.$style.'">' . $company_name. '</div>';
		$sub_array[] = '<div data-id="'.$company_id.'" data-column="address "'.$style.'">' . $address. '</div>';
		$sub_array[] = '<div data-id="'.$company_id.'" data-column="active_flag "'.$style.'">' . $status. '</div>';
		$sub_array[] = '<button type="button" name="view"  class="view '.$flag.'"  id="'.$company_id.'">View</button>
					<button type="button" name="edit"  class="edit '.$flag.'"  id="'.$company_id.'">Edit</button>
					<button type="button name="'.$name.'" class="'.$name." ".$flag.'" id="'.$company_id.'">'.$value.'</button>
					<button type="button" name="delete" class="delete '.$flag.'" id="'.$company_id.'">Delete</button>';
		
		$data[] = $sub_array;
	
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM tbl_company WHERE delete_flag='0' ";
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