<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		$section_id = $_POST['section_id'];
		$user_id = $_POST['user_id'];
	
		//get current term
		$term_qry = "SELECT term_id FROM tbl_acad_term WHERE  current_flag = '1' ";
		$term_rslt = mysqli_query($con, $term_qry);
		if(mysqli_num_rows($term_rslt) > 0){
			while($term_row = mysqli_fetch_assoc($term_rslt)){
				$term_id = $term_row['term_id'];
			}
		}
	
		$query = "INSERT INTO tbl_student_section (id, section_id, user_id, term_id) VALUES ('', '$section_id', '$user_id', '$term_id')";
		$message = 'Data Inserted'; 
		
		if(mysqli_query($con, $query)){  
			echo "<script language='JavaScript'>
				alert('".$message."');
				window.location = \"../staff/int-application-approved.php\";
			</script>";
		}
		
	}  
?>