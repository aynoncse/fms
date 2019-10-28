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
<div class="panel panel-default" style="min-height: 322px;">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-8" style="font-size: 22px;">
				<p><span style="font-size: 32px;">E</span>astern University is a government approved private university founded in 2003 by Mr. Abul Kasem Haider. The university is an independent organization with its own Board of Trustees</p>
				<p>Eastern University envisions to promote and create a learning environment through state-of-the-art facilities and tools; highly competent faculties and staff; expanded frontier of research-based knowledge; and international standards supportive of the new horizons in the diverse fields of disciplines and the enunciated development perspectives of the country.</p>
			</div>
			<div class="col-md-4 ">
				<img src="img/male.png" class="img-responsive">
				
			</div>
		</div>
	</div>
</div>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/footer.php');
?>