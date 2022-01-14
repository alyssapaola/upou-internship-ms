<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
		
		//variable initialization
		$output = '';  
		$message = '';  
		
		$section_name = strtoupper(mysqli_real_escape_string($con, $_POST["section_name"]));  
		$college_id = mysqli_real_escape_string($con, $_POST["college_type"]); 
		
		$course_id = mysqli_real_escape_string($con, $_POST["course_type"]); 
		$course_type_val = mysqli_real_escape_string($con, $_POST["course_type_val"]); 
		
		if(isset($_POST['status'])){
			$status = "0";
		}
		else{
			$status = "1";
		}
		
		//get section_id
		$cntuser_qry = "SELECT section_id, COUNT(*) as total FROM tbl_section";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$section_id_db = "SEC".$counter;
			}
		}
		
		//if edit record
		if($_POST["section_id"] != ''){ 
			if($course_id == ""){
				$course_id = $course_type_val;
			}
			$query = "UPDATE tbl_section SET section_name='$section_name', college_id='$college_id', course_id='$course_id', active_flag = '$status' WHERE section_id='".$_POST["section_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_section (section_id, section_name, college_id, course_id, active_flag, delete_flag) VALUES ('$section_id_db', '$section_name', '$college_id', '$course_id', '$status','0')";
			$message = 'Data Inserted'; 
		}
		
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message	."');
					window.location = \"../manager/config-section.php\";
				</script>";
				
			}
		}
		
	}  
?>