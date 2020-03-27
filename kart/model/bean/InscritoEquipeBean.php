<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class InscritoEquipeBean extends AbstractBean {
	private $id;
	private $equipe;
	private $inscrito;
	private $piloto;
	private $admin;
	public function InscritoEquipeBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getequipe() {
		return $this->equipe;
	}
	public function setequipe($equipe) {
		$this->equipe = $equipe;
	}
	public function getinscrito() {
		return $this->inscrito;
	}
	public function setinscrito($inscrito) {
		$this->inscrito = $inscrito;
	}
	public function getpiloto() {
		return $this->piloto;
	}
	public function setpiloto($piloto) {
		$this->piloto = $piloto;
	}
	public function getadmin() {
		return $this->admin;
	}
	public function setadmin($admin) {
		$this->admin = $admin;
	}
}
?>

