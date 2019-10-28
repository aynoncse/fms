<?php
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/Student.php');
	$student = new Student();
$db = new DB();
?>
<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) {
	$name 				= $_POST['name'];
	$course_code		= $_POST['course_code'];
	$fac_id 			= $_POST['fac_id'];
	$prog_id 			= $_POST['prog_id'];
	$credit_hours 		= $_POST['credit_hours'];

	$query = "INSERT INTO courses (name, course_code, fac_id, prog_id, credit_hours) VALUES ('$name','$course_code','$fac_id','$prog_id','$credit_hours')";
		$course_query = $db->insertData($query);

	if ($course_query) {?>
		<div class="alert alert-success" role="alert">
			Inserted Succeessfully
		</div>
	<?php }else{?>
		<div class="alert alert-danger" role="alert">
			Failed to insert!!
		</div>
	<?php	}
}
?>

<div class="panel panel-default">
	<div class="panel-heading clearfix">

		<h2 class="text-center">Add courses</h>

	</div>
		<form action="" method="post">
				<div class="panel-body">
					<div class="row">
					<div class="form-group form-data col-md-6">

						<input class="form-control" type="text" name="name" placeholder="Enter Course Name" required="required"/>
					</div>

					<div class="form-group form-data col-md-6">

						<input class="form-control" type="text" name="course_code" placeholder="Enter course_code" required="required"/>
					</div>

					<div class="form-group form-data col-md-6">
						<select name="fac_id" required="required" class="select-item">
						<option disabled selected value>Faculty</option>
						<?php 

						$query = "SELECT * FROM faculties";
						$faculty_query = $db->selectData($query);

						if ($faculty_query) {
							while ($facultyData = $faculty_query->fetch_assoc()) { ?>
								<option value="<?php echo $facultyData['id'];?>">
									<?php echo substr_replace($facultyData['name'], '', strpos($facultyData['name'], '('),strpos($facultyData['name'], ')'));?></option>';
								<?php }} ?>
							</select>
					</div>

					<div class="form-group form-data col-md-6">
						<select name="prog_id" required="required" class="select-item">
						<option disabled selected value>Programs</option>
						<?php 

						$query = "SELECT * FROM programs";
						$programs_query = $db->selectData($query);

						if ($programs_query) {
							while ($programsData = $programs_query->fetch_assoc()) { ?>
								<option value="<?php echo $programsData['id'];?>">
									<?php echo substr_replace($programsData['name'], '', strpos($programsData['name'], '('),strpos($programsData['name'], ')'));?></option>';
								<?php }} ?>
							</select>
					</div>

					<div class="form-group form-data col-md-6">
						<input class="form-control" type="text" name="credit_hours" placeholder="Enter credit hours" aria-describedby="basic-addon1">
					</div>


				</div>

					<input style="clear: both; float: left;" class="form-group btn btn-primary" type="submit" name="submit" value="Add"/>
				</form>
			</div>
		</div>
		<?php
		$filepath = realpath(dirname(__FILE__));
		include_once ($filepath.'/inc/footer.php');
		?>