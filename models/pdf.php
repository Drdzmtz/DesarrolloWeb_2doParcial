<?php 
require('../lib/fpdf/fpdf.php');


class Custom_PDF extends FPDF{
	
	// public  $ticket;

	// public function __construct(
	// 	Ticket $ticket

	// ){
	// 	$this->ticket = $ticket;
	// }

	public $ticket;

	function Header(){
		$x = $this->GetX();
		$y = $this->GetY();

		$this->SetLineWidth(.7);
		$this->SetFont('arial','', 10);
		$this->Cell(30, 10, "Numero de turno", "LRT", 1, "C");
		$this->Ln(5);
		$this->SetY($this->GetY()-5);

		$id = $this->ticket->id;

		$this->SetFont('arial','B', 40);
		$this->Cell(30, 18, "$id", "LRB", 1, "C");
		
		$this->setXY($this->GetX() + 70, $this->GetY() - 10);
		$this->SetFont('arial','B',15);
		$this->Cell(30,10,'Comprobante de Turno', 0, 0, 'C', False, "");

		$this->Image('../images/book.png', $x+80,$y+5, 10, 10);
		$this->Ln(25);

		$this->Line(20, 50, 210-20, 50);
	}
	

	function Footer(){
		$y= $this->GetPageHeight();

		$this->SetLineWidth(.7);
		$this->Line(20, $y-20, 210-20, $y-20);
	}
}

class PDF {

	public  $ticket;
	
	public function __construct(
		Ticket $ticket

	){
		$this->ticket = $ticket;
	}

	public function generatePDF() {

		$pdf=new Custom_PDF();
		$pdf->ticket = $this->ticket;
		$ticket = $this->ticket;

		$pdf->SetMargins(20, 15, 20);
		$pdf->AddPage();

		$x = $pdf->GetX();
		$y = $pdf->GetY();

		$pdf->SetXY($x, $y+5);

		$pdf->SetFont('arial', 'B', 20);
		$pdf->Cell(80, 5, "Datos del tramitante", 0, 1);

		$pdf->SetFillColor(248, 249, 250);
		$pdf->Rect( $x,  $y+15, 170,  55, "F");

		$pdf->SetXY($x+10, $pdf->GetY()+10);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Nombre del tramitante:", 0, 1);
		$pdf->SetFont('arial', '', 16);
		$pdf->SetX($x+10);
		$pdf->Cell(80, 5, "$ticket->tname", 0, 1);

		$pdf->SetXY($x+10, $pdf->GetY()+5);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Nivel de estudios:", 0, 1);
		$pdf->SetFont('arial', '', 16);
		$pdf->SetX($x+10);
		$pdf->Cell(80, 5, "$ticket->level", 0, 1);

		$pdf->SetXY($x+10, $pdf->GetY()+5);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Ciudad de origen:", 0, 1);
		$pdf->SetFont('arial', '', 16);
		$pdf->SetX($x+10);
		$pdf->Cell(80, 5, "$ticket->city", 0, 1);

		$pdf->SetXY($x+105, $y+20);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Asunto del ticket:", 0, 1);
		$pdf->SetFont('arial', '', 14);
		$pdf->SetXY($x+105, $pdf->GetY());
		$pdf->Cell(80, 5, "$ticket->subject", 0, 1);

		$pdf->SetXY($x+105, $pdf->GetY()+5);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Estado del ticket:", 0, 1);
		$pdf->SetFont('arial', '', 16);
		$pdf->SetXY($x+105, $pdf->GetY());
		$pdf->Cell(80, 5, "$ticket->status", 0, 1);

		$pdf->SetXY($x+105, $pdf->GetY()+5);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "CURP:", 0, 1);
		$pdf->SetFont('arial', '', 12);
		$pdf->SetXY($x+105, $pdf->GetY());
		$pdf->Cell(80, 5, "$ticket->CURP", 0, 1);


		$pdf->SetY($pdf->GetY()+20);
		$pdf->SetFont('arial', 'B', 20);
		$pdf->Cell(80, 5, "Datos de contacto", 0, 1);

		$pdf->SetFillColor(248, 249, 250);
		$pdf->Rect( $x,  $y+90, 170,  55, "F");

		$pdf->SetXY($x+10, $pdf->GetY()+10);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Telefono:", 0, 1);
		$pdf->SetFont('arial', '', 16);
		$pdf->SetX($x+10);
		$pdf->Cell(80, 5, "$ticket->telephone", 0, 1);
		
		$pdf->SetXY($x+10, $pdf->GetY()+5);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Celular:", 0, 1);
		$pdf->SetFont('arial', '', 16);
		$pdf->SetX($x+10);
		$pdf->Cell(80, 5, "$ticket->celphone", 0, 1);

		$pdf->SetXY($x+10, $pdf->GetY()+5);
		$pdf->SetFont('arial', 'B', 12);
		$pdf->Cell(80, 5, "Correo:", 0, 1);
		$pdf->SetFont('arial', '', 16);
		$pdf->SetX($x+10);
		$pdf->Cell(80, 5, "$ticket->mail", 0, 1);

		$pdf->Output("Comprobante_De_Turno$ticket->id.pdf",'I');

		return true;
	}
}

?>