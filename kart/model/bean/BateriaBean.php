<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class BateriaBean extends AbstractBean {
	private $id;
	private $etapa;
	private $sigla;
	private $nome;
	private $categoria;
	private $bateriaprecedente;
	private $pontuacaoesquema;
	private $dtbateria;
	private $pista;
	private $gridfechado;
	private $pilotoclt;
	private $urlresultados;
	
	public function BateriaBean() {
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
	public function getsigla() {
		return $this->sigla;
	}
	public function setsigla($sigla) {
		$this->sigla = $sigla;
	}
	public function getnome() {
		return $this->nome;
	}
	public function setnome($nome) {
		$this->nome = $nome;
	}
	public function getpontuacaoesquema() {
		return $this->pontuacaoesquema;
	}
	public function setpontuacaoesquema($pontuacaoesquema) {
		$this->pontuacaoesquema = $pontuacaoesquema;
	}
	public function getdtbateria() {
		return $this->dtbateria;
	}
	public function setdtbateria($dtbateria) {
		$this->dtbateria = $dtbateria;
	}
	public function getpilotoclt() {
		return $this->pilotoclt;
	}
	public function setpilotoclt($pilotoclt) {
		$this->pilotoclt = $pilotoclt;
	}
	public function getpista() {
		return $this->pista;
	}
	public function setpista($pista) {
		$this->pista = $pista;
	}
	
	public function getcategoria() {
		return $this->categoria;
	}
	public function setcategoria($categoria) {
		$this->categoria = $categoria;
	}
	public function getbateriaprecedente() {
		return $this->bateriaprecedente;
	}
	public function setbateriaprecedente($bateriaprecedente) {
		$this->bateriaprecedente= $bateriaprecedente;
	}
	public function geturlresultados() {
		return $this->urlresultados;
	}
	public function seturlresultados($urlresultados) {
		$this->urlresultados= $urlresultados;
	}
	public function getgridfechado() {
		return $this->gridfechado;
	}
	
	public function setgridfechado($gridfechado) {
		$this->gridfechado = $gridfechado;
	}
	
	
}


?>