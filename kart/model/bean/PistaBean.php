<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PistaBean extends AbstractBean {
	private $id;
	private $nome;
	private $sentido;
	private $local;
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
	public function getsentido() {
		return $this->sentido;
	}
	public function setsentido($sentido) {
		$this->sentido = $sentido;
	}
	public function getlocal() {
		return $this->local;
	}
	public function setlocal($local) {
		$this->local = $local;
	}
}

?>