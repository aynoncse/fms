<?php
include '../lib/Session.php';
Session::checkAdminSession();

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
		<div class="well text-center headsection well-custom">
			<img src="../img/header.png" alt="header image" class="img-responsive"/>
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
						<li <?php if ($fm->title() == 'Addstudent') {
							echo "class='active'";}?>>
							<a href="addstudent.php">Add Student</a>
						</li>
						<li <?php if ($fm->title() == 'Addteacher') {
								echo "class='active'";}?>>
								<a href="addteacher.php">Add Teacher</a>
						</li>
						<li <?php if ($fm->title() == 'Addfaculty') {
								echo "class='active'";}?>>
								<a href="addfaculty.php">Add Faculty</a>
						</li>
						<li <?php if ($fm->title() == 'Addtimeslot') {
								echo "class='active'";}?>>
								<a href="addtimeslot.php">Add Timeslot</a>
						</li>
						<li <?php if ($fm->title() == 'Addprograms') {
								echo "class='active'";}?>>
								<a href="addprograms.php">Add Programs</a>
						</li>
						<li <?php if ($fm->title() == 'Addcourses') {
								echo "class='active'";}?>>
								<a href="addcourses.php">Add Courses</a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Faculties<span class="caret"></span></a>
									<ul class="dropdown-menu">
									<?php
				$query = "SELECT * FROM faculties ORDER BY id";
				$result = $db->selectData($query);
					if ($result) {
						while ($faculty = $result->fetch_assoc()) {
				?>
										<li><a href="facultymembers.php?id=<?php echo $faculty['id'];?>"><?php echo $faculty['name'];?></a></li>
				<?php }} ?>
									</ul>
								</li>
							</ul>
				

							<ul class="nav navbar-nav navbar-right">
								
								<li><a href="?action=logout"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Logout</a></li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
