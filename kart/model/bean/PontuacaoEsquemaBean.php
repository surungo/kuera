<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PontuacaoEsquemaBean extends AbstractBean {
	private $id;
	private $nome;
	public function PontuacaoEsquemaBean() {
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
}

?>