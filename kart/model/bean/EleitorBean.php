<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class EleitorBean extends AbstractBean {
	private $id;
	private $nome = 'Eleitor';
	private $pessoa;

	private $eleitorCategoriaGrupo;
	private $voto;
	
	public function EleitorBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getnome() {
		return $this->$nome;
	}
	public function getpessoa() {
		return $this->pessoa;
	}
	public function setpessoa($pessoa) {
		$this->pessoa = $pessoa;
	}
	public function geteleitorCategoriaGrupo() {
		return $this->eleitorCategoriaGrupo;
	}
	public function seteleitorCategoriaGrupo($eleitorCategoriaGrupo) {
		$this->eleitorCategoriaGrupo = $eleitorCategoriaGrupo;
	}
	
	public function getvoto() {
		return $this->voto;
	}
	public function setvoto($voto) {
		$this->voto = $voto;
	}
	
	
	
}
?>
