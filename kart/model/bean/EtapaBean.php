<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class EtapaBean extends AbstractBean {
	private $id;
	private $campeonato;
	private $nome;
	private $numero;
	private $sigla;
	private $info;
	private $dtresultado;
	private $dtgrid;
	private $dtranking;
	
	public function EtapaBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
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
	public function getinfo() {
		return $this->info;
	}
	public function setinfo($info) {
		$this->info = $info;
	}
	public function getcampeonato() {
		return $this->campeonato;
	}
	public function setcampeonato($campeonato) {
		$this->campeonato = $campeonato;
	}
	
	public function getdtresultado() {
		return $this->dtresultado;
	}
	public function setdtresultado($dtresultado) {
		$this->dtresultado = $dtresultado;
	}
	public function isAtivoDtResultado(){
		if($this->dtresultado == ""){
			return false;
		}
		return $this->dtresultado <= Util::now();
	}
		
	public function getdtgrid() {
		return $this->dtgrid;
	}
	public function setdtgrid($dtgrid) {
		$this->dtgrid = $dtgrid;
	}
	public function isAtivoDtgrid(){
		if($this->dtgrid == ""){
			return false;
		} 
		return $this->dtgrid <= Util::now();
	}
	
	public function getdtranking() {
		return $this->dtranking;
	}
	public function setdtranking($dtranking) {
		$this->dtranking = $dtranking;
	}
	public function isAtivoDtranking(){
		if($this->dtranking == ""){
			return false;
		}
		return $this->dtranking <= Util::now();
	}
}

?>