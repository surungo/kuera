<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class RankingEtapaBean extends AbstractBean {
	private $id;
	private $etapa;
	private $ranking;

	public function RankingEtapaBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getetapa() {
		return $this->etapa;
	}
	public function setetapa($etapa) {
		$this->etapa = $etapa;
	}
	public function getranking() {
		return $this->ranking;
	}
	public function setranking($ranking) {
		$this->ranking = $ranking;
	}
	
}
?>

