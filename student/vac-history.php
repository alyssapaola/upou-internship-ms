<?php
	// Initialize the session
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	include '../connect.php';
	include '../components/student/get-details.php';
	
	$word = "student";
	
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
	
	// checks if user completed already his profile. otherwise, send to profile
	if ($student_details_flag == 0){
		header("location: ../student/profile.php");
		exit;
	}
	
	$userid = $_SESSION['userid'];
	$_SESSION['vac-history'] = "1";
	
	//get data
	$query = "SELECT tbl_job_application.job_application_id, tbl_job_application.status_flag, 
				tbl_job.job_name, tbl_company.company_name, tbl_status.status_name,
				tbl_acad_term.term_id, tbl_acad_term.term_name, tbl_acad_term.term_from_year, tbl_acad_term.term_to_year 
			FROM tbl_job_application 
			JOIN tbl_job ON tbl_job.job_id = tbl_job_application.job_id
			JOIN tbl_company ON tbl_company.company_id = tbl_job.company_id
			JOIN tbl_status ON tbl_status.status_id = tbl_job_application.status_flag
			JOIN tbl_acad_term ON tbl_acad_term.term_id = tbl_job_application.term_id 
			WHERE tbl_job_application.userid = '$userid'";
	$result = mysqli_query($con, $query);

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
		
		<!-- date picker -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
		
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
		.active_flg:hover{color:#fff;background-color:#EE0000;border-color:#940000}
		
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
					<h1 class="text-light"><a href="vac-history.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class=" drop-down"><a href="orientation.php">Orientation</a>
							<ul>
								<li ><a href="or-history.php">History</a></li>
							</ul>
						</li>
						<li class=" drop-down"><a href="application.php">Application</a>
							<ul>
								<li ><a href="app-records.php">Records</a></li>
							</ul>
						</li>
						<li class="active drop-down"><a href="vacancies.php">Job Vacancies</a>
							<ul>
								<li><a href="vac-applications.php">Applications</a></li>
								<li class="active"><a href="vac-history.php">History</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="#">Reports</a>
							<ul>
								<li><a href="templates.php">Templates</a></li>
							</ul>
						</li>
						<li><a href="profile.php">Profile</a></li>
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
							<h2>Job Applications Records</h2>
							
							<?php 						
								if(mysqli_num_rows($result) > 0){
							?>
							
									<h4>View all your job application/s</h4>
							
							<?php 
								}
								else{
							?>
							
									<h4>Nothing to see here yet.</h4>
									
							<?php 
								}
							?>
							
						</div>
					
						<br>
						
						<?php 						
							if(mysqli_num_rows($result) > 0){
						?>
					
								<form role="form" id="contact-form" method="post" action="vac-applications-view.php" enctype="multipart/form-data" >
								<div class="table-responsive">
									<div id="employee_table">  
										<table id="user_data" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No</th>
													<th>Academic Term</th>
													<th>Application Number</th>
													<th>Company Name</th>
													<th>Job Title</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											
											<?php
												while($row = mysqli_fetch_array($result)){
													$i = $i + 1;
					
													$company_name = $row["company_name"];
													$job_name = $row["job_name"];
													
													$job_application_id = $row["job_application_id"];
													
													$status_name = $row["status_name"];
													$status_flag = $row["status_flag"];
													
													$term_id = $row['term_id'];
													$term_name = $row["term_name"];
													$term_from_year = $row["term_from_year"];
													$term_to_year = $row["term_to_year"];
													$term_desc = $term_name.", AY ".$term_from_year." - ".$term_to_year;
			
													if ($status_flag == '1'){
														$class = "alert alert-success";
													}
													else if ($status_flag == '2'){
														$class = "alert alert-warning";
													}
													else if ($status_flag == '0'){
														$class = "alert alert-danger";
													}
												
											?>
													<tbody >
														<td class="<?php echo $class; ?>"><?php echo $i; ?></td>
														<td class="<?php echo $class; ?>"><?php echo $term_desc; ?></td>
														<td class="<?php echo $class; ?>"><?php echo $job_application_id; ?></td>
														<td class="<?php echo $class; ?>"><?php echo $company_name; ?></td>
														<td class="<?php echo $class; ?>"><?php echo $job_name; ?></td>
														<td class="<?php echo $class; ?>"><?php echo strtoupper($status_name); ?></td>
														<td>
															<input type="hidden" name="term_id"  id="term_id" value="<?php echo $term_id; ?>" /> 
															<button type="submit" name="job_application_id" value="<?php echo $job_application_id; ?>" class="view btn btn-danger btn-xs active_flg">View Application</button>
														</td>
													</tbody>
											<?php
											
												}
												
											?>
											
										</table>
									</div>
								</div>
								</form>
						
						<?php
							}
						?>
					
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