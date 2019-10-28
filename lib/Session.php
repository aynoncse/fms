<?php
class Session{
	public static function init(){
		if (version_compare(phpversion(), '5.4.0', '<')) {
			if (session_id() == '') {
				session_start();
			}
		} else {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}
	}

	public static function destroy(){
		self::init();
		session_unset();
		session_destroy();
		unset($_SESSION['user_id']);
		header("Location: login.php");
	}
	public static function adminDestroy(){
		self::init();
		session_unset();
		session_destroy();
		unset($_SESSION['user_id']);
		header("Location: ../login.php");
	}
	public static function set($key, $value){
		$_SESSION[$key] = $value;
	}
	public static function get($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}else{
			return false;
		}
	}
	public function checkAdminSession(){
		self::init();
		if (self::get("login") == false || self::get("admin_type") != 'admin') {
			self::admindestroy();
			header("Location: ../login.php");
		}
	}


	public function checkDirectorSession(){
		self::init();
		if (self::get("login") == false || self::get("admin_type") != 'director') {
			self::admindestroy();
			header("Location: ../login.php");
		}
	}

	public function checkFacultySession(){
		self::init();
		if (self::get("login") == false || self::get("admin_type") != 'faculty') {
			self::destroy();
			header("Location: login.php");
		}
	}


	
	public function checkLogin(){
		self::init();
		if (self::get("login") == true) {
			header("Location: index.php");
		}
	}
}
?>