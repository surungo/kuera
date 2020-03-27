<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class RankingBean extends AbstractBean {
	private $id;
	private $campeonato;
	private $etapa;
	private $rankingetapa;
	private $info;
	private $categoria;
	private $tabelaranking;
	
	private $descarte;
	private $rankingpilotoclt;
	
	
	public function RankingBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getcampeonato() {
		return $this->campeonato;
	}
	public function setcampeonato($campeonato) {
		$this->campeonato = $campeonato;
	}
	public function getetapa() {
		return $this->etapa;
	}
	public function setetapa($etapa) {
		$this->etapa = $etapa;
	}
	public function getinfo() {
		return $this->info;
	}
	public function setinfo($info) {
		$this->info = $info;
	}

	public function getcategoria() {
		return $this->categoria;
	}
	public function setcategoria($categoria) {
		$this->categoria= $categoria;
	}

	public function gettabelaranking() {
		return $this->tabelaranking;
	}
	public function settabelaranking($tabelaranking) {
		$this->tabelaranking= $tabelaranking;
	}
	public function getdescarte() {
		return $this->descarte;
	}
	public function setdescarte($descarte) {
		$this->descarte = $descarte;
	}
	public function getrankingpilotoclt() {
		return $this->rankingpilotoclt;
	}
	public function setrankingpilotoclt($rankingpilotoclt) {
		$this->rankingpilotoclt = $rankingpilotoclt;
	}
	
	public function getrankingetapaclt() {
		return $this->rankingetapaclt;
	}
	public function setrankingetapaclt($rankingetapaclt) {
		$this->rankingetapaclt= $rankingetapaclt;
	}
	
}
?>

