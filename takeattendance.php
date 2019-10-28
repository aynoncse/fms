<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include_once ($filepath.'/Student.php');
include_once ($filepath.'/../helpers/Format.php');
$fm 	 = new Format();
$student = new Student();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-attendance'])) {
	
	if (!isset($_POST['attendance'])) {
		echo "<script>alert('Please Select Student');</script>";
	}else{
		$student_id	 	= $_POST['attendance'];
		$date 			= $_POST['attend-date'];
		$date 			= explode('-', $date);
		$attend_date    = $date[2].'-'.$date[1].'-'.$date[0];
		$course_code	= $_POST['course_code'];
		$fac_id 		= $_POST['fac_id'];
		$prog_id 		= $_POST['prog_id'];
		$group_no 		= $_POST['group_no'];
		//$ip_address 	= $_SERVER['REMOTE_ADDR'];
		$count 			= sizeof($student_id);
		for ($i=0; $i <$count ; $i++) {
			$query 	= "INSERT INTO attendance (
			student_id, course_code, fac_id, prog_id, group_no, `date`
			) VALUES (
			$student_id[$i], '$course_code', '$fac_id', '$prog_id', '$group_no', '$attend_date' )";
			$result = $db->insertData($query);

		}

		Session::set("attendance_date", $attend_date);
		Session::set("course_code", $course_code);
		Session::set("fac_id", $fac_id);
		Session::set("prog_id", $prog_id);
		Session::set("group_no", $group_no);
		

	}
}
?>
<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<form name="attend-date" action="" method="post" class="header-form">
			<div class="row">
				<div class="col-md-2 col-xs-6 form-group form-data input-group">
					<select id="group" name="group" required="required" class="select-item" style="margin-left: 15px;">
						<option disabled selected value>Select a Group</option>
						<?php 

						$query = "SELECT * FROM groups WHERE teacher_id='$user_id'";
						$groups_query = $db->selectData($query);

						if ($groups_query) {
							while ($groupsData = $groups_query->fetch_assoc()) { ?>
								<option value="<?php echo $groupsData['course_code']."-".$groupsData['fac_id']."-".$groupsData['prog_id']."-".$groupsData['group_no'];?>">
									<?php echo $groupsData['course_code'];?> Group <?php echo $groupsData['group_no'];?>
								</option>';
							<?php }} ?>
						</select>
					</div>
				</div>
			</form>
		</div>
		<div id="student-list" style="min-height: 250px;"></div>
		

		<script>
			$('#group').on('change', function() {
				var value = $(this).val();
				if (value != '') {
					$.ajax({
						url:"getstudentdata.php",
						method:"POST",
						data:{group:value},
						dataType:"text",
						success:function(data){
							$('#student-list').html(data);
						}
					});
				}else{
					$('#student-list').html('');
				}
			});
		</script>
	</div>
	<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/footer.php');
	?>