<?php
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/Student.php');
	$student = new Student();
$db = new DB();
?>
<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) {
	$id 			= substr($_POST['year'], -2).$_POST['semester'].$_POST['dept'].$_POST['shift'];

	$match_id 	 	= $student->matchID($id);

	if($match_id){
		$id 		= $student->prevId($id);
		$id 		= mysqli_fetch_array($id);
		$id 		= $id['id']+1;
	}else{
		$id 		= $id.'001';
	}

	$name 			= $_POST['name'];
	$dept_name		= $_POST['dept'];
	$email 			= $_POST['email'];
	$cell 			= $_POST['cell'];
	$g_cell 		= $_POST['g_cell'];
	$father 		= $_POST['father'];
	$mother 		= $_POST['mother'];
	$pre_address 	= $_POST['pre_address'];
	$per_address 	= $_POST['per_address'];
	$admission_date = date('Y-m-d');


	$insert = $student->createStudent($id, $name, $dept_name, $email, $cell, $g_cell, $father, $mother, $pre_address, $per_address, $admission_date);

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
		<form action="" method="post">
			<div class="row">
				<div class="col-md-2 col-xs-6 form-group form-data">
					<select name="semester" required="required" class="select-item">
						<option disabled selected value>Semester</option>
						<option value="1">Spring</option>
						<option value="2">Summer</option>
						<option value="3">Fall</option>
					</select>
				</div>

				<div class="col-md-2 col-xs-6 form-group form-data">
					<select name="dept" required="required" class="select-item">
						<option disabled selected value>Programs</option>
						<?php 

						$query = "SELECT * FROM programs";
						$programs_query = $db->selectData($query);

						if ($programs_query) {
							while ($programsData = $programs_query->fetch_assoc()) { ?>
								<option value="<?php echo $programsData['id'];?>">
									<?php echo substr_replace($programsData['name'], '', strpos($programsData['name'], '('),strpos($programsData['name'], ')'));?></option>
								<?php }} ?>
							</select>
						</div>

						<div class="col-md-2 col-xs-6 form-group form-data">
							<select name="shift" required="required" class="select-item">
								<option disabled selected value>Shift</option>
								<option value="0">Day</option>
								<option value="1">Evening</option>
							</select>
						</div>

						<div class="col-md-2 col-xs-6 form-group form-data">
							<select name="year" required="required" class="select-item">
								<option disabled selected value>Year</option>
								<?php 	for($i = date('Y'); $i >= date('Y', strtotime('-20 years')); $i--){  ?>
								<option value="<?php echo $i ?>"><?php echo $i ?></option>
							<?php 	}  ?>
								
							</select>
						</div>



					</div>
				</div>

				<div class="panel-body">
					<div class="row">
					<div class="form-group form-data col-md-6">

						<input class="form-control" type="text" name="name" placeholder="Enter Student Name" required="required"/>
					</div>

					<div class="form-group form-data col-md-6">

						<input class="form-control" type="text" name="father" placeholder="Enter Fathers Name" required="required"/>
					</div>

					<div class="form-group form-data col-md-6">
						<input class="form-control" type="text" name="mother" placeholder="Enter Mothers Name" required="required"/>
					</div>

					<div class="form-group form-data col-md-6">
						<input class="form-control" type="email" name="email" placeholder="Enter an Email">
					</div>

					<div class="form-group form-data col-md-6">
						<input class="form-control" type="text" name="cell" placeholder="Enter Cell Number" aria-describedby="basic-addon1">
					</div>

					<div class="form-group form-data col-md-6">
						<input class="form-control" type="text" name="g_cell" placeholder="Enter Guardian's Cell Number" aria-describedby="basic-addon1">
					</div>

					<div class="form-group form-data col-md-6">
						<textarea  class="form-control" name="per_address" placeholder="Enter Permanent Address"></textarea>
					</div>

					<div class="form-group form-data col-md-6">
						<textarea  class="form-control" name="pre_address" placeholder="Enter Present Address"></textarea>
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