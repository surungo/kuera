<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
include_once 'PilotoBean.php';
class RankingVO extends AbstractBean {
	private $piloto;
	private $cltPilotoBateria;
	private $posicao;
	private $valorpontuacao;
	private $desempate;
	public function RankingVO() {
	}
	public function getpiloto() {
		return $this->piloto;
	}
	public function setpiloto($piloto) {
		$this->piloto = $piloto;
	}
	public function getcltPilotoBateria() {
		return $this->cltPilotoBateria;
	}
	public function setcltPilotoBateria($cltPilotoBateria) {
		$this->cltPilotoBateria = $cltPilotoBateria;
	}
	public function getposicao() {
		return $this->posicao;
	}
	public function setposicao($posicao) {
		$this->posicao = $posicao;
	}
	public function getvalorpontuacao() {
		return $this->valorpontuacao;
	}
	public function setvalorpontuacao($valorpontuacao) {
		$this->valorpontuacao = $valorpontuacao;
	}
	public function addvalorpontuacao($valorpontuacao) {
		$this->valorpontuacao = $this->valorpontuacao + $valorpontuacao;
	}
	public function getdesempate() {
		return $this->desempate;
	}
	public function setdesempate($desempate) {
		$this->desempate = $desempate;
	}
}
?>

