<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	$word = "staff";
	
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
	
	//FOR ACAD TERM FILTER SELECT OPTION
	$acad_term = '';
	$query = "SELECT * FROM tbl_acad_term WHERE delete_flag='0' ORDER BY current_flag DESC, term_from_year DESC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row){
		$term_id = $row['term_id'];
		$term_name = $row["term_name"];
		$term_from_year = $row["term_from_year"];
		$term_to_year = $row["term_to_year"];
		$term_desc = $term_name." AY ".$term_from_year." - ".$term_to_year;
		
		$acad_term .= '<option value="'.$term_id.'">'.$term_desc.'</option>';
	}
	
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
	
	//FOR APPLICATION STATUS FILTER SELECT OPTION
	$application_status = '';
	$query_2 = "SELECT * FROM tbl_status ORDER BY status_name ASC";
	$statement_2 = $connect->prepare($query_2);
	$statement_2->execute();
	$result_2 = $statement_2->fetchAll();
	foreach($result_2 as $row){
		$status_id = $row['status_id'];
		$status_name = $row["status_name"];
		$application_status .= '<option value="'.$status_id.'">'.$status_name.'</option>';
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
		
		<!-- DateTime Picker  -->
		
		<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
		
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
		
		<!-- Stylesheet for DataTable -->
		.active_flg {
			background-color: #940000;
			color: white;
			border: 2px solid #940000;
		}
		.active_flg:hover{color:#fff;background-color:#EE0000    ;border-color:#940000}
		
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
		#filter_role, #filter_role_1, #filter_role_2 {
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
					<h1 class="text-light"><a href="int-application.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="active drop-down"><a href="#">Internship Module</a>
							<ul>
								<li ><a href="int-orientation.php">Orientation</a></li>
								<li class="active drop-down"><a href="int-application.php">Application</a>
									<ul>
										<li><a href="int-application-approved.php">Approved Application</a></li>
										<li><a href="int-application-pending.php">Pending Application</a></li>
										<li><a href="int-application-rejected.php">Rejected Application</a></li>
									</ul>
								</li>
								<li><a href="int-assigned.php">Section Assigned</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="#">Configuration</a>
							<ul>
								<li><a href="config-orientation.php">Manage Orientation</a></li>
								<li><a href="config-templates.php">Manage Templates</a>
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
							<h2>Internship Application Record</h2>
							<h4>Displays all application of the students</h4>
						</div>
						
						
						<div class="table-responsive">
							
							<div class="row">
								<div class="form-group">
									<select name="filter_role" id="filter_role" class="form-control" required>
										<option value="">Select Academic Term</option>
										<?php echo $acad_term; ?>
									</select>
									
								</div>
								<div class="form-group">
									<select name="filter_role_1" id="filter_role_1" class="form-control" required>
										<option value="">Select College</option>
										<?php echo $college_info; ?>
									</select>
									
								</div>
								<div class="form-group">
									<select name="filter_role_2" id="filter_role_2" class="form-control" required>
										<option value="">Select Status</option>
										<?php echo $application_status; ?>
									</select>
									
								</div>
								<div class="form-group" style="padding-top:-20px; " >
									<button type="button" name="filter" id="filter" class="btn btn-danger" style="height:40px; width:60px;">Filter</button>
								</div>
							</div>
							
							<div id="alert_message"></div>
							
							<div id="employee_table">  
								<table id="user_data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Application Number</th>
											<th>Student Number</th>
											<th>College</th>
											<th>Academic Term</th>
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
		
		function fetch_data(filter_role = '', filter_role_1 = '', filter_role_2 = ''){
			var dataTable = $('#user_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"searching" : true,
				"ajax" : {
					url:"../components/int-application/fetch-all.php",
					type:"POST",
					data:{
						filter_role:filter_role,
						filter_role_1:filter_role_1,
						filter_role_2:filter_role_2
					}
				}
		   });
		}
		
		$("#acad_term_select").change(function(){
			var cid=$(this).val();
			$.ajax({
				url:'../components/int-orientation/load-orientation.php',
				type:'post',
				data:{id:cid},
				success:function(res){	
					$('#orientation_select').prop('disabled', false);
					$("#orientation_select").html(res);
				}
			});
		});
		
		$('#filter').click(function(){
			var filter_role = $('#filter_role').val();
			var filter_role_1 = $('#filter_role_1').val();
			var filter_role_2 = $('#filter_role_2').val();
			
			$('#user_data').DataTable().destroy();
			
			if(filter_role == ''){
				var filter_role = "";
			}
			if(filter_role_1 == ''){
				var filter_role_1 = "";
			}
			if(filter_role_2 == ''){
				var filter_role_2 = "";
			}
			
			fetch_data(filter_role, filter_role_1, filter_role_2);
			
		});
		
		$(document).on('click', '.view', function(){  
			var applicationid = $(this).attr("id");  
		   
			if(applicationid != ''){  
				$.ajax({  
                    url:"../components/int-application/view.php",  
                    method:"POST",  
                    data:{applicationid:applicationid},  
                    success: function(data){
					   window.location = "int-application-view.php";
					}
                });  
			}            
		});
		
		
	});
</script>