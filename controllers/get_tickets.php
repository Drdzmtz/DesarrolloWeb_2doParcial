<?php

require_once('../models/results.php');
require_once('../models/ticket_dal.php');

$id = isset($_GET['id']) ? $_GET['id'] : false;

$db = new TicketDAL();
$db->connect();

if ($id !== false) { // get once
	$r = $db->getById($id);

	if(gettype($r) === "string")
		Result::error($r);

	Result::success($r);
}

// get all
$r = $db->getAll();
if(gettype($r) === "string")
	Result::error($r);

Result::success($r);

?>