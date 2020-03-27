<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class CategoriaBean extends AbstractBean {
	private $id;
	private $nome;
	private $valor;
	private $valorlote1;
	private $valorlote2;
	private $valorlote3;
	private $regulamento;
	private $requisitos;
	
	private $campeonato;
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
	public function getvalor() {
		return $this->valor;
	}
	public function setvalor($valor) {
		$this->valor = $valor;
	}
	public function getcampeonato() {
		return $this->campeonato;
	}
	public function setcampeonato($campeonato) {
		$this->campeonato = $campeonato;
	}
	public function getValorlote1(){
		return $this->valorlote1;
	}
	public function setValorlote1($valorlote1){
		$this->valorlote1 = $valorlote1;
		return $this;
	}
	public function getValorlote2(){
		return $this->valorlote2;
	}
	public function setValorlote2($valorlote2){
		$this->valorlote2 = $valorlote2;
		return $this;
	}
	public function getValorlote3(){
		return $this->valorlote3;
	}
	public function setValorlote3($valorlote3){
		$this->valorlote3 = $valorlote3;
		return $this;
	}
	public function getRegulamento(){
		return $this->regulamento;
	}
	public function setRegulamento($regulamento){
		$this->regulamento = $regulamento;
		return $this;
	}
	public function getRequisitos(){
		return $this->requisitos;
	}
	public function setRequisitos($requisitos){
		$this->requisitos = $requisitos;
		return $this;
	}

}

?>