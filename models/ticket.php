<?php

class Ticket {
	public function __construct(
		public int $id,
		public string $tname,
		public string $CURP,
		public string $name,
		public string $lpname,
		public string $lmname,
		public string $telephone,
		public string $celphone,
		public string $mail,
		public string $level,
		public string $city,
		public string $subject
	) {}

	public function __toString() {
		return
		"ID       = $this->id,
		TNAME    = $this->$tname,
		CURP     = $this->$CURP,
		NAME     = $this->$name,
		LPNAME   = $this->$lpname,
		LMNAME   = $this->$lmname,
		TELEPHONE= $this->$telephone,
		CELPHONE = $this->$celphone,
		MAIL     = $this->$mail,
		LEVEL    = $this->$level,
		CITY     = $this->$city,
		SUBJECT  = $this->$subject";
	}
}

?>