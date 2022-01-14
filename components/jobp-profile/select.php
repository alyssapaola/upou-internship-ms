<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$current_date = date("Y-m-d");
	
	if(isset($_POST["id"]))  {  
		$output = '';  
		$query = "SELECT * FROM tbl_company 
					JOIN tbl_company_address1 ON tbl_company_address1.company_address_id = tbl_company.company_address_id
						JOIN cities ON cities.city_id = tbl_company_address1.city_id
						JOIN provinces ON provinces.province_id = tbl_company_address1.province_id 
					JOIN tbl_company_contact ON tbl_company_contact.company_contact_id = tbl_company.company_contact_id
					JOIN tbl_company_moa ON tbl_company_moa.company_moa_id = tbl_company.company_moa_id
					JOIN tbl_user ON tbl_user.userid = tbl_company.userid
				WHERE tbl_company.company_id = '".$_POST["id"]."'";  
		$result = mysqli_query($con, $query);  
		$output .= '  
			<div class="table-responsive">  
				<table class="table table-bordered">';  
			
				while($row = mysqli_fetch_array($result)) {  
					
					//COUNT OF EMPLOYEES
					$cntEmp_qry = "SELECT userid, COUNT(*) as total FROM tbl_company_employee WHERE company_id = '".$_POST["id"]."'";  
					$cntEmp_rslt = mysqli_query($con, $cntEmp_qry);
					if(mysqli_num_rows($cntEmp_rslt) > 0){
						while($cntEmp_row = mysqli_fetch_assoc($cntEmp_rslt)){
							$totalEmp = $cntEmp_row['total'];
						}
					}
		
					$company_id = $row['company_id'];
					$company_file = $row['company_file'];
					$company_img = $row['company_img'];
					
					$term_start = $row['term_start'];
					$term_end = $row['term_end'];
					
					$term_end_db = date("Y-m-d", strtotime($term_end));
					
					$term_start_str = date("F d, Y", strtotime($term_start));
					$term_end_str = date("F d, Y", strtotime($term_end));
					
					$date_modified = $row['date_modified'];
					$date_modified_str = date("F d, Y", strtotime($date_modified));
					
					if ($current_date >= $term_end_db) {
						$status = "For Renewal";
					}
					else {
						$status = "Active";
					}
		
					$output .= '  
						<tr>  
							<td width="30%"><label>Name</label></td>  
							<td width="70%">'.$row["company_name"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Description</label></td>  
							<td width="70%">'.$row["company_desc"].'</td>  
						</tr>  						
						<tr>  
							<td width="30%"><label>Registered Employees</label></td>  
							<td width="70%">'.$totalEmp.'</td>  
						</tr> 
						<tr>  
							<td width="30%" style="vertical-align: middle;"><label>Address</label></td>  
							<td width="70%">'.$row["address"].'<br>'.$row["city_name"].', '.$row["province_name"].'</td>  
						</tr>  
						
						<tr>  
							<td colspan="2"><label>Contact Information</label></td>  
						</tr>
						
						<tr>  
							<td width="30%"><label>Mobile Number: </label></td>  
							<td width="70%">'.$row["mobile_num"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Phone Number: </label></td>  
							<td width="70%">'.$row["phone_num"].'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Email: </label></td>  
							<td width="70%">'.$row["email"].'</td>  
						</tr>  
						
						<tr>  
							<td colspan="2"><label>Memorandum of Agreement</label></td>  
						</tr>
						<tr>  
							<td width="30%"><label>Status: </label></td>  
							<td width="70%">'.$status.'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>Duration: </label></td>  
							<td width="70%">'.$term_start_str.' - '.$term_end_str.'</td>  
						</tr>  
						<tr>  
							<td width="30%"><label>File</label></td>  
							<td width="70%"><a href="../upload/employer/'.$company_id.'/'.$company_file.'" download>'.$company_file.'</a></td>  
						</tr>  
						
						<tr>  
							<td colspan="2"><label>Logo</label></td>  
						</tr>
						<tr> 
							<td colspan="2"><img src="../upload/employer/'.$company_id.'/'.$company_img.'" height="200px" width="200px" /></td>  
							 
						</tr>
						
						<tr>  
							<td colspan="2"><label>Last Modified</label></td>  
						</tr>
						<tr>  
							<td width="30%"><label>User: </label></td>  
							<td width="70%">'.$row["firstname"].' '.$row['lastname'].'</td>  
						</tr> 
						<tr>  
							<td width="30%"><label>Date: </label></td>  
							<td width="70%">'.$date_modified_str.'</td>  
						</tr> 
					';  
				}  
			
			$output .= '
				</table>  
			</div>'; 
			
		echo $output;  
	}  
 ?>