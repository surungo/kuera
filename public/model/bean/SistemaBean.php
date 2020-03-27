<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class SistemaBean extends AbstractBean {
	private $id;
	private $nome;
	private $codigo;
	public function SistemaBean() {
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
	public function getcodigo() {
		return $this->codigo;
	}
	public function setcodigo($codigo) {
		$this->codigo = $codigo;
	}
}
?>