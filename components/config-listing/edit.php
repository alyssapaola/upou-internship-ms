<?php
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	$userid = $_SESSION['userid'];
	$current = date("m/d/Y");
	
	$company_id = $_SESSION['company_id'];
	
	$job_id = $_POST["job_id"];
	
	$job_title = ucwords(mysqli_real_escape_string($con, $_POST["job_title"]));
	$job_desc = ucwords(mysqli_real_escape_string($con, $_POST["job_desc"]));
	$job_vac = mysqli_real_escape_string($con, $_POST["job_vac"]);
	
	$values_category = $_POST["job_category"];
	
	if (isset($_POST['job_salary'])){
		$job_salary = "1";
	}
	
	//get job category ID
	$cntID_qry = "SELECT job_category_id, COUNT(*) as total FROM tbl_job_category ";
	$cntID_rslt = mysqli_query($con, $cntID_qry);
	if(mysqli_num_rows($cntID_rslt) > 0){
		while($row = mysqli_fetch_assoc($cntID_rslt)){
			$total = $row['total'];
		}
	}
	
	//delete previous job categories
	$delete_qry = "UPDATE tbl_job_category SET delete_flag = '1' WHERE job_id = '$job_id' ";
	mysqli_query($con, $delete_qry);

	$updateJob = "UPDATE tbl_job SET job_name = '$job_title', job_desc = '$job_desc', num_vacancy = '$job_vac', allowance_flag = '$job_salary', date_modified = '$current', userid = '$userid' WHERE job_id = '$job_id' ";
	
	if(!mysqli_query($con, $updateJob) ){  
		$message1 = "Error description: " . mysqli_error($con);
		echo "<script language='JavaScript'>
			alert('".$message1."');
		</script>";
	}
	
	else{
		foreach ((array) $values_category as $category) {
			$total = $total+1;
			$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
			$job_category_id_db = "J-CATEGORY".$counter;
			
			$queryJobCat = "INSERT INTO tbl_job_category (job_category_id, job_id, course_id, delete_flag) 
						VALUES ('$job_category_id_db', '$job_id', '$category', '0')";
			
			//$count_category = $count_category+1;
			if(!mysqli_query($con, $queryJobCat) ){  
				$message2 = "Error description: " . mysqli_error($con);
				break;
			}
			
		}
		
		if($message2 != ""){
			echo "<script language='JavaScript'>
				alert('".$message2."');
			</script>";
		}
		else{
			echo "<script language='JavaScript'>
				alert('Data Saved');
				window.location = \"../employer/config-listing.php\";
			</script>";
		}
		
	}