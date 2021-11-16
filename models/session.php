<?php

class Session {
	public static function login($username, $password) {
		self::logout();

		$db = new mysqli(
			'localhost',
			'root',
			'',
			'dweb'
		);

		if ($db->connect_errno)
			return $db->connect_error;
		
		$data = $db->query(
			"SELECT
				`USERNAME`,
				`NAME`
			FROM users
			WHERE `USERNAME`='$username' AND `PASSWORD`=MD5('$password')"
		);
		
		$r = $data->fetch_array();
		if (!$r)
			return 'the username or password is not correct';

		$_SESSION['username'] = $r['USERNAME'];
		$_SESSION['name']     = $r['NAME'];

		return true;
	}

	public static function logout() {
		if (self::isOpen())
			session_destroy();
	}

	public static function isOpen() {
		self::sessionStart();

		return isset($_SESSION['username']);
	}

	public static function isOpenOrView() {
		if (self::isOpen()) return;

		header('Location: login.php');
	}

	private static function sessionStart() {
		if (session_status() == PHP_SESSION_ACTIVE) return;
		
		session_start();
	}
}


?>