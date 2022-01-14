<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	$word = "manager";
	
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
		require_once "../components/jobp-profile/jobp-profile-edit-sql.php";
	}
	
	$query = $_SESSION['query'];
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result)) {  
		$company_id_db = $row["company_id"];
		$company_address_id_db = $row["company_address_id"];
		$company_contact_id_db = $row["company_contact_id"];
		$company_moa_id_db = $row["company_moa_id"];
		
		$company_name_db = $row["company_name"];
		$company_desc_db = $row["company_desc"];
		
		$province_id_db = $row['province_id'];
		$province_name_db = $row['province_name'];
		
		$city_id_db = $row['city_id'];
		$city_name_db = $row['city_name'];
		
		$address_db = $row['address'];
		
		$mobile_num_db = $row['mobile_num'];
		$phone_num_db = $row['phone_num'];
		$email_db = $row['email'];
		
		$term_start = $row['term_start'];
		$term_end = $row['term_end'];
		
		$term_start_db = date('F d, Y',strtotime($term_start));
		$term_end_db = date('F d, Y',strtotime($term_end));
		
		$company_img_db = $row['company_img'];
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
		
		<!------ Upload photo css/js ---------->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        
		<!-- Include Date Range Picker -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


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
			width: 200px;
			height: 200px;
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
						<li><a href="jobp-profile.php">Back to Home</a></li>
					</ul>
				</nav><!-- .main-nav -->
				
			</div>
		</header><!-- #header -->
	
		<main id="main">
		
			<!--==========================
			Main Content
			============================-->
			<section id="login">
				<div class="form">

					<h4>Edit Company Details</h4>

					<form method="post" action="" role="form" class="contactForm" enctype="multipart/form-data" onsubmit="return validateContactForm()">
						
						<div class="form-group">
							<label for="company_name"><b>Company Name <font color="red">*</font> </b></label>
							<input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo $company_name_db; ?>" />
							<input type="hidden" name="company_id" value="<?php echo $company_id_db; ?>" class="form-control"  /> 
							<div id="company_name-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="company_desc"><b>Description <font color="red">*</font> </b></label>
							<textarea name="company_desc" id="company_desc" class="form-control" ><?php echo $company_desc_db; ?></textarea>
							<div id="company_desc-info" class="info"></div>
						</div>		
						
						<div class="form-group">
							<label for="address_province"><b>Province <font color="red">*</font> </b></label>
							<select id="address_province" name="address_province" class="form-control"  >
							<?php 
								echo '<option value="'.$province_id_db.'" selected>'.$province_name_db.'</option>';
								$prov_qry = "SELECT * FROM  provinces ORDER BY province_name ASC";
								$prov_rslt = mysqli_query($con, $prov_qry);
								if(mysqli_num_rows($prov_rslt) > 0){
									while($row = mysqli_fetch_assoc($prov_rslt)){
										echo '<option value="'.$row['province_id'].'" >'.$row['province_name'].'</option>';
									}
								}
							?>
							</select>
							<div id="address_province-info" class="info"></div>
						</div>	
						
						<div class="form-group">
							<label for="address_city"><b>City <font color="red">*</font> </b></label>
							<select id="address_city" name="address_city" class="form-control" >
							<?php 
								echo '<option value="'.$city_id_db.'" selected>'.$city_name_db.'</option>';
							?>
							</select>
							<div id="address_city-info" class="info"></div>
						</div>	
						
						<div class="form-group">
							<label for="address_other"><b>Floor/Unit/Room <font color="red">*</font> </b></label>
							<textarea name="address_other" id="address_other" class="form-control" ><?php echo $address_db; ?></textarea>
							<input type="hidden" name="company_address_id" value="<?php echo $company_address_id_db; ?>" class="form-control"  /> 
							<div id="address_other-info" class="info"></div>
						</div>				
						
						<div class="form-group">
							<label for="company_email"><b>Email Address <font color="red">*</font> </b></label>
							<input type="email" class="form-control" name="company_email" id="company_email"  value="<?php echo $email_db; ?>"  />
							<input type="hidden" name="company_contact_id" value="<?php echo $company_contact_id_db; ?>" class="form-control"  /> 
							<div id="company_email-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="company_mobile"><b>Mobile <font color="red">*</font> </b></label>
							<input type="text" class="form-control" name="company_mobile" id="company_mobile" value="<?php echo $mobile_num_db; ?>"  />
							<div id="company_mobile-info" class="info"></div>
						</div>
						
						<div class="form-group">
							<label for="company_phone"><b>Phone <font color="red">*</font> </b></label>
							<input type="text" class="form-control" name="company_phone" id="company_phone" value="<?php echo $phone_num_db; ?>" />
							<div id="company_phone-info" class="info"></div>
						</div>
						
						<div class="form-group ">
							<label for="term_start"><b>Agreement Start Date <font color="red">*</font> </b></label>
							<input class="form-control" id="term_start" name="term_start" value="<?php echo $term_start_db; ?>" type="text"/>
							<div id="term_start-info" class="info"></div>
						</div>
						
						<div class="form-group ">
							<label for="term_end"><b>Agreement End Date <font color="red">*</font> </b></label>
							<input class="form-control" id="term_end" name="term_end" value="<?php echo $term_end_db; ?>" type="text"/>
							<div id="term_end-info" class="info"></div>
						</div>
						
						<div class="form-group ">
							<label for="term_end"><b>Upload Memorandum of Agreement: </b></label>
							<input type="file" name="term_file" id="term_file" class="form-control"  size="25"  accept=".doc, .docx,.pdf"  >
							<input type="hidden" name="company_moa_id" value="<?php echo $company_moa_id_db; ?>" class="form-control"  /> 
							<div id="term_file-info" class="info"></div>
						</div>
						
						<?php
							$src = "../upload/employer/$company_id_db/$company_img_db";
						?>
						<div class="form-group">
							<label for="company_img"><b>Image/Logo </b></label>
							<div class="input-group" id="company_img">
								<span class="input-group-btn">
									<span class="btn btn-default btn-file">
										Browse… <input type="file" id="company_img-input" name="company_img" accept="image/*"  />
									</span>
								</span>
								<input type="text" class="form-control"  id="company_img-address" readonly>
							</div>
							<div id="company_img-info" class="info"> </div>
							<br>
							
							<img id='img-upload' src="<?php echo $src; ?>" height="200px" width="200px" />
						
						</div>
						
						<input type="submit" name="register" value="Update"></input>
						
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
		
	</body>
</html>

<script type="text/javascript">
   
	function validateContactForm() {
		var valid = true;

		$(".info").html("");
		$(".form-control").css('border', '#e0dfdf 1px solid');
		
		var company_name = $("#company_name").val();
		var company_desc = $("#company_desc").val();
		
		var address_province = $("#address_province").val();
		var address_city = $("#address_city").val();
		var address_other = $("#address_other").val();
		
		var company_email = $("#company_email").val();
		var company_mobile = $("#company_mobile").val();
		var company_phone = $("#company_phone").val();
		
		var term_start = $("#term_start").val();
		var term_end = $("#term_end").val();
		
		if (company_name == "") {
			$("#company_name-info").html("Please supply necessary information.");
			$("#company_name").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (company_desc == "") {
			$("#company_desc-info").html("Please supply necessary information.");
			$("#company_desc").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		if (address_province == "") {
			$("#address_province-info").html("Please select one option.");
			$("#address_province").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (address_city == "") {
			$("#address_city-info").html("Please select one option.");
			$("#address_city").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (address_other == "") {
			$("#address_other-info").html("Please select one option.");
			$("#address_other").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		if (company_email == "") {
			$("#company_email-info").html("Please supply necessary information.");
			$("#company_email").css('border', '#ff0000 1px solid');
			valid = false;
		}
		else{
			if (!company_email.match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)){
				$("#company_email-info").html("Please enter a valid email address.");
				$("#company_email").css('border', '#ff0000 1px solid');
				valid = false;
			}
		}
		
		if (company_mobile == "") {
			$("#company_mobile-info").html("Please supply necessary information.");
			$("#company_mobile").css('border', '#ff0000 1px solid');
			valid = false;
		}
		else if (company_mobile == "N/A") {
			valid = true;
		}
		else{
			if (!company_mobile.match(/^[0-9]+$/)){
				$("#company_mobile-info").html("Please enter numeric characters only.");
				$("#company_mobile").css('border', '#ff0000 1px solid');
				valid = false;
			}
		}
		
		if (company_phone == "") {
			$("#company_phone-info").html("Please supply necessary information.");
			$("#company_phone").css('border', '#ff0000 1px solid');
			valid = false;
		}
		else if (company_phone == "N/A") {
			valid = true;
		}
		else{
			if (!company_phone.match(/^[0-9]+$/)){
				$("#company_phone-info").html("Please enter numeric characters only.");
				$("#company_phone").css('border', '#ff0000 1px solid');
				valid = false;
			}
		}
		
		if (term_start == "") {
			$("#term_start-info").html("Please supply necessary information.");
			$("#term_start").css('border', '#ff0000 1px solid');
			valid = false;
		}
		if (term_end == "") {
			$("#term_end-info").html("Please supply necessary information.");
			$("#term_end").css('border', '#ff0000 1px solid');
			valid = false;
		}
		
		return valid;
	}
	
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
				$('#img-upload').attr('src',' ')
	            $('#img-upload').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#company_img-input").change(function(){
	    readURL(this);
	}); 
	
	$("#address_province").change(function(){
		var id=$(this).val();
		$.ajax({
			url:'../components/jobp-profile/load_cities.php',
			type:'post',
			data:{id:id},
			success:function(res){	
				$('#address_city').prop('disabled', false);
				$("#address_city").html(res);
			}
		});
    });
	
	$(document).ready(function(){
		$('#address_city').prop('disabled', true);
		
		var date_input=$('input[name="term_start"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'MM dd, yyyy',
			orientation: "top left", 
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
		
		
		var date_input=$('input[name="term_end"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'MM dd, yyyy',
			orientation: "top left", 
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
		
	});

</script>