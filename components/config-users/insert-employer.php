<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	//if update/insert button is clicked
	if(!empty($_POST)){  
	
		//variable initialization
		$output = '';  
		$message = '';  
		
		$userid = $_POST["user_id"];
		$empid = $_POST["emp_id"];
		
		$first_name = ucwords(mysqli_real_escape_string($con, $_POST["fname"]));  
		$last_name = ucwords(mysqli_real_escape_string($con, $_POST["lname"]));  
		$user_name = mysqli_real_escape_string($con, $_POST["uname"]);  
		$acct_type = mysqli_real_escape_string($con, $_POST["accttype"]); 
		
		$emp_company = mysqli_real_escape_string($con, $_POST["emp_company"]); 
		$emp_dept = mysqli_real_escape_string($con, $_POST["emp_dept"]); 
		$emp_designation = mysqli_real_escape_string($con, $_POST["emp_designation"]); 
		
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
		
		//get emp_id
		$cntuser_qry = "SELECT employee_id, COUNT(*) as total FROM tbl_company_employee";
		$cntuser_rslt = mysqli_query($con, $cntuser_qry);
		if(mysqli_num_rows($cntuser_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntuser_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$emp_id_db = "C-EMP".$counter;
			}
		}
		
		//if existing users
		if($_POST["user_id"] != ''){ 
			
			if($_POST["pword"] == '') { //if empty password, proceed w/o
				$query = "UPDATE tbl_user   
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
				$query = "  UPDATE tbl_user   
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
			
			$query1 = "UPDATE tbl_company_employee   
					SET company_id='$emp_company',   
						department_id='$emp_dept',   
						employee_designation='$emp_designation' 
					WHERE employee_id='".$_POST["emp_id"]."'";  
			
		}
		
		//if new users	
		else{  
			
			$query = "INSERT INTO tbl_user (userid, username, password, role_id, attempts, activetime, firstname, lastname, forgotpass_flag, active_flag, delete_flag) 
						VALUES ('$user_id_db', '$user_name', '$user_pass', '$acct_type', '0', '$time', '$first_name', '$last_name', '1', '$status','0')";
			
			$query1 = "INSERT INTO tbl_company_employee (employee_id, userid, company_id, department_id, employee_designation) 
						VALUES ('$emp_id_db', '$user_id_db', '$emp_company', '$emp_dept', '$emp_designation')";
			
			$message = 'Data Inserted'; 
			
		}
	
		if ($query!="" && $query1!="") {
			if(mysqli_query($con, $query) && mysqli_query($con, $query1) ){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../manager/jobp-employers.php\";
				</script>";
			}
			else{
				$message = "Error description: " . mysqli_error($con);
				echo "<script language='JavaScript'>
					alert('".$message."');
				</script>";
			}
		}
		
	}  
?>