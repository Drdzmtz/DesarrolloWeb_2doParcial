<?php

class Ticket {
	public  $id;
	public  $tname;
	public  $CURP;
	public  $name;
	public  $lpname;
	public  $lmname;
	public  $telephone;
	public  $celphone;
	public  $mail;
	public  $level;
	public  $city;
	public  $subject;
	public 	$status;
	
	public function __construct(
		string    $id,
		string $tname,
		string $CURP,
		string $name,
		string $lpname,
		string $lmname,
		string $telephone,
		string $celphone,
		string $mail,
		string $level,
		string $city,
		string $subject,
		string $status
	) {
		$this->id        = $id;
		$this->tname     = $tname;
		$this->CURP      = $CURP;
		$this->name      = $name;
		$this->lpname    = $lpname;
		$this->lmname    = $lmname;
		$this->telephone = $telephone;
		$this->celphone  = $celphone;
		$this->mail      = $mail;
		$this->level     = $level;
		$this->city      = $city;
		$this->subject   = $subject;
		$this->status	 = $status;
	}

	public function __toString() {
		return
		"ID      = $this->id,
		TNAME    = $this-> tname,
		CURP     = $this-> CURP,
		NAME     = $this-> name,
		LPNAME   = $this-> lpname,
		LMNAME   = $this-> lmname,
		TELEPHONE= $this-> telephone,
		CELPHONE = $this-> celphone,
		MAIL     = $this-> mail,
		LEVEL    = $this-> level,
		CITY     = $this-> city,
		SUBJECT  = $this-> subject,
		STATUS   = $this-> status";
	}
}

?>