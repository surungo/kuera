<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class ParametroBean extends AbstractBean {
	private $id;
	private $codigo;
	private $valor;
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getcodigo() {
		return $this->codigo;
	}
	public function setcodigo($codigo) {
		$this->codigo = $codigo;
	}
	public function getvalor() {
		return $this->valor;
	}
	public function setvalor($valor) {
		$this->valor = $valor;
	}
}

?>