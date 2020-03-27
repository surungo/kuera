<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class GrupoBean extends AbstractBean {
	private $id;
	private $campeonato;
	private $sigla;
	private $nome;
	private $total;
	
	private $categoriaGrupo;
	
	public function GrupoBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getcampeonato() {
		return $this->campeonato;
	}
	public function setcampeonato($campeonato) {
		$this->campeonato = $campeonato;
	}
	public function getsigla() {
		return $this->sigla;
	}
	public function setsigla($sigla) {
		$this->sigla = $sigla;
	}
	public function getnome() {
		return $this->nome;
	}
	public function setnome($nome) {
		$this->nome = $nome;
	}
	public function gettotal() {
		return $this->total;
	}
	public function settotal($total) {
		$this->total = $total;
	}
	
	public function getcategoriagrupo() {
		return $this->categoriagrupo;
	}
	public function setcategoriagrupo($categoriagrupo) {
		$this->categoriagrupo = $categoriagrupo;
	}
}

?>