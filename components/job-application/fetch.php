<?php
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$company_id = $_SESSION['company_id'];
	
	date_default_timezone_set('Asia/Manila');
	
	$columns = array('job_id','job_name', 'job_id', 'job_id', 'job_id', 'job_id');
	
	$query = "SELECT * FROM  tbl_job WHERE company_id ='$company_id' AND delete_flag = '0' ";
	
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
		$job_id = $row["job_id"];
		$active = $row["active_flag"];
		
		//get count: 1 approved; 2 disapproved; 0 pending
		$getnum_qry = "SELECT COUNT(job_application_id) AS countPending FROM tbl_job_application WHERE job_id = '$job_id' AND status_flag = '2' ";  
		$getnum_rslt = mysqli_query($con, $getnum_qry);
		while($getnum_row = mysqli_fetch_array($getnum_rslt)) {  
			$count_pending = $getnum_row["countPending"];
		}
		
		//get count: 1 approved; 2 disapproved; 0 pending
		$getnum_qry1 = "SELECT COUNT(job_application_id) AS countApproved FROM tbl_job_application WHERE job_id = '$job_id' AND status_flag = '1' ";  
		$getnum_rslt1 = mysqli_query($con, $getnum_qry1);
		while($getnum_row1 = mysqli_fetch_array($getnum_rslt1)) {  
			$count_approved = $getnum_row1["countApproved"];
		}
		
		//get count: 1 approved; 2 disapproved; 0 pending
		$getnum_qry2 = "SELECT COUNT(job_application_id) AS countDisapproved FROM tbl_job_application WHERE job_id = '$job_id' AND status_flag = '0' ";  
		$getnum_rslt2 = mysqli_query($con, $getnum_qry2);
		while($getnum_row2 = mysqli_fetch_array($getnum_rslt2)) {  
			$count_disapproved = $getnum_row2["countDisapproved"];
		}
		
		$count_total = $count_pending + $count_approved + $count_disapproved;
		
		//check if item is active or not
		if($active == '0'){
			$style = "style='color:#878787'";		//ia
		}
		else{
			//$style = "style='color:#121212'";	  
			$style = "style='color:#121212'";	//active
		}
		
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="job_id "'.$style.'">' . $i . '</div>';
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="job_name "'.$style.'">' .  $row['job_name'] . '</div>';
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="active_flag "'.$style.'"><a href="job-application-view.php?id='.$row["job_id"].'&&stat=2">' . $count_pending . '</div>';
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="active_flag "'.$style.'"><a href="job-application-view.php?id='.$row["job_id"].'&&stat=1">' . $count_approved . '</div>';
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="active_flag "'.$style.'"><a href="job-application-view.php?id='.$row["job_id"].'&&stat=0">' . $count_disapproved . '</div>';
		$sub_array[] = '<div data-id="'.$row["job_id"].'" data-column="active_flag "'.$style.'">' . $count_total . '</div>';
						
		$data[] = $sub_array;
	}
	
	function get_all_data($con){
		$query = "SELECT * FROM  tbl_job WHERE company_id ='$company_id' AND delete_flag = '0' ";
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