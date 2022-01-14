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
		
		if(isset($_POST['status'])){
			$status = "0";
		}
		else{
			$status = "1";
		}
		
		//get COLLEGE_ID
		$cntuser_qry = "SELECT college_id, COUNT(*) as total FROM tbl_college";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$college_id_db = "COL".$counter;
			}
		}
		
		//if edit record
		if($_POST["college_id"] != ''){ 
			$query = "UPDATE tbl_college SET college_shortname='$c_shortname', college_fullname='$c_fullname', active_flag = '$status' WHERE college_id='".$_POST["college_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_college (college_id, college_shortname, college_fullname, active_flag, delete_flag) VALUES ('$college_id_db', '$c_shortname', '$c_fullname', '$status','0')";
			$message = 'Data Inserted'; 
		}
	
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../admin/college.php\";
				</script>";
			}
		}
		
	}  
?>