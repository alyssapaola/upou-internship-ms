<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		//variable initialization
		$output = '';  
		$message = '';  
		
		$term_name = mysqli_real_escape_string($con, $_POST["term_name"]);  
		$to_year = mysqli_real_escape_string($con, $_POST["to_year"]);  
		$from_year = mysqli_real_escape_string($con, $_POST["from_year"]);  
		
		if(isset($_POST['status'])){
			$status = "0";
		}
		else{
			$status = "1";
		}
		
		if(isset($_POST['status_c'])){
			$status_c = "1";
		}
		else{
			$status_c = "0";
		}
		
		//get term_id
		$cntuser_qry = "SELECT term_id, COUNT(*) as total FROM tbl_acad_term";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$term_id_db = "TERM".$counter;
			}
		}
		
		//if edit record
		if($_POST["term_id"] != ''){ 
			$query = "UPDATE tbl_acad_term 
						SET term_name='$term_name', term_from_year='$from_year', term_to_year='$to_year', active_flag = '$status', current_flag = '$status_c' 
						WHERE term_id='".$_POST["term_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_acad_term (term_id, term_name, term_from_year, term_to_year, current_flag, active_flag, delete_flag) 
						VALUES ('$term_id_db', '$term_name', '$from_year','$to_year', '0', '$status','0')";
			$message = 'Data Inserted'; 
		}
	
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../admin/acad_term.php\";
				</script>";
			}
		}
		
	}  
?>