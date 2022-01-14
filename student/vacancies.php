<?php
	// Initialize the session
	include '../connect.php';
	include '../components/student/get-details.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	$current = date("F d, Y");
	$year_now = date("Y");
	
	$word = "student";
	
	/*
	$_SESSION["loggedin"] = true;
	$_SESSION['userid'] = $db_userid;
	$_SESSION['role'] = $db_rolename;
	$_SESSION['fname'] = $db_fname;
	*/
	
	// Checks if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== $word ){
		header("location: ../login/index.php");
		exit;	
	}
	
	// checks if user completed already his profile. otherwise, send to profile
	if ($student_details_flag == 0){
		header("location: ../student/profile.php");
		exit;
	}
	
	$user_id = $_SESSION['userid'];
	
	//get current acad term
	$queryTerm = "SELECT term_id FROM tbl_acad_term WHERE current_flag ='1'";
	$resultTerm = mysqli_query($con, $queryTerm);
	while($rowTerm = mysqli_fetch_array($resultTerm)){	
		$term_id = $rowTerm['term_id'];
		$_SESSION['term_id'] = $term_id;
	}
	
	//check if job application is approved
	$queryCheck = "SELECT * FROM tbl_job_application WHERE userid ='$user_id' AND term_id ='$term_id' AND status_flag = '1'";
	$resultCheck = mysqli_query($con, $queryCheck);
	if(mysqli_num_rows($resultCheck) > 0){
		$_SESSION['vac_err'] = "1";
		require_once "vac-err.php";
	}
	
	else{	
	
		//check internship application if approved:
		$queryApp = "SELECT * FROM tbl_internship_application 
				JOIN tbl_acad_term ON tbl_internship_application.term_id = tbl_acad_term.term_id
				WHERE tbl_internship_application.userid ='$user_id' AND tbl_internship_application.active_flag ='1' AND tbl_acad_term.current_flag = '1' AND tbl_internship_application.status_flag ='1'";
		$resultApp = mysqli_query($con, $queryApp);
		if(mysqli_num_rows($resultApp) > 0){
			
			//check if there is an existing job for respective course
			$queryJob = "SELECT * FROM  tbl_job 
					JOIN tbl_company ON tbl_company.company_id = tbl_job.company_id
					JOIN tbl_company_address1 ON tbl_company_address1.company_address_id = tbl_company.company_address_id
						JOIN provinces ON provinces.province_id = tbl_company_address1.province_id
						JOIN cities ON cities.city_id = tbl_company_address1.city_id
					JOIN tbl_job_category ON tbl_job_category.job_id = tbl_job.job_id
					WHERE tbl_job.delete_flag = '0' AND tbl_job.active_flag = '1' 
						AND tbl_job_category.delete_flag = '0' AND tbl_job_category.course_id = '$course_id'
					ORDER BY tbl_job.job_name ASC";
			$resultJob = mysqli_query($con, $queryJob);
			if(mysqli_num_rows($resultJob) > 0){
				require_once "vac-view.php";
			}
			else{
				$_SESSION['vac_err'] = "2";
				require_once "vac-err.php";
			}
		}
		
		//else, no data yet:
		else{
			$_SESSION['vac_err'] = "3";
			require_once "vac-err.php";
		}
		
	}
	
	
?>