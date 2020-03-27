<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PontuacaoBean extends AbstractBean {
	private $id;
	private $pontuacaoesquema;
	private $posicao;
	private $valor;
	public function PontuacaoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getposicao() {
		return $this->posicao;
	}
	public function setposicao($posicao) {
		$this->posicao = $posicao;
	}
	public function getvalor() {
		return $this->valor;
	}
	public function setvalor($valor) {
		$this->valor = $valor;
	}
	public function getpontuacaoesquema() {
		return $this->pontuacaoesquema;
	}
	public function setpontuacaoesquema($pontuacaoesquema) {
		$this->pontuacaoesquema = $pontuacaoesquema;
	}
}

?>