<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	$word = "manager";
	
	$loc = $word."/intp-students";
	$_SESSION['loc'] = $loc;
	
	/*
	$_SESSION["loggedin"] = true;
	$_SESSION['userid'] = $db_userid;
	$_SESSION['role'] = $db_rolename;
	$_SESSION['fname'] = $db_fname;
	*/
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== $word ){
		header("location: ../login/index.php");
		exit;	
	}
	
	//$connect = new PDO("mysql:host=localhost;dbname=db_ojt", "root", "");
	
	//FOR COLLEGE FILTER SELECT OPTION
	$college_info = '';
	$query_1 = "SELECT * FROM tbl_college WHERE delete_flag='0' ORDER BY college_shortname ASC";
	$statement_1 = $connect->prepare($query_1);
	$statement_1->execute();
	$result_1 = $statement_1->fetchAll();
	foreach($result_1 as $row){
		$college_id = $row['college_id'];
		$college_shortname = $row["college_shortname"];
		$college_info .= '<option value="'.$college_id.'">'.$college_shortname.'</option>';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Internship Management System</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="" name="keywords">
		<meta content="" name="description">
		
		<!-- Favicons -->
		<link rel="apple-touch-icon" sizes="180x180" href="../img/favicon_io/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon_io/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon_io/favicon-16x16.png">
		<link rel="manifest" href="../img/favicon_io/site.webmanifest">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">
		
		<!-- Bootstrap CSS File
		<link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">  -->
		
		<!-- Libraries CSS Files -->
		<link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../lib/animate/animate.min.css" rel="stylesheet">
		<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
		<link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
		
		<!-- Main Stylesheet File -->
		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/popup.css" rel="stylesheet">
		
		<!-- Stylesheet/JS file for DataTable  -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> 
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<!-- JavaScript Libraries -->
		<script src="../lib/easing/easing.min.js"></script>
		<script src="../lib/mobile-nav/mobile-nav.js"></script>
		<script src="../lib/wow/wow.min.js"></script>
		<script src="../lib/waypoints/waypoints.min.js"></script>
		<script src="../lib/counterup/counterup.min.js"></script>
		<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
		<script src="../lib/isotope/isotope.pkgd.min.js"></script>
		<script src="../lib/lightbox/js/lightbox.min.js"></script>

		<!-- Template Main Javascript File -->
		<script src="../lib/js/main.js"></script>
		
		<!-- =======================================================
			Theme Name: Rapid
			Theme URL: https://bootstrapmade.com/rapid-multipurpose-bootstrap-business-template/
			Author: BootstrapMade.com
			License: https://bootstrapmade.com/license/
		======================================================= -->
	</head>
	
	<style>
		#header {
			background: #f2f2f2;
		}
		#about{
			padding-top: 100px;	
		}
		.about-content{
			 margin: auto;
			width: 100%;
		}
		
		.listRight {
			left: auto !important;
			right: 220px; !important;
		}

		.main-nav .drop-down .drop-right > a:after {
		  content: "\f104";
		  position: absolute;
		  left: 0px;
		}
		
		<!-- Stylesheet for DataTable -->
		.active_flg {
			background-color: #940000;
			color: white;
			border: 2px solid #940000;
		}
		.active_flg:hover{color:#fff;background-color:#EE0000    ;border-color:#940000}
		
		.inactive_flg {
			background-color: #474747;
			color: white;
			border: 2px solid #474747;
		}
		.inactive_flg:hover{color:#333;background-color:#e6e6e6;border-color:#474747}
		
		.float-left{float:left!important}.float-right{float:right!important}
		
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-family: "Montserrat", sans-serif;
			font-weight: 400;
			margin: 0 0 20px 0;
			padding: 0;
		}

		body {
			background: #fff;
			color: #444;
			font-family: "Open Sans", sans-serif;
		}
		
		/* For select filter_role setting */
		#filter_role, #filter_role_1{
			width:250px;  
			height:40px;line-height:30px;    
		}
		
		/* Create two equal columns that floats next to each other */
		.form-group {
			float: left;
			width: 22%;
			padding: 20px;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		@media screen and (max-width: 600px) {
			.column {
				width: 100%;
			}	
		}
	</style>

	<body>
	
		<!--==========================
		Header
		============================-->
		<header id="header">
			<div id="topbar">
				<div class="container">
					<div class="social-links">
						<span style="font-size:14px; font-family: Montserrat, sans-serif; font-style: italic">Hello, <?php echo $_SESSION['fname']; ?> </span>
						<a href="https://www.facebook.com/lpu.csi.iao/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
						<a href="https://www.instagram.com/lpu.csi.iao/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
					</div>
				</div>
			</div>
		
			<div class="container">
				<div class="logo float-left">
					<!-- Uncomment below if you prefer to use an image logo -->
					<h1 class="text-light"><a href="intp-students.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="active drop-down"><a href="#">Internship Portal</a>
							<ul>
								<li><a href="intp-assignment.php">Faculty Assignment</a></li>
								<li class="drop-down"><a href="#">Internship/Credit Hours</a>
									<ul>
										<li><a href="intp-hours.php">Internship Hours</a></li>
										<li><a href="intp-credhours.php">Internship Credit Hours</a></li>
									</ul>
								</li>
								<li><a href="intp-orientation.php">Orientation</a></li>
								<li class="active"><a href="intp-students.php">Students</a></li>
								<li><a href="intp-templates.php">Templates</a>
							</ul>
						</li>
						<li class="drop-down"><a href="#">Job Portal</a>
							<ul>	
								<li><a href="jobp-profile.php">Company Profile</a></li>
								<li><a href="jobp-department.php">Configure Department</a></li>
								<li><a href="jobp-employers.php">Employer Information</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="#">Configuration</a>
							<ul>
								<li><a href="config-section.php">Manage Section</a></li>
								<li><a href="config-users.php">Manage Users</a>
							</ul>
						</li>
						<li><a href="../login/logout.php">Logout</a></li>
					</ul>
				</nav><!-- .main-nav -->
				
			</div>
		</header><!-- #header -->
	
		<main id="main">
		
			<!--==========================
			Main Content
			============================-->
			<section id="about" >
				<div class="container">
					<div class="row">
					
						<div class="about-content"  style="text-align:justify;">
							<h2>Students</h2>
							<h4>Displays all students enrolled in the system</h4>
						</div>
						
						<div class="table-responsive">
							
							<div class="row">
								<div class="form-group">
									<select name="filter_role" id="filter_role" class="form-control" required>
										<option value="">Select College</option>
										<?php echo $college_info; ?>
									</select>
									
								</div>
								<div class="form-group">
									<select name="filter_role_1" id="filter_role_1" class="form-control" required>
										<option value="">Select Course</option>
									</select>
									
								</div>
								<div class="form-group" style="padding-top:-20px; " >
									<button type="button" name="filter" id="filter" class="btn btn-danger" style="height:40px; width:60px;">Filter</button>
									<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-danger" style="height:40px; width:60px;">Add</button>  
								</div>
							</div>
							
							<div id="alert_message"></div>
							
							<div id="employee_table">  
								<table id="user_data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Student Number</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>College</th>
											<th>Course</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
							</div>
							
						</div>
						
					</div>
				</div>
			</section><!-- #about -->
		</main>
		
		<!--==========================
			View Modal
		============================-->
		
		<div id="dataModal" class="modal fade">  
			<div class="modal-dialog">  
				<div class="modal-content">  
					<div class="modal-header">  
						<button type="button" class="close" data-dismiss="modal">&times;</button>  
						<h4 class="modal-title">User Details</h4>  
					</div>  
					
					<div class="modal-body" id="employee_detail">  </div>  
					
					<div class="modal-footer">  
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
					</div>  
				</div>  
			</div>  
		</div>  
		
		<!--==========================
			Insert/Update Modal
		============================-->
		
		<div id="add_data_Modal" class="modal fade">  
			<div class="modal-dialog">  
				<div class="modal-content"> 
					<form method="post" id="insert_form">
						
						<div class="modal-header">  
							<button type="button" class="close" data-dismiss="modal">&times;</button>  
							<h4 class="modal-title">Create New Account</h4>  
						</div>  
						
						<div class="modal-body">  
							<label><strong>Student Number </strong> <font color="red" style="font-weight: bold;">*</font> </label>  
							<input type="text" class="form-control" name="stud_num" id="stud_num" placeholder="2021-2-00000" pattern="\d{4}[\-]\d{1}[\-]\d{5}" required />
							<br />  
							
							<label><strong>First Name </strong> <font color="red" style="font-weight: bold;">*</font> </label>  
							<input type="text" name="fname" id="fname" class="form-control" size="25" required />  
							<br />  
							
							<label><strong>Last Name </strong> <font color="red" style="font-weight: bold;">*</font> </label>  
							<input type="text" name="lname" id="lname" class="form-control" size="25" required />  
							<br />  
							
							<label><strong>Username</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<input type="text" name="uname" id="uname" class="form-control" size="25" required>
							<br /> 
							
							<label><strong>Password </strong>  </label>
							<input type="text" name="pword" id="pword"  class="form-control" size="25" >
							<br /> 
							
							<label><strong>College:</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select name="college"  id="college" class="form-control" required>
								<option value="">Choose here</option>
								<?php 
									$college_qry = "SELECT * FROM  tbl_college WHERE delete_flag='0'";
									$college_rslt = mysqli_query($con, $college_qry);
									if(mysqli_num_rows($college_rslt) > 0){
										while($row = mysqli_fetch_assoc($college_rslt)){
											echo "<option value='".$row['college_id']."'>".$row['college_fullname']."</option>";
										}
									}
								?>
							</select>
							<br /> 
							
							<label><strong>Course:</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select name="course"  id="course" class="form-control" required> 
								<option value="">Choose here</option>
								<?php 
									$course_qry = "SELECT * FROM  tbl_course WHERE delete_flag='0'";
									$course_rslt = mysqli_query($con, $course_qry);
									if(mysqli_num_rows($course_rslt) > 0){
										while($row = mysqli_fetch_assoc($course_rslt)){
											echo "<option value='".$row['course_id']."'>".$row['course_fullname']."</option>";
										}
									}
								?>
							</select>
							<input type="hidden" name="course_val" id="course_val" class="form-control" size="25">
							<br /> 
							
							<label><strong>Year Level:</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select name="year_level"  id="year_level" class="form-control" required >
								<option value="">Choose here</option>
								<?php
									$year_level_qry = "SELECT * FROM tbl_year_level";
									$year_level_rslt = mysqli_query($con, $year_level_qry);
									if(mysqli_num_rows($year_level_rslt) > 0){
										while($row = mysqli_fetch_assoc($year_level_rslt)){
											echo "<option value='".$row['year_level_id']."'>".$row['year_level_desc']."</option>";
										}
									}
								?>
							</select>
							<br />
							
							<input type="checkbox" name="status" id="status"  >
							<label><strong>Suspended account</strong> <font color="red" style="font-weight: bold;"></font></label>
							<input type="hidden" name="flag" id="flag" class="form-control" size="25">
							
							<input type="hidden" name="user_id" id="user_id" /> 
						</div>  
						
						<div class="modal-footer">  
							<input type="submit" name="insert" id="insert" value="Insert" class="btn btn-danger" />  
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
						</div>  
						
					</form>  
				</div>  
			</div>  
		</div>  

		<!--==========================
			Footer
		============================-->
		<footer id="footer" class="section-bg">
			<div class="footer-top">
				<div class="container">
					<div class="row">
					
						<div class="col-lg-6">
							<div class="footer-info">
								<h3>Web•IMS</h3>
								<p>An internship management system developed for the Center for Career Services and Industry Relations to help the Center implement a smooth and paperless internship transaction.</p>
							</div>
						</div>
						
						<div class="col-lg-6">	
							<div class="footer-links">
								<h4>Contact Us</h4>
								<p>Lyceum of the Philippines University - Cavite  <br>
									Governor's Drive, General Trias <br>
									Cavite <br>
									<strong>Phone:</strong> (046) 481-1462 <br>
									<strong>Email:</strong> cvt-ccsir@lpu.edu.ph<br>
								</p>
							</div>
				
							<div class="social-links">
								<a href="https://www.facebook.com/lpu.csi.iao/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
								<a href="https://www.instagram.com/lpu.csi.iao/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
							</div>
						</div>
				
					</div>
					
				</div>
			</div>
		
			<div class="container">
				<div class="copyright">
					&copy; Copyright <strong>Web•IMS</strong>. All Rights Reserved
				</div>
				<div class="credits">
					<!--
					All the links in the footer should remain intact.
					You can delete the links only if you purchased the pro version.
					Licensing information: https://bootstrapmade.com/license/
					Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Rapid
					-->
					Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
				</div>
			</div>
			
		</footer><!-- #footer -->
		
		<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
		<!-- Uncomment below i you want to use a preloader -->
		<!-- <div id="preloader"></div> -->
	
	</body>
</html>

<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		fetch_data();
		
		function fetch_data(filter_role = '', filter_role_1 = ''){
			var dataTable = $('#user_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"searching" : true,
				"ajax" : {
					url:"../components/config-users/fetch-student.php",
					type:"POST",
					data:{
						filter_role:filter_role,
						filter_role_1:filter_role_1
					}
				}
		   });
		}
		
		$('#filter').click(function(){
			var filter_role = $('#filter_role').val();
			var filter_role_1 = $('#filter_role_1').val();
			
			$('#user_data').DataTable().destroy();
			
			if(filter_role == ''){
				var filter_role = "";
			}
			if(filter_role_1 == ''){
				var filter_role_1 = "";
			}
			
			fetch_data(filter_role, filter_role_1);
			
		});
		
		$("#filter_role").change(function(){
			var id=$(this).val();
			$.ajax({
				url:'../components/config-section/load_course.php',
				type:'post',
				data:{id:id},
				success:function(res){	
					$('#filter_role_1').prop('disabled', false);
					$("#filter_role_1").html(res);
				}
			});
        });
		
		$("#college").change(function(){
			var id=$(this).val();
			$.ajax({
				url:'../components/config-section/load_course.php',
				type:'post',
				data:{id:id},
				success:function(res){	
					$('#course').prop('disabled', false);
					$("#course").html(res);
				}
			});
        });
		
		$('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
		});
		
		$(document).on('click', '.edit', function(){  
			var user_id = $(this).attr("id");  
			
			$.ajax({  
                url:"../components/config-users/write-student.php",  
                method:"POST",  
                data:{user_id:user_id},  
                dataType:"json",  
                success:function(data){  
				
					$('#user_id').val(data.userid); 
                    $('#fname').val(data.firstname);  
                    $('#lname').val(data.lastname);  
                    $('#uname').val(data.username);  
					$('#flag').val(data.active_flag); 
					
					$('#stud_num').val(data.student_number);
					$('#college').val(data.college_id);
					$('#course').val(data.course_id);		
					$('#course_val').val(data.course_id);		
					$('#course').prop('disabled', true);
					
					$('#year_level').val(data.year_level_id);
					
					//0 suspended; 1 active;
					if($('#flag').val() == "1"){
						$('#status').prop('checked', false);
					}
					else{
						$('#status').prop('checked', true);
					}
					
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
                }  
			});  
		});  
	  
		$('#insert_form').on("submit", function(event){  
			event.preventDefault();  
			
			var email = $('#uname').val();
			
			if(IsEmail(email)==false){
				alert("This email is not valid");  
                return false;
            }
			
			if($('#fname').val() == ""){  
                alert("First name is required");  
			}  
			else if($('#lname').val() == ''){  
                alert("Last name is required");  
			}  
			else if($('#uname').val() == ''){  
                alert("Username is required");  
			}  
			else if($('#stud_num').val() == ''){  
                alert("Student number is required");  
			}
			else if($('#college').val() == ''){  
                alert("Please choose an option");  
			}
			else if($('#course').val() == ''){  
                alert("Please choose an option");  
			}
			else if($('#year_level').val() == ''){  
                alert("Please choose an option");  
			}
			else{  
				var username = $("#uname").val();
				var user_id = $("#user_id").val();
		
				$.ajax({
					url : "../components/config-users/check.php",
					type : "POST",
					cache:false,
					data : {username:username, user_id:user_id},
					success:function(result){
						if (result == 1) {
							alert("Username exists!");  
						}
						else{
							$.ajax({  
								url:"../components/config-users/insert-student.php",  
								method:"POST",  
								data:$('#insert_form').serialize(),  
								beforeSend:function(){  
								  $('#insert').val("Inserting");  
								},  
								success:function(data){  
								  $('#insert_form')[0].reset();  
								  $('#add_data_Modal').modal('hide');  
								  $('#employee_table').html(data);  
								}  
							});  
						}
					}
				});
			}	   
		});
	  
		function IsEmail(email) {
			//var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var regex = /^[^@]+@(lpunetwork|lpu)\.edu.ph$/i
			
			if(!regex.test(email)) {
				return false;
			}else{
				return true;
			}
		}
	  
		$(document).on('click', '.view', function(){  
           var user_id = $(this).attr("id");  
		   
           if(user_id != ''){  
                $.ajax({  
                    url:"../components/config-users/select-student.php",  
                    method:"POST",  
                    data:{user_id:user_id},  
                    success:function(data){  
                        $('#employee_detail').html(data);  
						$('#dataModal').modal('show');  
                    }  
                });  
			}            
		});
		
		$(document).on('click', '.delete', function(){
			var id = $(this).attr("id");
		
			if(confirm("Are you sure you want to remove this?")){
				$.ajax({
					url:"../components/config-users/delete.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});
				
				setInterval(function(){
					$('#alert_message').html('');
				}, 5000);
			}
		});
  
		$(document).on('click', '.archive', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to archive this?")){
				$.ajax({
					url:"../components/config-users/archive.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});
				
				setInterval(function(){
					$('#alert_message').html('');
				}, 5000);
			}
		});

		$(document).on('click', '.restore', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to restore this?")){
				$.ajax({
					url:"../components/config-users/restore.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});
				
				setInterval(function(){
					$('#alert_message').html('');
				}, 5000);
			}
		});
	});
</script>