<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["user_id"]))  {  
		
		$user_id = $_POST["user_id"];
		//basic user
		$queryUser = "SELECT * FROM tbl_user WHERE userid = '$user_id'";  
		$rsltUser = mysqli_query($con, $queryUser);  
		
		$queryEduc = "SELECT tbl_student_educ_info.student_number, tbl_college.college_fullname, tbl_course.course_fullname, tbl_year_level.year_level_desc
				FROM tbl_student_educ_info 
					JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
					JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
					JOIN tbl_year_level ON tbl_student_educ_info.year_level_id = tbl_year_level.year_level_id
				WHERE tbl_student_educ_info.userid = '$user_id' AND tbl_student_educ_info.current_flag = '1' ";
		$rsltEduc = mysqli_query($con, $queryEduc);
		
		
		$queryContact = "SELECT contact_num, contact_email, contact_add FROM tbl_student_contact_info WHERE userid = '$user_id' AND current_flag = '1' ";
		$rsltContact = mysqli_query($con, $queryContact);
	
		$output = '';  
		$output .= '  
			<div class="table-responsive">  
				<table class="table table-bordered">';  
			
				while($row = mysqli_fetch_array($rsltUser)) {  
					$active_flag = $row["active_flag"];
					
					if ($active_flag == "0"){
						$status = "Suspended";
					}
					else{
						$status = "Active";
					}
					
					$output .= '  
						<tr>  
							<td width="30%"><label>First Name</label></td>  
							<td width="70%">'.$row["firstname"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Last Name</label></td>  
							<td width="70%">'.$row["lastname"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Username</label></td>  
							<td width="70%">'.$row["username"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Status</label></td>  
							<td width="70%">'.$status.'</td>  
						</tr> 
					';  
				}  
				
				$output .= '  
						<tr>  
							<td colspan="2"><label>Educational Information</label></td>  
							
						</tr>  
						';
						
				while($row = mysqli_fetch_array($rsltEduc)) {  
					
					$output .= '  
						<tr>  
							<td width="30%"><label>Student Number</label></td>  
							<td width="70%">'.$row["student_number"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>College</label></td>  
							<td width="70%">'.$row["college_fullname"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Course</label></td>  
							<td width="70%">'.$row["course_fullname"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Year Level</label></td>  
							<td width="70%">'.$row["year_level_desc"].'</td>  
						</tr> 
					';
				}

				$output .= '  
						<tr>  
							<td colspan="2"><label>Contact Information</label></td>  
						</tr>  
						';
						
				if(mysqli_num_rows($rsltContact) > 0){
					while($row = mysqli_fetch_array($rsltContact)) {  
						
						$output .= '  
							<tr>  
								<td width="30%"><label>Mobile Number</label></td>  
								<td width="70%">'.$row["contact_num"].'</td>  
							</tr>  
							<tr>  
								<td width="30%"><label>Email Address</label></td>  
								<td width="70%">'.$row["contact_email"].'</td>  
							</tr>  
							<tr>  
								<td width="30%"><label>Home Address</label></td>  
								<td width="70%">'.$row["contact_add"].'</td>  
							</tr>
						';
					} 
				}
				else{
					$output .= '  
						<tr>  
							<td colspan="2">No available data as of the moment. Advise student to update his/her profile.</td>  
						</tr>  
						';
				}
				
			$output .= '
				</table>  
			</div>'; 
			
		echo $output;  
	}  
 ?>