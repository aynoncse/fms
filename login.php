<?php
include 'lib/Session.php';
Session::checkLogin();
?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/lib/DB.php');
include_once ($filepath.'/Teacher.php');
include 'helpers/Format.php';
$teacher = new Teacher();
$db = new DB();
$fm = new Format();

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$id   = $fm->validate($_POST['userid']);
	$password   = $fm->validate($_POST['password']);
	$admin_type   = $fm->validate($_POST['admin_type']);

	$userid = mysqli_real_escape_string($db->link, $id);
	$password = mysqli_real_escape_string($db->link, $password);

	$password   = md5($password);

	if($admin_type == 'admin'){
		$loginInfo = $teacher->getAdmin($id);

	}else if($admin_type == 'faculty'){
		$loginInfo = $teacher->getTeacher($id);
	}else{
		$loginInfo = $teacher->getDirector($id, $admin_type);	
	}
	

	if ($loginInfo != false) {
		$value  = mysqli_fetch_array($loginInfo);
		$row    = mysqli_num_rows($loginInfo);

		if ($row > 0) {
			Session::set("login", true);
			Session::set("user_id", $value['id']);
			Session::set("admin_type", $admin_type);
			Session::set("login_datetime", date('Y-m-d h:i:s'));

			if($admin_type == 'admin'){
				Session::set("successmsg", 'Welcome '.$admin_type.'. You are now logged in.');
				header("Location: admin/index.php");
			}
			else if($admin_type == 'director'){
				Session::set("successmsg", 'Welcome '.$admin_type.'. You are now logged in.');
				header("Location: director/index.php");
			}
			else if($admin_type == 'faculty'){
				Session::set("successmsg", 'Welcome '.$value['name'].'. You are now logged in.');
				header("Location: index.php");
			}

		}else{
			$errors = "No Data Found!!";
		}
	}else{

		$errors = 'User ID or Password not matched!!';
	}
}   
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
	<link rel="stylesheet" href="css/loginstyle.css" media="screen"/>
	<link rel="stylesheet" href="css/fontawesome.min.css" media="screen"/>
	<link rel="stylesheet" href="css/fontawesome-all.min.css" media="screen"/>
</head>
<body>
	<section class="container" style="margin-top: 150px;"">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="" method="post" autocomplete="off">

						<?php if(isset($errors)){?>
							<div class="form-group">
								<div class="alert alert-danger" role="alert">
									<span class="blink"> <?php echo $errors;?></span>
								</div>
								
							</div>
						<?php }?>

						<div class="form-group">
							<select name="admin_type" required="required" class="form-control">
								<option disabled selected value>Select Type</option>
								<option value="admin">Admin</option>';
								<option value="director">Director</option>';
								<option value="faculty">Faculty</option>';
							</select>
						</div>

						<div class="form-group">
							<input type="text" name="userid" class="form-control" placeholder="Enter User ID.....">
						</div>

						


						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Enter Password.....">
						</div>

						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" la value="Login">
						</div>
					</form>
				</div>
				<div class="lock"><i class="fa fa-lock fa-3x"></i></div>
				<div class="label">Login</div>
				<div class="label2"></div>
			</div>
		</div>
	</div>