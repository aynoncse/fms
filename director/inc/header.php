<?php
	include '../lib/Session.php';
	Session::checkDirectorSession();
?>

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../../lib/DB.php');
	include_once ($filepath.'/Teacher.php');
	$teacher = new Teacher();
	$db = new DB();
?>

<?php
if (isset($_GET['action']) && $_GET['action']=='logout') {
	Session::admindestroy();
}
include ($filepath.'/../helpers/Format.php');
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
	<link rel="stylesheet" href="../css/bootstrap.css" media="screen"/>
	<link rel="stylesheet" href="../css/style.css" media="screen"/>
	<link rel="stylesheet" href="../css/fontawesome-all.min.css" media="screen"/>
</head>
<body>
	<section class="container">
		<div class="well text-center headsection well-custom director-header">
			<a class="director-logout" href="?action=logout"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Logout</a>
			<img src="../img/header.png" alt="header image" class="img-responsive"/>
		<h2 class="text-center">Faculty Monitoring System</h2>
		</div>
