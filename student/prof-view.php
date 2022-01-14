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
		.form-group input[type="submit"] {
			background: #b30000;
			border: 0;
			border-radius: 3px;
			padding: 8px 20px;
			color: #fff;
			transition: 0.3s;
			font-size: 13px;
		}
		
		.info-box {
			box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 50%);
			border-radius: .75rem;
			padding: 8px 20px;
			width: 70%;
		}
		
		.form-group{
			width: 70%;
		}
		
		.info {
			font-size: .7em;
			color: #ff0000;
			padding-left: 5px;
		}
		
		#con_address, #emer_address {
		  resize: none;
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
					<h1 class="text-light"><a href="profile.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="drop-down"><a href="orientation.php">Orientation</a>
							<ul>
								<li><a href="or-history.php">History</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="application.php">Application</a>
							<ul>
								<li><a href="app-records.php">Records</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="vacancies.php">Job Vacancies</a>
							<ul>
								<li><a href="vac-applications.php">Applications</a></li>
								<li><a href="vac-history.php">History</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="#">Reports</a>
							<ul>
								<li><a href="templates.php">Templates</a></li>
							</ul>
						</li>
						<li class="active"><a href="profile.php">Profile</a></li>
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
							<h2>Profile</h2>
							<h6><i>Edit your profile that matches with your basic information</h6>
							<?php if ($student_details_flag == 0){ ?>
								<h6 id = "div2" style="color:red;"><i>Reminder to complete first your profile.</h6>
							<?php } ?>
						</div>
						
						
					</div>
					
					<br>
					
					<div class="table-responsive info-box">
			
						<h5 class="basic-info-flip"><b>Basic Information </b><sub style=" font-size: x-small;">(click to show/hide panel) </sub> </h5>
 
						<div class="basic-info-panel" style="display:none">  
							<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validate_BasicInfoForm()">
						
								<div class="form-group">
									<label for="basic_firstname">First Name: <font color="red">*</font></label>
									<input type="text" class="form-control" name="basic_firstname" id="basic_firstname" value="<?php echo $firstname_db; ?>"  />
									<div id="basic_firstname-info" class="info"></div>
								</div>	
								
								<div class="form-group">
									<label for="basic_lastname">Last Name: <font color="red">*</font></label>
									<input type="text" class="form-control" name="basic_lastname" id="basic_lastname" value="<?php echo $lastname_db; ?>"  />
									<div id="basic_lastname-info" class="info"></div>
								</div>				
								
								<div class="form-group">
									<label for="basic_email">University / Office365 Email: <font color="red">*</font> </label>
									<input type="email" class="form-control" name="basic_email" id="basic_email" value="<?php echo $username_db; ?>"  />
									<div id="basic_email-info" class="info"></div>
								</div>
							
								<div class="form-group">
									<input type="submit" name="save_basic_info" value="Save Changes"></input>
								</div>
								
							</form>
						</div>
						
					</div>
					
					<br>
					
					<div class="table-responsive info-box">
			
						<h5 class="contact-info-flip"><b>Contact Information </b><sub style=" font-size: x-small;">(click to show/hide panel) </sub> </h5>
 
						<div class="contact-info-panel" style="display:none">  
							<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validate_ContactInfoForm()">
						
								<div class="form-group">
									<label for="con_mobilenum">Mobile Number <font color="red">*</font></label>
									<input type="text" class="form-control" name="con_mobilenum" id="con_mobilenum" value="<?php echo $contact_num_db; ?>" pattern="[09][0-9]{10}"  />
									<div id="con_mobilenum-info" class="info"></div>
								</div>	
								
								<div class="form-group">
									<label for="con_email">Alternate Email Address <font color="red">*</font></label>
									<input type="email" class="form-control" name="con_email" id="con_email" value="<?php echo $contact_email_db; ?>" />
									<div id="con_email-info" class="info"></div>
								</div>				
								
								<div class="form-group">
									<label for="con_address">Home Address: <font color="red">*</font> </label>
									<textarea class="form-control" name="con_address" id="con_address" ><?php echo $contact_add_db; ?></textarea>
									<div id="con_address-info" class="info"></div>
								</div>
							
								<div class="form-group">
									<input type="submit" name="save_contact_info" value="Save Changes"></input>
								</div>
								
							</form>
						</div>
						
					</div>
					
					<br> 
					
					<div class="table-responsive info-box">
						
						<h5 class="educ-info-flip"><b>Education Information </b><sub style=" font-size: x-small;">(click to show/hide panel) </sub> </h5>
 
						<div class="educ-info-panel" style="display:none">  
							<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validate_EducInfoForm()">
							
								<div class="form-group">
									<label for="educ_stud_num">Student Number: <font color="red">*</font></label>
									<input type="text" class="form-control" name="educ_stud_num" id="educ_stud_num" pattern="\d{4}[\-]\d{1}[\-]\d{5}" value="<?php echo $student_number_db; ?>" />
									<div id="educ_stud_num-info" class="info"></div>
								</div>
							
								<div class="form-group">
									<label for="educ_college">College: <font color="red">*</font></label>
									<select name="educ_college"  id="educ_college" class="form-control" >
										<option value="">Choose here</option>
										<?php
											if ($college_id_db != "") {
										?>
											<option value="<?php echo $college_id_db; ?>" selected ><?php echo $college_fullname_db; ?></option>
										<?php
											}
										?>
										<?php 
											$college_qry = "SELECT * FROM  tbl_college WHERE delete_flag='0' AND college_id != '$college_id_db'";
											$college_rslt = mysqli_query($con, $college_qry);
											if(mysqli_num_rows($college_rslt) > 0){
												while($row = mysqli_fetch_assoc($college_rslt)){
													
													echo "<option value='".$row['college_id']."'>".$row['college_fullname']."</option>";
												}
											}
										?>
									</select>
									<div id="educ_college-info" class="info"></div>
								</div>
							
								<div class="form-group">
									<label for="educ_course">Course: <font color="red">*</font></label>
									<select name="educ_course"  id="educ_course" class="form-control" >
										<option value="">Choose here</option>
										<option value="<?php echo $course_id_db; ?>" selected ><?php echo $course_fullname_db; ?></option>
										<?php
											$course_type_qry = "SELECT * FROM tbl_course WHERE college_id = '".$college_id_db."' AND course_id != '$course_id_db'";
											$course_type_rslt = mysqli_query($con, $course_type_qry);
											if(mysqli_num_rows($course_type_rslt) > 0){
												while($row = mysqli_fetch_assoc($course_type_rslt)){
													echo "<option value='".$row['course_id']."'>".$row['course_fullname']."</option>";
												}
											}
										?>
									</select>
									<div id="educ_course-info" class="info"></div>
								</div>
								
								<div class="form-group">
									<label for="educ_year">Year Level: <font color="red">*</font></label>
									<select name="educ_year"  id="educ_year" class="form-control" >
										<option value="">Choose here</option>
										<?php
											if ($year_level_desc_db != "") {
										?>
											<option value="<?php echo $year_level_db; ?>" selected ><?php echo $year_level_desc_db; ?></option>
										<?php
											}
										?>
										
										<?php
											$year_level_qry = "SELECT * FROM tbl_year_level WHERE year_level_id != '$year_level_db'";
											$year_level_rslt = mysqli_query($con, $year_level_qry);
											if(mysqli_num_rows($year_level_rslt) > 0){
												while($row = mysqli_fetch_assoc($year_level_rslt)){
													echo "<option value='".$row['year_level_id']."'>".$row['year_level_desc']."</option>";
												}
											}
										?>
									</select>
									<div id="educ_year-info" class="info"></div>
								</div>
								
								<div class="form-group">
									<input type="submit" name="save_educ_info" value="Save Changes"></input>
								</div>
							</form>
						</div>
						
					</div>
					
					<br>
					
					<div class="table-responsive info-box">
			
						<h5 class="emergency-info-flip"><b>Emergency Contact Information </b><sub style=" font-size: x-small;">(click to show/hide panel) </sub> </h5>
 
						<div class="emergency-info-panel" style="display:none">  
							<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validate_EmergencyInfoForm()">
								
								<div class="form-group">
									<label for="emer_name">Name: <font color="red">*</font></label>
									<input type="text" class="form-control" name="emer_name" id="emer_name" value="<?php echo $emergency_name_db; ?>"  />
									<div id="emer_name-info" class="info"></div>
								</div>
								
								<div class="form-group">
									<label for="emer_rel">Relationship: <font color="red">*</font></label>
									<input type="text" class="form-control" name="emer_rel" id="emer_rel" value="<?php echo $emergency_rel_db; ?>"  />
									<div id="emer_rel-info" class="info"></div>
								</div>
								
								<div class="form-group">
									<label for="emer_mobilenum">Mobile Number: <font color="red">*</font></label>
									<input type="text" class="form-control" name="emer_mobilenum" id="emer_mobilenum" value="<?php echo $emergency_num_db; ?>" pattern="[09][0-9]{10}"  />
									<div id="emer_mobilenum-info" class="info"></div>
								</div>	
							
								<div class="form-group">
									<label for="emer_address">Home Address: <font color="red">*</font> </label>
									<textarea class="form-control" name="emer_address" id="emer_address" ><?php echo $emergency_add_db; ?></textarea>
									<div id="emer_address-info" class="info"></div>
								</div>
							
								<div class="form-group">
									<input type="submit" name="save_emergency_info" value="Save Changes"></input>
								</div>
								
							</form>
						</div>
						
					</div>
					
					<br> 
					
					<div class="table-responsive info-box">
		
						<h5 class="change-pass-flip"><b>Change Password </b><sub style=" font-size: x-small;">(click to show/hide panel) </sub> </h5>
 
						<div class="change-pass-panel" style="display:none">  
							<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validate_ChangePassForm()">
							
							<div class="form-group">
								<label for="old_pass">Old Password: <font color="red">*</font></label>
								<input type="password" class="form-control" name="old_pass" id="old_pass" />
								<input type="hidden" class="form-control" name="old_pass_hid" id="old_pass_hid" value="<?php echo $old_pass_db; ?>" />
								<div id="old_pass-info" class="info"></div>
							</div>
							
							<div class="form-group">
								<label for="new_pass">New Password: <font color="red">*</font></label>
								<input type="password" class="form-control" name="new_pass" id="new_pass" />
								<div id="new_pass-info" class="info"></div>
							</div>
							
							<div class="form-group">
								<label for="confirm_pass">Confirm Password: <font color="red">*</font></label>
								<input type="password" class="form-control" name="confirm_pass" id="confirm_pass" />
								<div id="confirm_pass-info" class="info"></div>
							</div>
						
							<div class="form-group">
								<input type="submit" name="save_change_pass" value="Save Changes"></input>
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

