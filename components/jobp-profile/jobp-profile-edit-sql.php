<?php
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	$output_img = 0;
	$output_file = 0;
	
	$userid = $_SESSION['userid'];
	$current = date("m/d/Y");
	
	$company_id = $_POST["company_id"];
	$company_address_id = $_POST["company_address_id"];
	$company_contact_id = $_POST["company_contact_id"];
	$company_moa_id = $_POST["company_moa_id"];
	
	$company_name = ucwords(mysqli_real_escape_string($con, $_POST["company_name"]));
	$company_desc = ucwords(mysqli_real_escape_string($con, $_POST["company_desc"]));
	
	$address_province = mysqli_real_escape_string($con, $_POST["address_province"]);
	$address_city = mysqli_real_escape_string($con, $_POST["address_city"]);
	$address_other = ucwords(mysqli_real_escape_string($con, $_POST["address_other"]));
	
	$company_mobile = mysqli_real_escape_string($con, $_POST["company_mobile"]);
	$company_phone = mysqli_real_escape_string($con, $_POST["company_phone"]);
	$company_email = mysqli_real_escape_string($con, $_POST["company_email"]);
	
	$term_start = mysqli_real_escape_string($con, $_POST["term_start"]);
	$term_end = mysqli_real_escape_string($con, $_POST["term_end"]);
	
	$term_start_db = date('m/d/Y',strtotime($term_start));
	$term_end_db = date('m/d/Y',strtotime($term_end));
	
	$term_start_str = date("Y-m-d", strtotime($term_start));
	$term_end_str = date("Y-m-d", strtotime($term_end));
	
	if($company_mobile == ""){
		$company_mobile = "N/A";
	}
	
	if($company_phone == ""){
		$company_phone = "N/A";
	}
	
	if($term_start_str < $term_end_str ){
		
		$file_date = date('Md',strtotime($current));
		
		//proceed only if files has value
		$companyImg  = $_FILES['company_img']['name'];
		$termFile  = $_FILES['term_file']['name'];
		
		if ($companyImg != "" || $termFile != "" ){
			
			//The name of the directory that we need to create.
			//$directoryName = "../../upload/student/".$student_number."/";
			$directoryName = "../upload/employer/".$company_id."/";
			
			//Check if the directory already exists.
			if(!is_dir($directoryName)){
				//Directory does not exist, so lets create it.
				mkdir($directoryName, 0755, true);
			}
		
			if ($companyImg != ""){
				$companyImg_tmp  = $_FILES['company_img']['tmp_name'];
				$imageFileType = pathinfo($companyImg,PATHINFO_EXTENSION);
				$imageFileType = strtolower($imageFileType);
				
				//$newFileName_Img = "IMAGE.".$imageFileType;
				$newFileName_Img = "IMAGE (".$file_date.").".$imageFileType;
				$locationImg = $directoryName.$newFileName_Img;
			}
		
			if ($termFile != ""){
				//file
				$termFile  = $_FILES['term_file']['name'];
				$termFile_tmp  = $_FILES['term_file']['tmp_name'];
				/* Location */
				$termFileType = pathinfo($termFile,PATHINFO_EXTENSION);
				$termFileType = strtolower($termFileType);
				
				//$newFileName_Term = "MOA-".$company_name.".".$termFileType;
				$newFileName_Term = "MOA-".$company_name." (".$file_date.").".$termFileType;
				$locationFile = $directoryName.$newFileName_Term;
			}
			
			if (file_exists($locationImg) || file_exists($locationFile) ) {
				if (file_exists($locationImg)) {
					$response .= 'Filename ' . $newFileName_Img . ' exists.'; 
					$response .= '\n';
					$err = "img";
				}
				if (file_exists($locationFile)) {
					$response .= 'Filename ' . $newFileName_Term . ' exists.';
					$response .= '\n';
					$err = "file";
				}
				
				$response .= 'Try uploading with revised filename'; 
				$response .= '\n';
			}
			else{
				/* Valid extensions */
				$valid_extensions = array("jpg","png","jpeg");

				/* Check file extension */
				if(in_array(strtolower($imageFileType), $valid_extensions)) {				
					move_uploaded_file($companyImg_tmp,$locationImg);
					$output_img = 1;
				}
				else{
					$response .= 'Image Error: File extension is not valid';
					$response .= '\n';
				}
				
				/* Valid extensions */
				$valid_extensions = array("pdf","doc","docx");
				
				/* Check file extension */
				if(in_array(strtolower($termFileType), $valid_extensions)) {				
					move_uploaded_file($termFile_tmp,$locationFile);
					$output_file = 1;
				}
				else{
					$response = 'File Error: File extension is not valid';
					$response .= '\n';
				}
				
			}
		}
		
		//if img exists
		if ($output_img > 0){
			$queryCompany = "UPDATE tbl_company SET company_name = '$company_name', company_desc = '$company_desc', company_img = '$newFileName_Img', userid = '$userid', date_modified = '$current' WHERE company_id = '$company_id'";
		}
		else{
			$queryCompany = "UPDATE tbl_company SET company_name = '$company_name', company_desc = '$company_desc', userid = '$userid', date_modified = '$current' WHERE company_id = '$company_id'";
		}
		
		if ($address_city != ""){
			$queryAddress = "UPDATE tbl_company_address1 SET province_id = '$address_province', city_id = '$address_city', address = '$address_other' WHERE company_address_id = '$company_address_id'";
		}
		else{
			$queryAddress = "UPDATE tbl_company_address1 SET address = '$address_other' WHERE company_address_id = '$company_address_id'";
		}
		
		$queryContact = "UPDATE tbl_company_contact SET mobile_num = '$company_mobile', phone_num = '$company_phone', email = '$company_email' WHERE company_contact_id = '$company_contact_id'";
		
		//if file exists
		if ($output_file > 0){
			$queryMOA = "UPDATE tbl_company_moa SET company_file = '$newFileName_Term', term_start = '$term_start_db', term_end = '$term_end_db' WHERE company_moa_id = '$company_moa_id'";
		}
		else{
			$queryMOA = "UPDATE tbl_company_moa SET term_start = '$term_start_db', term_end = '$term_end_db' WHERE company_moa_id = '$company_moa_id'";
		}
		
		
		if(mysqli_query($con, $queryAddress) && mysqli_query($con, $queryContact) && mysqli_query($con, $queryMOA) && mysqli_query($con, $queryCompany) ){  
			$message = 'Data Saved'; 
		}
		else{
			$response = "Error description: " . mysqli_error($con);
			if($err == "img"){
				unlink($locationImg);
			}
			if($err == "file"){
				unlink($locationFile);
			}
		}
	
		if($response == ""){
			echo "<script language='JavaScript'>
				alert('".$message."');
				window.location = \"../manager/jobp-profile.php\";
			</script>";
			
		}
		else{
			echo "<script language='JavaScript'>
				alert('".$response."');
			</script>";
		}
		
	}
	
	else{
		echo "<script language='JavaScript'>
				alert('End of term must be higher that Start of term');
			</script>";	
	}
	
?>