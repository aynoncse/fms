<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include_once ($filepath.'/../helpers/Format.php');
include_once ($filepath.'/Teacher.php');
$teacher = new Teacher();
$db = new DB();
$fm = new Format();
?>


<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) {
	$name 			= $fm->validate($_POST['name']);
	$fac_id			= $fm->validate($_POST['faculty']);
	$email 			= $fm->validate($_POST['email']);
	$cell 			= $fm->validate($_POST['cell']);
	$telephone 		= $fm->validate($_POST['telephone']);
	$father 		= $fm->validate($_POST['father']);
	$mother 		= $fm->validate($_POST['mother']);
	$detail 		= $fm->validate($_POST['detail']);
	$designation 	= $fm->validate($_POST['designation']);
	$pre_address 	= $fm->validate($_POST['pre_address']);
	$per_address 	= $fm->validate($_POST['per_address']);
	$id 			= substr(date('Y'), -2).$fac_id;
	$match_id 	 	= $teacher->matchID($id);
	if($match_id){
		$id 		= $teacher->prevId($id);
		$id 		= mysqli_fetch_array($id);
		$id 		= $id['id']+1;
	}else{
		$id 		= $id.'0001';
	}

	$join_date 		= date('Y-m-d');
	$password 		= mysqli_real_escape_string($db->link, $id);
    $password   	= md5($password);
	$insert = $teacher->createTeacher($id, $fac_id, $password, $name, $email, $cell, $telephone, $father, $mother, $pre_address, $per_address, $detail, $designation, $join_date);

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
			<div class="col-md-2 col-xs-6 form-group form-data">
				<select name="faculty" required="required" class="select-item" style="margin-left: -15px">
					<option disabled selected value>Faculty</option>
				<?php
				$query = "SELECT * FROM faculties ORDER BY id";
				$result = $db->selectData($query);
					if ($result) {
						while ($faculty = $result->fetch_assoc()) {
				?>
					<option value="<?php echo $faculty['id'];?>"><?php echo $faculty['name'];?></option>';
				<?php }} ?>
				</select>
			</div>

			<div class="col-md-2 col-xs-6 form-group form-data">
				<select name="designation" required="required" class="select-item">
					<option disabled selected value>Designation</option>
					<option value="Professor">Professor</option>';
					<option value="Associate Professor">Associate Professor</option>';
					<option value="Assistant Prof">Assistant Professor</option>';
					<option value="Senior Lecturer">Senior Lecturer</option>';
					<option value="Lecturer">Lecturer</option>';
				</select>
			</div>
			
		</div>

		<div class="panel-body">
		<div class="row">
			<div class="form-group form-data col-md-6">
				
				<input class="form-control" type="text" name="name" placeholder="Enter Teacher Name" required="required"/>
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
				<input class="form-control" type="text" name="telephone" placeholder="Enter Telephone Number">
			</div>
			
			<div class="form-group form-data col-md-6">
				<input class="form-control" type="text" name="cell" placeholder="Enter Cell Number" aria-describedby="basic-addon1">
			</div>

			<div class="form-group form-data col-md-6">
				<textarea  class="form-control" name="per_address" placeholder="Enter Permanent Address"></textarea>
			</div>

			<div class="form-group form-data col-md-6">
				<textarea  class="form-control" name="pre_address" placeholder="Enter Present Address"></textarea>
			</div>

			<div class="form-group form-data col-md-6 form-data-2">
				<textarea id="editor" name="detail" placeholder="Enter Detail...."></textarea>
			</div>
		</div>

			<input style="clear: both; float: left;" class="form-group btn btn-primary" type="submit" name="submit" value="Add"/>
		</form>
	</div>
</div>

<script src="../js/ckeditor5/ckeditor.js" type="text/javascript"></script>
<script>

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/footer.php');
?>