<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/DB.php');
?>
<?php
	class Teacher
	{
		private $db;
		public function __construct(){
			$this->db = new DB();
		}

		public function getTeachers(){
			$query 	= "SELECT * FROM teacher";
			$result = $this->db->selectData($query);
			return $result;
		}

		public function getTeacher($id){
			$query 	= "SELECT * FROM teacher WHERE id = '$id'";
			$result = $this->db->selectData($query);
			return $result;
		}

		public function getDirector($id, $admin_type){
			$q1 	= "SELECT * FROM teacher join  faculties on faculties.dean = teacher.id   WHERE teacher.id = '$id'";
			$result = $this->db->selectData($q1);
			if(!empty($this->db->selectData($q1)))
			 	$result  = $this->db->selectData($q1);   
			else{
				$q1 = "SELECT * FROM teacher join  programs on programs.chairman = teacher.id   WHERE teacher.id = '$id'";
				$result = $this->db->selectData($q1);

			}

			return $result;

		}


		public function getAdmin($id){
			$query 	= "SELECT * FROM admin WHERE user_name = '$id'";
			$result = $this->db->selectData($query);
			return $result;
		}

		public function getFacultyMembers($id){
			$query 	= "SELECT * FROM teacher WHERE fac_id = '$id'";
			$result = $this->db->selectData($query);
			return $result;
		}

		public function createTeacher($id, $fac_id, $password, $name, $email, $cell, $telephone, $father, $mother, $pre_address, $per_address, $detail, $designation, $join_date){
			$query 	= "INSERT INTO teacher (id, fac_id, password, name, email, cell, telephone, father, mother, pre_address, per_address, detail, designation, join_date) VALUES ($id, $fac_id, '$password', '$name', '$email', '$cell', '$telephone', '$father', '$mother', '$pre_address', '$per_address', '$detail', '$designation', '$join_date')";

			$result = $this->db->insertData($query);
			if ($result) {
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public function matchId($id){
			$query = "SELECT * FROM teacher WHERE id LIKE '$id%'";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function prevId($id){
			$query = "SELECT * FROM teacher WHERE id LIKE '$id%' ORDER BY id DESC LIMIT 1";
			$result = $this->db->selectData($query);
			return $result;
		}
	}
?>