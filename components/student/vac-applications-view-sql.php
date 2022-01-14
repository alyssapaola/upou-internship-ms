<?php

	if(isset($_POST['term_id'])){
		$term_id = $_POST['term_id'];
	}
	else{
		$term_id = $_SESSION['term_id'];
	}
	
	$user_id = $_SESSION['userid'];

	//check internship application if approved:
	$queryApp = "SELECT application_id FROM tbl_internship_application WHERE userid ='$user_id' AND term_id = '$term_id' AND tbl_internship_application.status_flag ='1'";
	$resultApp = mysqli_query($con, $queryApp);
	while($rowApp = mysqli_fetch_array($resultApp)){
		$application_id = $rowApp["application_id"];
	}

	$job_application_id = $_POST['job_application_id'];
		
	//get job application details
	$query = "SELECT tbl_job_application.status_flag, tbl_job_application.date_applied, 
					tbl_job.job_name, tbl_company.company_name, 
					tbl_status.status_name, 
					tbl_internship_application.application_img, 
					tbl_user.firstname, tbl_user.lastname, tbl_user.username, 
					tbl_course.course_fullname, tbl_year_level.year_level_desc, 
					tbl_student_contact_info.contact_num, tbl_student_contact_info.contact_email, tbl_student_contact_info.contact_add, 
					tbl_internship_hours.internship_hrs,
					tbl_job_application_desc.skills, tbl_job_application_desc.description
		FROM tbl_job_application 
		JOIN tbl_job_application_desc ON tbl_job_application_desc.job_application_id = tbl_job_application.job_application_id
		JOIN tbl_job ON tbl_job.job_id = tbl_job_application.job_id
		JOIN tbl_company ON tbl_company.company_id = tbl_job.company_id
		JOIN tbl_status ON tbl_status.status_id = tbl_job_application.status_flag
		JOIN tbl_user ON tbl_user.userid = tbl_job_application.userid 
		JOIN tbl_internship_application ON tbl_internship_application.userid = tbl_job_application.userid
			JOIN tbl_student_contact_info ON tbl_internship_application.contact_info_id = tbl_student_contact_info.contact_info_id
			JOIN tbl_student_educ_info ON tbl_internship_application.educ_info_id = tbl_student_educ_info.educ_info_id
				JOIN tbl_college ON tbl_student_educ_info.college_id = tbl_college.college_id
				JOIN tbl_course ON tbl_student_educ_info.course_id = tbl_course.course_id
				JOIN tbl_year_level ON tbl_student_educ_info.year_level_id = tbl_year_level.year_level_id
			JOIN tbl_internship_hours ON tbl_internship_application.internship_hrs_id = tbl_internship_hours.internship_hrs_id
		WHERE tbl_job_application.job_application_id = '$job_application_id' AND tbl_internship_application.application_id = '$application_id' ";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result)){
		$company_name = $row["company_name"];
		$job_name = $row["job_name"];
		
		$status_name = $row["status_name"];
		$status_flag = $row["status_flag"];
		
		$date_applied = $row['date_applied'];
		$date_db = date("F d, Y", strtotime($date_applied));
		
		$application_img = $row['application_img'];
		$dir = "../upload/student/".$application_id."/".$application_img."";
		
		$firstname = $row["firstname"];
		$lastname = $row["lastname"];	
		$fullName = $firstname." ".$lastname;
		
		$course_fullname = $row["course_fullname"];	
		$year_level_desc = $row['year_level_desc'];
		
		$username = $row['username'];
		$contact_num = $row['contact_num'];
		$contact_email = $row['contact_email'];
		$contact_add = $row['contact_add'];
		
		$internship_hrs = $row['internship_hrs'];
		
		$skills = $row['skills'];
		$description = $row['description'];
		
	}

?>