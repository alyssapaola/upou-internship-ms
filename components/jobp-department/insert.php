<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		//variable initialization
		$output = '';  
		$message = '';  
		
		$dept_name = ucwords(mysqli_real_escape_string($con, $_POST["dept_name"]));  
		
		//get venue_id
		$cntuser_qry = "SELECT department_id, COUNT(*) as total FROM tbl_company_dept";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$dept_id_db = "C-DEPT".$counter;
			}
		}
		
		//if edit record
		if($_POST["dept_id"] != ''){ 
			$query = "UPDATE tbl_company_dept SET department_name='$dept_name' WHERE department_id='".$_POST["dept_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_company_dept (department_id, department_name, delete_flag) VALUES ('$dept_id_db', '$dept_name','0')";
			$message = 'Data Inserted'; 
		}
		
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../manager/jobp-department.php\";
				</script>";
			}
		}
		
	}  
?>