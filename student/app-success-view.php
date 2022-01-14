<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	date_default_timezone_set('Asia/Manila');
	$current = date("F d, Y");
	$year_now = date("Y");
	
	$word = "student";
	
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
	
	if(isset($_POST['application_id'])){
		include '../components/student/app-success-view-sql.php';
	}
	else if(isset($_POST['app_denied'])){
		$_SESSION['reset'] = $_POST['app_denied'];
		header("location: app-denied.php");
		exit;
	}
	else{
		header("location: application.php");
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
					
					<?php
						if ($_SESSION['app-records'] == "1"){
					?>
							
							<li><a href="app-records.php">Back to Home</a></li>
							
					<?php
						}
						else{
					?>
							
							<li><a href="application.php">Back to Home</a></li>
							
					<?php
						}
					?>
					
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
						<h2>Internship Application </h2>
						<h4 style="margin-top:-15px;"> <?php echo $term_desc; ?></h4>
					</div>
					
					<div class="about-content"  style="text-align:justify; padding-top:10px;"> 
						<form role="form" id="contact-form" method="post" action="../components/student/app-generate-doc.php" target="_blank" >
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
										<td width="50%"  colspan="2"><?php echo $application_id; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Student Number: </b></td>  
										<td width="50%"  colspan="2"><?php echo $student_number; ?></td>  
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
										<td colspan="3"><label><i><u>In case of emergency contact </u></i></label></td>  	
									</tr>
									<tr>  
										<td width="30%"><b>Name: </b></td>  
										<td width="50%" colspan="2"><?php echo $emergency_name; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Relationship: </b></td>  
										<td width="50%" colspan="2"><?php echo $emergency_rel; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Mobile Number: </b></td>  
										<td width="50%" colspan="2"><?php echo $emergency_num; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Home Address: </b></td>  
										<td width="50%" colspan="2"><?php echo $emergency_add; ?></td>  
									</tr>
									<tr>  
										<td colspan="3"></td>  
									</tr>
									<tr>  
										<td width="30%"> <b>Internship Hours: </b></td>  
										<td width="50%" colspan="2"><?php echo $internship_hrs." hours"; ?></td>  
									</tr>
									<tr>  
										<td colspan="3"></td>  
									</tr>
									<tr>  
										<td colspan="3"><label><i><u>Internship Files</u></i></label></td>  	
									</tr>

									<?php 
										//$query = $_SESSION['query'];
										$query = "SELECT tbl_internship_application_files.application_file_dir, tbl_internship_application_files.application_file_size,  tbl_template.template_name 
												FROM tbl_internship_application_files 
												JOIN tbl_internship_application ON tbl_internship_application.application_id = tbl_internship_application_files.application_id 
												JOIN tbl_template ON tbl_template.template_id = tbl_internship_application_files.template_id
												WHERE tbl_internship_application_files.application_id = '$application_id'";
										$result = mysqli_query($con, $query);
										if(mysqli_num_rows($result) > 0){
										while($row = mysqli_fetch_array($result)){
											
											$application_file_dir = $row['application_file_dir'];
											$template_name = $row['template_name'];
											$application_file_size = $row['application_file_size'];
									?>
										
										<tr> 
											<td colspan="3">
											<?php 
												echo '<a href="../upload/student/'.$application_id.'/'.$application_file_dir.'" download>'.$template_name.'</a>';
												echo " (".$application_file_size.")"; 
											?>
											</td>
										</tr>	
										
									<?php
										}
										}
									?>
									<tr>  
										<td colspan="3"></td>  
									</tr>
									<tr>  
										<td colspan="3"><label><i><u>Application of Crediting of Internship Hours</u></i></label></td>  	
									</tr>
									<tr> 
										<th>Name of Document</th>
										<th>Hours</th>
										<th>Status</th>
									</tr>	
									<?php 
										//$query = $_SESSION['query'];
										$query = "SELECT tbl_internship_application_credit.application_credit_dir, tbl_internship_application_credit.application_credit_size, tbl_internship_application_credit.status_flag, tbl_internship_hours_credit.credit_hrs_name, tbl_internship_hours_credit.credit_hrs, tbl_status.status_name 
											FROM tbl_internship_application_credit 
											JOIN tbl_internship_application ON tbl_internship_application.application_id = tbl_internship_application_credit.application_id
											JOIN tbl_internship_hours_credit ON tbl_internship_hours_credit.credit_hrs_id = tbl_internship_application_credit.credit_hrs_id
											JOIN tbl_status ON tbl_status.status_id = tbl_internship_application_credit.status_flag
											WHERE tbl_internship_application_credit.application_id = '$application_id'";
										$result = mysqli_query($con, $query);
										if(mysqli_num_rows($result) > 0){
										while($row = mysqli_fetch_array($result)){
											
											$application_credit_dir = $row['application_credit_dir'];
											$application_credit_size = $row['application_credit_size'];
											$status_flag_cr = $row['status_flag'];
											
											$credit_hrs_name = $row['credit_hrs_name'];
											$credit_hrs = $row['credit_hrs'];
											
											$status_name = $row['status_name'];
											
											if ($status_flag_cr == "1"){
												$approved_credit_hours = $approved_credit_hours + $credit_hrs;
											}
											else{
												$approved_credit_hours = "0";
											}
									?>
										
										<tr> 
											<td>
											<?php 
												echo '<a href="../upload/student/'.$application_id.'/'.$application_credit_dir.'" download>'.$credit_hrs_name.'</a>';
												echo " (".$application_credit_size.")"; 
											?>
											</td>
											<td >
												<?php echo $credit_hrs; ?> hours
											</td>
											<td >
												<?php echo ucwords($status_name); ?>
											</td>
										</tr>	
										
									<?php
										}
										}
									?>
									<tr>  
										<td colspan="3"></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Final Internship Hours </b></td>
										<td width="50%"colspan="2"><b>
											<?php 
												if ($status_flag == '1'){
													echo $internship_hrs - $approved_credit_hours." hours"; 
												}
												else{
													echo "-";
												}
											?>
										</b></td>
									</tr>
									<tr>  
										<td width="30%"><b>Comment </b></td>
										<td width="50%"colspan="2">
											<?php if ($comment == "") { echo "<b>-</b>"; } else {echo $comment; }?> 
										</td>
									</tr>
									<tr>  
										<td colspan="3"></td>  
									</tr>
									<?php
										if ($status_flag != '0' ){
									?>
										<tr>  
											<td colspan="3" align="center">
												<button type="submit" name="application_id" value="<?php echo $application_id; ?>" class="view btn btn-danger btn-xs active_flg">View/Download your Application</button>
											</td>  
										</tr>
									<?php
										}
									?>
								</table>
								
							</div>
						</form>
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