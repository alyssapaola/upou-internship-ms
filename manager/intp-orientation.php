<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	
	$word = "manager";
	
	$loc = $word."/intp-orientation";
	$_SESSION['loc'] = $loc;
	
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
	
	//$connect = new PDO("mysql:host=localhost;dbname=db_ojt", "root", "");
	$term_value = '';
	$query = "SELECT * FROM tbl_acad_term WHERE delete_flag = '0'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row){
		$term_name = $row["term_name"];
		$term_from_year = $row["term_from_year"];
		$term_to_year = $row["term_to_year"];
		$term_desc = $term_name." AY ".$term_from_year." - ".$term_to_year;
		$term_value .= '<option value="'.$row['term_id'].'">'.$term_desc.'</option>';
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
		
		<!-- Bootstrap CSS File
		<link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">  -->
		
		<!-- Libraries CSS Files -->
		<link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../lib/animate/animate.min.css" rel="stylesheet">
		<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
		<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
		<link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
		
		<!-- Main Stylesheet File -->
		<link href="../css/style.css" rel="stylesheet">
		<link href="../css/popup.css" rel="stylesheet">
		
		<!-- Stylesheet/JS file for DataTable  -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> 
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<!-- Date Time Picker  -->
		<script type="text/javascript" src="../lib/datetimepicker/jquery.timepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="../lib/datetimepicker/jquery.timepicker.css" />
		<script type="text/javascript" src="../lib/datetimepicker/bootstrap-datepicker.js"></script>
		<link rel="stylesheet" type="text/css" href="../lib/datetimepicker/bootstrap-datepicker.css" />
		
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
		#about{
			padding-top: 100px;	
		}
		.about-content{
			 margin: auto;
			width: 100%;
		}
		
		.listRight {
			left: auto !important;
			right: 220px; !important;
		}

		.main-nav .drop-down .drop-right > a:after {
		  content: "\f104";
		  position: absolute;
		  left: 0px;
		}
		
		<!-- Stylesheet for DataTable -->
		.active_flg {
			background-color: #940000;
			color: white;
			border: 2px solid #940000;
		}
		.active_flg:hover{color:#fff;background-color:#EE0000;border-color:#940000}
		
		.inactive_flg {
			background-color: #474747;
			color: white;
			border: 2px solid #474747;
		}
		.inactive_flg:hover{color:#333;background-color:#e6e6e6;border-color:#474747}
		
		.float-left{float:left!important}.float-right{float:right!important}
		
		h1,h2,h3,h4,h5,h6 {
			font-family: "Montserrat", sans-serif;
			font-weight: 400;
			margin: 0 0 20px 0;
			padding: 0;
		}

		body {
			background: #fff;
			color: #444;
			font-family: "Open Sans", sans-serif;
		}
		
		.ui-timepicker-wrapper.ui-timepicker-with-duration.ui-timepicker-step-30, .ui-timepicker-wrapper.ui-timepicker-with-duration.ui-timepicker-step-60 {
			width: 40em;
		}
		
		/* For select filter_role setting */
		#filter_role{
			width:250px;  
			height:40px;line-height:30px;    
		}
		
		/* Create two equal columns that floats next to each other */
		.form-group {
			float: left;
			width: 22%;
			padding: 20px;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		@media screen and (max-width: 600px) {
			.column {
				width: 100%;
			}	
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
					<h1 class="text-light"><a href="intp-orientation.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="active drop-down"><a href="#">Internship Portal</a>
							<ul>
								<li><a href="intp-assignment.php">Faculty Assignment</a></li>
								<li class="drop-down"><a href="#">Internship/Credit Hours</a>
									<ul>
										<li><a href="intp-hours.php">Internship Hours</a></li>
										<li><a href="intp-credhours.php">Internship Credit Hours</a></li>
									</ul>
								</li>
								<li class="active"><a href="intp-orientation.php">Orientation</a></li>
								<li><a href="intp-students.php">Students</a></li>
								<li><a href="intp-templates.php">Templates</a>
							</ul>
						</li>
						<li class="drop-down"><a href="#">Job Portal</a>
							<ul>	
								<li><a href="jobp-profile.php">Company Profile</a></li>
								<li><a href="jobp-department.php">Configure Department</a></li>
								<li><a href="jobp-employers.php">Employer Information</a></li>
							</ul>
						</li>
						<li class="drop-down"><a href="#">Configuration</a>
							<ul>
								<li><a href="config-section.php">Manage Section</a></li>
								<li><a href="config-users.php">Manage Users</a>
							</ul>
						</li>
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
							<h2>Orientation Record</h2>
							<h4>Manages the records of current and past orientation</h4>
						</div>
						
						<div class="table-responsive">
			
							<div class="row">
								<div class="form-group">
									<select name="filter_role" id="filter_role" class="form-control" required>
										<option value="">Select Academic Term</option>
										<?php echo $term_value; ?>
									</select>
								</div>
							
								<div class="form-group" style="padding-top:-20px; " >
									<button type="button" name="filter" id="filter" class="btn btn-danger" style="height:40px; width:60px;">Filter</button>
									<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-danger" style="height:40px; width:60px;">Add</button>  
								</div>
							</div>
							
							<div id="alert_message"></div>
							
							<div id="employee_table">  
								<table id="user_data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Academic Term</th>
											<th>Venue</th>
											<th>Date</th>
											<th>Time</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
							</div>
							
						</div>
						
					</div>
				</div>
			</section><!-- #about -->
		</main>
		
		<!--==========================
			Insert/Update Modal
		============================-->
		
		<div id="add_data_Modal" class="modal fade">  
			<div class="modal-dialog">  
				<div class="modal-content">  
					<form method="post" id="insert_form">
					
						<div class="modal-header">  
							<button type="button" class="close" data-dismiss="modal">&times;</button>  
							<h4 class="modal-title">Create New</h4>  
						</div>  
						
						<div class="modal-body">  
							<label><strong>Academic Term</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select name="acad_term"  id="acad_term" class="form-control" required>
								<?php 
									$acad_term_qry = "SELECT * FROM  tbl_acad_term WHERE delete_flag='0' ORDER BY current_flag DESC, term_from_year DESC ";
									$acad_term_rslt = mysqli_query($con, $acad_term_qry);
									if(mysqli_num_rows($acad_term_rslt) > 0){
										while($row = mysqli_fetch_assoc($acad_term_rslt)){
											$term_name = $row["term_name"];
											$term_from_year = $row["term_from_year"];
											$term_to_year = $row["term_to_year"];
											
											$term_desc = $term_name." AY ".$term_from_year." - ".$term_to_year;
											
											$term_id = $row['term_id'];
											$current_flag = $row["current_flag"];
											
								?>
											<option value="<?php echo $term_id; ?>" <?php if($current_flag==='1') {echo 'selected="selected"';}?> ><?php echo $term_desc; ?></option>
								<?php	
										}
									}
									else{
										echo "<option value='' disabled selected>Choose here</option>";
									}
								?>
							</select>
							<br />
							
							<label><strong>Venue</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select name="venue"  id="venue" class="form-control" required>
								<option value="" disabled selected>Choose here</option>
								<?php
									$venue_qry = "SELECT * FROM tbl_venue ";
									$venue_rslt = mysqli_query($con, $venue_qry);
									if(mysqli_num_rows($venue_rslt) > 0){
										while($row = mysqli_fetch_assoc($venue_rslt)){
											echo "<option value='".$row['venue_id']."'>".$row['venue_name']."</option>";
										}
									}
								?>
							</select>
							<br />
							
							<label><strong>Orientation Date</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<div class='input-group date' id='datepairExample'  style="width: 100%;">
								<input type="text" class="form-control date start" style="border-radius: 4px;" name="or_date" id="or_date" />
							</div>
							<br />
							
							<label><strong>Orientation Start Time</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<div class='input-group date' id='datepairExample' style="width: 100%;">
								<input type="text" class="form-control time start" style="border-radius: 4px;" name="or_start_time" id="or_start_time" />
							</div>
							<br />
							
							<label><strong>Orientation End Time</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<div class='input-group date' id='datepairExample' style="width: 100%;">
								<input type="text" class="form-control time end" style="border-radius: 4px;" name="or_end_time" id="or_end_time" />
							</div>
							
							<?php
							
								//if yes, attedance panel will be shown:
								$current_qry = "SELECT term_id FROM tbl_acad_term WHERE current_flag ='1'";
								$current_reg = mysqli_query($con, $current_qry);
								if(mysqli_num_rows($current_reg) > 0){
							
							?>
							
									<br />
									<input type="checkbox" name="status" id="status"  >
									<label><strong>Publish?</strong> <font color="red" style="font-weight: bold;"></font></label>
									<input type="hidden" name="flag" id="flag" class="form-control" size="25" required>
							
							<?php
							
								}
							
							?>
							
							<input type="hidden" name="orientation_id" id="orientation_id" /> 
						</div>  
						
						<div class="modal-footer">  
							<input type="submit" name="insert" id="insert" value="Insert" class="btn btn-danger" />  
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
						</div>  
						
					</form> 
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
		
		<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
		<!-- Uncomment below i you want to use a preloader -->
		<!-- <div id="preloader"></div> -->
	
	</body>
</html>

<script src="https://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>
<script src="https://jonthornton.github.io/Datepair.js/dist/jquery.datepair.js"></script>

<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		fetch_data();
		
		function fetch_data(filter_role = ''){
			var dataTable = $('#user_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"searching" : true,
				"ajax" : {
					url:"../components/config-orientation/fetch.php",
					type:"POST",
					data:{
						filter_role:filter_role
					}
				}
		   });
		}
		
		$('#filter').click(function(){
			var filter_role = $('#filter_role').val();
			
			if(filter_role != ''){
				$('#user_data').DataTable().destroy();
				fetch_data(filter_role);
			}
			else{
				$('#user_data').DataTable().destroy();
				fetch_data();
			}
		});
		
		$('#datepairExample .time').timepicker({
			'showDuration': true,
			'timeFormat': 'h:i A'
		});
		$('#datepairExample .date').datepicker({
			'format': 'MM dd, yyyy',
			'autoclose': true
		});
		$('#datepairExample').datepair();
 
		$('#add').click(function(){  
			$('#insert').val("Insert");  
			$('#insert_form')[0].reset();  
		});
		
		$(document).on('click', '.edit', function(){  
			var id = $(this).attr("id");  
			
			$.ajax({  
                url:"../components/config-orientation/write.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
					$('#orientation_id').val(data.orientation_id); 
                    $('#acad_term').val(data.term_id); 
					$('#venue').val(data.venue_id);
					
					//$('#datetime').val(data.orientation_date + " " + data.orientation_time);
					
					$('#or_date').val(data.orientation_date);
					$('#or_start_time').val(data.orientation_start_time);
					$('#or_end_time').val(data.orientation_end_time);
					
					$('#flag').val(data.active_flag); 
					
					//0 suspended; 1 active;
					if($('#flag').val() == "1"){
						$('#status').prop('checked', true);
					}
					else{
						$('#status').prop('checked', false);
					}
					
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
                }  
			});  
		});  
	  
		$('#insert_form').on("submit", function(event){  
			event.preventDefault();  
			
			if($('#or_date').val() == ""){  
                alert("Field is required");  
			}  
			else if($('#or_start_time').val() == ""){  
                alert("Field is required");  
			}  
			else if($('#or_end_time').val() == ""){  
                alert("Field is required");  
			}  
			else if($('#acad_term').val() == ''){  
                alert("Please choose an Academic Term");  
			}  
			else if($('#venue').val() == ''){  
                alert("Please choose a Venue");  
			} 
			else{  
				var orientation_id = $("#orientation_id").val();
				var or_date = $("#or_date").val();
				var or_start_time = $("#or_start_time").val();
			
				$.ajax({
					url : "../components/config-orientation/check.php",
					type : "POST",
					cache:false,
					data : {orientation_id:orientation_id, or_date:or_date, or_start_time:or_start_time},
					success:function(result){
						if (result == 1) {
							alert("Date and time is already taken!");  
						}
						else{
							$.ajax({  
								url:"../components/config-orientation/insert.php",  
								method:"POST",  
								data:$('#insert_form').serialize(),  
								beforeSend:function(){  
								  $('#insert').val("Inserting");  
								},  
								success:function(data){  
								  $('#insert_form')[0].reset();  
								  $('#add_data_Modal').modal('hide');  
								  $('#employee_table').html(data);  
								}  
							});  
						}
					}
				});
			}	   
		});
	  
		$(document).on('click', '.delete', function(){
			var id = $(this).attr("id");
		
			if(confirm("Are you sure you want to remove this?")){
				$.ajax({
					url:"../components/config-orientation/delete.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});
				
				setInterval(function(){
					$('#alert_message').html('');
				}, 5000);
			}
		});
  
		$(document).on('click', '.archive', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to hide this?")){
				$.ajax({
					url:"../components/config-orientation/archive.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});
				
				setInterval(function(){
					$('#alert_message').html('');
				}, 5000);
			}
		});

		$(document).on('click', '.restore', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to publish this?")){
				$.ajax({
					url:"../components/config-orientation/restore.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});
				
				setInterval(function(){
					$('#alert_message').html('');
				}, 5000);
			}
		});
	});
</script>