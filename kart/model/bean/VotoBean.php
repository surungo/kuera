<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class VotoBean extends AbstractBean {
	private $id;
	private $eleitorCategoriaGrupo;
	private $candidatoCategoriaGrupo;
	
	public function VotoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
    public function geteleitorcategoriagrupo() {
		return $this->eleitorcategoriagrupo;
	}
	public function seteleitorcategoriagrupo($eleitorCategoriaGrupo) {
		$this->eleitorcategoriagrupo = $eleitorCategoriaGrupo;
	}
	public function getcandidatoCategoriaGrupo() {
		return $this->candidatoCategoriaGrupo;
	}
	public function setcandidatoCategoriaGrupo($candidatoCategoriaGrupo) {
		$this->candidatoCategoriaGrupo = $candidatoCategoriaGrupo;
	}
	
}
?>
