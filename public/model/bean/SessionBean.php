<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class SessionBean extends AbstractBean {
	private $id;
	private $keysession;
	private $usuario;
	private $token;
	private $ip;
	public function SessionBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getkeysession() {
		return $this->keysession;
	}
	public function setkeysession($keysession) {
		$this->keysession = $keysession;
	}
	public function getusuario() {
		return $this->usuario;
	}
	public function setusuario($usuario) {
		$this->usuario = $usuario;
	}
	public function getip() {
		return $this->ip;
	}
	public function setip($ip) {
		$this->ip = $ip;
	}
	public function getToken(){
		return $this->token;
	}
	public function setToken($token){
		$this->token = $token;
		return $this;
	}

}
?>