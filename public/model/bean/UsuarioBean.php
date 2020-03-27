<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class UsuarioBean extends AbstractBean {
	private $id;
	private $nome;
	private $usuario;
	private $senha;
	private $email;
	private $dtlogin;
	private $dtaprovado;
	private $dtcancelamento;
	private $perfil;
	private $perfis;
	public function UsuarioBean() {
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
	public function getusuario() {
		return $this->usuario;
	}
	public function setusuario($usuario) {
		$this->usuario = $usuario;
	}
	public function getsenha() {
		return $this->senha;
	}
	public function setsenha($senha) {
		$this->senha = $senha;
	}
	public function getemail() {
		return $this->email;
	}
	public function setemail($email) {
		$this->email = $email;
	}
	public function getdtlogin() {
		return $this->dtlogin;
	}
	public function setdtlogin($dtlogin) {
		$this->dtlogin = $dtlogin;
	}
	public function getdtaprovado() {
		return $this->dtaprovado;
	}
	public function setdtaprovado($dtaprovado) {
		$this->dtaprovado = $dtaprovado;
	}
	public function getdtcancelamento() {
		return $this->dtcancelamento;
	}
	public function setdtcancelamento($dtcancelamento) {
		$this->dtcancelamento = $dtcancelamento;
	}
	public function getperfil() {
		return $this->perfil;
	}
	public function setperfil($perfil) {
		$this->perfil = $perfil;
	}
	public function getperfis() {
		return $this->perfis;
	}
	public function setperfis($perfis) {
		$this->perfis = $perfis;
	}
}
?>