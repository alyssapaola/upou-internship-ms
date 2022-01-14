<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["temp_id"]))  {  
		$output = '';  
		$query = "SELECT tbl_template.template_name, tbl_template.template_desc, tbl_template.template_size, tbl_user.firstname, tbl_user.lastname, tbl_template.file_modified, tbl_template.active_flag, tbl_template.template_dir, tbl_template_category.temp_category_name
				FROM tbl_template 
				JOIN tbl_user ON tbl_user.userid = tbl_template.userid
				JOIN tbl_template_category ON tbl_template_category.temp_category_id = tbl_template.temp_category_id
				WHERE tbl_template.template_id = '".$_POST["temp_id"]."'";  
		$result = mysqli_query($con, $query);  
		$output .= '  
			<div class="table-responsive">  
				<table class="table table-bordered">';  
			
				while($row = mysqli_fetch_array($result)) {  
					$active_flag = $row["active_flag"];
					
					$firstname = $row["firstname"];
					$lastname = $row["lastname"];
					$full_name = $firstname." ".$lastname;
					
					$date_db = $row["file_modified"];
					$date_db = date("F d, Y h:i a", strtotime($date_db));  
					
					if ($active_flag == "0"){
						$status = "Hidden";
					}
					else{
						$status = "Published";
					}
					
					$template_dir = $row["template_dir"];
		
					
					$output .= '  
						<tr>  
							<td width="30%"><label>Template Name</label></td>  
							<td width="70%">'.$row["template_name"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Description</label></td>  
							<td width="70%">'.$row["template_desc"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Category</label></td>  
							<td width="70%">'.$row["temp_category_name"].'</td>  
						</tr>
						<tr>  
							<td width="30%"><label>File Size</label></td>  
							<td width="70%">'.$row["template_size"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Last Modified by:</label></td>  
							<td width="70%">'.$full_name.'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Date Modified: </label></td>  
							<td width="70%">'.$date_db.'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Status</label></td>  
							<td width="70%">'.$status.'</td>  
						</tr>
						<tr>  
							<td colspan="2"><label> <u><a href="../upload/admin/'.$template_dir.'" download> Download File </u></a> </label></td>
						</tr>						
					';  
				}  
			
			$output .= '
				</table>  
			</div>'; 
			
		echo $output;  
	}  
 ?>