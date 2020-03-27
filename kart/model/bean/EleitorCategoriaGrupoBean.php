<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class EleitorCategoriaGrupoBean extends AbstractBean {
	private $id;
	private $eleitor;
	private $categoriagrupo;
	
	public function EleitorCategoriaGrupoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
    public function geteleitor() {
		return $this->eleitor;
	}
	public function seteleitor($eleitor) {
		$this->eleitor = $eleitor;
	}
	public function getcategoriagrupo() {
		return $this->categoriagrupo;
	}
	public function setcategoriagrupo($categoriagrupo) {
		$this->categoriagrupo = $categoriagrupo;
	}
	
}
?>
