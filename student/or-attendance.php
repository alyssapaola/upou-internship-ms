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
		
		<!-- swal alert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		<!-- convert date format -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
		
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
		#about .about-content button[type="button"] {
			background: #b30000;
			border: 0;
			border-radius: 3px;
			padding: 8px 20px;
			color: #fff;
			transition: 0.3s;
			font-size: 13px;
		}
		
		.swal-text {color:black;text-align: center;}
		.swal-button {background: #b30000;color: #fff;}
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
					<h1 class="text-light"><a href="orientation.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="active drop-down"><a href="orientation.php">Orientation</a>
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
							<h2>Orientation Attendance </h2>
							
						</div>
					</div>
				</div>
				
				<!-- This panel will be displayed if student doesnt mark their attendance yet -->
				
				<?php
				
				if($attendance_flag_db == 0){
					
					// check first if orientation date is past the current date
					// nov 3 <= nov 11
					if ($current_date <= $date_database ) {
					
				?>
				
						<div class="container"  style="text-align:justify; padding-top:20px;">
							<p>
								Hello, <?php echo $_SESSION['fname']; ?>, you are expected to attend the orientation for <?php echo $term_desc_db; ?>. Check out the following details for your reference.<br><b>Note:</b> Visit the portal after the orientation to mark your attendance and download/view your certificate.
							</p>
							
						</div>
					
						<div class="container" style="padding-left:30px;">
							<div class="row info-box" style="width:80%;" >
								<div class="about-content"  style="text-align:justify; padding-top:10px;">
									
									<form role="form" id="contact-form" method="post">
									<div class="table-responsive">  
										<table class="table table-bordered">
											<tr>  
												<td width="30%"><label>Venue</label></td>  
												<td width="70%"><?php echo $venue_name_db; ?></td>  
											</tr>
											<tr>  
												<td width="30%"><label>Date</label></td>  
												<td width="70%"><?php echo $date_db; ?></td>  
											</tr>
											<tr>  
												<td width="30%"><label>Time</label></td>  
												<td width="70%"><?php echo $time_db; ?></td>  
											</tr>
											
											<?php
											
											//will show only between the end time and + 1hour for attendance
											if ($current >= $datetime_database && $current <= $datetime_database_one) {
									
											?>
												<tr>  
													<td colspan ="2" style="text-align: center;">	
														<button type="button" class="register btn" name="attendance_btn" id="<?php echo $registration_id_db; ?>">Mark as Attended</button>
													</td>  
												</tr>
											
											<?php		
											
											}
											
											?>
											
										</table>
									</div>
									</form>
									
								</div>
							</div>
						</div>
						
				<?php
				
					}
					
					else{
						
				?>
				
						<div class="container"  style="text-align:justify; padding-top:20px;">
							<p>
								Hello, <?php echo $_SESSION['fname']; ?>, it seems that you didnt mark your attendance during the Orientation for <b> <?php echo $term_desc_db; ?></b> last <b><?php echo $date_db; ?></b>. You may coordinate with CCSIR for more information.
							</p>
							
						</div>
						
				<?php
				
					}
				}
				
				// This panel will be displayed if student already mark their attendance
				else{
		
				?>

					<div class="container" style="padding-left:30px;">
						<div class="row info-box" style="width:90%;" >
							<div class="about-content"  style="text-align:justify; padding-top:10px;">
								<p>
									Hello, <?php echo $_SESSION['fname']; ?>, thank you for attending the orientation for <?php echo $term_desc_db; ?>. You may now view or download your certificate for your reference, and proceed to the next step of internship.
								</p>
								<form role="form" id="contact-form" method="post" action="../components/student/or-generate-cert.php" target="_blank">
									<button type="submit" name="registration_id" class="btn" value="<?php echo $registration_id_db; ?>" >View/Download your certificate</button>
											
								</form>
								
							</div>
						</div>
					</div>
					
				<?php
				
				}
					
				?>
				
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

$(document).ready(function(){
	//$('#contact-form').on('submit',function(e) {  //Don't foget to change the id form
	$(document).on('click', '.register', function(){
		
		//var id = $("#reg_hidden").val();
		var id = $(this).attr("id");
		
		$.ajax({
			url:'../components/student/or-attended.php', //===PHP file name====
			data:{id:id},
			method:'POST',
			success:function(data){
				console.log(data);
				
				//Success Message == 'Title', 'Message body', Last one leave as it is
				//swal("Success!", "Your attendance has been recorded!", "success");
				
				//swal({title: "Successful! ", text:"Your attendance has been recorded!", type: "success"}).then(function(){ location.reload();});
				
				swal("Successful!", "Your attendance has been recorded", "success");
				
				setTimeout(function(){// wait for 5 secs(2)
					location.reload(); // then reload the page.(3)
				}, 2000); 

			},
			error:function(data){
				//Error Message == 'Title', 'Message body', Last one leave as it is
				swal("Oops...", "Something went wrong.", "error");
			}
		});
		
		e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
		
	});
	
});
</script>