<?php 
	// Initialize the session
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../../connect.php';
	
	$course_type_qry = "SELECT * FROM tbl_course WHERE college_id = '".$_POST["id"]."'";
	$course_type_rslt = mysqli_query($con, $course_type_qry);
	if(mysqli_num_rows($course_type_rslt) > 0){
		while($row = mysqli_fetch_assoc($course_type_rslt)){
			echo "<option value='".$row['course_id']."'>".$row['course_fullname']."</option>";
		}
	}
	else{
		echo "<option value='' disabled selected>No course available yet</option>";
	}
?>