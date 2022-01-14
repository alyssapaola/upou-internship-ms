<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	$year_now = date("Y");
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		//variable initialization
		$output = '';  
		$message = '';  
		
		//$acad_term_select = mysqli_real_escape_string($con, $_POST["acad_term_select"]);  
		$orientation_select = mysqli_real_escape_string($con, $_POST["orientation_select"]); 
		$stud_num = mysqli_real_escape_string($con, $_POST["stud_num"]); 
		$datetime_input = mysqli_real_escape_string($con, $_POST["datetime_input"]); 
		
		
		$query_date = "SELECT * FROM tbl_orientation WHERE orientation_id = '$orientation_select'";
		$result_date = mysqli_query($con, $query_date);
		while($row = mysqli_fetch_array($result_date)){		
			$or_end_time = $row["orientation_end_time"];
			$time_db = $or_start_time." - ".$or_end_time;
			
			$or_date = $row["orientation_date"];
			$date_db = date("F d, Y", strtotime($or_date));
		}
		
		$date_database = date("Y-m-d", strtotime($or_date));
		$time_database = date("H:i", strtotime($or_end_time));
		$time_database_one = date("H:i", strtotime($or_end_time)+ 60*60);
		
		$datetime_database = $date_database." ".$time_database;
		$datetime_database_one = $date_database." ".$time_database_one;
		
		//$current = date("Y-m-d H:i");
		$datetime = date("Y-m-d H:i", strtotime($datetime_input));
		
		//if date input is in range of the end time + 1 hour, proceed
		if ($datetime >= $datetime_database && $datetime <= $datetime_database_one) {
			
			//get user_id
			$user_qry = "SELECT userid FROM tbl_student_educ_info  WHERE student_number = '".$stud_num."' AND current_flag = '1'"; 
			$user_rslt = mysqli_query($con, $user_qry);
			if(mysqli_num_rows($user_rslt) > 0){
				while($row = mysqli_fetch_assoc($user_rslt)){
					$userid_db = $row['userid'];
				}
			}
			
			//get ID
			$cntID_qry = "SELECT registration_id, COUNT(*) as total FROM tbl_orientation_registration WHERE registration_id LIKE '%$year_now%'";
			$cntID_rslt = mysqli_query($con, $cntID_qry);
			if(mysqli_num_rows($cntID_rslt) > 0){
				while($row = mysqli_fetch_assoc($cntID_rslt)){
					$total = $row['total'];
					$total = $total+1;
					$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
					$registration_id_db = "REG-".$year_now."-".$counter;
				}
			}
		
			//if existing users
			if($_POST["registration_id"] != ''){ 
				
				$query = "UPDATE tbl_orientation_registration   
						SET orientation_id='$orientation_select', attendance_flag='1',   date_confirmed = '$datetime_input'
						WHERE registration_id='".$_POST["registration_id"]."'";  
					$message = 'Data Updated';  
					
			}
			
			//if new users	
			else{  
				
				$query = "INSERT INTO tbl_orientation_registration (registration_id, userid, student_number, orientation_id, date_registered, attendance_flag, date_confirmed) VALUES ('$registration_id_db', '$userid_db', '$stud_num', '$orientation_select', 'N/A', '1', '$datetime_input')";
				$message = 'Data Inserted'; 
				
			}
		
			if ($query!=""){
				if(mysqli_query($con, $query)){  
					echo "<script language='JavaScript'>
						alert('".$message."');
						window.location = \"../staff/int-orientation.php\";
					</script>";
				}
			}
			
		}
		else{
			echo 1;
		}
		
		
		
	}  
?>