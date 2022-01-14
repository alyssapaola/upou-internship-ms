<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	$current = date("F d, Y");
	$year_now = date("Y");
	
	$word = "employer";
	
	/*
	$_SESSION["loggedin"] = true;
	$_SESSION['userid'] = $db_userid;
	$_SESSION['role'] = $db_rolename;
	$_SESSION['fname'] = $db_fname;
	*/
	
	// Checks if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== $word ){
		header("location: ../login/index.php");
		exit;	
	}
	
	$job_id = $_SESSION['job_id'];
	$status = $_SESSION['status'];
	
	$job_application_id = $_SESSION['job_application_id'];
	
	
	if(isset($_SESSION['job_application_id'])){
		include '../components/job-application/job-application-details-sql.php';
	}
	else{
		header("location: job-application.php");
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
		
		<!-- Bootstrap CSS File -->
		<link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Libraries CSS Files -->
		<link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../lib/animate/animate.min.css" rel="stylesheet">
		<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
		<link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
		
		<!-- Main Stylesheet File -->
		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/popup.css" rel="stylesheet">
		
		<!-- JavaScript Libraries -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
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
			width: 80%;
		}
		.info-box {
			box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 50%);
			border-radius: .75rem;
			background-color: #fff;
			display: -ms-flexbox;
			display: flex;
			margin-bottom: 1rem;
			min-height: 80px;
			padding: .5rem;
			position: relative;
			width: 50%;
		}
		#about .about-content button[type="submit"] {
			background: #b30000;
			border: 0;
			border-radius: 3px;
			padding: 8px 20px;
			color: #fff;
			transition: 0.3s;
			font-size: 13px;
		}
		.table tr { line-height: 20px; }
		.table-bordered  td{
			vertical-align: middle;
		}
		
		<!-- for image -->
		.container .image {
		  width: 30%;
		}

		.container img {
		  width: calc(100% - (20px * 2));
		  margin: 20px;
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
					<h1 class="text-light"><a href="javascript:window.location.reload(true)" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
				
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="job-application-view.php?id=<?php echo $job_id; ?>&&stat=<?php echo $status; ?>">Back</a></li>
					</ul>
				</nav><!-- .main-nav -->
			</div>
			
		</header><!-- #header -->
	
		<main id="main">
		
			<!--==========================
			Main Content
			============================-->
			<section id="about" >

				<div class="container" style="padding-left:30px;">
				
					<div class="about-content"  style="text-align:center;">
						<h2>Job Application </h2>
						<h3 style="margin-top:-15px; "> <?php echo $job_name; ?> </h3>
						<h4 style="margin-top:-15px;"> <?php echo $company_name; ?> </h4>
					</div>
					
					<div class="about-content"  style="text-align:justify; padding-top:10px;"> 
						
						<div class="table-responsive">  
						
							<table class="table table-bordered ">
								<tr>  
									<?php
										//0 decline 1 approved 2 pending
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
									<td width="30%" style="font-size:25px; height: 50px; " class="<?php echo $class; ?>" ><b>Status: </b></td>  
									<td width="50%" colspan="2" style="font-size:25px; height: 50px; " class="<?php echo $class; ?>" ><b><?php echo strtoupper($status_name); ?></b></td>  
								</tr>
								<tr>  
									<td width="30%"><b>Date Filed: </b></td>  
									<td width="50%" colspan="2"><?php echo $date_db; ?></td>  
								</tr>
								<tr>  
									<td width="30%"><b>Application Number: </b></td> 
									<td width="50%"  colspan="2"><?php echo $job_application_id; ?></td>  
								</tr>
								<tr>  
									<td colspan="3"></td>  
								</tr>
								<tr>  
									<td ><?php echo "<img src='".$dir."' />"; ?></td>  
								</tr>
								<tr>  
									<td width="30%"><b>Name: </b></td>  
									<td width="50%"  colspan="2"><?php echo $fullName; ?></td>  
								</tr>
								<tr>  
									<td width="30%"><b>Year and Course: </b></td>  
									<td width="50%" colspan="2"><?php echo $year_level_desc." ".$course_fullname; ?></td>  
								</tr>
								<tr>  
									<td colspan="3"></td>  
								</tr>
								<tr>  
									<td colspan="3"><label><i><u>Contact Information </u></i></label></td>  	
								</tr>
								<tr>  
									<td width="30%"><b>Mobile Number: </b></td>  
									<td width="50%" colspan="2"><?php echo $contact_num; ?></td>  
								</tr>
									<tr>  
									<td width="30%"><b>Primary Email Address: </b></td>  
									<td width="50%" colspan="2"><?php echo $username; ?></td>  
								</tr>
								</tr>
									<tr>  
									<td width="30%"><b>Alternate Email Address</b></td>  
									<td width="50%" colspan="2"><?php echo $contact_email; ?></td>  
								</tr>
								<tr>  
									<td width="30%"><b>Home Address: </b></td>  
									<td width="50%" colspan="2"><?php echo $contact_add; ?></td>  
								</tr>
								<tr>  
									<td colspan="3"></td>  
								</tr>
								<tr>  
									<td width="30%"> <b>Internship Hours: </b></td>  
									<td width="50%"colspan="2"><b>
									
									<?php 
										$queryHrs = "SELECT tbl_internship_hours_credit.credit_hrs FROM tbl_internship_application_credit 
													JOIN tbl_internship_hours_credit ON tbl_internship_hours_credit.credit_hrs_id = tbl_internship_application_credit.credit_hrs_id
										WHERE tbl_internship_application_credit.application_id = '$application_id' AND status_flag = '1'";
										$resultHrs = mysqli_query($con, $queryHrs);
										if(mysqli_num_rows($resultHrs) > 0){
											while($rowHrs = mysqli_fetch_array($resultHrs)){
												$credit_hrs += $rowHrs['credit_hrs'];
											}
											echo $internship_hrs = $internship_hrs - $credit_hrs;
										}
										else{
											echo $internship_hrs;
										}
									?>
									
									hours </b></td>
								</tr>
								<tr>  
									<td colspan="3"></td>  
								</tr>
								<tr>  
									<td colspan="3"><label><i><u>Application Question</u></i></label></td>  	
								</tr>
								<tr>  
									<td width="30%"><b>Skills </b></td>
									<td width="50%" colspan="2"><?php echo $skills; ?></td>  
								</tr>
								<tr>  
									<td width="30%"><b>Why should we hire you> </b></td>
									<td width="50%" colspan="2"><?php echo $description; ?></td>  
								</tr>
								<tr>  
									<td colspan="3"></td>  
								</tr>
								<tr>  
									<td colspan="3" align="center">
									<?php
										if ($status == '2'){
									?>
											<button type="submit" id="<?php echo $job_application_id; ?>" class="approveBtn btn btn-danger btn-xs">Approve</button>
											<button type="submit" id="<?php echo $job_application_id; ?>" class="declineBtn btn btn-danger btn-xs">Decline</button>
									<?php
										}
									?>
									</td>  
								</tr>
		
							</table>
							
						</div>
						
					</div
					
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
		
		$(document).on('click', '.approveBtn', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to select this action?")){
				
				/*
				$.ajax({  
					url:"../components/job-application/approve-application.php",
					method:"POST",  
					data:{id:id},
					success:function(data){
						alert("Application Approved");  
						//window.location.reload();
						 window.location = "job-application.php";
						
					}
				});  
				*/
				
				$.ajax({
					url : "../components/job-application/check.php",
					type : "POST",
					cache:false,
					data : {id:id},
					success:function(result){
						if (result == 1) {
							alert("Student is already affiliated with other company");  
						}
						else{
							$.ajax({  
								url:"../components/job-application/approve-application.php",
								method:"POST",  
								data:{id:id},
								success:function(data){
									alert("Application Approved");  
									//window.location.reload();
									 window.location = "job-application.php";
									
								}
							});  
						}
					}
				});
				
			}
		});
		
		$(document).on('click', '.declineBtn', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to select this action?")){
				$.ajax({
					url:"../components/job-application/decline-application.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						alert("Application Denied");  
						//window.location.reload();
						 window.location = "job-application.php";
						 
					}
				});
			}
		});
		
		
	});
</script>