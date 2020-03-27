<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class PerfilBean extends AbstractBean {
	private $id;
	private $nome;
	private $paginacapa;
	private $paginas;
	private $itemperfil;
	public function PerfilBean() {
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
	public function getpaginacapa() {
		return $this->paginacapa;
	}
	public function setpaginacapa($paginacapa) {
		$this->paginacapa = $paginacapa;
	}
	public function getpaginas() {
		return $this->paginas;
	}
	public function setpaginas($paginas) {
		$this->paginas = $paginas;
	}
	public function getitemperfil() {
		return $this->itemperfil;
	}
	public function setitemperfil($itemperfil) {
		$this->itemperfil = $itemperfil;
	}
}
?>