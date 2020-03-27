<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PilotoCampeonatoBean extends AbstractBean {
	private $id;
	private $piloto;
	private $campeonato;
	public function PilotoCampeonatoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getpiloto() {
		return $this->piloto;
	}
	public function setpiloto($piloto) {
		$this->piloto = $piloto;
	}
	public function getcampeonato() {
		return $this->campeonato;
	}
	public function setcampeonato($campeonato) {
		$this->campeonato = $campeonato;
	}
}
?>

