<?php
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
	$userid = $_SESSION['userid'];
	$current = date("m/d/Y");
	
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
	
		//get company ID
		$cntID_qry = "SELECT company_id, COUNT(*) as total FROM tbl_company ";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$company_id_db = "COMPANY".$counter;
			}
		}
		
		//get address ID
		$cntID_qry = "SELECT company_address_id, COUNT(*) as total FROM tbl_company_address1 ";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$address_id_db = "C-ADDRESS".$counter;
			}
		}
		
		//get contact ID
		$cntID_qry = "SELECT company_contact_id, COUNT(*) as total FROM tbl_company_contact ";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$contact_id_db = "C-CONTACT".$counter;
			}
		}
		
		//get MOA ID
		$cntID_qry = "SELECT company_moa_id, COUNT(*) as total FROM tbl_company_moa ";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$moa_id_db = "C-MOA".$counter;
			}
		}
		
		//The name of the directory that we need to create.
		//$directoryName = "../../upload/student/".$student_number."/";
		$directoryName = "../upload/employer/".$company_id_db."/";
		
		//Check if the directory already exists.
		if(!is_dir($directoryName)){
			//Directory does not exist, so lets create it.
			mkdir($directoryName, 0755, true);
		}
		
		/* For the validation */
		
		//image
		$companyImg  = $_FILES['company_img']['name'];
		$companyImg_tmp  = $_FILES['company_img']['tmp_name'];
		$imageFileType = pathinfo($companyImg,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType);
		
		$newFileName_Img = "IMAGE.".$imageFileType;
		$locationImg = $directoryName.$newFileName_Img;
		
		
		//file
		$termFile  = $_FILES['term_file']['name'];
		$termFile_tmp  = $_FILES['term_file']['tmp_name'];
		/* Location */
		$termFileType = pathinfo($termFile,PATHINFO_EXTENSION);
		$termFileType = strtolower($termFileType);
		
		$newFileName_Term = "MOA-".$company_name.".".$termFileType;
		$locationFile = $directoryName.$newFileName_Term;
		
		if (file_exists($locationImg) || file_exists($locationFile) ) {
			if (file_exists($locationImg)) {
				$response .= 'Filename ' . $newFileName_Img . ' exists.'; 
				$response .= '\n';
			}
			if (file_exists($locationFile)) {
				$response .= 'Filename ' . $newFileName_Term . ' exists.';
				$response .= '\n';
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
			}
			else{
				$response = 'File Error: File extension is not valid';
				$response .= '\n';
			}
			
		}
		
		if($response == ""){
			
			$queryCompany = "INSERT INTO tbl_company (company_id, company_name, company_desc, company_address_id, company_contact_id, company_moa_id, company_img, userid, date_modified, delete_flag) 
						VALUES ('$company_id_db', '$company_name', '$company_desc', '$address_id_db', '$contact_id_db', '$moa_id_db', '$newFileName_Img', '$userid', '$current', '0')";
							
			$queryAddress = "INSERT INTO tbl_company_address1 (company_address_id, province_id, city_id, address) 
							VALUES ('$address_id_db', '$address_province', '$address_city', '$address_other')";
			
			$queryContact = "INSERT INTO tbl_company_contact (company_contact_id, mobile_num, phone_num, email) 
							VALUES ('$contact_id_db', '$company_mobile', '$company_phone', '$company_email')";
							
			$queryMOA = "INSERT INTO tbl_company_moa (company_moa_id, company_file, term_start, term_end) 
							VALUES ('$moa_id_db', '$newFileName_Term', '$term_start_db', '$term_end_db')";
							
			$message = 'Data Saved'; 
			
			if(mysqli_query($con, $queryAddress) && mysqli_query($con, $queryContact) && mysqli_query($con, $queryMOA) && mysqli_query($con, $queryCompany) ){  
				echo "<script language='JavaScript'>
					alert('".$message."');
					window.location = \"../manager/jobp-profile.php\";
				</script>";
			}
			else{
				array_map("unlink", glob("$directoryName/*")); array_map("rmdir", glob("$directoryName/*")); rmdir($directoryName);
				$message = "Error description: " . mysqli_error($con);
				echo "<script language='JavaScript'>
					alert('".$message."');
				</script>";
			}
			
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