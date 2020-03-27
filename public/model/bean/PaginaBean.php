<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class PaginaBean extends AbstractBean {
	private $id;
	private $nome;
	private $url;
	private $ordem;
	private $hierarquia;
	private $target;
	private $visivel;
	private $ativo;
	private $sistema;
	public function PaginaBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getnome() {
		return $this->nome;
	}
	public function setnome($nome) {
		$this->nome = $nome;
	}
	public function geturl() {
		return $this->url;
	}
	public function seturl($url) {
		$this->url = $url;
	}
	public function getordem() {
		return $this->ordem;
	}
	public function setordem($ordem) {
		$this->ordem = $ordem;
	}
	public function gethierarquia() {
		return $this->hierarquia;
	}
	public function sethierarquia($hierarquia) {
		$this->hierarquia = $hierarquia;
	}
	public function gettarget() {
		return $this->target;
	}
	public function settarget($target) {
		$this->target = $target;
	}
	public function isvisivel() {
		return ($this->visivel == "S") ? true : false;
	}
	public function getvisivel() {
		return $this->visivel;
	}
	public function setvisivel($visivel) {
		$this->visivel = $visivel;
	}
	public function isativo() {
		return ($this->ativo == "S") ? true : false;
	}
	public function getativo() {
		return $this->ativo;
	}
	public function setativo($ativo) {
		$this->ativo = $ativo;
	}
	public function getsistema() {
		return $this->sistema;
	}
	public function setsistema($sistema) {
		$this->sistema = $sistema;
	}
}
?>