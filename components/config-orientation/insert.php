<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$loc = $_SESSION['loc'];
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
		
		//variable initialization
		$output = '';  
		$message = '';  
		
		//$datetime = $_POST["datetime"];
		//$date_db = date('m/d/Y',strtotime($datetime));
		//$time_db = date('h:i A',strtotime($datetime));
		
		$or_date = $_POST["or_date"];
		$or_start_time = $_POST["or_start_time"];
		$or_end_time = $_POST["or_end_time"];
		
		$or_date_db = date('m/d/Y',strtotime($or_date));
		//$time_db = date('h:i A',strtotime($datetime));
		
		$term_id = mysqli_real_escape_string($con, $_POST["acad_term"]); 
		$venue_id = mysqli_real_escape_string($con, $_POST["venue"]); 
		
		if(isset($_POST['status'])){
			$status = "1";
		}
		else{
			$status = "0";
		}
		
		//get orientation_id
		$cntuser_qry = "SELECT orientation_id, COUNT(*) as total FROM tbl_orientation";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$orientation_id_db = "OR".$counter;
			}
		}
		
		//if edit record
		if($_POST["orientation_id"] != ''){ 
			$query = "UPDATE tbl_orientation 
					SET term_id='$term_id', venue_id='$venue_id', orientation_date='$or_date_db', orientation_start_time='$or_start_time', orientation_end_time='$or_end_time', active_flag = '$status' 
					WHERE orientation_id='".$_POST["orientation_id"]."'";  
			$message = 'Data Updated';  
		}
		
		//if new	
		else{  			
			$query = "INSERT INTO tbl_orientation (orientation_id, term_id, venue_id, orientation_date, orientation_start_time, orientation_end_time, active_flag, delete_flag) 
						VALUES ('$orientation_id_db', '$term_id', '$venue_id', '$or_date_db', '$or_start_time', '$or_end_time', '$status', '0')";
			$message = 'Data Inserted'; 
		}
		
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../".$loc.".php\";
				</script>";
				unset($_SESSION['loc']);
			}
		}
		
	}  
?>