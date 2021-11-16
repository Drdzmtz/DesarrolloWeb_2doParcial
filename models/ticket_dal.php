<?php
require_once('ticket.php');

class TicketDAL {
	private $db;
	private $cnx_err;
	
	public function __construct() {
		$this->db = null;
		$this->db_err = 'there is no connection with the DB';
	}

	public function __destruct() {
		if ($this->db === null) return;

		$this->db->close();
	}

	public function connect() {
		if ($this->db !== null) return true;

		$db = new mysqli(
			'localhost',
			'root',
			'',
			'dweb'
		);

		if ($db->connect_errno) {
			$this->cnx_err = $db->connect_error;
			return $this->cnx_err;
		}
		
		$this->db = $db;
		$this->cnx_err = null;
		return true;
	}

	public function insert($ticket) {
		if ($this->db === null) return $this->cnx_err;

		$r = $this->db->query(
			"INSERT INTO tickets VALUES (
				NULL,
				'$ticket->tname'    ,
				'$ticket->CURP'     ,
				'$ticket->name'     ,
				'$ticket->lpname'   ,
				'$ticket->lmname'   ,
				'$ticket->telephone',
				'$ticket->celphone'	 ,
				'$ticket->mail'     ,
				'$ticket->level'    ,
				'$ticket->city'     ,
				'$ticket->subject'  ,
				'$ticket->status'	
			)"
		);

		$last_id = $this->db->insert_id;
		$result = array("success" => True, "id" => $last_id);
		
		return $r ? $result : $this->db->error;
	}

	public function update($ticket) {
		if ($this->db === null) return $this->cnx_err;

		$r = $this->db->query(
			"UPDATE tickets SET
				`TNAME`    = '$ticket->tname'    ,
				`CURP`     = '$ticket->CURP'     ,
				`NAME`     = '$ticket->name'     ,
				`LPNAME`   = '$ticket->lpname'   ,
				`LMNAME`   = '$ticket->lmname'   ,
				`TELEPHONE`= '$ticket->telephone',
				`CELPHONE` = '$ticket->celphone' ,
				`MAIL`     = '$ticket->mail'     ,
				`LEVEL`    = '$ticket->level'    ,
				`CITY`     = '$ticket->city'     ,
				`SUBJECT`  = '$ticket->subject'  ,
				`STATUS`   = '$ticket->status'	 
			WHERE ID=$ticket->id"
		);

		return $r ? true : $this->db->error;
		return $r ? true : 'Is not possible update the ticket';
	}

	public function updateStatus($id, $status) {
		if ($this->db === null) return $this->cnx_err;

		$r = $this->db->query(
			"UPDATE tickets SET
				`STATUS`  = '$status'   
			WHERE ID=$id"
		);

		return $r ? true : 'Is not possible update status of the ticket';
	}

	public function delete($id) {
		if ($this->db === null) return $this->cnx_err;

		$r = $this->db->query(
			"DELETE FROM tickets WHERE ID=$id"
		);

		return $r ? true : 'Is not possible delete the ticket';
	}

	public function exists($ticket) {
		return gettype($this->getById($ticket->id)) === "object";
	}

	public function getById($id) {
		if ($this->db === null) return $this->cnx_err;

		$data = $this->db->query(
			"SELECT
				ID,          
				TNAME,
				CURP,
				`NAME`,
				LPNAME,
				LMNAME,
				TELEPHONE,
				CELPHONE,
				MAIL,
				`LEVEL`,
				CITY,
				`SUBJECT`,
				`STATUS`
			FROM tickets
			WHERE ID=$id"
		);

		if (!$data) return $this->db->error;
		
		if ($r = $data->fetch_array()) return new Ticket(
			$r['ID'],
			$r['TNAME'],
			$r['CURP'],
			$r['NAME'],
			$r['LPNAME'],
			$r['LMNAME'],
			$r['TELEPHONE'],
			$r['CELPHONE'],
			$r['MAIL'],
			$r['LEVEL'],
			$r['CITY'],
			$r['SUBJECT'],
			$r['STATUS']
		);

		return null;
	}

	public function getByCURP($id, $curp) {
		if ($this->db === null) return $this->cnx_err;

		$data = $this->db->query(
			"SELECT
				ID,
				TNAME,
				CURP,
				`NAME`,
				LPNAME,
				LMNAME,
				TELEPHONE,
				CELPHONE,
				MAIL,
				`LEVEL`,
				CITY,
				`SUBJECT`,
				`STATUS`
			FROM tickets
			WHERE
				ID       =  $id            AND
				CURP     = '$curp'         AND
				`STATUS` = 'Sin atender'"
		);

		if (!$data) return $this->db->error;
		
		if ($r = $data->fetch_array()) return new Ticket(
			$r['ID'],
			$r['TNAME'],
			$r['CURP'],
			$r['NAME'],
			$r['LPNAME'],
			$r['LMNAME'],
			$r['TELEPHONE'],
			$r['CELPHONE'],
			$r['MAIL'],
			$r['LEVEL'],
			$r['CITY'],
			$r['SUBJECT'],
			$r['STATUS']
		);

		return null;
	}

	public function getAllByStatus($status) {
		if ($this->db === null) return $this->cnx_err;

		$data = $this->db->query(
			"SELECT
				ID,          
				TNAME,
				CURP,
				`NAME`,
				LPNAME,
				LMNAME,
				TELEPHONE,
				CELPHONE,
				MAIL,
				`LEVEL`,
				CITY,
				`SUBJECT`,
				`STATUS`
			FROM tickets
			WHERE `STATUS`='$status'"
		);

		if (!$data) return $this->db->error;

		$results = array();
		while ($r = $data->fetch_array()) {
			$results[] = new Ticket(
				$r['ID'],
				$r['TNAME'],
				$r['CURP'],
				$r['NAME'],
				$r['LPNAME'],
				$r['LMNAME'],
				$r['TELEPHONE'],
				$r['CELPHONE'],
				$r['MAIL'],
				$r['LEVEL'],
				$r['CITY'],
				$r['SUBJECT'],
				$r['STATUS']
			);
		}

		return $results;
	}

	public function getAll() {
		if ($this->db === null) return $this->cnx_err;

		$data = $this->db->query(
			"SELECT
				ID,          
				TNAME,
				CURP,
				`NAME`,
				LPNAME,
				LMNAME,
				TELEPHONE,
				CELPHONE,
				MAIL,
				`LEVEL`,
				CITY,
				`SUBJECT`,
				`STATUS`
			FROM tickets"
		);

		if (!$data) return $this->db->error;

		$results = array();
		while ($r = $data->fetch_array()) {
			$results[] = new Ticket(
				$r['ID'],
				$r['TNAME'],
				$r['CURP'],
				$r['NAME'],
				$r['LPNAME'],
				$r['LMNAME'],
				$r['TELEPHONE'],
				$r['CELPHONE'],
				$r['MAIL'],
				$r['LEVEL'],
				$r['CITY'],
				$r['SUBJECT'],
				$r['STATUS']
			);
		}

		return $results;
	}
}

?>