<?php  
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	date_default_timezone_set('Asia/Manila');
	$current_date = date("m/d/Y");
	
	
	//variable initialization
	$output = '';  
	$message = '';  
	$response = 0;
	
	$term_end = mysqli_real_escape_string($con, $_POST["term_end"]);
	$term_end_db = date('m/d/Y',strtotime($term_end));
	
	$file_year = date('MY',strtotime($current_date));
	
	$company_id = $_POST['company_id'];
	$company_name = $_POST['company_name'];
	
	//The name of the directory that we need to create.

	$directoryName = "../../upload/employer/".$company_id."/";
	
	//Check if the directory already exists.
	if(!is_dir($directoryName)){
		//Directory does not exist, so lets create it.
		mkdir($directoryName, 0755, true);
	}
	
	/* For the validation */
	
	//file
	$termFile  = $_FILES['file']['name'];
	$termFile_tmp  = $_FILES['file']['tmp_name'];
	
	/* Location */
	$termFileType = pathinfo($termFile,PATHINFO_EXTENSION);
	$termFileType = strtolower($termFileType);
	
	$newFileName_Term = "MOA-Renew-".$company_name." (".$file_year.").".$termFileType;
	$locationFile = $directoryName.$newFileName_Term;
	
	if ( file_exists($locationFile) ) {
		$message .= 'Filename ' . $newFileName_Term . ' exists. Try uploading with revised filename'; 
	} 
	else{
		
		/* Valid extensions */
		$valid_extensions = array("pdf","doc","docx");
		
		/* Check file extension */
		if(in_array(strtolower($termFileType), $valid_extensions)) {				
			move_uploaded_file($termFile_tmp,$locationFile);
			
			//get MOA ID
			$cntID_qry = "SELECT company_moa_id FROM tbl_company WHERE company_id = '".$_POST["company_id"]."'";  
			$cntID_rslt = mysqli_query($con, $cntID_qry);
			if(mysqli_num_rows($cntID_rslt) > 0){
				while($row = mysqli_fetch_assoc($cntID_rslt)){
					$company_moa_id = $row['company_moa_id'];
				}
			}
			
			$query = "UPDATE tbl_company_moa SET company_file = '$newFileName_Term', term_end = '$term_end_db' WHERE company_moa_id = '$company_moa_id'";
			
		}
		else{
			
			$message = 'Internship File Error: File extension is not valid';
		}
	}
	
	if ($message==""){
		mysqli_query($con, $query);
	}
	
	else {
		$response = $message;
	}

	echo $response;

?>