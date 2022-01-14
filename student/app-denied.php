<?php
	// Initialize the session
	include '../connect.php';
	include '../components/student/get-details.php';
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
	$_SESSION['fname'] = $db_fname
	$_SESSION['reset'] = "true";
	*/
	
	// Checks if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== $word ){
		header("location: ../login/index.php");
		exit;	
	}
	
	if(!isset($_SESSION['reset'])){
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
		
		<!------ Upload photo css/js ---------->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
		#about .about-content input[type="submit"] {
			background: #b30000;
			border: 0;
			border-radius: 3px;
			padding: 8px 20px;
			color: #fff;
			transition: 0.3s;
			font-size: 13px;
		}
		.table tr { line-height: 10px; }
		.table-bordered  td{
			vertical-align: middle;
		}
		<!-- for file upload -->
		#img-upload{
			width: 100%;
		}
		.btn-file {
			position: relative;
			overflow: hidden;
		}
		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}
		
		#img-upload{
			width: 30%;
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
					<h1 class="text-light"><a href="application.php" class="scrollto"><span>Web•IMS</span></a></h1>
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
						<li class="active drop-down"><a href="application.php">Application</a>
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

				<div class="container" style="padding-left:30px;">
				
					<div class="about-content"  style="text-align:center;">
						<h2>Internship Application </h2>
						<h4 style="margin-top:-15px;">
						<?php
							$query_term = "SELECT * FROM tbl_acad_term WHERE current_flag = '1'";
							$result_term = mysqli_query($con, $query_term);
							while($row = mysqli_fetch_array($result_term)){
								$term_id = $row['term_id'];
								$_SESSION['term_id'] = $term_id;
								$term_name = $row["term_name"];
								$term_from_year = $row["term_from_year"];
								$term_to_year = $row["term_to_year"];
								echo $term_desc = $term_name.", AY ".$term_from_year." - ".$term_to_year;
							}
						?>
						</h4>
					</div>
					
					<div class="about-content"  style="text-align:justify; padding-top:10px;"> <!-- action="../components/student/app-view-process.php" -->
						<form role="form" id="contact-form" method="post" enctype="multipart/form-data" action="../components/student/app-view-process.php" >
							<div class="table-responsive">  
							
								<p align="right" style="margin-bottom:1px; font-size:0.75em;"><a href="profile.php">Change your information? Click here.</a></p>
							
								<table class="table table-bordered ">
									<tr>  
										<td width="30%"><b>Date Filed: </b></td>  
										<td width="50%"><?php echo $current; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Application Number: </b></td> 
										<td width="50%">
										<?php
											//get ID
											$cntID_qry = "SELECT application_id, COUNT(*) as total FROM tbl_internship_application WHERE application_id LIKE '%$year_now%'";
											$cntID_rslt = mysqli_query($con, $cntID_qry);
											if(mysqli_num_rows($cntID_rslt) > 0){
												while($row = mysqli_fetch_assoc($cntID_rslt)){
													$total = $row['total'];
													$total = $total+1;
													$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
													echo $application_id_db = "CCSIR-".$year_now."-".$counter;
													$_SESSION['application_id_db'] = $application_id_db;
												}
											}
										?>
										</td>  
									</tr>
									<tr>  
										<td colspan="2"></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Student Number: </b></td>  
										<td width="50%"><?php echo $student_number; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Name: </b></td>  
										<td width="50%"><?php echo $fullName; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Year and Course: </b></td>  
										<td width="50%"><?php echo $year_level_desc." ".$course_fullname; ?></td>  
									</tr>
									<tr>  
										<td colspan="2"></td>  
									</tr>
									<tr>  
										<td colspan="2"><label><i><u>Contact Information </u></i></label></td>  	
									</tr>
									<tr>  
										<td width="30%"><b>Mobile Number: </b></td>  
										<td width="50%"><?php echo $contact_num; ?></td>  
									</tr>
										<tr>  
										<td width="30%"><b>Primary Email Address: </b></td>  
										<td width="50%"><?php echo $username; ?></td>  
									</tr>
									</tr>
										<tr>  
										<td width="30%"><b>Alternate Email Address</b></td>  
										<td width="50%"><?php echo $contact_email; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Home Address: </b></td>  
										<td width="50%"><?php echo $contact_add; ?></td>  
									</tr>
									<tr>  
										<td colspan="2"></td>  
									</tr>
									<tr>  
										<td colspan="2"><label><i><u>In case of emergency contact </u></i></label></td>  	
									</tr>
									<tr>  
										<td width="30%"><b>Name: </b></td>  
										<td width="50%"><?php echo $emergency_name; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Relationship: </b></td>  
										<td width="50%"><?php echo $emergency_rel; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Mobile Number: </b></td>  
										<td width="50%"><?php echo $emergency_num; ?></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Home Address: </b></td>  
										<td width="50%"><?php echo $emergency_add; ?></td>  
									</tr>
									<tr>  
										<td colspan="2"></td>  
									</tr>
									<tr>  
										<td width="30%"> <b>Internship Hours: </b></td>  
										<td width="50%">
											<select name="internship_hours"  id="internship_hours" class="form-control" required>
												<option value="" disabled selected>Choose here</option>
												<?php 
													$int_hrs_qry = "SELECT * FROM tbl_internship_hours WHERE course_id='$course_id'";
													$int_hrs_rslt = mysqli_query($con, $int_hrs_qry);
													if(mysqli_num_rows($int_hrs_rslt) > 0){
														while($row = mysqli_fetch_assoc($int_hrs_rslt)){
															echo "<option value='".$row['internship_hrs_id']."'>".$row['internship_hrs']." hours</option>";
														}
													}
												?>
											</select>
										</td>  
									</tr>
									<tr>  
										<td colspan="2"></td>  
									</tr>
									<tr>  
										<td width="30%"><b>Application Photo</b></td>  
										<td width="50%">
											<div class="input-group">
												<span class="input-group-btn">
													<span class="btn btn-default btn-file">
														Browse… <input type="file" id="imgInp" name="app_img" accept="image/*" required />
													</span>
												</span>
												<input type="text" class="form-control" readonly>
											</div>
										</td>  
									</tr>
									<tr>  
										<td colspan="2" >  <img id='img-upload'/></td>    
									</tr>
									<tr>  
										<td colspan="2"><label><i><u>Internship Files</u></i></label></td>  	
									</tr>
									<?php 
										
										$int_files_qry = "SELECT tbl_template.template_id, tbl_template.template_name FROM tbl_template 
														JOIN tbl_template_category ON tbl_template_category.temp_category_id = tbl_template.temp_category_id
														WHERE tbl_template_category.temp_category_name LIKE '%prelim%' AND tbl_template.delete_flag='0'";
										$int_files_rslt = mysqli_query($con, $int_files_qry);
										if(mysqli_num_rows($int_files_rslt) > 0){
											while($row = mysqli_fetch_assoc($int_files_rslt)){
												$template_id = $row['template_id'];
												
									?>
												<tr> 
													<td width="30%"><b><?php echo $row['template_name']; ?></b></td>  
													<td width="50%">
														<input type="file" class="form-control" name="internshipFile[]" id='internshipFile' accept='.pdf,.doc,.docx' required />
														<input type="hidden" name="templateID[]" id="templateID" value="<?php echo $template_id; ?>" /> 
													</td>  
												</tr>
									<?php
									
											}
										}
									?>
									<tr>  
										<td colspan="2"></td>  
									</tr>
									<tr>  
										<td colspan="2"><label><i><u>Crediting of Hours (upload your supporting documents)</u></i></label>
										
										</td>  	
									</tr>
									<?php 
										$cred_hrs_qry = "SELECT * FROM tbl_internship_hours_credit WHERE college_id = '$college_id'";
										$cred_hrs_rslt = mysqli_query($con, $cred_hrs_qry);
										if(mysqli_num_rows($cred_hrs_rslt) > 0){
											while($row = mysqli_fetch_assoc($cred_hrs_rslt)){
												$credit_hrs_id = $row['credit_hrs_id'];
												
									?>
												<tr> 
													<td width="30%"><b><?php echo $row['credit_hrs_name']; ?></b></td>  
													<td width="50%">
														<input type="file" class="form-control" name="credithrsFile[]" id='credithrsFile' accept='.pdf,.doc,.docx' />
														<input type="hidden" name="credithrsID[]" id="credithrsID" value="<?php echo $credit_hrs_id; ?>" /> 
													</td>  
												</tr>
									<?php
									
											}
										}
									?>
									<tr>  
										<td colspan="2"></td>  
									</tr>

									<tr>  
										<td colspan="2" style=" line-height: 1.6;">
											<input type="checkbox" name="status" id="status" required >
											By ticking this box, I hereby acknowledge and certify that I have carefully read and understood the terms and conditions of the Data Privacy Policy of the Lyceum of the Philippines University (LPU). By providing personal information to LPU, I am confirming that the data is true and correct. I understand that LPU reserves the right to revise any decision made on the basis of the information I provided should the information be found to be untrue or incorrect. I likewise agree that any issue that may arise in connection with processing of my personal information will be settled amicably with LPU before resorting to appropriate arbitration or court proceedings within the Philippine jurisdiction. Finally, I am providing my voluntary consent and authorization to LPU and its duly authorized representatives to lawfully process my/my child’s data/Information.
										</td>  	
									</tr>
									<tr>  
										<td colspan="2" align="center"><input type="submit" class="register btn" name="submitForm" id="submitForm" value="Submit Application"></input>
										</td>  
									</tr>
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
<script type="text/javascript">
	$(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		}); 

		
	});

</script>