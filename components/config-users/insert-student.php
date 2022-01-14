<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	$loc = $_SESSION['loc'];
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		//variable initialization
		$output = '';  
		$message = '';  
		
		$first_name = ucwords(mysqli_real_escape_string($con, $_POST["fname"]));  
		$last_name = ucwords(mysqli_real_escape_string($con, $_POST["lname"]));  
		$user_name = mysqli_real_escape_string($con, $_POST["uname"]);  
		
		$stud_num = mysqli_real_escape_string($con, $_POST["stud_num"]);
		$college = mysqli_real_escape_string($con, $_POST["college"]);
		$course = mysqli_real_escape_string($con, $_POST["course"]);
		$course_val = mysqli_real_escape_string($con, $_POST["course_val"]); 
		$year_level = mysqli_real_escape_string($con, $_POST["year_level"]);
		
		$user_id = $_POST["user_id"];
		
		if($_POST["pword"] == '') { //if empty password, give default 
			$user_pass = str_replace(' ', '', (strtoupper($last_name)));
		}
		else{ //else, textfield = value
			$user_pass = mysqli_real_escape_string($con, $_POST["pword"]); 
			$user_pass = str_replace(' ', '', (strtoupper($user_pass)));
		}
		
		$user_pass = md5($user_pass);	
		
		if(isset($_POST['status'])){
			$status = "0";
		}
		else{
			$status = "1";
		}
		
		//get user_id
		$cntuser_qry = "SELECT userid, COUNT(*) as total FROM tbl_user";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$user_id_db = "USER".$counter;
			}
		}
		
		//get educ_info_id
		$cntID_qry = "SELECT educ_info_id, COUNT(*) as total FROM tbl_student_educ_info";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$educ_info_id_db = "EDUC".$counter;
			}
		}
				
		//get role id
		$acct_type_qry = "SELECT role_id FROM tbl_role WHERE role_name LIKE '%student%'";
		$acct_type_rslt = mysqli_query($con, $acct_type_qry);
		if(mysqli_num_rows($acct_type_rslt) > 0){
			while($row = mysqli_fetch_assoc($acct_type_rslt)){
				$acct_type = $row['role_id'];
			}
		}
		
		if($course == ""){
			$course = $course_val;
		}
	
		//if existing users = edit table
		if($user_id != ""){ 
			
			// FOR TBL_USER
			if($_POST["pword"] == "") { //if empty password, proceed w/o
				$query = "UPDATE tbl_user   
					SET username='$user_name', firstname='$first_name', lastname = '$last_name', role_id = '$acct_type', attempts = '0', activetime = '$time',					
						active_flag = '$status'
					WHERE userid = '$user_id'";  
			}
			
			else{ //else, textfield = value
				$query = "UPDATE tbl_user   
					SET username='$user_name', password='$user_pass', firstname='$first_name', lastname = '$last_name', role_id = '$acct_type', attempts = '0', activetime = '$time',
						active_flag = '$status'
					WHERE userid = '$user_id'";  
			}
			
			// FOR TBL_EDUC_INFO:
			
			//check if this data exists
			$changes_qry = "SELECT educ_info_id FROM tbl_student_educ_info  
						WHERE student_number = '$stud_num' AND college_id = '$college' AND course_id = '$course' AND year_level_id = '$year_level' AND current_flag = '1' AND userid = '$user_id'";
			$changes_rslt = mysqli_query($con, $changes_qry);
			
			if(mysqli_num_rows($changes_rslt) == 0){ //if no data exists = changes made
				
				//check if there is existing user id, update the current info flag then insert. Otherwise, just do insert.
				$dataQry = "SELECT educ_info_id FROM tbl_student_educ_info WHERE userid = '$user_id'";  
				$dataRslt = mysqli_query($con, $dataQry);
				if(mysqli_num_rows($dataRslt) > 0){
					$queryUpdate = "UPDATE tbl_student_educ_info SET current_flag='0' WHERE userid = '$user_id'";  
					mysqli_query($con, $queryUpdate);
				}
				
				$queryInsert = "INSERT INTO tbl_student_educ_info (educ_info_id, userid, student_number, college_id, course_id, year_level_id, current_flag) 
					VALUES ('$educ_info_id_db', '$user_id', '$stud_num', '$college','$course', '$year_level', '1' )";
				mysqli_query($con, $queryInsert);
				
			}
			
			$message = 'Data Updated';  
			
			if(mysqli_query($con, $query)  ){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../".$loc.".php\";
				</script>";
				unset($_SESSION['loc']);
			}	
			
		}
		
		//if new users	
		else{  
			
			$query = "INSERT INTO tbl_user (userid, username, password, role_id, attempts, activetime, firstname, lastname, forgotpass_flag, active_flag, delete_flag) 
						VALUES ('$user_id_db', '$user_name', '$user_pass', '$acct_type', '0', '$time', '$first_name', '$last_name', '1', '$status','0')";
			
			$query1 = "INSERT INTO tbl_student_educ_info (educ_info_id, userid, student_number, college_id, course_id, year_level_id, current_flag) 
					VALUES ('$educ_info_id_db', '$user_id_db', '$stud_num', '$college', '$course', '$year_level', '1' )";
			
			$message = 'Data Inserted'; 
			
			if(mysqli_query($con, $query) && mysqli_query($con, $query1) ){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../".$loc.".php\";
				</script>";
				unset($_SESSION['loc']);
			}	
			
		}
		
	}  
?>