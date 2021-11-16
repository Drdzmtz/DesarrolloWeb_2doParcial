<?php

require_once('../models/results.php');
require_once('../models/ticket_dal.php');

$id     = isset($_GET['id'])        ? $_GET['id']        : -1;
$curp   = isset($_GET['curp'])      ? $_GET['curp']      : '';

$db = new TicketDAL();
$db->connect();

$r = $db->getByCURP($id, $curp);

if(gettype($r) === "string")
	Result::error($r);

Result::success($r);

?>