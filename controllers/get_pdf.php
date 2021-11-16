<?php

require_once('../models/results.php');
require_once('../models/ticket_dal.php');

function getData($name, $replace=null) {
	$data = isset($_POST[$name]) ? $_POST[$name] : '';

	if ($replace != null)
		$data = preg_replace($replace['pattern'], $replace['rep'], $data);

	return $data;
}

echo "HOLAA!";

?>