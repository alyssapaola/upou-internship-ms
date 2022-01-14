<?php
	
	$staff_info = $_POST["staff_info"];
	$section_category = $_POST["section_category"];
	
	//get job ID
	$cntID_qry = "SELECT sec_assign_id, COUNT(*) as total FROM tbl_section_assignment ";
	$cntID_rslt = mysqli_query($con, $cntID_qry);
	if(mysqli_num_rows($cntID_rslt) > 0){
		while($row = mysqli_fetch_assoc($cntID_rslt)){
			$total = $row['total'];
		}
	}
	
	foreach ((array) $section_category as $category) {
		$total = $total+1;
		$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
		$sec_category_id_db = "SEC-ASSIGN-".$counter;
		
		//check if existing
		$check_qry = "SELECT sec_assign_id FROM tbl_section_assignment WHERE section_id = '$category' AND delete_flag = '0' ";
		$check_rslt = mysqli_query($con, $check_qry);
		if(mysqli_num_rows($check_rslt) > 0){
			$message = "Assignment already exists";
			break;
		}
		
		else{	
			$queryJobCat = "INSERT INTO tbl_section_assignment (sec_assign_id, section_id, user_id, delete_flag) 
						VALUES ('$sec_category_id_db', '$category', '$staff_info', '0')";
			
			//$count_category = $count_category+1;
			if(!mysqli_query($con, $queryJobCat) ){  
				$message = "Error description: " . mysqli_error($con);
				break;
			}
		}
		
	}
	
	if($message != ""){
		echo "<script language='JavaScript'>
			alert('".$message."');
		</script>";
	}
	else{
		echo "<script language='JavaScript'>
			alert('Data Saved');
			window.location = \"../manager/intp-assignment.php\";
		</script>";
	}

?>
	