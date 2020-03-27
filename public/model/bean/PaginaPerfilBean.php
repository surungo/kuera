<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
include_once PATHPUBBEAN . '/PerfilBean.php';
include_once PATHPUBBEAN . '/PaginaBean.php';
class PaginaPerfilBean extends AbstractBean {
	private $perfil;
	private $pagina;
	public function PaginaPerfilBean() {
	}
	public function getperfil() {
		return $this->perfil;
	}
	public function setperfil($perfil) {
		$this->perfil = $perfil;
	}
	public function getpagina() {
		return $this->pagina;
	}
	public function setpagina($pagina) {
		$this->pagina = $pagina;
	}
}
?>