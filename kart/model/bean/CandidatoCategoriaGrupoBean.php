<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class CandidatoCategoriaGrupoBean extends AbstractBean {
	private $id;
	private $candidato;
	private $categoriagrupo;
	
	public function CandidatoCategoriaGrupoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
    public function getcandidato() {
		return $this->candidato;
	}
	public function setcandidato($candidato) {
		$this->candidato = $candidato;
	}
	public function getcategoriagrupo() {
		return $this->categoriagrupo;
	}
	public function setcategoriagrupo($categoriagrupo) {
		$this->categoriagrupo = $categoriagrupo;
	}
	
}
?>
