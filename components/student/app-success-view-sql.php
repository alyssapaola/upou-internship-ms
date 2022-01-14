<?php
	
	if(isset($_SESSION['applicationid'])){
		$application_id = $_SESSION['applicationid'];
	}
	
	if(isset($_POST['application_id'])){
		$application_id = $_POST['application_id'];
	}
	
	//check if application details
	$query = "SELECT tbl_internship_application.date_applied, tbl_internship_application.application_img, tbl_internship_application.status_flag, tbl_internship_application.comment, tbl_internship_application.date_confirmed, tbl_internship_application.staff_confirmed, 
				tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year,
				tbl_student_educ_info.student_number, 
				tbl_college.college_id, tbl_course.course_fullname, tbl_year_level.year_level_desc, 
				tbl_user.firstname, tbl_user.lastname, tbl_user.username,
				tbl_student_contact_info.contact_num, tbl_student_contact_info.contact_email, tbl_student_contact_info.contact_add,
				tbl_student_emergency_info.emergency_name, tbl_student_emergency_info.emergency_rel, tbl_student_emergency_info.emergency_num, tbl_student_emergency_info.emergency_add,
				tbl_internship_hours.internship_hrs,
				tbl_status.status_name 
			FROM tbl_internship_application 
			JOIN tbl_acad_term ON tbl_internship_application.term_id = tbl_acad_term.term_id
			JOIN tbl_student_educ_info ON tbl_internship_application.educ_info_id = tbl_student_educ_info.educ_info_id
				JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
				JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
				JOIN tbl_year_level ON tbl_student_educ_info.year_level_id = tbl_year_level.year_level_id
			JOIN tbl_user ON tbl_internship_application.userid = tbl_user.userid 
			JOIN tbl_student_contact_info ON tbl_internship_application.contact_info_id = tbl_student_contact_info.contact_info_id
			JOIN tbl_student_emergency_info ON tbl_internship_application.emergency_info_id	 = tbl_student_emergency_info.emergency_info_id	
			JOIN tbl_internship_hours ON tbl_internship_application.internship_hrs_id = tbl_internship_hours.internship_hrs_id
			JOIN tbl_status ON tbl_status.status_id = tbl_internship_application.status_flag
			WHERE tbl_internship_application.application_id = '$application_id'";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$term_name = $row["term_name"];
			$term_from_year = $row["term_from_year"];
			$term_to_year = $row["term_to_year"];
			$term_desc = $term_name.", AY ".$term_from_year." - ".$term_to_year;
			
			$date_applied = $row['date_applied'];
			$date_db = date("F d, Y", strtotime($date_applied));
			
			$student_number = $row['student_number'];
			$_SESSION['student_number'] = $student_number;
			
			$application_img = $row['application_img'];
			
			$dir = "../upload/student/".$application_id."/".$application_img."";
			$dir1 = "../../upload/student/".$application_id."/".$application_img."";
			$_SESSION['dir1'] = $dir1;
			
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];	
			
			$fullName = $firstname." ".$lastname;
			$_SESSION['fullName'] = $fullName;
			
			$username = $row['username'];
			
			$course_fullname = $row["course_fullname"];	
			$year_level_desc = $row['year_level_desc'];
			$college_id = $row['college_id'];
			
			$contact_num = $row['contact_num'];
			$contact_email = $row['contact_email'];
			$contact_add = $row['contact_add'];
			
			$emergency_name = $row['emergency_name'];
			$emergency_rel = $row['emergency_rel'];
			$emergency_num = $row['emergency_num'];
			$emergency_add = $row['emergency_add'];
			
			$internship_hrs = $row['internship_hrs'];
			
			$status_flag = $row['status_flag'];
			$status_name = $row['status_name'];
			
			$comment  = $row['comment'];
			
			$date_confirmed =  $row['date_confirmed'];
			$date_confirmed_db = date("F d, Y", strtotime($date_confirmed));
			
			$staff_confirmed = $row['staff_confirmed'];
			
			//for printing of pdf report
			$output .= '<h4 align="center">'.$term_desc.'</h4>
			<table >
				<tr  style="line-height: 20px;" >  
					<td colspan="2"></td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Date Filed: </b></td>  
					<td>'.$date_db.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Name: </b></td>  
					<td>'.$fullName.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Year and Course: </b></td>  
					<td>'.$year_level_desc.' '.$course_fullname.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Mobile Number: </b></td>  
					<td>'.$contact_num.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Primary Email Address: </b></td>  
					<td>'.$username.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Alternate Email Address</b></td>  
					<td>'.$contact_email.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Home Address: </b></td>  
					<td>'.$contact_add.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td colspan="2"></td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td width="200px;" style=" text-align: left;"><b>Internship Hours: </b></td>  
					<td>'.$internship_hrs.' hours</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td colspan="2"></td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					<td colspan="2"><label><i><u>In case of emergency contact </u></i></label></td>  	
				</tr>
			</table>
			
			<table>
				<tr  style="line-height: 20px;" >  
					<td width="150px;" style=" text-align: left;"><b>Name: </b></td>  
					<td width="200px;">'.$emergency_name.'</td>  
					<td width="150px;" style=" text-align: left;"><b>Relationship: </b></td>  
					<td>'.$emergency_rel.'</td>  
				</tr>
				<tr  style="line-height: 20px;" >  
					
					<td width="150px;" style=" text-align: left;"><b>Home Address: </b></td>  
					<td width="200px;">'.$emergency_add.'</td>  
					<td width="150px;" style=" text-align: left;"><b>Mobile Number: </b></td>  
					<td>'.$emergency_num.'</td>  
				</tr>
			</table>';
		}	
	
		//for crediting	
		$final_hrs = "_____  ";
		$approved_credit_hrs = "_____  ";
		$credit_hrs = "_____  ";
		
		$output_cr .= '
		<table>  
			<tr>  
				<td width="150px;" ><i><b>To be filled out by CSI:</b></i></td> 
			</tr>';
			
		$query1 = "SELECT credit_hrs_id, credit_hrs_name, credit_hrs FROM tbl_internship_hours_credit WHERE college_id = '$college_id'";
		$result1 = mysqli_query($con, $query1);
		if(mysqli_num_rows($result1) > 0){
			
			while($row1 = mysqli_fetch_array($result1)){	
				$credit_hrs_name = $row1['credit_hrs_name'];
				$credit_hrs_id = $row1['credit_hrs_id'];
				
				if ($status_flag != "2"){ //if application is pending, do not show hours
				
					$query2 = "SELECT status_flag FROM tbl_internship_application_credit WHERE credit_hrs_id = '$credit_hrs_id'";
					$result2 = mysqli_query($con, $query2);
					if(mysqli_num_rows($result2) > 0){
						while($row2 = mysqli_fetch_array($result2)){
							$status_flag_cr = $row2['status_flag'];
						
							if($status_flag_cr == "1"){
								$credit_hrs = $row1['credit_hrs'];
								$approved_credit_hrs = $approved_credit_hrs + $credit_hrs;
							}
							else{
								$credit_hrs = "0";
								$approved_credit_hrs = "0";
							}
						}
					}
					else{
						$credit_hrs = "0";
						$approved_credit_hrs = "0";
					}
				}
				
				$output_cr .= '
					<tr>  
						<td width="250px;" >'.$credit_hrs_name.'</td>  
						<td width="100px;">'.$credit_hrs.' hrs</td>
					</tr>';		
			}
			
			if($status_flag_cr == "1"){
				$final_hrs = $internship_hrs - $approved_credit_hrs;
			}
			else if($status_flag_cr == "0"){
				$final_hrs = $internship_hrs;
			}
		}
		//for printing of pdf report
		$output_cr .= '
			<tr>
				<td width="250px;"><b>Total credited hours</b></td>  
				<td width="100px;"><b>'.$approved_credit_hrs.' hrs</b></td>
			</tr> 	
			<tr>
				<td width="250px;"><b>Total internship hours</b></td>  
				<td width="100px;"><b>'.$final_hrs.' hrs</b></td>
			</tr> 	
		</table>';
		
		
		//for staff information
		$query3 = "SELECT firstname, lastname FROM tbl_user WHERE userid = '$staff_confirmed'";
		$result3 = mysqli_query($con, $query3);
		if(mysqli_num_rows($result3) > 0){
		
			while($row3 = mysqli_fetch_array($result3)){	
				$staff_fname = $row3['firstname'];
				$staff_lname = $row3['lastname'];
				$staff_fullname = "<b>sgd. </b> &nbsp; &nbsp; ".$staff_fname." ".$staff_lname."</td>";
			}
			
			
		}
		else{
			
			$staff_fullname = "_________________________________";
			$date_confirmed_db = "_________________________________";
		}
		
		//for printing of pdf report
		$output_user .= '
		<table>  
			<tr>  
				<td style="text-indent:400px;"><b>Checked by:</b></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr> 
			<tr>
				<td style="text-indent:400px;">'.$staff_fullname.'</td>
			</tr> 	
			<tr>
				<td style="text-indent:440px;">Signature over Printed Name</td>
			</tr> 
			<tr>
				<td style="text-indent:470px;">Internship Adviser</td>
			</tr>
			<tr>
				<td></td>
			</tr> 
			<tr>  
				<td style="text-indent:400px;"><b>Date:</b></td>
			</tr>
			<tr>
				<td></td>
			</tr> 
			<tr>
				<td style="text-indent:400px;">'.$date_confirmed_db.'</td>
			</tr> 	
		</table>';
	
	}
?>