<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class CategoriaInscritoBean extends AbstractBean {
	private $id;
	private $categoria;
	private $inscrito;
	private $nome;
	private $valor;
	
	public function CategoriaInscritoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
    public function getcategoria() {
		return $this->categoria;
	}
	public function setcategoria($categoria) {
		$this->categoria = $categoria;
	}
	public function getinscrito() {
		return $this->inscrito;
	}
	public function setinscrito($inscrito) {
		$this->inscrito = $inscrito;
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
	
}
?>
