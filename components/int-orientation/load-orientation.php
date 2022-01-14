<?php 
	// Initialize the session
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$orientation_qry = "SELECT * FROM tbl_orientation 
						JOIN tbl_acad_term ON tbl_orientation.term_id = tbl_acad_term.term_id
						WHERE tbl_orientation.term_id = '".$_POST["id"]."' AND tbl_orientation.delete_flag = '0'
						ORDER BY tbl_orientation.orientation_date ASC";
	$orientation_rslt = mysqli_query($con, $orientation_qry);
	if(mysqli_num_rows($orientation_rslt) > 0){
		while($row = mysqli_fetch_assoc($orientation_rslt)){
			$date_db = $row["orientation_date"];
			$date_db = date("F d, Y", strtotime($date_db));  
			
			$or_start_time = $row["orientation_start_time"];
			$or_end_time = $row["orientation_end_time"];
			$time_db = $or_start_time." - ".$or_end_time;
			
			$datetime = $date_db." / ".$time_db;
			
			$orientation_id = $row["orientation_id"];
			
			echo "<option value='".$orientation_id."'>".$datetime."</option>";
		}
	}
	else{
		echo "<option value='' disabled selected>No orientation data available yet</option>";
	}
?>