<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class DescarteEtapaBean extends AbstractBean {
	private $id;
	private $etapa;
	private $descarte;

	public function DescarteEtapaBean() {
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
	public function getdescarte() {
		return $this->descarte;
	}
	public function setdescarte($descarte) {
		$this->descarte = $descarte;
	}
	
}
?>

