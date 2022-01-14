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
		
		<!-- swal alert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<!-- convert date format -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>

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
							<h2>Orientation Schedule</h2>
						</div>
					</div>
				</div>
				
				<!-- Starts displaying -->
				
				<?php
					
					if(mysqli_num_rows($result_reg) > 0){
					
				?>
					
						<div class="container"  style="text-align:justify; padding-top:20px;">
							<h5>Are you scheduled to have your internship?</h5>
							<p>As first step for internship procedure, all students who are scheduled to take their internship must attend the Orientation. In line with this, the Career Services and Industry Relations would like to invite you to their upcoming Orientation. Should you willing to participate, you may register from the schedules below: </p>
						</div>
				
				<?php 
				
						$i = 0;
						
						while($row = mysqli_fetch_array($result_reg)){
							
							$i = $i + 1;
							
							$orientation_id_db = $row["orientation_id"];
							
							$or_date = $row["orientation_date"];
							$date_db = date("F d, Y", strtotime($or_date));
							
							//for date checking
							$date_database = date("Y-m-d", strtotime($date_db));
							
							$term_name = $row["term_name"];
							$term_from_year = $row["term_from_year"];
							$term_to_year = $row["term_to_year"];
							
							$term_desc_db = $term_name." AY ".$term_from_year." - ".$term_to_year;
							
							$or_start_time = $row["orientation_start_time"];
							$or_end_time = $row["orientation_end_time"];
							$time_db = $or_start_time." - ".$or_end_time;
						
				?>
				
							<div class="container" style="padding-left:30px;">
								<div class="row info-box">
									<div class="about-content"  style="text-align:justify; padding-top:10px;">
										<h6><b>Schedule <?php echo $i; ?></b></h6>
										
											<form role="form" id="contact-form" method="post">
											<div class="table-responsive">  
												<table class="table table-bordered">
													<tr>  
														<td width="30%"><label>Academic Term</label></td>  
														<td width="70%"><?php echo $term_desc_db; ?></td>  
													</tr>
													<tr>  
														<td width="30%"><label>Venue</label></td>  
														<td width="70%"><?php echo $row["venue_name"]; ?></td>  
													</tr>
													<tr>  
														<td width="30%"><label>Date</label></td>  
														<td width="70%"><?php echo $date_db; ?></td>  
													</tr>
													<tr>  
														<td width="30%"><label>Time</label></td>  
														<td width="70%"><?php echo $time_db; ?></td>  
													</tr>
													<tr>  
														<td width="30%">	
															<input type="hidden" name="venue" id="venue" /> 
															<input type="hidden" name="or_date" id="or_date" /> 
															<input type="hidden" name="or_start_time" id="or_start_time" /> 
															<input type="hidden" name="or_end_time" id="or_end_time" /> 
														</td>  
														<td width="70%"> 
															
														<?php
														
															//can register only until one day before the orientation date
															if ($current_date < $date_database) {
															
														?>
															
																<button type="button" class="register btn" name="register" id="<?php echo $orientation_id_db; ?>">Register</button>
																
														<?php
															
															}
															
														?>
															
														</td>  
													</tr>
												</table>
											</div>
											</form>
									</div>
								</div>
							</div>
				
				<?php
						}
					}
					
					else{
						
						
				?>
						<div class="container"  style="text-align:justify; padding-top:20px;">
							<h5>No schedule yet.</h5>
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
		
		var datetime = $('#datetime').val();
		
		$.ajax({
			url:'../components/student/or-confirm.php', //===PHP file name====
			data:{id:id},
			method:'POST',
			dataType:"json", 
			success:function(data){
				//console.dir(data);
				
				$('#or_date').val(data.orientation_date);  
				var or_date = $('#or_date').val();
				
				$('#or_start_time').val(data.orientation_start_time);  
				var or_start_time = $('#or_start_time').val();
				
				$('#or_end_time').val(data.orientation_end_time);  
				var or_end_time = $('#or_end_time').val();
				
				$('#venue').val(data.venue_name);  
				var venue = $('#venue').val();
				 
				//Success Message == 'Title', 'Message body', Last one leave as it is
				
				swal("Success!", "You have been registered to this event scheduled on: \n"+moment(or_date).format('MMMM D, Y')+" from "+or_start_time+" to "+or_end_time+"\n at "+venue, "success");
				
				setTimeout(function(){// wait for 5 secs(2)
					location.reload(); // then reload the page.(3)
				}, 2000); 
				
				/*
				swal({title: "Successful! ", text:"You have been registered to this event scheduled on: \n"+moment(or_date).format('MMMM D, Y')+" from "+or_start_time+" to "+or_end_time+"\n at "+venue, type: "success"}).then(function(){ location.reload(); });
				*/
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