<?php

require_once('../models/results.php');
require_once('../models/ticket_dal.php');

function getData($name, $replace=null) {
	$data = isset($_POST[$name]) ? $_POST[$name] : '';

	if ($replace != null)
		$data = preg_replace($replace['pattern'], $replace['rep'], $data);

	return $data;
}

$db = new TicketDAL();
$db->connect();

$id     = getData('id');
$status = getData('status');

$id = is_numeric($id) ? intval($id) : -1;

$r = $db->updateStatus($id, $status);

if(gettype($r) === "string")
	Result::error($r);

Result::success($r);

?>