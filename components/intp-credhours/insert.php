<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
		
		//variable initialization
		$output = '';  
		$message = '';  
		
		$credit_id = $_POST["credit_id"];
		
		$credit_name = mysqli_real_escape_string($con, $_POST["credit_name"]);  
		$credit_hrs = mysqli_real_escape_string($con, $_POST["credit_hrs"]);  
		$college_type = mysqli_real_escape_string($con, $_POST["college_type"]);  
		
		//get id
		$cntID_qry = "SELECT credit_hrs_id, COUNT(*) as total FROM tbl_internship_hours_credit";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$cred_hours_id_db = "CRED".$counter;
			}
		}
		
		//if edit record
		if($_POST["credit_id"] != ''){ 
			$query = "UPDATE tbl_internship_hours_credit 
					SET credit_hrs_name='$credit_name', credit_hrs='$credit_hrs',  college_id='$college_type' 
					WHERE credit_hrs_id='".$_POST["credit_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_internship_hours_credit (credit_hrs_id, credit_hrs_name, credit_hrs, college_id, delete_flag) 
					VALUES ('$cred_hours_id_db', '$credit_name', '$credit_hrs', '$college_type', '0')";
			$message = 'Data Inserted'; 
		}
		
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../manager/intp-credhours.php\";
				</script>";
				
			}
		}
		
	}  
?>