<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	$word = "manager";
	
	$loc = $word."/jobp-employers.php";
	$_SESSION['loc'] = $loc;
	
	$_SESSION['users'] = "employer";
	
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
		
		<!-- Include Date Range Picker -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

		
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
					<h1 class="text-light"><a href="jobp-profile.php" class="scrollto"><span>Web•IMS</span></a></h1>
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
								<li class="active"><a href="jobp-profile.php">Company Profile</a></li>
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
		
		<!--==========================
			Main Content
		============================-->
			
		<main id="main">
			<section id="about" >
				<div class="container">
					<div class="row">
					
						<div class="about-content"  style="text-align:justify;">
							<h2>Company Profile</h2>
							<h4>Displays the list of affiliated industry partners</h4>
						</div>
						
						<div class="table-responsive">
							
							<div align="left">  
								<form role="form" id="contact-form" method="post" enctype="multipart/form-data" action="jobp-profile-add.php" >
									<button type="submit" name="add" id="add" class="btn btn-danger">Add</button>
								</form>
							</div>
							
							<br>
							<div id="alert_message"></div>
							
							<div id="employee_table">  
								<table id="user_data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Company Name</th>
											<th>Company Address</th>
											<th>Status</th>
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
		
		<div id="view_form" class="modal fade">  
			<div class="modal-dialog">  
				<div class="modal-content">  
					<div class="modal-header">  
						<button type="button" class="close" data-dismiss="modal">&times;</button>  
						<h4 class="modal-title">Company Details</h4>  
					</div>  
					
					<div class="modal-body" id="employee_detail">  </div>  
					
					<div class="modal-footer">  
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
					</div>  
				</div>  
			</div>  
		</div>  
		
		<!--==========================
			Renew Modal
		============================-->
		
		<div id="renew_form" class="modal fade">  
			<div class="modal-dialog">  
				<div class="modal-content"> 
					<form method="post" id="insert_form" enctype="multipart/form-data">
						
						<div class="modal-header">  
							<button type="button" class="close" data-dismiss="modal">&times;</button>  
							<h4 class="modal-title">Renew Agreement</h4>  
						</div>  
						
						<div class="modal-body">  
							
							<label for="term_end"><b>Agreement End Date <font color="red">*</font> </b></label>
							<input type="text" id="term_end" name="term_end" placeholder="January 01, 1970" class="form-control" required  />
							<br />  
							
							<label><strong>Upload Memorandum of Agreement: </strong><font color="red" style="font-weight: bold;">*</font> </label>  
							<input type="file" name="file" id="file" class="form-control"  class="form-control"  required />
							<br />  
							
							<input type="hidden" name="company_id" id="company_id" class="form-control"  /> 
							<input type="hidden" name="company_name" id="company_name" class="form-control"  /> 							
							
						</div>  
						
						<div class="modal-footer">  
							<input type="submit" name="insert" id="insert" value="Renew" class="btn btn-danger" />  
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
		
		function fetch_data(){
			var dataTable = $('#user_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"ajax" : {
					url:"../components/jobp-profile/fetch.php",
					type:"POST"
				}
			});
		}
		
		$(document).on('click', '.edit', function(){  
			var id = $(this).attr("id");  
			
			$.ajax({  
                url:"../components/jobp-profile/check.php",  
                method:"POST",  
                data:{id:id}, 
                success:function(data){  
                    window.location = "jobp-profile-edit.php";
                }  
			});  
		});  
	  
		$(document).on('click', '.view', function(){  
			var id = $(this).attr("id");  
		   
			$.ajax({  
				url:"../components/jobp-profile/select.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#employee_detail').html(data);  
					$('#view_form').modal('show');  
                }  
            });  
			
		});
		
		$(document).on('click', '.delete', function(){
			var id = $(this).attr("id");
		
			if(confirm("Are you sure you want to remove this?")){
				$.ajax({
					url:"../components/jobp-profile/delete.php",
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
			
			if(confirm("Are you sure you want to end affiliation with this company?")){
				$.ajax({
					url:"../components/jobp-profile/archive.php",
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
			
			$.ajax({
				url:"../components/jobp-profile/renew.php",
				method:"POST",
				data:{id:id},
				dataType:"json",  
				success:function(data){
					$('#company_id').val(data.company_id); 
					$('#company_name').val(data.company_name); 
					$('#renew_form').modal('show');  
				}
			});
			
		});
		
		$('#insert_form').on("submit", function(event){  
			event.preventDefault();  
			
			 // AJAX request
            $.ajax({
				url:"../components/jobp-profile/insert.php",  
                type: 'post',
                data: new FormData($('#insert_form')[0]),
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 0){
						alert('Data Updated');
						location.reload(true);
                    }else{
                        alert(response);
                    }
                }
            });
		
		});
		
		var date_input=$('input[name="term_end"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'MM dd, yyyy',
			orientation: "top left", 
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
		
	});
</script>