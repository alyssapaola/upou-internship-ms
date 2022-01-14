<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["user_id"]))  {  
		$output = '';  
		$query = "SELECT tbl_user.username, tbl_user.firstname, tbl_user.lastname, tbl_user.active_flag, 
				tbl_company.company_name, tbl_company_dept.department_name, tbl_company_employee.employee_designation
			FROM tbl_user 
			JOIN tbl_company_employee ON tbl_company_employee.userid = tbl_user.userid
				JOIN tbl_company ON tbl_company.company_id = tbl_company_employee.company_id 
				JOIN tbl_company_dept ON tbl_company_dept.department_id = tbl_company_employee.department_id
			WHERE tbl_user.userid = '".$_POST["user_id"]."'";  
		$result = mysqli_query($con, $query);  
		$output .= '  
			<div class="table-responsive">  
				<table class="table table-bordered">';  
			
				while($row = mysqli_fetch_array($result)) {  
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
							<td width="30%"><label>Company Affiliated</label></td>  
							<td width="70%">'.$row["company_name"].'</td>   
						</tr> 
						<tr>  
							<td width="30%"><label>Department</label></td>  
							<td width="70%">'.$row["department_name"].'</td>   
						</tr> 
						<tr>  
							<td width="30%"><label>Designation</label></td>  
							<td width="70%">'.$row["employee_designation"].'</td>   
						</tr> 
						
						<tr>  
							<td width="30%"><label>Status</label></td>  
							<td width="70%">'.$status.'</td>  
						</tr> 
					';  
				}  
			
			$output .= '
				</table>  
			</div>'; 
			
		echo $output;  
	}  
 ?>