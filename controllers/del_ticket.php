<?php

require_once('../models/results.php');
require_once('../models/ticket_dal.php');

$id = isset($_POST['id']) ? $_POST['id'] : null;

if ($id === null)
	Result::error('Id not specified');

$db = new TicketDAL();
$db->connect();

$r = $db->delete($id);
if(gettype($r) === "string")
	Result::error($r);

Result::success($r);

?>