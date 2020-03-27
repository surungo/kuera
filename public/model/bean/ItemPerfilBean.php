<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class ItemPerfilBean extends AbstractBean {
	private $id;
	private $perfil;
	private $item;
	private $pagina;
	public function ItemPerfilBean() {
	}
	
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	
	public function getperfil() {
		return $this->perfil;
	}
	public function setperfil($perfil) {
		$this->perfil = $perfil;
	}
	public function getitem() {
		return $this->item;
	}
	public function setitem($item) {
		$this->item = $item;
	}
	public function getpagina() {
		return $this->pagina;
	}
	public function setpagina($pagina) {
		$this->pagina = $pagina;
	}
}
?>