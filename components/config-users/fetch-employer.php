<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$columns = array('userid', 'firstname', 'lastname', 'username', 'company_name', 'userid');
	
	$query = "SELECT tbl_user.userid, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.active_flag, tbl_user.delete_flag,
				tbl_company.company_name 
			FROM tbl_user 
			JOIN tbl_role ON tbl_role.role_id = tbl_user.role_id
			JOIN tbl_company_employee ON tbl_company_employee.userid = tbl_user.userid
			JOIN tbl_company ON tbl_company.company_id = tbl_company_employee.company_id 
			WHERE tbl_user.delete_flag='0' AND tbl_role.role_name LIKE '%employer%'  ";
	
	if(isset($_POST['filter_role']) && $_POST['filter_role'] != ''){
		$query .= 'AND tbl_user.role_id = "'.$_POST['filter_role'].'" ';
	}
	
	if(isset($_POST["search"]["value"])){
		$query .= 'AND (tbl_user.firstname LIKE "%'.$_POST["search"]["value"].'%" 
					OR tbl_user.lastname LIKE "%'.$_POST["search"]["value"].'%") ';
	}
	
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY tbl_user.userid ASC ';
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
		$userid_db = $row["userid"];
		
		if($active == '0'){
			$style = "style='color:#878787'";		//ia
			$value = "Restore";
			$name = "restore";
			$flag = "btn btn-default btn-xs inactive_flg";
		}
		else{
			$style = "style='color:#121212'";	  //active
			$value = "Archive";
			$name = "archive";
			$flag = "btn btn-danger btn-xs active_flg";
		}
	
		$sub_array[] = '<div data-id="'.$row["userid"].'" data-column="userid "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["userid"].'" data-column="firstname "'.$style.'">' . $row["firstname"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["userid"].'" data-column="lastname "'.$style.'">' . $row["lastname"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["userid"].'" data-column="username "'.$style.'">' . $row["username"] . '</div>';
		$sub_array[] = '<div data-id="'.$row["userid"].'" data-column="company_name "'.$style.'">' . $row["company_name"] . '</div>';
		$sub_array[] = '<button type="button" name="view"  class="view '.$flag.'"  id="'.$row["userid"].'">View</button>
					<button type="button" name="edit"  class="edit '.$flag.'"  id="'.$row["userid"].'">Edit</button>
					<button type="button name="'.$name.'" class="'.$name." ".$flag.'" id="'.$row["userid"].'">'.$value.'</button>
					<button type="button" name="delete" class="delete '.$flag.'" id="'.$row["userid"].'">Delete</button>';
		
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT tbl_user.userid, tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.active_flag, tbl_user.delete_flag,
				tbl_company.company_name
			FROM tbl_user 
			JOIN tbl_role ON tbl_role.role_id = tbl_user.role_id
			JOIN tbl_company_employee ON tbl_company_employee.userid = tbl_user.userid
			JOIN tbl_company ON tbl_company.company_id = tbl_company_employee.company_id 
			WHERE tbl_user.delete_flag='0' AND tbl_role.role_name LIKE '%employer%' ";
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