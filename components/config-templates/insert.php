<?php

error_reporting (E_ALL ^ E_NOTICE);
session_start();
include '../../connect.php';

$user_id = $_SESSION['userid'];

date_default_timezone_set('Asia/Manila');
$timenow = time();	

if(!empty($_POST)){  	
	
	$response = 0;

	$time_now = date("m/d/Y h:i a",$timenow);
	
	$template_desc = mysqli_real_escape_string($con, $_POST["template_desc"]); 
	$template_name = mysqli_real_escape_string($con, $_POST["template_name"]); 
	$template_cat = mysqli_real_escape_string($con, $_POST["template_cat"]); 
	
	if(isset($_POST['status'])){
		$status = "1";
	}
	else{
		$status = "0";
	}
	
	//get template_id
	$cnttemp_qry = "SELECT template_id, COUNT(*) as total FROM tbl_template";
	$cnttemp_rslt = mysqli_query($con, $cnttemp_qry);
	if(mysqli_num_rows($cnttemp_rslt) > 0){
		while($row = mysqli_fetch_assoc($cnttemp_rslt)){
			$total = $row['total'];
			$total = $total+1;
			$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
			$template_id_db = "TEMP".$counter;
		}
	}
		
	/* Getting file SIZE */
	$filesize = $_FILES['file']['size'];
	
	if ($filesize >= 1073741824){
		$bytes = number_format($filesize / 1073741824, 2) . ' GB';
    }
    elseif ($filesize >= 1048576){
        $bytes = number_format($filesize / 1048576, 2) . ' MB';
    }
    elseif ($filesize >= 1024){
        $bytes = number_format($filesize / 1024, 2) . ' KB';
    }
    elseif ($filesize > 1){
        $bytes = $filesize . ' bytes';
    }
    elseif ($filesize == 1){
        $bytes = $filesize . ' byte';
    }
    else{
        $bytes = '0 bytes';
    }

	/* Getting file name */
	$filename = $_FILES['file']['name'];
	
	/* Location */
	//$location = "../../upload/admin/".$filename;
	$imageFileType = pathinfo($filename,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
	
	$directory = "../../upload/admin/";
	$newFileName = $template_name.".".$imageFileType;
	$location = $directory.$newFileName;
	
	if (file_exists($location)) {
		$response = 'Filename ' . $newFileName . ' exists. Try uploading with revised filename'; 
		
		echo $response;
		exit;
	} 
	
	else {
		//$alert = 'The file ' . $location . ' does not exist';
		
		/* Valid extensions */
		$valid_extensions = array("pdf","doc","docx");


		/* Check file extension */
		if(in_array(strtolower($imageFileType), $valid_extensions)) {

			/* Upload file */
			//if (move_uploaded_file($_FILES["file"]["tmp_name"], "../../upload/admin/" . $newfilename)){
			if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
				
				//if edit record
				if($_POST["template_id"] != ''){ 
					$query = "UPDATE tbl_template 
							SET template_name='$template_name', template_desc='$template_desc', template_size='$bytes', template_dir = '$newFileName', file_modified = '$time_now', temp_category_id = '$template_cat', active_flag = '$status', userid = '$user_id' 
							WHERE template_id='".$_POST["template_id"]."'"; 
				}
				
				//if new	
				else{  			
					$query = "INSERT INTO tbl_template (template_id, template_name, template_desc, template_size, template_dir, file_modified, temp_category_id, userid, active_flag, delete_flag) 
							VALUES ('$template_id_db', '$template_name', '$template_desc',  '$bytes', '$newFileName', '$time_now', '$template_cat', '$user_id', '$status', '0')";
				}
				
				if(mysqli_query($con, $query)){
					$response = 0;
				}
				else{
					$response = 'Error on query';
				}
				
			}
			else{
				$response = 'File not uploaded';
			}
		}
		else{
			$response = 'File extension is not valid';
		}
		
		echo $response;
		exit;
	}
	
}

echo 0;

?>