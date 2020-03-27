<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class CategoriaGrupoBean extends AbstractBean {
	private $id;
	private $categoria;
	private $grupo;
	
	public function CategoriaGrupoBean() {
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
	public function getgrupo() {
		return $this->grupo;
	}
	public function setgrupo($grupo) {
		$this->grupo = $grupo;
	}
	
}
?>
