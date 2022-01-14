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
		
		$first_name = ucwords(mysqli_real_escape_string($con, $_POST["fname"]));  
		$last_name = ucwords(mysqli_real_escape_string($con, $_POST["lname"]));  
		$user_name = mysqli_real_escape_string($con, $_POST["uname"]);  
		$acct_type = mysqli_real_escape_string($con, $_POST["accttype"]); 
		
		if($_POST["pword"] == '') { //if empty password, give default 
			$user_pass = str_replace(' ', '', (strtoupper($last_name)));
		}
		else{ //else, textfield = value
			$user_pass = mysqli_real_escape_string($con, $_POST["pword"]); 
			$user_pass = str_replace(' ', '', (strtoupper($user_pass)));
		}
		
		$user_pass = md5($user_pass);	
		
		if(isset($_POST['status'])){
			$status = "0";
		}
		else{
			$status = "1";
		}
		
		//get user_id
		$cntuser_qry = "SELECT userid, COUNT(*) as total FROM tbl_user";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$user_id_db = "USER".$counter;
			}
		}
		
		//if existing users
		if($_POST["user_id"] != ''){ 
			
			if($_POST["pword"] == '') { //if empty password, proceed w/o
				$query = "  
					UPDATE tbl_user   
					SET username='$user_name', 
					firstname='$first_name',   
					lastname = '$last_name',   
					role_id = '$acct_type',
					attempts = '0',
					activetime = '$time',					
					active_flag = '$status'
					WHERE userid='".$_POST["user_id"]."'";  
				$message = 'Data Updated';  
			}
			
			else{ //else, textfield = value
				$query = "  
					UPDATE tbl_user   
					SET username='$user_name',   
					password='$user_pass',   
					firstname='$first_name',   
					lastname = '$last_name',   
					role_id = '$acct_type',
					attempts = '0',
					activetime = '$time',
					active_flag = '$status'
					WHERE userid='".$_POST["user_id"]."'";  
				$message = 'Data Updated';  
			}

		}
		
		//if new users	
		else{  
			
			$query = "INSERT INTO tbl_user (userid, username, password, role_id, attempts, activetime, firstname, lastname, forgotpass_flag, active_flag, delete_flag) 
						VALUES ('$user_id_db', '$user_name', '$user_pass', '$acct_type', '0', '$time', '$first_name', '$last_name', '1', '$status','0')";
			$message = 'Data Inserted'; 
			
		}
	
		if ($query!=""){
			if(mysqli_query($con, $query)){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../".$loc.".php\";
				</script>";
			}
		}
		
	}  
?>