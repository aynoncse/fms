<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include_once ($filepath.'/Student.php');
$teacher = new Teacher();
$db = new DB();
?>
<div class="panel panel-default">
	<?php 
		if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = "SELECT * FROM faculties WHERE id = '$id'";
		$fac_query = $db->selectData($query);
		$fac_data = mysqli_fetch_assoc($fac_query);
	?>
	<div class="panel-heading"> Faculty Members of <?php echo $fac_data['name']; ?></div>
	<div class="panel-body">

		<table class="table table-striped">
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Telephone</th> 
				<th>Email</th>
				<th>Cell</th>
				<th>Designation</th>
			</tr>
	<?php 
		$faculty = $teacher->getFacultyMembers($id);

		if ($faculty) {
			while ($facultyData = $faculty->fetch_assoc()) {
	?>
				<tr>
					<td><?php echo $facultyData['id'];?></td>
					<td><?php echo $facultyData['name'];?></td>
					<td><?php echo $facultyData['telephone'];?></td>
					<td><?php echo $facultyData['email'];?></td>
					<td><?php echo $facultyData['cell'];?></td>
					<td><?php echo $facultyData['designation'];?></td>
				</tr>
		<?php }}
			else {
				echo "<tr><td colspan = 6 class = 'alert alert-danger'>No Member Found for This Faculty </td></tr>";
			}
	} ?>
		</table>
	</div>

	<div class="panel-heading clearfix"></div>

</div>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/footer.php');
?>
