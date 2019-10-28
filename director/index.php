<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include_once ($filepath.'/Student.php');
$student = new Student();
?>

<?php if (isset($_SESSION['successmsg'])) : ?>
	<div class="alert alert-success">
		<?php 

		echo $_SESSION['successmsg'];
		unset($_SESSION['successmsg']);
		?>
	</div>
<?php endif ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="text-center" style="margin: 0;">Courses For Fall 2018</h2>
	</div>

	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr class="success">
					<th>Sn</th>
					<th>Course Code</th>
					<th>Course Name</th>
					<th>Faculty Name</th>
					<th>Group</th>					
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
			<?php 

				$query = "SELECT 
								g.*, 
								c.name AS course_name,
								t.name AS teacher_name
								FROM groups AS g 
								LEFT JOIN courses AS c 
								ON g.course_code = c.course_code 
								LEFT JOIN teacher AS t
								ON g.teacher_id = t.id 
								WHERE g.fac_id=3";
				$course_query = $db->selectData($query);

				if ($course_query) {
					$i = 0;
					while ($courseData = $course_query->fetch_assoc()) { 
						$i++;
			?>

				<tr <?php if($i%2 == 0) { echo "class='info'";} else{echo "style='background-color: #729ab4;'";} ?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $courseData['course_code']; ?></td>
					<td><?php echo $courseData['course_name']; ?></td>
					<td><?php echo $courseData['teacher_name']; ?></td>
					<td><?php echo $courseData['group_no']; ?></td>					
					<td><a href="class_details.php?c_id=<?php echo $courseData['course_code'];?>&t_name=<?php echo $courseData['teacher_name'];?>&g_no=<?php echo $courseData['group_no']; ?>">Go</a></td>
				</tr>
			<?php
				}}
			?>
			</tbody>
		</table>
	</div>
</div>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/footer.php');
?>