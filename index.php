<?php
	// Initialize the session
	include 'connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	/*
	$_SESSION["loggedin"] = true;
	$_SESSION['userid'] = $db_userid;
	$_SESSION['role'] = $db_rolename;
	$_SESSION['fname'] = $db_fname;
	*/
	
	// if user is logged in, redirect them to their main page
	$role = $_SESSION['role'];
	if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true || $_SESSION['role'] != "" ){
		header('location: '.$role.'/index.php');
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
		<link rel="apple-touch-icon" sizes="180x180" href="img/favicon_io/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="img/favicon_io/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="img/favicon_io/favicon-16x16.png">
		<link rel="manifest" href="img/favicon_io/site.webmanifest">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">
		
		<!-- Bootstrap CSS File -->
		<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Libraries CSS Files -->
		<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="lib/animate/animate.min.css" rel="stylesheet">
		<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
		<link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
		
		<!-- Main Stylesheet File -->
		<link href="css/style.css" rel="stylesheet">

		<!-- =======================================================
			Theme Name: Rapid
			Theme URL: https://bootstrapmade.com/rapid-multipurpose-bootstrap-business-template/
			Author: BootstrapMade.com
			License: https://bootstrapmade.com/license/
		======================================================= -->
	</head>

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
						<li class="active"><a href="#intro">Home</a></li>
						<li><a href="#call-to-action">Bulletin</a></li>
						<li><a href="#about">About Us</a></li>
						<li><a href="#services">Services</a></li>
						<li><a href="#team">Team</a></li>
						<li><a href="#footer">Contact Us</a></li>
					</ul>
				</nav><!-- .main-nav -->
			</div>
		</header><!-- #header -->
	
		<!--==========================
			Intro Section
		============================-->
		<section id="intro" class="clearfix">
			<div class="container d-flex h-100">
				<div class="row justify-content-center align-self-center">
					<div class="col-md-6 intro-info order-md-first order-last">
						<h2>Web-based <br> <span>Internship </span> Management <br> System</h2>
						<div>
							<a href="login/index.php" class="btn-get-started scrollto">Login</a>
						</div>
					</div>
					
					<div class="col-md-6 intro-img order-md-last order-first">
						<img src="img/intro-img.svg" alt="" class="img-fluid">
					</div>
				</div>
			</div>
		</section><!-- #intro -->
	
	<main id="main">
		
		<!--==========================
		Call To Action Section
		============================-->
		<section id="call-to-action" class="wow fadeInUp">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 text-center text-lg-left">
						<h3 class="cta-title">B U L L E T I N</h3>
						<p class="cta-text"> The Center is conducting an Orientation this Academic Term. Log in to WEB IMS portal for more information. <br> Not yet registered? Click the <b><i>Register Now </i></b> button to claim your account.</p>
					</div>
					<div class="col-lg-3 cta-btn-container text-center">
						<a class="cta-btn align-middle" href="register/index.php">Register Now</a>
					</div>
				</div>
			</div>
		</section><!-- #call-to-action -->
		
		<!--==========================
		About Us Section
		============================-->
		<section id="about">
			<div class="container">
				<div class="row">
					<div class="about-content"  style="text-align:justify;">
						<h2>About Us</h2>
						<h3>The Center for Career Services and Industry Relations</h3>
						<p>In today’s global industries, an academic institution’s image is greatly enhanced by the quality and depth of its local and international linkages. While it is primarily the institution’s credibility that makes it attractive to prospective partner institutions, these networks must be established and nurtured through deliberate and sustained programs for these partnerships to bear fruits.</p>
						<p>Hence, the University, envisioning itself as an internationally-accredited institution, recognizes the pivotal role that local and international linkages play in instructional and institutional development and has proactively responded to these needs by establishing the Center for Career Services and Industry Relations (CCSIR).</p>
						<p>The CCSIR is responsible for managing partnerships and collaborations with business establishments, non-government and government institutions, and other organizations for student internship. The CCSIR facilitates application, deployment, monitoring, and evaluation of student internships. Further, to strengthen ties with industry partners and to facilitate quality and meaningful internships for students, the CCSIR facilitates site visits, regular consultations and dialogues with industry partners.</p>
						<p>Through this Internship Management System, it aims to help the CCSIR to provide better and quality service to its stakeholders.	</p>
					</div>
				</div>
			</div>
		</section><!-- #about -->
	
		<!--==========================
		Services Section
		============================-->
		<section id="services" class="section-bg">
			<div class="container">
		
				<header class="section-header">
				<h3>Services</h3>
				<p>Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p>
				</header>
		
				<div class="row">
		
				<div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
					<div class="box">
					<div class="icon" style="background: #fceef3;"><i class="ion-ios-analytics-outline" style="color: #ff689b;"></i></div>
					<h4 class="title"><a href="">Lorem Ipsum</a></h4>
					<p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
					<div class="box">
					<div class="icon" style="background: #fff0da;"><i class="ion-ios-bookmarks-outline" style="color: #e98e06;"></i></div>
					<h4 class="title"><a href="">Dolor Sitema</a></h4>
					<p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
					</div>
				</div>
		
				<div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
					<div class="box">
					<div class="icon" style="background: #e6fdfc;"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
					<h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
					<p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
					<div class="box">
					<div class="icon" style="background: #eafde7;"><i class="ion-ios-speedometer-outline" style="color:#41cf2e;"></i></div>
					<h4 class="title"><a href="">Magni Dolores</a></h4>
					<p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
					</div>
				</div>
		
				<div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
					<div class="box">
					<div class="icon" style="background: #e1eeff;"><i class="ion-ios-world-outline" style="color: #2282ff;"></i></div>
					<h4 class="title"><a href="">Nemo Enim</a></h4>
					<p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
					<div class="box">
					<div class="icon" style="background: #ecebff;"><i class="ion-ios-clock-outline" style="color: #8660fe;"></i></div>
					<h4 class="title"><a href="">Eiusmod Tempor</a></h4>
					<p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
					</div>
				</div>
		
				</div>
		
			</div>
		</section><!-- #services -->

	
		
	
		<!--==========================
		Features Section
		============================-->
		<section id="features">
			<div class="container">
		
				<div class="row feature-item">
				<div class="col-lg-6 wow fadeInUp">
					<img src="img/features-1.svg" class="img-fluid" alt="">
				</div>
				<div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
					<h4>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h4>
					<p>
					Ipsum in aspernatur ut possimus sint. Quia omnis est occaecati possimus ea. Quas molestiae perspiciatis occaecati qui rerum. Deleniti quod porro sed quisquam saepe. Numquam mollitia recusandae non ad at et a.
					</p>
					<p>
					Ad vitae recusandae odit possimus. Quaerat cum ipsum corrupti. Odit qui asperiores ea corporis deserunt veritatis quidem expedita perferendis. Qui rerum eligendi ex doloribus quia sit. Porro rerum eum eum.
					</p>
				</div>
				</div>
		
				<div class="row feature-item mt-5 pt-5">
					<div class="col-lg-6 wow fadeInUp order-1 order-lg-2">
						<img src="img/features-2.svg" class="img-fluid" alt="">
					</div>
			
					<div class="col-lg-6 wow fadeInUp pt-4 pt-lg-0 order-2 order-lg-1">
						<h4>Neque saepe temporibus repellat ea ipsum et. Id vel et quia tempora facere reprehenderit.</h4>
						<p>
						Delectus alias ut incidunt delectus nam placeat in consequatur. Sed cupiditate quia ea quis. Voluptas nemo qui aut distinctio. Cumque fugit earum est quam officiis numquam. Ducimus corporis autem at blanditiis beatae incidunt sunt. 
						</p>
						<p>
						Voluptas saepe natus quidem blanditiis. Non sunt impedit voluptas mollitia beatae. Qui esse molestias. Laudantium libero nisi vitae debitis. Dolorem cupiditate est perferendis iusto.
						</p>
						<p>
						Eum quia in. Magni quas ipsum a. Quis ex voluptatem inventore sint quia modi. Numquam est aut fuga mollitia exercitationem nam accusantium provident quia.
						</p>
					</div>
				</div>
		
			</div>
		</section><!-- #about -->
	
	
		<!--==========================
		Team Section
		============================-->
		<section id="team" class="section-bg">
		<div class="container">
			<div class="section-header">
			<h3>Team</h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
			</div>
	
			<div class="row">
	
			<div class="col-lg-3 col-md-6 wow fadeInUp">
				<div class="member">
				<img src="img/team-1.jpg" class="img-fluid" alt="">
				<div class="member-info">
					<div class="member-info-content">
					<h4>Lizandro Ferrer</h4><span>Director</span>
					</div>
				</div>
				</div>
			</div>
	
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
				<div class="member">
				<img src="img/team-2.jpg" class="img-fluid" alt="">
				<div class="member-info">
					<div class="member-info-content">
					<h4>Kristin Zen Cuevas</h4> <span>Internship Adviser</span>
					</div>
				</div>
				</div>
			</div>
	
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="member">
				<img src="img/team-3.jpg" class="img-fluid" alt="">
				<div class="member-info">
					<div class="member-info-content">
					<h4>Genaiza Ann Bautista</h4><span>Internship Adviser</span>
					</div>
				</div>
				</div>
			</div>
	
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
				<div class="member">
				<img src="img/team-4.jpg" class="img-fluid" alt="">
				<div class="member-info">
					<div class="member-info-content">
					<h4>Cristel Joy Beclon</h4><span>Internship Adviser</span>
					</div>
				</div>
				</div>
			</div>
	
			</div>
	
		</div>
		</section><!-- #team -->
	
		<!--==========================
		Clients Section
		============================-->
		<section id="clients" class="wow fadeInUp">
		<div class="container">
	
			<header class="section-header">
			<h3>Host Training Establishments</h3>
			</header>
	
			<div class="owl-carousel clients-carousel">
			<img src="img/clients/client-1.png" alt="">
			<img src="img/clients/client-2.png" alt="">
			<img src="img/clients/client-3.png" alt="">
			<img src="img/clients/client-4.png" alt="">
			<img src="img/clients/client-5.png" alt="">
			<img src="img/clients/client-6.png" alt="">
			<img src="img/clients/client-7.png" alt="">
			<img src="img/clients/client-8.png" alt="">
			</div>
	
		</div>
		</section><!-- #clients -->
	
		<!--==========================
		Frequently Asked Questions Section
		============================-->
		<section id="faq">
			<div class="container">
				<header class="section-header">
				<h3>Frequently Asked Questions</h3>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
				</header>
		
				<ul id="faq-list" class="wow fadeInUp">
				<li>
					<a data-toggle="collapse" class="collapsed" href="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="ion-android-remove"></i></a>
					<div id="faq1" class="collapse" data-parent="#faq-list">
					<p>
						Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
					</p>
					</div>
				</li>
		
				<li>
					<a data-toggle="collapse" href="#faq2" class="collapsed">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="ion-android-remove"></i></a>
					<div id="faq2" class="collapse" data-parent="#faq-list">
					<p>
						Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
					</p>
					</div>
				</li>
		
				<li>
					<a data-toggle="collapse" href="#faq3" class="collapsed">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="ion-android-remove"></i></a>
					<div id="faq3" class="collapse" data-parent="#faq-list">
					<p>
						Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
					</p>
					</div>
				</li>
		
				<li>
					<a data-toggle="collapse" href="#faq4" class="collapsed">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="ion-android-remove"></i></a>
					<div id="faq4" class="collapse" data-parent="#faq-list">
					<p>
						Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
					</p>
					</div>
				</li>
		
				<li>
					<a data-toggle="collapse" href="#faq5" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="ion-android-remove"></i></a>
					<div id="faq5" class="collapse" data-parent="#faq-list">
					<p>
						Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
					</p>
					</div>
				</li>
		
				<li>
					<a data-toggle="collapse" href="#faq6" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="ion-android-remove"></i></a>
					<div id="faq6" class="collapse" data-parent="#faq-list">
					<p>
						Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
					</p>
					</div>
				</li>
		
				</ul>
		
			</div>
		</section><!-- #faq -->
	
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
	
	<!-- JavaScript Libraries -->
	<script src="lib/jquery/jquery.min.js"></script>
	<script src="lib/jquery/jquery-migrate.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="lib/easing/easing.min.js"></script>
	<script src="lib/mobile-nav/mobile-nav.js"></script>
	<script src="lib/wow/wow.min.js"></script>
	<script src="lib/waypoints/waypoints.min.js"></script>
	<script src="lib/counterup/counterup.min.js"></script>
	<script src="lib/owlcarousel/owl.carousel.min.js"></script>
	<script src="lib/isotope/isotope.pkgd.min.js"></script>
	<script src="lib/lightbox/js/lightbox.min.js"></script>
	
	<!-- Template Main Javascript File -->
	<script src="lib/js/main.js"></script>
	
	</body>
</html>
