<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class CandidatoBean extends AbstractBean {
	private $id;
	private $nome = 'Candidato';
	private $pessoa;
	
	private $candidatoCategoriaGrupo;
	
	public function CandidatoBean() {
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
	
	public function getcandidatoCategoriaGrupo() {
		return $this->candidatoCategoriaGrupo;
	}
	public function setcandidatoCategoriaGrupo($candidatoCategoriaGrupo) {
		$this->candidatoCategoriaGrupo = $candidatoCategoriaGrupo;
	}
	
}
?>
