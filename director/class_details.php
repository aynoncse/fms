<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include_once ($filepath.'/Student.php');
$student = new Student();
?>
<?php 
if (!isset($_GET['c_id'])) {
	header("Location: index.php");
	
}else{
	$course_code 	= $_GET['c_id'];
	$group_no 		= $_GET['g_no'];
	$teacher_name 	= $_GET['t_name'];
}
?>

<div class="panel panel-success">
	<div class="panel-heading">
		<h4 class="info" style="margin: 0;"><span><?php echo $course_code." Group - ".$group_no; ?></span> <span class="pull-right"><?php echo $teacher_name?></span> </h4>
	</div>

	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr class="success">
					<th>Sn</th>
					<th>Date</th>
					<th>Building</th>
					<th>Room No</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Total Duration</th>				
				</tr>
			</thead>
			<tbody>
				<?php 


				$query = "SELECT attendance.*, class_duration.*, classroom.* FROM attendance join class_duration on class_duration.course_code = attendance.course_code AND class_duration.fac_id = attendance.fac_id  AND class_duration.prog_id = attendance.prog_id AND attendance.group_no = class_duration.group_no   AND class_duration.date = attendance.date join classroom on classroom.ip_address = class_duration.ip_address   WHERE attendance.course_code='$course_code' GROUP BY attendance.date, attendance.course_code;";
				$attendance_query = $db->selectData($query);

				if ($attendance_query) {
					$i = 0;
					while ($attendanceData = $attendance_query->fetch_assoc()) { 
						$i++;

						

						?>
						<tr class="success">
							<td><?php echo $i; ?></td>
							<td><?php echo $attendanceData['date']; ?></td>
							<td><?php echo $attendanceData['building']; ?></td>
							<td><?php echo $attendanceData['name']; ?></td>
							<td><?php echo $start_time =  date("h:i:s", strtotime($attendanceData['start_time'])); ?></td>
							<td><?php echo $end_time = date("h:i:s", strtotime($attendanceData['end_time'])); ?></td>
							<td>
								<?php 
								$datetime1 = new DateTime($start_time);
								$datetime2 = new DateTime($end_time);
								$interval = $datetime1->diff($datetime2);
								
								?>
								<?php echo $interval->format('%H:%I:%S');  ?>  </td>				
							</tr>
							<?php
						}}
						?>
					</tbody>
				</table>
				<div class="pull-right">
					<a href="index.php" class="btn btn-primary">Back</a>
				</div>
			</div>
		</div>
		<?php
		$filepath = realpath(dirname(__FILE__));
		include_once ($filepath.'/inc/footer.php');
		?>