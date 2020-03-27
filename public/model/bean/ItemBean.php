<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class ItemBean extends AbstractBean {
	private $iditem;
	private $nome;
	private $codigo;
	private $perfil;
	public function ItemBean() {
	}
	public function getid() {
		return $this->iditem;
	}
	public function setid($iditem) {
		$this->iditem = $iditem;
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
	public function getperfil() {
		return $this->perfil;
	}
	public function setperfil($perfil) {
		$this->perfil = $perfil;
	}
}
?>