<?php

require_once('../models/results.php');
require_once('../models/ticket_dal.php');

$id     = isset($_GET['id'])        ? $_GET['id']        : false;
$filter = isset($_GET['ft-status']) ? $_GET['ft-status'] : false;

$db = new TicketDAL();
$db->connect();

if ($id !== false) { // get once
	$r = $db->getById($id);

	if(gettype($r) === "string")
		Result::error($r);

	Result::success($r);
}

// get all or filtered
if ($filter !== false) $r = $db->getAllByStatus($filter);
else                   $r = $db->getAll();

if(gettype($r) === "string")
	Result::error($r);

Result::success($r);

?>