<?php
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/Student.php');
	$student = new Student();
$db = new DB();
?>
<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) {

	$time_start		= $_POST['time_start'];
	$time_end		= $_POST['time_end'];
	
	$query = "INSERT INTO timeslot (time_start,time_end) VALUES ('$time_start','$time_end')";
		$insert = $db->insertData($query);
	if ($insert) {?>
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
		<h2>Add Time Slot</h2>
	</div>
		<div class="panel-body">
		<form action="" method="post">
		<div class="row">
			<div class="form-group form-data col-md-6">

				<input class="form-control" type="time" name="time_start" placeholder="Enter start time" required="required"/>
			</div>

			<div class="form-group form-data col-md-6">
				<input class="form-control" type="time" name="time_end" placeholder="Enter ending time" required="required"/>
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