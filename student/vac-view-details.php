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
	$_SESSION['fname'] = $db_fname;
	*/
	
	// Checks if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== $word ){
		header("location: ../login/index.php");
		exit;	
	}
	
	// checks if user completed already his profile. otherwise, send to profile
	if ($student_details_flag == 0){
		header("location: ../student/profile.php");
		exit;
	}
	
	$userid = $_SESSION['userid'];
	$term_id = $_SESSION['term_id'];
	$job_id = $_POST['job_id'];
	
	//check if already applied on the current term
	$queryCheck = "SELECT * FROM  tbl_job_application WHERE job_id = '$job_id' AND userid = '$userid' AND term_id = '$term_id'";
	$resultCheck = mysqli_query($con, $queryCheck);
	
	
	//get job details
	$query = "SELECT * FROM  tbl_job 
			JOIN tbl_company ON tbl_company.company_id = tbl_job.company_id
			JOIN tbl_company_address1 ON tbl_company_address1.company_address_id = tbl_company.company_address_id
				JOIN provinces ON provinces.province_id = tbl_company_address1.province_id
				JOIN cities ON cities.city_id = tbl_company_address1.city_id
			WHERE tbl_job.job_id = '$job_id'";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result)){
		$company_name = $row["company_name"];
		$company_id = $row["company_id"];
		
		$job_name = $row["job_name"];
		$num_vacancy = $row["num_vacancy"];
		
		$city = $row["city_name"];
		$province = $row["province_name"];
		$address = $city.", ".$province;
		
		$job_desc = $row["job_desc"];
		
		$date_db = $row["date_modified"];
		$date_db = date("F d, Y", strtotime($date_db));  
		
		//get ID
		$cntID_qry = "SELECT tbl_job_application.job_application_id, COUNT(*) as total FROM tbl_job_application 
					JOIN tbl_job ON tbl_job.job_id = tbl_job_application.job_id
					WHERE tbl_job.company_id = '$company_id' AND  tbl_job_application.job_application_id LIKE '%$year_now%'";
		$cntID_rslt = mysqli_query($con, $cntID_qry);
		if(mysqli_num_rows($cntID_rslt) > 0){
			while($row = mysqli_fetch_assoc($cntID_rslt)){
				$total = $row['total'];
				$total = $total+1;
				$counter = str_pad($total, 3, '0', STR_PAD_LEFT);
				$job_application_id_db = $company_id."-".$year_now."-".$counter;
			}
		}
	
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
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
			width: 80%;
		}
		#about .about-content button[type="submit"] {
			background: #4d4d4d;
			border: 0;
			border-radius: 3px;
			padding: 8px 20px;
			color: #fff;
			transition: 0.3s;
			font-size: 13px;
		}
		
		#box{padding:8px 2px;border:1px solid #CCCCCC;display:block}
		#box input,#box input:active,#box input:focus{border:none;background:none;outline:none}
		#box ul,#box li,#box input{margin:0;padding:0}
		#box ul,#box li{list-style:none}
		#box li,#box a{display:inline-block;margin:2px}
		#box span{background-color:#EDEDED;padding:3px;color:#666666;border:1px solid #CCCCCC}
		#box a{font-size:12px;line-height:12px;color:#666666;text-decoration:none;padding:1px 3px;margin-left:5px;font-weight:bold;background-color:#FFFFFF;vertical-align:top;border:1px solid #CCCCCC;margin-top:-1px}
		#box a:hover{background-color:#666666;color:#FFFFFF}

		/* why not? */
		body{font-family:sans-serif}
		#box span{border-radius:5px}
		#box a{border-radius:100%;overflow:hidden}
		
		.info {
			font-size: .8em;
			font-style: italic;
			color: #ff0000;
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
				
				<div class="container" style="padding-left:30px;">
				
					<div class="about-content"  style="text-align:left;">
						<h2><?php echo $job_name; ?> </h2>
						<h6 style="margin-top:-15px;">
							Posted on <?php echo $date_db; ?> by <b> <?php echo $company_name; ?> </b>
						</h6>
					</div>
				
					<div class="about-content"  style="text-align:justify; padding-top:10px;"> <!-- action="../components/student/vac-view-details-sql.php"  onsubmit="return confirm('Confirm to submit your application to this job post?');"-->
						
						<form role="form" id="insert_form" method="post" enctype="multipart/form-data"  >
						
							<div class="table-responsive">  
								<table class="table">	
								
									<?php
										if(mysqli_num_rows($resultCheck) > 0){
									?>
											<tr>  
												<td colspan="2"> You have an existing application for this job. Kindly wait to be shortlisted or for any feedbacks via the <b>Applications page under Job Vacancies menu </b>. Thank you! </td>  
											</tr>
									
									<?php
										}
										else{
									?>
								
											<tr>  
												<td width="10%"> <b>Address:</b> </td>  
												<td width="70%"><?php echo $address; ?></td>  
											</tr>
											<tr>  
												<td width="20%"> <b>No. of Vacancies:</b> </td>  
												<td width="70%"><?php echo $num_vacancy; ?></td>  
											</tr>
											<tr>  
												<td width="20%"> <b>Description:</b> </td>  
												<td width="70%"><?php echo $job_desc; ?> vacancies</td>  
											</tr>
											<tr>  
												<td colspan="2"> <b>Skills</b> <span class="info">enter your skills on the field below and click the <b>spacebar</b> after each keyword</span> </td>  
											</tr>
											<tr>  
												<td colspan="2">
													<div id="box">
														<ul>
															<li><input type="text" id="type" size="100"  /> </li>
														</ul>
													</div>
												</td>  
											</tr>
											<tr>  
												<td colspan="2"> <b>Why should we hire you?</b> </td>  
											</tr>
											<tr>  
												<td  colspan="2">
													<textarea name="applicant_desc" id="applicant_desc" class="form-control" rows="10" ></textarea> 
												</td>  
											</tr>
											<tr>  
												<td colspan="2" align="center">
												<input type="hidden" name="job_application_id"  id="job_application_id" value="<?php echo $job_application_id_db; ?>" /> 
												<input type="hidden" name="job_id"  id="job_id" value="<?php echo $job_id; ?>" />
												<button type="submit" name="submitBtn" class="btn" id="submitBtn" >Apply for this job</button>
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

$(document).ready(function(){
		
		function closer(){
			$('#box a').on('click', function() {
				$(this).parent().parent().remove(); 
			});
		}
		
		$('#type').keypress(function(e) {
			if(e.which == 32) {//change to 32 for spacebar instead of enter
				var tx = $(this).val();
				if (tx) {
					
					$(this).val('').parent().before('<li><span>'+tx+'<a href="javascript:void(0);">x</a></span></li>');
					closer();
					
				}
			}
			
		});
		
		$('#insert_form').on("submit", function(event){  
			var skill = $('#box').text();
			var id = $('#job_application_id').val();
			var desc = $('#applicant_desc').val();
			var job_id = $('#job_id').val();
			
			if(desc == "" || skill == "" ){  
                alert("Please complete required fields");  
				return false;
			}  
			else{
				$.ajax({ 
					type: "POST", 
					url: "../components/student/vac-view-details-sql.php", 
					data: { desc : desc, id: id, skill:skill, job_id:job_id }, 
					success:function(result){
						if (result != "") { //error
							alert("result");  
							return false;
						}
						else{
							alert("Congratulations! Application has been submitted.");  
							window.location = "vacancies.php";
						}
					} 
				}); 
			}
		});
		
	});
	
</script>