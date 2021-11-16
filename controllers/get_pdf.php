<?php
require_once('../models/results.php');
require_once('../models/ticket_dal.php');
require_once('../models/pdf.php');

function getData($name, $replace=null) {
	$data = isset($_GET[$name]) ? $_GET[$name] : '';

	if ($replace != null)
		$data = preg_replace($replace['pattern'], $replace['rep'], $data);

	return $data;
}

$db = new TicketDAL();
$db->connect();

$ticketByID = $db->getById(getData("f-id"));

if(gettype($ticketByID) === "string")
	Result::error($ticketByID);

$pdf = new PDF($ticketByID);
$r = $pdf->generatePDF();

if(gettype($r) === "string")
	Result::error($r);

Result::success($r);

?>