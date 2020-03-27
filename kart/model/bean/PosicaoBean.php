<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PosicaoBean extends AbstractBean {
	private $id;
	private $ordem;
	private $nome;
	private $pontuacao;
	public function PosicaoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getordem() {
		return $this->ordem;
	}
	public function setordem($ordem) {
		$this->ordem = $ordem;
	}
	public function getnome() {
		return $this->nome;
	}
	public function setnome($nome) {
		$this->nome = $nome;
	}
	public function getpontuacao() {
		return $this->pontuacao;
	}
	public function setpontuacao($pontuacao) {
		$this->pontuacao = $pontuacao;
	}
}

?>