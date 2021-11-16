<?php 
require('./lib/fpdf/fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('arial', 'B', 16);
$pdf->Cell(80, 10, 'HOLA!');

$pdf->Output('result.pdf','I');
?>