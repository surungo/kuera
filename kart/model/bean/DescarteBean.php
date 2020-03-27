<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class DescarteBean extends AbstractBean {
	private $id;
	private $campeonato;
	private $sigla;
	private $nome;
	private $numero;
	private $quantidade;
	
	private $descarteetapa;
	
	public function DescarteBean() {
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
	public function getnumero() {
		return $this->numero;
	}
	public function setnumero($numero) {
		$this->numero = $numero;
	}
	
	public function getdescarteetapa() {
		return $this->descarteetapa;
	}
	public function setdescarteetapa($descarteetapa) {
		$this->descarteetapa = $descarteetapa;
	}
	
	public function getquantidade() {
		return $this->quantidade;
	}
	public function setquantidade($quantidade) {
		$this->quantidade = $quantidade;
	}
	
	
}

?>