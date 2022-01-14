<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"]))  {  
		$output = '';  
		$query = "SELECT tbl_orientation_registration.student_number, tbl_orientation_registration.date_registered, 
					tbl_orientation_registration.date_confirmed, tbl_orientation_registration.attendance_flag,
				tbl_user.firstname, tbl_user.lastname, 
				tbl_course.course_fullname, 
				tbl_orientation.orientation_date, tbl_orientation.orientation_start_time, tbl_orientation.orientation_end_time, 
				tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year
			FROM tbl_orientation_registration 
			JOIN tbl_user ON tbl_user.userid = tbl_orientation_registration.userid
			JOIN tbl_student_educ_info ON tbl_student_educ_info.student_number = tbl_orientation_registration.student_number
				JOIN tbl_course ON tbl_course.course_id = tbl_student_educ_info.course_id
			JOIN tbl_orientation ON tbl_orientation.orientation_id = tbl_orientation_registration.orientation_id
				JOIN tbl_acad_term ON tbl_acad_term.term_id = tbl_orientation.term_id
			WHERE tbl_orientation_registration.registration_id = '".$_POST["id"]."' AND tbl_student_educ_info.current_flag = '1'"; 
		$result = mysqli_query($con, $query);  
		$output .= '  
			<div class="table-responsive">  
				<table class="table table-bordered">';  
			
				while($row = mysqli_fetch_array($result)) {  
					$attendance_flag = $row["attendance_flag"];
					
					if ($attendance_flag == 0){
						$attendance = "No Attendance Record";
					}
					else{
						$attendance = "Attended";
					}
					
					$date_db = $row["orientation_date"];
					$date_db = date("F d, Y", strtotime($date_db));  
					
					$or_start_time = $row["orientation_start_time"];
					$or_end_time = $row["orientation_end_time"];
					$time_db = $or_start_time." - ".$or_end_time;
					
					$datetime = $date_db." / ".$time_db;
					
					$term_name = $row["term_name"];
					$term_from_year = $row["term_from_year"];
					$term_to_year = $row["term_to_year"];
					$term_desc = $term_name." AY ".$term_from_year." - ".$term_to_year;
					
					$date_registered = $row["date_registered"];
					if ($date_registered != "" && $date_registered != "N/A"){
						$date_registered_db = date("F d, Y h:i a", strtotime($date_registered));  
					}
					else{
						$date_registered_db = $date_registered;
					}
					
					$date_confirmed = $row["date_confirmed"];
					if ($date_confirmed != "" && $date_confirmed != "N/A"){
						$date_confirmed_db = date("F d, Y h:i a", strtotime($date_confirmed));  
					}
					else{
						$date_confirmed_db = $date_confirmed;
					}
					
					
					$output .= '
						<tr>  
							<td width="30%"><label>Orientation Registration No.</label></td>  
							<td width="70%">'.$_POST["id"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Student Number</label></td>  
							<td width="70%">'.$row["student_number"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Student Name</label></td>  
							<td width="70%">'.$row["firstname"].' '.$row["lastname"].'</td>  
						</tr> 
						<tr>  
							<td width="30%"><label>Course</label></td>  
							<td width="70%">'.$row["course_fullname"].'</td>  
						</tr> 						
						<tr>  
							<td width="30%"><label>Orientation Schedule</label></td>  
							<td width="70%">'.$datetime.'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Academic Term</label></td>  
							<td width="70%">'.$term_desc.'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Date Registered</label></td>  
							<td width="70%">'.$date_registered_db.'</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Status</label></td>  
							<td width="70%">'.$attendance.'</td>  
						</tr> 						
						<tr>  
							<td width="30%"><label>Date Attended</label></td>  
							<td width="70%">'.$date_confirmed_db.'</td>  
						</tr> 
					';  
				}  
			
			$output .= '
				</table>  
			</div>'; 
			
		echo $output;  
	}  
 ?>