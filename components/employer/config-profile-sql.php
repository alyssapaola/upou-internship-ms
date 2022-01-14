<?php
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	$output_img = 0;
	
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
	
	if($company_mobile == ""){
		$company_mobile = "N/A";
	}
	
	if($company_phone == ""){
		$company_phone = "N/A";
	}
	
	$file_date = date('Md',strtotime($current));
	
	//proceed only if files has value
	$companyImg  = $_FILES['company_img']['name'];
	
	if ($companyImg != "" ){
		
		//The name of the directory that we need to create.
		//$directoryName = "../../upload/student/".$student_number."/";
		$directoryName = "../upload/employer/".$company_id."/";
		
		//Check if the directory already exists.
		if(!is_dir($directoryName)){
			//Directory does not exist, so lets create it.
			mkdir($directoryName, 0755, true);
		}
		
		$companyImg_tmp  = $_FILES['company_img']['tmp_name'];
		$imageFileType = pathinfo($companyImg,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType);
		
		//$newFileName_Img = "IMAGE.".$imageFileType;
		$newFileName_Img = "IMAGE (".$file_date.").".$imageFileType;
		$locationImg = $directoryName.$newFileName_Img;
		
		
		if (file_exists($locationImg) ) {
			$response .= 'Filename ' . $newFileName_Img . ' exists.'; 
			$response .= '\n';
			
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
	
	if(mysqli_query($con, $queryAddress) && mysqli_query($con, $queryContact) && mysqli_query($con, $queryCompany) ){  
		$message = 'Data Saved'; 
	}
	else{
		$response = "Error description: " . mysqli_error($con);
		unlink($locationImg);
	}
	
	if($response == ""){
		echo "<script language='JavaScript'>
			alert('".$message."');
			window.location = \"../employer/config-profile.php\";
		</script>";
		
	}
	else{
		echo "<script language='JavaScript'>
			alert('".$response."');
		</script>";
	}
	
	
?>