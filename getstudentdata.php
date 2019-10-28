<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/lib/DB.php');
	include_once ($filepath.'/Student.php');
	$std = new Student();
	$db = new DB();
?>
<?php 
if (isset( $_POST['group'])) {
	$group 			= $_POST['group'];
	$course 		= explode('-', $group);
	$course_code 	= $course[0];
	$fac_id 		= $course[1];
	$prog_id 		= $course[2];
	$group_no 		= $course[3];
	$query = "SELECT student.name, student.id FROM teaches LEFT JOIN student ON student.id = teaches.student_id WHERE teaches.course_code = '$course_code' AND teaches.group_no='$group_no'";
	$student_query = $db->selectData($query);
}
?>
<div class="panel-body">
	<form name="attendance" action="" method="post" class="attend-form">
		<div id="datepicker" class="form-group form-data input-group date" data-date-format="dd-mm-yyyy">
			<input name="attend-date" id="date" class="form-control" type="text" value="<?php echo date('d-m-Y');?>" readonly />
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		</div>
		<table class="table table-striped">

			<thead>
				<tr>
					<td></td>
					<td></td>
					<td>Select All</td>
					<td><input type="checkbox" id="checkAll"> </td>
				</tr>
				<tr>
					<th width="10%">Serial</th>
					<th width="40%">Name</th>
					<th width="30%">Id</th>
					<th width="20%">Attendance</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if ($student_query) {
					$i= 0;
					while ($students = $student_query->fetch_assoc()) {
						$i++;
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $students['name'];?></td>
							<td><?php echo $students['id'];?></td>
							<td>
								<input type="checkbox" name="attendance[]" value="<?php echo $students['id'];?>">
							</td>
						</tr>

								<input type="hidden" name="course_code" value="<?php echo $course_code;?>">
								<input type="hidden" name="fac_id" value="<?php echo $fac_id;?>">
								<input type="hidden" name="prog_id" value="<?php echo $prog_id;?>">
								<input type="hidden" name="group_no" value="<?php echo $group_no;?>">

					<?php }} else{?>
						<tr>
							<td colspan="4" class="alert-danger error blink" align="center" style="font-size: 24px;">
								Empty Group!!
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td colspan="4">
							<input class="btn btn-primary" type="submit" name="submit-attendance" value="Submit">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<script>
	$("#checkAll").click(function () {
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
</script>
<script type="text/javascript">
	$(function () {
		$('#datepicker').datepicker();
	});
</script>
