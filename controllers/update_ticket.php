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

$id = getData("f-id");
$id = is_numeric($id) ? intval($id) : -1;

// insert one
$r = $db->update(new Ticket(
	$id,
	getData("f-tname"),
	getData("f-curp"),
	getData("f-name"),
	getData("f-flast-name"),
	getData("f-slast-name"),
	getData("f-tel", ["pattern" => '/\D/', "rep" => '']),
	getData("f-cel", ["pattern" => '/\D/', "rep" => '']),
	getData("f-mail"),
	getData("f-level"),
	getData("f-city"),
	getData("f-subj"),
	getData("f-status"),
));

if(gettype($r) === "string")
	Result::error($r);

Result::success($r);

?>