<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class EquipeBean extends AbstractBean {
	private $id;
	private $campeonato;
	private $sigla;
	private $nome;
	private $codigoacesso;
	private $campoaux;
	private $valor;
	private $situacao;
	private $dtpagamento;
	private $nrinscrito;
	private $categoria;
	private $inscritolider;
	public function EquipeBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getnrinscrito() {
		return $this->nrinscrito;
	}
	public function setnrinscrito($nrinscrito) {
		$this->nrinscrito = $nrinscrito;
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
	public function getcodigoacesso() {
		return $this->codigoacesso;
	}
	public function setcodigoacesso($codigoacesso) {
		$this->codigoacesso = $codigoacesso;
	}
	public function getcampoaux() {
		return $this->campoaux;
	}
	public function setcampoaux($campoaux) {
		$this->campoaux = $campoaux;
	}
	public function getvalor() {
		return $this->valor;
	}
	public function setvalor($valor) {
		$valor = str_replace ( " ", "", $valor );
		$valor = str_replace ( " ", "", $valor );
		$valor = str_replace ( " ", "", $valor );
		$this->valor = str_replace ( ",", ".", $valor );
	}
	public function getvalorDecimal() {
		// return str_replace(".", ",", $this->valor);
		return ($this->valor != null && $this->valor != "") ? number_format ( $this->valor, 2, ',', ' ' ) : "";
	}
	public function getsituacao() {
		return $this->situacao;
	}
	public function setsituacao($situacao) {
		$this->situacao = $situacao;
	}
	public function getdtpagamento() {
		return $this->dtpagamento;
	}
	public function setdtpagamento($dtpagamento) {
		$this->dtpagamento = $dtpagamento;
	}
	public function getcategoria() {
		return $this->categoria;
	}
	public function setcategoria($categoria) {
		$this->categoria = $categoria;
	}
	public function getinscritolider() {
		return $this->inscritolider;
	}
	public function setinscritolider($inscritolider) {
		$this->inscritolider = $inscritolider;
	}
}

?>