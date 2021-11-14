<?php

class Result {
	public static function error($error) {
		echo json_encode(array('error' => $error, 'success' => null));
		die;
	}
	
	public static function success($success) {
		echo json_encode(array('success' => $success, 'error' => null));
		exit;
	}
}

?>