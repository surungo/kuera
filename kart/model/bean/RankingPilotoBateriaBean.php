<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class RankingPilotoBateriaBean extends AbstractBean {
	private $id;
	private $rankingpiloto;
	private $pilotobateria;
	private $donovolta;
	private $melhorpessoal;
	private $pontos;
	
	public function RankingPilotoBateriaBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getrankingpiloto() {
		return $this->rankingpiloto;
	}
	public function setrankingpiloto($rankingpiloto) {
		$this->rankingpiloto = $rankingpiloto;
	}
	public function getpilotobateria() {
		return $this->pilotobateria;
	}
	public function setpilotobateria($pilotobateria) {
		$this->pilotobateria = $pilotobateria;
	}
	public function getdonovolta() {
		return $this->donovolta;
	}
	public function setdonovolta($donovolta) {
		$this->donovolta = $donovolta;
	}
	public function getmelhorpessoal() {
		return $this->melhorpessoal;
	}
	public function setmelhorpessoal($melhorpessoal) {
		$this->melhorpessoal = $melhorpessoal;
	}
	public function getpontos() {
		return $this->pontos;
	}
	public function setpontos($pontos) {
		$this->pontos = $pontos;
	}
}
?>

