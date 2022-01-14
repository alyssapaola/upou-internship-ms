<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["id"]))  {  
		$output = '';  
		$query = "SELECT * FROM  tbl_job 
				JOIN tbl_user ON tbl_user.userid = tbl_job.userid
				WHERE tbl_job.job_id = '".$_POST["id"]."'";  
		$result = mysqli_query($con, $query);  
		$output .= '  
			<div class="table-responsive">  
				<table class="table table-bordered">';  
			
				while($row = mysqli_fetch_array($result)) {  
					
					$job_id = $row["job_id"];
					$allowance_flag = $row["allowance_flag"];
					$active_flag = $row["active_flag"];
					
					$firstname = $row["firstname"];
					$lastname = $row["lastname"];
					$full_name = $firstname." ".$lastname;
					
					$date_db = $row["date_modified"];
					$date_db = date("F d, Y", strtotime($date_db));  
					
					$query1 = "SELECT tbl_course.course_fullname FROM  tbl_job_category 
							JOIN tbl_course ON tbl_course.course_id = tbl_job_category.course_id
							WHERE tbl_job_category.job_id = '$job_id' AND tbl_job_category.delete_flag = '0' 
							ORDER BY tbl_course.course_fullname ASC";  
					$result1 = mysqli_query($con, $query1);  
					while($row1 = mysqli_fetch_array($result1)) {  
						$courses[] = $row1["course_fullname"];
					}
					
					//$courses_str = var_dump(implode(",", $courses));
		
					if ($allowance_flag == "0"){
						$status = "No";
					}
					else{
						$status = "Yes";
					}
					
					if ($active_flag == "0"){
						$status = "Expired";
					}
					else{
						$status = "Active";
					}
					
					$output .= '  
						<tr>  
							<td width="30%"><label>Job Title</label></td>  
							<td width="70%">'.$row["job_name"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Description</label></td>  
							<td width="70%">'.$row["job_desc"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Number of Vacancies</label></td>  
							<td width="70%">'.$row["num_vacancy"].'</td>  
						</tr>
						<tr>  
							<td width="30%"><label>With Allowance? </label></td>  
							<td width="70%">'.$allowance_flag.'</td>  
						</tr>
						<tr>  
							<td width="30%"><label>Tagged Courses </label></td>  
							<td width="70%">'.implode(" , ",$courses).'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Status</label></td>  
							<td width="70%">'.$status.'</td>  
						</tr>	
						<tr>  
							<td width="30%"><label>Last Modified by:</label></td>  
							<td width="70%">'.$full_name.'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Date Modified: </label></td>  
							<td width="70%">'.$date_db.'</td>  
						</tr>  
					';  
				}  
			
			$output .= '
				</table>  
			</div>'; 
			
		echo $output;  
	}  
 ?>