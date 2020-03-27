<?php
class DiaSemanaBean extends AbstractBean {
	private $id;
	private $nome;
	private $data;
	public function DiaSemanaBean($id, $nome, $data) {
		$this->id = $id;
		$this->nome = $nome;
		$this->data = $data;
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
	public function getdata() {
		return $this->data;
	}
	public function setdata($data) {
		$this->data = $data;
	}
}
?>