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
		<script src="../js/main.js"></script>

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
			padding-top: 50px;	
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
						<a href="https://www.facebook.com/lpu.csi.iao/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
						<a href="https://www.instagram.com/lpu.csi.iao/" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
					</div>
				</div>
			</div>

			<div class="container">

				<div class="logo float-left">
					<!-- Uncomment below if you prefer to use an image logo -->
					<h1 class="text-light"><a href="index.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>

				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="../index.php">Back to Home</a></li>
					</ul>
				</nav><!-- .main-nav -->

			</div>
		</header><!-- #header -->

		<!--==========================
		Main
		============================-->
		<main id="main">

			<section id="login">
				<div class="form">

					<h4>Registration</h4>

					<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validateContactForm()">
						
						<div class="form-group">
							<label for="stud_num">Student Number: <font color="red">*</font></label>
							<input type="text" class="form-control" name="stud_num" id="stud_num" placeholder="2021-2-00000" pattern="\d{4}[\-]\d{1}[\-]\d{5}" value="<?php echo $_POST["stud_num"]; ?>" />
							<div id="stud_num-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="first_name">First Name: <font color="red">*</font></label>
							<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $_POST["first_name"]; ?>" />
							<div id="first_name-info" class="info"></div>
						</div>	
						
						<div class="form-group">
							<label for="last_name">Last Name: <font color="red">*</font></label>
							<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $_POST["last_name"]; ?>" />
							<div id="last_name-info" class="info"></div>
						</div>				
						
						<div class="form-group">
							<label for="user_name">University / Office365 Email: <font color="red">*</font> </label>
							<input type="email" class="form-control" name="user_name" id="user_name" value="<?php echo $_POST["user_name"]; ?>" />
							<div id="user_name-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="college">College: <font color="red">*</font></label>
							<select name="college"  id="college" class="form-control">
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
							<div id="college-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="course">Course: <font color="red">*</font></label>
							<select name="course"  id="course" class="form-control">
								<option value="">Choose here</option>
							</select>
							<div id="course-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="year_level">Year Level: <font color="red">*</font></label>
							<select name="year_level"  id="year_level" class="form-control" >
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
							<div id="year_level-info" class="info"></div>
						</div>
			 
						<div class="form-group">
							<input type="submit" name="register" value="Register"></input>
						</div>


						<div class="form-group">
							<p>Already have an account?<a href="../login/index.php"><b>Sign in</b></a>
						</div>

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

		<!--
		<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
		<!-- Uncomment below i you want to use a preloader -->
		<!-- <div id="preloader"></div> -->

	</body>
</html>

<script type="text/javascript" language="javascript" >
	function validateContactForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var stud_num = $("#stud_num").val();
		var user_name = $("#user_name").val();
		
		var first_name = $("#first_name").val();
		var last_name = $("#last_name").val();
		
		var college = $("#college").val();
		var course = $("#course").val();
		var year_level = $("#year_level").val();
		
		if (stud_num == "") {
			$("#stud_num-info").html("Please supply necessary information.");
			$("#stud_num").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (user_name == "") {
			$("#user_name-info").html("Please supply necessary information.");
			$("#user_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (!user_name.match(/^[^@]+@(lpunetwork)\.edu.ph$/i)){
			$("#user_name-info").html("Please enter only your Office365 email address.");
			$("#user_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (first_name == "") {
			$("#first_name-info").html("Please supply necessary information.");
			$("#first_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (last_name == "") {
			$("#last_name-info").html("Please supply necessary information.");
			$("#last_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (college == "") {
			$("#college-info").html("Please select one option.");
			$("#college").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (course == "") {
			$("#course-info").html("Please select one option.");
			$("#course").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (year_level == "") {
			$("#year_level-info").html("Please select one option.");
			$("#year_level").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		
		return valid;
	}
	
	$(document).ready(function(){
		
		$("#college").change(function(){
			var cid=$(this).val();
			$.ajax({
				url:'../components/config-section/load_course.php',
				type:'post',
				data:{id:cid},
				success:function(res){	
					$('#course').prop('disabled', false);
					$("#course").html(res);
				}
			});
		});
		
	});
</script>