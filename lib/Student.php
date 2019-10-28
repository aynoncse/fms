<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/DB.php');
?>
<?php
	class Student
	{
		private $db;
		public function __construct(){
			$this->db = new DB();
		}

		public function getStudents(){
			$query 	= "SELECT * FROM student";
			$result = $this->db->selectData($query);
			return $result;
		}

		public function createStudent($id, $name, $dept_name, $email, $cell, $g_cell, $father, $mother, $pre_address, $per_address, $admission_date){
			$query 	= "INSERT INTO student (id, name, dept_name, email, cell, g_cell, father, mother, pre_address, per_address, admission_date) VALUES ($id, '$name', '$dept_name', '$email', '$cell', '$g_cell', '$father', '$mother', '$pre_address', '$per_address', '$admission_date')";

			$result = $this->db->insertData($query);
			if ($result) {
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function matchId($id){
			$query = "SELECT * FROM student WHERE id LIKE '$id%'";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function prevId($id){
			$query = "SELECT * FROM student WHERE id LIKE '$id%' ORDER BY id DESC LIMIT 1";
			$result = $this->db->selectData($query);
			return $result;
		}
	}
?>