<?php
	// Initialize the session
	include '../connect.php';
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	$word = "admin";
	
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
	
	//check if there's a current:
	$current_qry = "SELECT term_id FROM tbl_acad_term WHERE current_flag = '1'";
	$current_rslt = mysqli_query($con, $current_qry);
	
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
		
		<!-- date picker -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
		
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
		
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
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
					<h1 class="text-light"><a href="acad_term.php" class="scrollto"><span>Web•IMS</span></a></h1>
					<!-- <a href="#header" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid"></a> -->
				</div>
			
				<nav class="main-nav float-right d-none d-lg-block">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="active drop-down"><a href="#">Configuration</a>
						<ul>
						  <li><a href="users.php">Users</a></li>
						  <li><a href="college.php">College</a></li>
						  <li><a href="course.php">Course</a></li>
						  <li class="active"><a href="acad_term.php">Academic Term</a></li>
						  <li><a href="venue.php">Venue</a></li>
						</ul>
						<li><a href="../login/logout.php">Logout</a></li>
					  </li>
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
							<h2>Academic Term</h2>
							<h4>Modifies the details of each academic term</h4>
						</div>
						
						<div class="table-responsive">
			
							<div align="left">  
								<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-danger">Add</button>  
							</div>
							
							<br/>
							
							<div id="alert_message"></div>
							
							<div id="employee_table">  
								<table id="user_data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Description</th>
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
							<label><strong>Term Description</strong> <font color="red" style="font-weight: bold;">*</font> </label>
							<select name="term_name"  id="term_name" class="form-control" required>
								<option value="" disabled selected>Choose here</option>
								<option value="First Semester">First Semester</option>
								<option value="Second Semester">Second Semester</option>
								<option value="Third Semester">Third Semester</option>
								<option value="Summer Term">Summer Term</option>
							</select>
							<br />
							
							<label><strong>From:</strong> <font color="red" style="font-weight: bold;">*</font> </label>  
							<input class="date-own form-control" style="width: 100px;" type="text" name="from_year" id="from_year"><br />
							
							<label><strong>To:</strong> <font color="red" style="font-weight: bold;">*</font> </label>  
							<input class="date-own form-control" style="width: 100px;" type="text"  name="to_year" id="to_year"><br />
							
							<?php if(mysqli_num_rows($current_rslt) === 0){ ?>
								<input type="checkbox" name="status_c" id="status_c"  >
								<label><strong>Current Term?</strong> <font color="red" style="font-weight: bold;"></font></label>
								<input type="hidden" name="flag_c" id="flag_c" class="form-control" size="25" required>
								<br /> 
							<?php } ?>
							
							<input type="checkbox" name="status" id="status"  >
							<label><strong>Hide?</strong> <font color="red" style="font-weight: bold;"></font></label>
							<input type="hidden" name="flag" id="flag" class="form-control" size="25" required>
							
							<input type="hidden" name="term_id" id="term_id" /> 
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

<script type="text/javascript" language="javascript" >
	
    $('.date-own').datepicker({
		minViewMode: 2, format: 'yyyy'
    });

	$(document).ready(function(){
		fetch_data();

		function fetch_data(){
			var dataTable = $('#user_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"ajax" : {
					url:"../components/config-term/fetch.php",
					type:"POST"
				}
			});
		}
		
		$('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
		});
		
		$(document).on('click', '.edit', function(){  
			var term_id = $(this).attr("id");  
			
			$.ajax({  
                url:"../components/config-term/write.php",  
                method:"POST",  
                data:{term_id:term_id},  
                dataType:"json",  
                success:function(data){  
                    $('#term_name').val(data.term_name); 
					$('#from_year').val(data.term_from_year); 
					$('#to_year').val(data.term_to_year); 
					$('#term_id').val(data.term_id); 
					
					$('#flag').val(data.active_flag); 
					
					$('#flag_c').val(data.current_flag);
					
					//0 suspended; 1 active;
					if($('#flag').val() == "1"){
						$('#status').prop('checked', false);
					}
					else{
						$('#status').prop('checked', true);
					}
					
					//0 not; 1 current;
					if($('#flag_c').val() == "1"){
						$('#status_c').prop('checked', true);
					}
					else{
						$('#status_c').prop('checked', false);
					}
					
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
                }  
			});  
		});  
	  
		$('#insert_form').on("submit", function(event){  
			event.preventDefault();  
			
			if($('#term_name').val() == ""){  
                alert("Please choose a term name");  
			}  
			else if($('#from_year').val() == ''){  
                alert("Please choose a starting year");  
			}  
			else if($('#to_year').val() == ''){  
                 alert("Please choose an end year");  
			}  
			else{  
				var term_name = $("#term_name").val();
				var to_year = $("#to_year").val();
				var from_year = $("#from_year").val();
				var term_id = $("#term_id").val();
				
				$.ajax({
					url : "../components/config-term/check.php",
					type : "POST",
					cache:false,
					data : {term_id:term_id, term_name:term_name, to_year:to_year, from_year:from_year },
					success:function(result){
						if (result == 1) {
							alert("Term alias is already taken!");  
						}
						else{
							$.ajax({  
								url:"../components/config-term/insert.php",  
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
					url:"../components/config-term/delete.php",
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
			
			if(confirm("Are you sure you want to archive this?")){
				$.ajax({
					url:"../components/config-term/archive.php",
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
			
			if(confirm("Are you sure you want to restore this?")){
				$.ajax({
					url:"../components/config-term/restore.php",
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
		
		$(document).on('click', '.set', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to set this as the current academic term?")){
				$.ajax({
					url:"../components/config-term/set.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						
						//For wait 1.5 seconds
						setTimeout(function(){
							location.reload();  //Refresh page
						}, 1500);
						
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});
				
			}
		});
		
		$(document).on('click', '.unset', function(){
			var id = $(this).attr("id");
			
			if(confirm("Are you sure you want to unset this as the current academic term? \nThis will hide all the events related to this term.")){
				$.ajax({
					url:"../components/config-term/unset.php",
					method:"POST",
					data:{id:id},
					success:function(data){
						$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
						
						//For wait 1.5 seconds
						setTimeout(function(){
							location.reload();  //Refresh page
						}, 1500);
						
						$('#user_data').DataTable().destroy();
						fetch_data();
					}
				});

			}
		});
		
	});
</script>