<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';

	date_default_timezone_set('Asia/Manila');
	$timenow=time();	
	
	$orientation_id = $_POST["id"];
	
	if(isset($orientation_id)){ 
		
		$user_id = $_SESSION['userid'];
		
		$studnum_qry = "SELECT student_number FROM tbl_student_educ_info WHERE userid='$user_id' AND current_flag = '1'";
		$studnum_rslt = mysqli_query($con, $studnum_qry);
		if(mysqli_num_rows($studnum_rslt) > 0){
			while($row = mysqli_fetch_assoc($studnum_rslt)){
				$student_number = $row['student_number'];	
			}
		}
				
		$time_now = date("m/d/Y h:i a",$timenow);
		$year_now = date("Y");
		
		//get ID
		$cntID_qry = "SELECT registration_id, COUNT(*) as total FROM tbl_orientation_registration WHERE registration_id LIKE '%$year_now%'";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$registration_id_db = "REG-".$year_now."-".$counter;
			}
		}
		
		//get orientation details that was chosen
		$orientation_qry = "SELECT tbl_orientation.orientation_date, tbl_orientation.orientation_start_time,  tbl_orientation.orientation_end_time,
								tbl_venue.venue_name
							FROM tbl_orientation JOIN tbl_venue ON tbl_venue.venue_id = tbl_orientation.venue_id
							WHERE tbl_orientation.orientation_id='$orientation_id'";
		$orientation_rslt = mysqli_query($con, $orientation_qry);
		$orientation_row = mysqli_fetch_array($orientation_rslt);  									
		
		
		$query = "INSERT INTO tbl_orientation_registration (registration_id, userid, student_number, orientation_id, date_registered, attendance_flag, date_confirmed) VALUES ('$registration_id_db', '$user_id', '$student_number', '$orientation_id', '$time_now','0', '')";
	
		if(mysqli_query($con, $query)){
			echo json_encode($orientation_row);  
			//echo "success"; //anything on success
		} 
		else {
			die(header("HTTP/1.0 404 Not Found")); //Throw an error on failure
		}
	}
?>