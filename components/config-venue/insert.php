<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		//variable initialization
		$output = '';  
		$message = '';  
		
		$venue_name = ucwords(mysqli_real_escape_string($con, $_POST["venue_name"]));  
		
		if(isset($_POST['status'])){
			$status = "0";
		}
		else{
			$status = "1";
		}
		
		//get venue_id
		$cntuser_qry = "SELECT venue_id, COUNT(*) as total FROM tbl_venue";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$venue_id_db = "VENUE".$counter;
			}
		}
		
		//if edit record
		if($_POST["venue_id"] != ''){ 
			$query = "UPDATE tbl_venue SET venue_name='$venue_name',  active_flag = '$status' WHERE venue_id='".$_POST["venue_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_venue (venue_id, venue_name, active_flag, delete_flag) VALUES ('$venue_id_db', '$venue_name', '$status','0')";
			$message = 'Data Inserted'; 
		}
		
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../admin/venue.php\";
				</script>";
			}
		}
		
	}  
?>