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

		<!-- Pagination jquery -->
		<script src="../lib/pagination/paginga.jquery.js"></script>
		
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
		
		#about .paginate-no-scroll {
			padding-top: 10px;
		}


		/* Stylesheet for Pagination */
		.items div {
			border: 1px solid gray;
			margin-top: 20px;
			margin-left: 5px;
			padding: 10px;
		}

		.pager div{
			float: left;
			border: 1px solid gray;
			margin-top: 20px;
			margin-left: 5px;
			padding: 10px;
		}

		.pager div.disabled{
			opacity: 0.25;
		}

		.pager .pageNumbers a{
			display: inline-block;
			padding: 0 10px;
			color: gray;
		}

		.pager .pageNumbers a.active{
			color: #b30000;
			 font-weight: bold;
		}

		.pager {
			overflow: hidden;
		}

		.paginate-no-scroll .items div{
			height: 100%;
		}
			
		/* Stylesheet for Hover */
		.card {
			box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
			background: #fff;
			transition: all 0.5s ease;
			cursor: pointer;
			user-select: none;
			z-index: 10;
			overflow: hidden;
			width: 80%;
		}

		.card .backgroundEffect {
			bottom: 0;
			height: 0px;
			width: 100%
		}

		.card:hover {
			color: #fff;
			transform: scale(1.025);
			box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 10px
		}

		.card:hover .backgroundEffect {
			bottom: 0;
			height: 320px;
			width: 100%;
			position: absolute;
			z-index: -1;
			background: #1b9ce3;
			animation: popBackground 0.3s ease-in
		}

		@keyframes popBackground {
			0% {
				height: 20px;
				border-top-left-radius: 50%;
				border-top-right-radius: 50%
			}

			50% {
				height: 80px;
				border-top-left-radius: 75%;
				border-top-right-radius: 75%
			}

			75% {
				height: 160px;
				border-top-left-radius: 85%;
				border-top-right-radius: 85%
			}

			100% {
				height: 320px;
				border-top-left-radius: 100%;
				border-top-right-radius: 100%
			}
		}
		
		.card .text-muted {
			font-size: 14px;
			line-height: 2px;
		}
		
		.card .text-address {
			font-size: 14px;
			margin-top: -20px;
			color: #6c757d;
		}
		
		
		.card:hover .text-hover{
			color: #b30000 !important
		}
		
		.card .content {
			border-color: #fff;
			margin-top: 2px;
		}
		
		.card .content .btn {
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 5px 10px;
			background-color: #4d4d4d;
			border-radius: 25px;
			font-size: 12px;
			border: none;
		}

		.card:hover .content .btn {
			background: #b30000;
			color: #fff;
			box-shadow: #0000001a 0px 3px 5px
		}
		
		#about .about-content button[type="submit"]{
			background-color: #4d4d4d;
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
					<h1 class="text-light"><a href="vacancies.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="drop-down"><a href="orientation.php">Orientation</a>
							<ul>
								<li ><a href="or-history.php">History</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="application.php">Application</a>
							<ul>
								<li><a href="app-records.php">Records</a></li>
							</ul>
						</li>
						<li class="active drop-down"><a href="vacancies.php">Job Vacancies</a>
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
					
						<div class="about-content" >
							<h2>Job Application</h2>
							<h4>Apply on different job listings here</h4>
						</div>
						
						<div class="paginate-no-scroll 5 about-content ">
							<div class="items ">
							
							<?php
								while($row = mysqli_fetch_array($resultJob)){
									$job_id = $row["job_id"];
									
									$company_name = $row["company_name"];
									$job_name = $row["job_name"];
									
									$city = $row["city_name"];
									$province = $row["province_name"];
									$address = $city.", ".$province;
									
									$job_desc = $row["job_desc"];
									// strip tags to avoid breaking any html
									$job_desc = strip_tags($job_desc);
									if (strlen($job_desc) > 100) {

										// truncate string
										$stringCut = substr($job_desc, 0, 100);
										$endPoint = strrpos($stringCut, ' ');

										//if the string doesn't contain any space then it will cut without word basis.
										$job_desc = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
										$job_desc .= '... <a href="#">Read More</a>';
									}
									
							?>
									<form role="form" method="post" action="vac-view-details.php" enctype="multipart/form-data" >
									<div class="card rounded ">
										<div class="content">
											<h3 class="text-hover"><?php echo $job_name; ?></h3>
											<p class="text-muted text-hover"><b> <?php echo $company_name; ?> </b></p>
											<p class="text-address text-hover"><b> <?php echo $address; ?> </b></p>
											<p class="text-muted text-hover"><?php echo $job_desc; ?></p>
											<button type="submit" name="job_id" value="<?php echo $job_id; ?>" class="btn btn-primary">Apply for this job</button>
										</div>
									</div>
									</form>
								
							<?php
							
								}
								
							?>
							</div>
							
							<div class="pager">
								<div class="firstPage">&laquo;</div>
								<div class="previousPage">&lsaquo;</div>
								<div class="pageNumbers"></div>
								<div class="nextPage">&rsaquo;</div>
								<div class="lastPage">&raquo;</div>
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

<script>
	$(function() {
		$(".paginate").paginga({
			// use default options
		});
	  
		$(".paginate-page-2").paginga({
			page: 2
		});

		$(".paginate-no-scroll").paginga({
			scrollToTop: false
		});
	});
</script>