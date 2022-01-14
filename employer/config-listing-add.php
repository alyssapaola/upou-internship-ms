<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	$word = "employer";
	
	date_default_timezone_set('Asia/Manila');
	$time = time();
	
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
	
	if(!empty($_POST["register"])) {
		require_once "../components/config-listing/add.php";
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
		<script src="../lib/jquery/jquery.min.js"></script>
		<script src="../lib/jquery/jquery-migrate.min.js"></script>
		<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
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
		
		<!-- Select Multiple Tag -->
		<link rel="stylesheet" href="../lib/chosen/docsupport/prism.css">
		<link rel="stylesheet" href="../lib/chosen/docsupport/first.css">
		<link rel="stylesheet" href="../lib/chosen/chosen.css">

		<!-- =======================================================
			Theme Name: Rapid
			Theme URL: https://bootstrapmade.com/rapid-multipurpose-bootstrap-business-template/
			Author: BootstrapMade.com
			License: https://bootstrapmade.com/license/
		======================================================= -->
		
	</head>
	
	<style>
		input[type=submit] {
			background: #b30000;
			border: 0;
			border-radius: 3px;
			padding: 8px 20px;
			color: #fff;
			transition: 0.3s;
			font-size: 13px;
		}
		.info {
			font-size: .8em;
			color: #ff0000;
			padding-left: 5px;
		}
		#header {
			background: #f2f2f2;
		}
		#main{
			padding-top: 20px;	
		}
		
		#login .form .form-group {
			text-align: left;
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
						<li><a href="config-listing.php">Back to Home</a></li>
					</ul>
				</nav><!-- .main-nav -->
				
			</div>
		</header><!-- #header -->
		
		<!--==========================
			Main Content
			============================-->
			
		<main id="main">
			<section id="login">
				<div class="form">

					<h4>Job Posting</h4>

					<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validateContactForm()">
						
						<div class="form-group">
							<label for="job_title"><b>Job Title <font color="red">*</font> </b></label>
							<input type="text" class="form-control" name="job_title" id="job_title" value="<?php echo $_POST['job_title']; ?>" />
							<div id="job_title-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="job_desc"><b>Description <font color="red">*</font> </b></label>
							<textarea name="job_desc" id="job_desc" class="form-control" ><?php echo $_POST['job_desc']; ?></textarea>
							<div id="job_desc-info" class="info"></div>
						</div>		
						
						<div class="form-group">
							<label for="job_vac"><b>No. of Vacancies <font color="red">*</font> </b></label>
							<input type="text" class="form-control" name="job_vac" id="job_vac" value="<?php echo $_POST['job_vac']; ?>" />
							<div id="job_vac-info" class="info"></div>
						</div>		
						
						<div class="form-group">
							<label for="job_category"><b>Applicable for Courses <font color="red">*</font> </b></label>
							<select data-placeholder="Choose here" class="chosen-select form-control" tabindex="6"  id="job_category" name="job_category[]" multiple>
								<option ></option>
								<?php 
									$college_qry = "SELECT * FROM  tbl_college ORDER BY college_fullname ASC";
									$college_rslt = mysqli_query($con, $college_qry);
									if(mysqli_num_rows($college_rslt) > 0){
										while($college_row = mysqli_fetch_assoc($college_rslt)){
											$college = $college_row['college_id'];
											echo "<optgroup label='".$college_row['college_fullname']."'>";
											
											$course_qry = "SELECT * FROM  tbl_course WHERE college_id = '$college' ORDER BY course_fullname ASC";
											$course_rslt = mysqli_query($con, $course_qry);
											if(mysqli_num_rows($course_rslt) > 0){
												while($course_row = mysqli_fetch_assoc($course_rslt)){
													echo "<option value='".$course_row['course_id']."'>".$course_row['course_fullname']."</option>";
												}
											}
											
										}
									}
								?>
								</optgroup>
							</select>
							<div id="job_category-info" class="info"></div>
						</div>	
						
						<div class="form-group">
							<input type="checkbox" name="job_salary" id="job_salary"  >
							<label for="job_salary"><b>With Salary/Allowance Provided? </b></label>
							
							<div id="job_salary-info" class="info"></div>
						</div>
						
						<input type="submit" name="register" value="Post"></input>
						
					</form>
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
		
		<!-- Select Multiple Tag -->
		<script src="../lib/chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="../lib/chosen/chosen.jquery.js" type="text/javascript"></script>
		<script src="../lib/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
		<script src="../lib/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
		
	</body>
</html>

<script type="text/javascript">
	
	function validateContactForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var job_title = $("#job_title").val();
		var job_desc = $("#job_desc").val();
		var job_vac = $("#job_vac").val();
		var job_category = $("#job_category").val();
		var job_salary = $("#job_salary").val();
		
		
		if (job_title == "") {
			$("#job_title-info").html("Please supply necessary information.");
			$("#job_title").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (job_desc == "") {
			$("#job_desc-info").html("Please supply necessary information.");
			$("#job_desc").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (job_vac == "") {
			$("#job_vac-info").html("Please supply necessary information.");
			$("#job_vac").css('border', '#ff0000 1px solid');
			valid = false;
		}
		else{
			if (!job_vac.match(/^[0-9]+$/)){
				$("#job_vac-info").html("Please enter numeric characters only.");
				$("#job_vac").css('border', '#ff0000 1px solid');
				valid = false;
			}
		}
		if (job_category == "") {
			$("#job_category-info").html("Please select one option.");
			$("#job_category").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		return valid;
	}
	
</script>