<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="../lib/js-md5/md5.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$('#educ_course').prop('disabled', true);
		$('#educ_year').prop('disabled', true);
		
		var isFade = true;

		function test() {
			if (!isFade){ 
				return false;
			}
			$("#div2").fadeToggle("slow", test);
		}
		
		test();
		
		$("#educ_college").change(function(){
			var cid=$(this).val();
			$.ajax({
				url:'../components/config-section/load_course.php',
				type:'post',
				data:{id:cid},
				success:function(res){	
					$('#educ_course').prop('disabled', false);
					$("#educ_course").html(res);
					$('#educ_year').prop('disabled', false);
				}
			});
		});
		
		$(".basic-info-flip").click(function() {
			$(".basic-info-panel").slideToggle("slow");
		});
		
		$(".contact-info-flip").click(function() {
			$(".contact-info-panel").slideToggle("slow");
		});
	
		$(".educ-info-flip").click(function() {
			$(".educ-info-panel").slideToggle("slow");
		});
		
		$(".emergency-info-flip").click(function() {
			$(".emergency-info-panel").slideToggle("slow");
		});
		
		$(".change-pass-flip").click(function() {
			$(".change-pass-panel").slideToggle("slow");
		});
		
	});
	
	function validate_BasicInfoForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var basic_firstname = $("#basic_firstname").val();
		var basic_lastname = $("#basic_lastname").val();
		var basic_email = $("#basic_email").val();
		
		if (basic_firstname == "") {
			$("#basic_firstname-info").html("Please supply necessary information.");
			$("#basic_firstname").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (basic_lastname == "") {
			$("#basic_lastname-info").html("Please supply necessary information.");
			$("#basic_lastname").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (basic_email == "") {
			$("#basic_email-info").html("Please supply necessary information.");
			$("#basic_email").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (!basic_email.match(/^[^@]+@(lpunetwork)\.edu.ph$/i)){
			$("#basic_email-info").html("Please enter only your Office365 email address.");
			$("#basic_email").css('border', '#ff0000 1px solid');
			valid = false;
		}
		return valid;
	}
	
	function validate_ContactInfoForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var con_mobilenum = $("#con_mobilenum").val();
		var con_email = $("#con_email").val();
		var con_address = $("#con_address").val();
		
		if (con_mobilenum == "") {
			$("#con_mobilenum-info").html("Please supply necessary information.");
			$("#con_mobilenum").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (con_email == "") {
			$("#con_email-info").html("Please supply necessary information.");
			$("#con_email").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (con_address == "") {
			$("#con_address-info").html("Please supply necessary information.");
			$("#con_address").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		return valid;
	}
	
	function validate_EducInfoForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var educ_stud_num = $("#educ_stud_num").val();
		var educ_college = $("#educ_college").val();
		var educ_course = $("#educ_course").val();
		var educ_year = $("#educ_year").val();
		
		if (educ_stud_num == "") {
			$("#educ_stud_num-info").html("Please supply necessary information.");
			$("#educ_stud_num").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (educ_college == "") {
			$("#educ_college-info").html("Please select one option.");
			$("#educ_college").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (educ_course == "") {
			$("#educ_course-info").html("Please select one option.");
			$("#educ_course").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (educ_year == "") {
			$("#educ_year-info").html("Please select one option.");
			$("#educ_year").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		return valid;
	}
	
	function validate_EmergencyInfoForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var emer_name = $("#emer_name").val();
		var emer_rel = $("#emer_rel").val();
		var emer_mobilenum = $("#emer_mobilenum").val();
		var emer_address = $("#emer_address").val();
		
		if (emer_name == "") {
			$("#emer_name-info").html("Please supply necessary information.");
			$("#emer_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (emer_rel == "") {
			$("#emer_rel-info").html("Please supply necessary information.");
			$("#emer_rel").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (emer_mobilenum == "") {
			$("#emer_mobilenum-info").html("Please supply necessary information.");
			$("#emer_mobilenum").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (emer_address == "") {
			$("#emer_address-info").html("Please supply necessary information.");
			$("#emer_address").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		return valid;
	}
	
	function validate_ChangePassForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var old_pass = $("#old_pass").val();
		var old_pass_hid = $("#old_pass_hid").val();
		var new_pass = $("#new_pass").val();
		var confirm_pass = $("#confirm_pass").val();
		
		var old_pass_md5 = md5(old_pass);
		
		if (old_pass == "") {
			$("#old_pass-info").html("Please supply necessary information.");
			$("#old_pass").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (old_pass_md5 !== old_pass_hid) {
			$("#old_pass-info").html("Password does not match with your current");
			$("#old_pass").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		if (new_pass == "") {
			$("#new_pass-info").html("Please supply necessary information.");
			$("#new_pass").css('border', '#ff0000 1px solid');
			valid = false;
		}
		else if (new_pass.length < 6 ){
			$("#new_pass-info").html("Password must have atleast 6 characters.");
			$("#new_pass").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (confirm_pass == "") {
			$("#confirm_pass-info").html("Please supply necessary information.");
			$("#confirm_pass").css('border', '#ff0000 1px solid');
			valid = false;
		}
		else if (confirm_pass !== new_pass) {
			$("#confirm_pass-info").html("Password does not match");
			$("#confirm_pass").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		return valid;
	}
	
</script>