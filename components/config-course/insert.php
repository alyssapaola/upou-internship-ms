<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
		
		//variable initialization
		$output = '';  
		$message = '';  
		
		$c_shortname = ucwords(mysqli_real_escape_string($con, $_POST["cshortname"]));  
		$c_fullname = mysqli_real_escape_string($con, $_POST["cfullname"]);  
		$college_id = mysqli_real_escape_string($con, $_POST["college_type"]); 
		
		if(isset($_POST['status'])){
			$status = "0";
		}
		else{
			$status = "1";
		}
		
		//get course_id
		$cntuser_qry = "SELECT course_id, COUNT(*) as total FROM tbl_course";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$course_id_db = "COU".$counter;
			}
		}
		
		//if edit record
		if($_POST["course_id"] != ''){ 
			$query = "UPDATE tbl_course SET course_shortname='$c_shortname', course_fullname='$c_fullname', college_id='$college_id', active_flag = '$status' WHERE course_id='".$_POST["course_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_course (course_id, course_shortname, course_fullname, college_id, active_flag, delete_flag) VALUES ('$course_id_db', '$c_shortname', '$c_fullname', '$college_id', '$status','0')";
			$message = 'Data Inserted'; 
		}
		
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../admin/course.php\";
				</script>";
				
			}
		}
		
	}  
?>