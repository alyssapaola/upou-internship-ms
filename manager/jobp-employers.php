<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	$word = "manager";
	
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
					<h1 class="text-light"><a href="jobp-employers.php" class="scrollto"><span>Web???IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="drop-down"><a href="#">Internship Portal</a>
							<ul>
								<li><a href="intp-assignment.php">Faculty Assignment</a></li>
								<li class="drop-down"><a href="#">Internship/Credit Hours</a>
									<ul>
										<li><a href="intp-hours.php">Internship Hours</a></li>
										<li><a href="intp-credhours.php">Internship Credit Hours</a></li>
									</ul>
								</li>
								<li><a href="intp-orientation.php">Orientation</a></li>
								<li><a href="intp-students.php">Students</a></li>
								<li><a href="intp-templates.php">Templates</a>
							</ul>
						</li>
						<li class="active drop-down"><a href="#">Job Portal</a>
							<ul>	
								<li><a href="jobp-profile.php">Company Profile</a></li>
								<li><a href="jobp-department.php">Configure Department</a></li>
								<li class="active"><a href="jobp-employers.php">Employer Information</a></li>
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
							<h2>Employer Information</h2>
							<h4>Displays the information of enrolled users of affiliated industry partners</h4>
						</div>
						
						<div class="table-responsive">
							
							<div align="left">  
								<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-danger">Add</button>  
							</div>
							
							<br>
							<div id="alert_message"></div>
							
							<div id="employee_table">  
								<table id="user_data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th>Username</th>
											<th>Company Affiliated</th>
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
							<label><strong>First Name </strong> <font color="red" style="font-weight: bold;">*</font> </label>  
							<input type="text" name="fname" id="fname" class="form-control" size="25" required />  
							<br />  
							
							<label><strong>Last Name </strong> <font color="red" style="font-weight: bold;">*</font> </label>  
							<input type="text" name="lname" id="lname" class="form-control" size="25" required />  
							<br />  
							
							<label><strong>Password </strong>  </label>
							<input type="text" name="pword" id="pword"  class="form-control" size="25" >
							<br /> 
							
							<label><strong>Username</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<input type="text" name="uname" id="uname" class="form-control" size="25" required>
							<br /> 
							
							<?php 
								$acctype_qry = "SELECT * FROM tbl_role WHERE role_name LIKE '%employer%'";
								$acctype_rslt = mysqli_query($con, $acctype_qry);
								if(mysqli_num_rows($acctype_rslt) > 0){
									while($row = mysqli_fetch_assoc($acctype_rslt)){
										$role_id = $row['role_id'];
									}
								}
							?>
							<input type="hidden" name="accttype" id="accttype" class="form-control" value="<?php echo $role_id; ?>" >
							
							<input type="checkbox" name="status" id="status"  >
							<label><strong>Suspended account</strong> <font color="red" style="font-weight: bold;"></font></label>
							<input type="hidden" name="flag" id="flag" class="form-control" size="25">
							<br /> 
							
							<hr>
							
							<label><strong>Company Affiliated </strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select id="emp_company" name="emp_company" class="form-control" required >
								<option value="">Choose here</option>
								<?php 
									$prov_qry = "SELECT * FROM  tbl_company ORDER BY company_name ASC";
									$prov_rslt = mysqli_query($con, $prov_qry);
									if(mysqli_num_rows($prov_rslt) > 0){
										while($row = mysqli_fetch_assoc($prov_rslt)){
											echo "<option value='".$row['company_id']."'>".$row['company_name']."</option>";
										}
									}
								?>
							</select>
							<br /> 
							
							<label><strong>Department </strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select id="emp_dept" name="emp_dept" class="form-control"  required >
								<option value="">Choose here</option>
								<?php 
									$prov_qry = "SELECT * FROM  tbl_company_dept ORDER BY department_name ASC";
									$prov_rslt = mysqli_query($con, $prov_qry);
									if(mysqli_num_rows($prov_rslt) > 0){
										while($row = mysqli_fetch_assoc($prov_rslt)){
											echo "<option value='".$row['department_id']."'>".$row['department_name']."</option>";
										}
									}
								?>
							</select>
							<br /> 
							
							<label><strong>Designation</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<input type="text" name="emp_designation" id="emp_designation" class="form-control" size="25" required>
							<br /> 
							
							<input type="hidden" name="user_id" id="user_id" /> 
							<input type="hidden" name="emp_id" id="emp_id" /> 
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
								<h3>Web???IMS</h3>
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
					&copy; Copyright <strong>Web???IMS</strong>. All Rights Reserved
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
		
		function fetch_data(){
			var dataTable = $('#user_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"ajax" : {
					url:"../components/config-users/fetch-employer.php",
					type:"POST"
				}
			});
		}
		
		$('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
		});
		
		$(document).on('click', '.edit', function(){  
			var user_id = $(this).attr("id");  
			
			$.ajax({  
                url:"../components/config-users/write-employer.php",  
                method:"POST",  
                data:{user_id:user_id},  
                dataType:"json",  
                success:function(data){  
                    $('#fname').val(data.firstname);  
                    $('#lname').val(data.lastname);  
                    $('#uname').val(data.username);  
				
                    $('#user_id').val(data.userid);  
					
					$('#flag').val(data.active_flag); 
					
					$('#emp_id').val(data.employee_id);  
					$('#emp_company').val(data.company_id);  
                    $('#emp_dept').val(data.department_id);  
                    $('#emp_designation').val(data.employee_designation);  
					
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
			else if($('#emp_company').val() == ''){  
                alert("Field is required");  
			} 
			else if($('#emp_dept').val() == ''){  
                alert("Field is required");  
			} 
			else if($('#emp_designation').val() == ''){  
                alert("Field is required");  
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
								url:"../components/config-users/insert-employer.php",  
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
                    url:"../components/config-users/select-employer.php",  
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