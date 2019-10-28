<?php
include 'lib/Session.php';
Session::checkFacultySession();

if(isset($_SESSION['user_id']))
   $user_id = $_SESSION['user_id'];
else
	header("Location: login.php");
?>


<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/DB.php');
include_once ($filepath.'/Teacher.php');
$teacher = new Teacher();
$db = new DB();
?>

<?php
    // get pc ip address 
	ob_start(); // Turn on output buffering
	system('ipconfig /all'); //Execute external program to display output
	$mycom 	= ob_get_contents(); // Capture the output into a variable
	ob_clean(); // Clean (erase) the output buffer
	$findme = "IPv4";
	$pmac 	= strpos($mycom, $findme); // Find the position of Physical text
	$ip_address	=substr($mycom,($pmac+36),13); // Get Physical Address
	$ip_address = explode('(', $ip_address);
	$ip_address = $ip_address[0];
	
if (isset($_GET['action']) && $_GET['action']=='logout') {

	// get all session data
	$logout_time 		= date('Y-m-d h:i:s');
	$attendance_date   	= $_SESSION['attendance_date'];
	$fac_id   			= $_SESSION['fac_id'];
	$prog_id   			= $_SESSION['prog_id'];
	$group_no   		= $_SESSION['group_no'];
	$login_datetime   	= $_SESSION['login_datetime'];
	$course_code   		= $_SESSION['course_code'];
	
  	$query 	= "INSERT INTO class_duration (
			course_code, fac_id, prog_id, group_no, start_time, end_time,`date`,ip_address
			) VALUES (
			'$course_code', '$fac_id', '$prog_id', '$group_no', '$login_datetime', '$logout_time', '$attendance_date', '$ip_address')";
			$result = $db->insertData($query);


	Session::destroy();
}
include 'helpers/Format.php';
$fm = new Format();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php echo TITLE; ?>
	</title>
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
	<link rel="stylesheet" href="css/bootstrap.css" media="screen"/>
	<link rel="stylesheet" href="css/style.css" media="screen"/>
	<link rel="stylesheet" href="css/fontawesome-all.min.css" media="screen"/>
	<script src="js/jquery.js"></script>
</head>
<body>
	<section class="container">
		<div class="well text-center headsection well-custom">
			<img src="img/header.png" alt="header image" class="img-responsive" usemap="#planetmap">
			<map name="planetmap">
			  <area shape="rect" coords="0,0,162,126" alt="Sun" href="index.php">
			</map>
		</div>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li <?php if ($fm->title() == 'Home') {
							echo "class='active'";}?>>
							<a href="index.php">Home<span class="sr-only">(current)</span></a>
						</li>
						<li <?php if ($fm->title() == 'Takeattendance') {
							echo "class='active'";}?>>
							<a href="takeattendance.php">Take Attendence</a>
						</li>
					</ul>
					

					<ul class="nav navbar-nav navbar-right">
						
						<li><a href="?action=logout"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Logout</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
