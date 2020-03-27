<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PessoaBean extends AbstractBean {
	private $id;
	private $apelido;
	private $nome;
	private $peso;
	private $dtnascimento;
	private $email;
	private $cpf;
	private $telefone;
	private $tamanhocamisa;
	private $dtvalidaemail;
	private $senha;
		
	public function PessoaBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getapelido() {
		return $this->apelido;
	}
	public function setapelido($apelido) {
		$this->apelido = $apelido;
	}
	public function getnome() {
		return $this->nome;
	}
	public function setnome($nome) {
		$this->nome = $nome;
	}
	public function getpeso() {
		return $this->peso;
	}
	public function setpeso($peso) {
		$this->peso = $peso;
	}
	public function getdtnascimento() {
		return $this->dtnascimento;
	}
	public function setdtnascimento($dtnascimento) {
		$this->dtnascimento = $dtnascimento;
	}
	public function getidade() {
		$idade = ($this->dtnascimento != "") ? floor ( (strtotime ( date ( 'd-m-Y' ) ) - strtotime ( $this->dtnascimento )) / (60 * 60 * 24 * 365.2421896) ) : "";
		return ($idade > 99) ? "NA" : $idade;
	}
	public function getemail() {
		return $this->email;
	}
	public function setemail($email) {
		$this->email = $email;
	}
	public function getcpfmascara() {
		return str_replace ( "-", "", str_replace ( ".", "", $this->cpf ) );
	}
	public function getcpf() {
		$vowels = array(".", "-");
		return str_replace($vowels, "",$this->cpf);
	}
	public function gettxcpf() {
		return $this->cpf;
	}
	public function setcpf($cpf) {
		$this->cpf = $cpf;
	}
	public function gettelefone() {
		return $this->telefone;
	}
	public function settelefone($telefone) {
		$this->telefone = $telefone;
	}
	public function gettamanhocamisa() {
		return $this->tamanhocamisa;
	}
	public function settamanhocamisa($tamanhocamisa) {
		$this->tamanhocamisa = $tamanhocamisa;
	}
	public function getdtvalidaemail() {
		return $this->dtvalidaemail;
	}
	public function setdtvalidaemail($dtvalidaemail) {
		$this->dtvalidaemail = $dtvalidaemail;
	}
	public function getsenha() {
		return $this->senha;
	}
	public function setsenha($senha) {
		$this->senha = $senha;
	}

}
?>
