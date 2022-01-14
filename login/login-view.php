<?php
	// Initialize the session
	session_start();		
	
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		$rolename = $_SESSION['role'];
		header("location: ../$rolename/index.php");
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
		
		<!-- Bootstrap CSS File-->
		<link href="../lib/bootstrap/css/bootstrap-login.min.css" rel="stylesheet"> 
		
		<!-- Libraries CSS Files -->
		<link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../lib/animate/animate.min.css" rel="stylesheet">
		<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
		<link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
		
		<!-- Main Stylesheet File -->
		<link href="../css/style.css" rel="stylesheet">
		
		<!-- Stylesheet/JS file for DataTable  -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> 
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<!-- SW Alert Message -->
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
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
		#main{
			padding-top: 30px;	
		}
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
		label{font-size:14px;}
		
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
					
					<h4>Log in</h4>
					
					<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validateContactForm()">
					
						<div class="form-group">
							<label for="user_name">Username: <font color="red">*</font> </label>
							<input type="email" class="form-control" name="user_name" id="user_name" value="<?php echo $_POST["user_name"]; ?>" />
							<div id="user_name-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="name">Password:</label>
							<input type="password" class="form-control" name="user_pass" id="user_pass" />
							<div id="user_pass-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<input type="submit" name="login" value="Login"></input>
						</div>
						
						<div class="form-group">
							<a data-target="#add_data_Modal" data-toggle="modal" id="add" href="#add_data_Modal"><b>Forgot Password?</b></a>
							<p>Don't have an account?<a href="../register/index.php"><b>Sign up</b></a>
						</div>
						
						
					</form>
				</div>			
			</section><!-- #about -->
		</main>
		
		<!--==========================
			Insert/Update Modal
		============================-->
		
		<div id="add_data_Modal" class="modal fade">  
			<div class="modal-dialog">  
				<div class="modal-content">  
					<div class="modal-header">  
						 <button type="button" class="close" data-dismiss="modal">&times;</button>  
						 <h4 class="modal-title">Forgot Password</h4>  
					</div>  
					
					<div class="modal-body">  
						<form method="post" id="insert_form">
							
							<label><strong>Username</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<input type="email" name="uname" id="uname" class="form-control" size="25" required>
							<br /> 
							
							<input type="submit" name="insert" id="insert" value="Reset Password" class="btn btn-success" />  
						</form>  
					</div>  
					
					<div class="modal-footer">  
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
					</div>  
				</div>  
			</div>  
		</div>  
		
	
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
		
		var user_pass = $("#user_pass").val();
		var user_name = $("#user_name").val();
		
		if (user_pass == "") {
			$("#user_pass-info").html("Please supply necessary information.");
			$("#user_pass").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (user_name == "") {
			$("#user_name-info").html("Please supply necessary information.");
			$("#user_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (!user_name.match(/^[^@]+@(lpunetwork|lpu)\.edu.ph$/i)){
			$("#user_name-info").html("Please enter only your Office365 email address.");
			$("#user_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		return valid;
	}
	
	$(document).ready(function(){
		
		$('#insert_form').on("submit", function(event){  
			event.preventDefault();  
			
			var email = $('#uname').val();
			
			if(IsEmail(email)==false){
				alert("Please enter your Office365 email address only.");  
				return false;
			}
			
			if($('#uname').val() == ''){  
				alert("Username is required");  
			}  
			else{  
				var username = $("#uname").val();
		
				$.ajax({
					url : "../components/login/check-username.php",
					type : "POST",
					cache:false,
					data : {username:username},
					success:function(result){
						if (result == 0) {
							alert("Sorry we could not find your account.");  
						}
						else{
							$.ajax({  
								url:"../components/login/reset-password.php",  
								method:"POST",  
								data:$('#insert_form').serialize(),  
								beforeSend:function(){  
								  $('#insert').val("Resetting");  
								},  
								success:function(data){  
									
									$('#insert_form')[0].reset();     
									$('#add_data_Modal').modal('hide');
									$('#login').html(data); 
									
									var maskid = username.replace(/^(.)(.*)(.@.*)$/,
										 (_, a, b, c) => a + b.replace(/./g, '*') + c
									);
									
									swal({title: "Successful! ", text: "We have sent your temporary login details to: "+maskid, type: 
									"success"}).then(function(){ 
									   location.reload();
									   }
									);
									
								}  
							});  
						}
					}
				});
			}	   
		});
	  
		function IsEmail(email) {
			//var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var regex = /^[^@]+@(lpunetwork|lpu)\.edu.ph$/i
			
			if(!regex.test(email)) {
				return false;
			}else{
				return true;
			}
		}
		
	});
	
</script>