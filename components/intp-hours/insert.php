<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
		
		//variable initialization
		$output = '';  
		$message = '';  
		
		$int_hours_id = $_POST["int_hours_id"];
		$int_hours = mysqli_real_escape_string($con, $_POST["int_hours"]); 
		
		$course_id = mysqli_real_escape_string($con, $_POST["course_type"]); 
		$course_type_val = mysqli_real_escape_string($con, $_POST["course_type_val"]); 
		
		//get id
		$cntID_qry = "SELECT internship_hrs_id, COUNT(*) as total FROM tbl_internship_hours";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$int_hours_id_db = "HOURS".$counter;
			}
		}
		
		//if edit record
		if($_POST["int_hours_id"] != ''){ 
			if($course_id == ""){
				$course_id = $course_type_val;
			}
			$query = "UPDATE tbl_internship_hours 
					SET internship_hrs_id='$int_hours_id', internship_hrs='$int_hours', course_id='$course_id' WHERE internship_hrs_id='".$_POST["int_hours_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_internship_hours (internship_hrs_id, course_id, internship_hrs, delete_flag) 
					VALUES ('$int_hours_id_db', '$course_id', '$int_hours','0')";
			$message = 'Data Inserted'; 
		}
		
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../manager/intp-hours.php\";
				</script>";
				
			}
		}
		
	}  
?>