<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	if(isset($_POST["user_id"]))  {  
		$output = '';  
		$query = "SELECT * FROM tbl_user 
				JOIN tbl_role ON tbl_user.role_id = tbl_role.role_id
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
							<td width="30%"><label>Role</label></td>  
							<td width="70%">'.$row["role_name"].'</td>  
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