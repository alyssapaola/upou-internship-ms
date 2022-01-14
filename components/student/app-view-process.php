<?php
	// Initialize the session
	include '../../connect.php';
	include 'get-details.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	$timenow=time();	
	$time_now = date("m/d/Y h:i a",$timenow);
	$year_now = date("Y");
	
	$user_id = $_SESSION['userid'];
	$term_desc = $_SESSION['term_desc'];
	$term_id = $_SESSION['term_id'];
	$application_id_db = $_SESSION['application_id_db'];
	
	//$reset = $_SESSION['reset'];
	
	if(isset($_POST["submitForm"]) && isset($_POST['status'])){

		//The name of the directory that we need to create.
		//$directoryName = "../../upload/student/".$student_number."/";
		$directoryName = "../../upload/student/".$application_id_db."/";
		
		//Check if the directory already exists.
		if(!is_dir($directoryName)){
			//Directory does not exist, so lets create it.
			mkdir($directoryName, 0755, true);
		}
		
		/*
		//The name of the directory that we need to create.
		$directoryName1 = "../../upload/student/".$student_number."/".$term_desc."/";

		//Check if the directory already exists.
		if(!is_dir($directoryName1)){
			//Directory does not exist, so lets create it.
			mkdir($directoryName1, 0755, true);
		}
		*/
		
		//for tbl_internship_application_files
		$countfiles = count($_FILES['internshipFile']['name']);
		for($i=0;$i<$countfiles;$i++){
			$internshipFile  = $_FILES['internshipFile']['name'][$i];
			$internshipFile_tmp  = $_FILES['internshipFile']['tmp_name'][$i];
			$internshipFile_size = $_FILES['internshipFile']['size'][$i];
			$templateID = $_POST['templateID'][$i];
			
			/* Getting file SIZE */
			if ($internshipFile_size >= 1073741824){
				$bytes = number_format($internshipFile_size / 1073741824, 2) . ' GB';
			}
			elseif ($internshipFile_size >= 1048576){
				$bytes = number_format($internshipFile_size / 1048576, 2) . ' MB';
			}
			elseif ($internshipFile_size >= 1024){
				$bytes = number_format($internshipFile_size / 1024, 2) . ' KB';
			}
			elseif ($internshipFile_size > 1){
				$bytes = $internshipFile_size . ' bytes';
			}
			elseif ($internshipFile_size == 1){
				$bytes = $internshipFile_size . ' byte';
			}
			else{
				$bytes = '0 bytes';
			}
			
			//get ID
			$cntID_qry = "SELECT application_file_id, COUNT(*) as total FROM tbl_internship_application_files";
			$cntID_rslt = mysqli_query($con, $cntID_qry);
			if(mysqli_num_rows($cntID_rslt) > 0){
				while($row = mysqli_fetch_assoc($cntID_rslt)){
					$total = $row['total'];
					$total = $total+1;
					$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
					$file_id_db = "INTFILE".$counter;
				}
			}
		
			/* Location */
			$imageFileType = pathinfo($internshipFile,PATHINFO_EXTENSION);
			$imageFileType = strtolower($imageFileType);
			
			$newFileName = $lastname."-".$templateID.".".$imageFileType;
			$location = $directoryName.$newFileName;
	
			if (file_exists($location)) {
				$response = 'Filename ' . $newFileName . ' exists. Try uploading with revised filename'; 
				break;
			} 
			else{
				/* Valid extensions */
				$valid_extensions = array("pdf","doc","docx");

				/* Check file extension */
				if(in_array(strtolower($imageFileType), $valid_extensions)) {				
					move_uploaded_file($internshipFile_tmp,$location);
					
					$query = "INSERT INTO tbl_internship_application_files (application_file_id, template_id, application_file_size, application_file_dir, application_id) 
							VALUES ('$file_id_db', '$templateID', '$bytes', '$newFileName', '$application_id_db' )";
					mysqli_query($con, $query);
				}
				else{
					$response = 'Internship Files Error: File extension is not valid';
					break;
				}
			}
		}
		
		//for tbl_internship_application_credit
		$countQuery = "SELECT credit_hrs_id, COUNT(*) as total FROM tbl_internship_hours_credit WHERE college_id = '$college_id' ";
		$countRslt = mysqli_query($con, $countQuery);
		if(mysqli_num_rows($countRslt) > 0){
			while($row = mysqli_fetch_assoc($countRslt)){
				$countCreditHrs = $row['total'];
			}
		}
		
		for($i=0;$i<$countCreditHrs;$i++){
			$credithrsFile  = $_FILES['credithrsFile']['name'][$i];
			$credithrsFile_tmp  = $_FILES['credithrsFile']['tmp_name'][$i];
			$credithrsFile_size = $_FILES['credithrsFile']['size'][$i];
			$credithrsID = $_POST['credithrsID'][$i];
			
			if(!empty($credithrsFile)){
				
				/* Getting file SIZE */
				if ($credithrsFile_size >= 1073741824){
					$bytes = number_format($credithrsFile_size / 1073741824, 2) . ' GB';
				}
				elseif ($credithrsFile_size >= 1048576){
					$bytes = number_format($credithrsFile_size / 1048576, 2) . ' MB';
				}
				elseif ($credithrsFile_size >= 1024){
					$bytes = number_format($credithrsFile_size / 1024, 2) . ' KB';
				}
				elseif ($credithrsFile_size > 1){
					$bytes = $credithrsFile_size . ' bytes';
				}
				elseif ($credithrsFile_size == 1){
					$bytes = $credithrsFile_size . ' byte';
				}
				else{
					$bytes = '0 bytes';
				}
				
				//get ID
				$cntID_qry = "SELECT application_credit_id, COUNT(*) as total FROM tbl_internship_application_credit";
				$cntID_rslt = mysqli_query($con, $cntID_qry);
				if(mysqli_num_rows($cntID_rslt) > 0){
					while($row = mysqli_fetch_assoc($cntID_rslt)){
						$total = $row['total'];
						$total = $total+1;
						$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
						$credit_id_db = "CREDIT".$counter;
					}
				}
		
				/* Location */
				$imageFileType = pathinfo($credithrsFile,PATHINFO_EXTENSION);
				$imageFileType = strtolower($imageFileType);
				
				$newFileName = $lastname."-".$credithrsID.".".$imageFileType;
				$location = $directoryName.$newFileName;
		
				if (file_exists($location)) {
					if($response!=""){
						$response .= '\n';
					}
					$response .= 'Filename ' . $newFileName . ' exists. Try uploading with revised filename'; 
					break;
				} 
				
				else{
					/* Valid extensions */
					$valid_extensions = array("pdf","doc","docx");

					/* Check file extension */
					if(in_array(strtolower($imageFileType), $valid_extensions)) {				
						move_uploaded_file($credithrsFile_tmp,$location);
	
						$query = "INSERT INTO tbl_internship_application_credit (application_credit_id, credit_hrs_id, application_credit_size, application_credit_dir, application_id, status_flag) VALUES ('$credit_id_db', '$credithrsID', '$bytes', '$newFileName', '$application_id_db', '2')";
						mysqli_query($con, $query);
					}
					else{
						if($response!=""){
							$response .= '\n';
						}
						$response .= 'Crediting Files Error: File extension is not valid';
						break;
						
					}
				}
				
			}
		}
		
		/* For the image validation */
		$internshipImg  = $_FILES['app_img']['name'];
		$internshipImg_tmp  = $_FILES['app_img']['tmp_name'];
		$imageFileType = pathinfo($internshipImg,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType);
		
		$newFileName_Img = $lastname."- IMAGE.".$imageFileType;
		$location = $directoryName.$newFileName_Img;
		
		if (file_exists($location)) {
			if($response!=""){
				$response .= '\n';
			}
			$response .= 'Filename ' . $newFileName_Img . ' exists. Try uploading with revised filename'; 
			
		} 
		
		else{
			/* Valid extensions */
			$valid_extensions = array("jpg","png","jpeg");

			/* Check file extension */
			if(in_array(strtolower($imageFileType), $valid_extensions)) {				
				move_uploaded_file($internshipImg_tmp,$location);
			}
			else{
				if($response!=""){
					$response .= '\n';
				}
				$response .= 'Application Image Error: File extension is not valid';
			}
		}
		
		$internship_hours = $_POST['internship_hours'];
		
		//no error
		if ($response == ""){
			//for tbl_internship_application_files
			$queryApplication = "INSERT INTO tbl_internship_application (application_id, userid, term_id, educ_info_id, contact_info_id, emergency_info_id, internship_hrs_id, application_img, date_applied, status_flag, comment, date_confirmed, staff_confirmed, active_flag) 
			VALUES ('$application_id_db', '$user_id', '$term_id', '$educ_info_id', '$contact_info_id', '$emergency_info_id','$internship_hours', '$newFileName_Img', '$time_now', '2', '', '', '','1')";
			mysqli_query($con, $queryApplication);
			
			//reset the former application
			if(isset($_SESSION['reset'])){
				$queryUpdate = "UPDATE tbl_internship_application SET active_flag = '0' WHERE application_id = '".$_SESSION["reset"]."'";
				mysqli_query($con, $queryUpdate);
			}
			
			echo "<script language='JavaScript'>
					alert(\"Congratulations! Application has been submitted. \")
					window.location = \"../../student/application.php\";
				</script>";
		}
		
		//else 
		else{
			//delete the moved files on dir 
			array_map("unlink", glob("$directoryName/*")); array_map("rmdir", glob("$directoryName/*")); rmdir($directoryName);
			
			//delete entry on database:
			$query = "DELETE FROM tbl_internship_application_credit WHERE application_id = '$application_id_db'";
			mysqli_query($con, $query);
			
			$query1 = "DELETE FROM tbl_internship_application_files WHERE application_id = '$application_id_db'";
			mysqli_query($con, $query1);
			
			echo "<script language='JavaScript'>
					alert(\"$response\")
					window.location = \"../../student/application.php\";
				</script>";
		}
		
	}
	
?>