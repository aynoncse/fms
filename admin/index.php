<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/header.php');
include_once ($filepath.'/Student.php');
$student = new Student();

 // cound depart wise student
 $q  = "SELECT dept_name, count(id) as totalStudent FROM student GROUP BY dept_name";
 $student = $db->selectData($q); 
 // refactor student data acording dept id
 $programWiseStuArray = [];
 while ($stu = $student->fetch_assoc()) {
 	$programWiseStuArray[$stu['dept_name']] = $stu['totalStudent'];
 }

 $query = "SELECT * FROM programs ORDER BY id asc";
 $program_query = $db->selectData($query); 


?>

<script type="text/javascript">

	// canvas js 
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true		
	title:{
		text: "Department Wise Student"
	},
	data: [
	{
		type: "column",
		dataPoints: [
  			<?php 
  				$i = 0;
  				while ($program = $program_query->fetch_assoc()) { 
                    // assign totalstu variable zero if total student is empty
  					if(!empty($programWiseStuArray[$program['id']])) $totalStu  = $programWiseStuArray[$program['id']] ;
  					else
  						$totalStu = 0;

  					if(++$i == $program_query->num_rows){
  			 ?>				
			 	{ label: "<?php echo $program['short_name']; ?>",  y: <?php echo $totalStu; ?>  }
		<?php  }else{ ?>
			{ label: "<?php echo $program['short_name'] ?>",  y: <?php echo $totalStu; ?>  },
		<?php } } ?>
		

		
		]
	}
	]
});
chart.render();

}
</script>


<?php if (isset($_SESSION['successmsg'])) : ?>
	<div class="alert alert-success">
		<?php 

		echo $_SESSION['successmsg'];
		unset($_SESSION['successmsg']);
		?>
	</div>
<?php endif ?>
<div class="panel panel-default">
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	
</div>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/inc/footer.php');
?>