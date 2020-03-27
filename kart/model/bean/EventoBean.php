<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class EventoBean extends AbstractBean {
	private $id;
	private $sigla;
	private $nome;
	private $tipoevento;
	private $totalvaga;
	private $totalvagaequipe;
	private $totalinscritoequipe;
	private $valor;
	private $adicionarcentavos;
	private $valorporextenso;
	private $valorpaypal;
	private $emailpaypal;
	private $mostrarespera;
	private $msglistaespera;
	private $listainscrito;
	private $msgaguardandopagamento;
	private $msgatualizadosucesso;
	private $msgsucesso;
	private $msgsucessoequipe;
		
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
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
	public function gettotalvaga() {
		return $this->totalvaga;
	}
	public function settotalvaga($totalvaga) {
		$this->totalvaga = $totalvaga;
	}
	public function gettotalvagaequipe() {
		return $this->totalvagaequipe;
	}
	public function settotalvagaequipe($totalvagaequipe) {
		$this->totalvagaequipe = $totalvagaequipe;
	}
	public function gettotalinscritoequipe() {
		return $this->totalinscritoequipe;
	}
	public function settotalinscritoequipe($totalinscritoequipe) {
		$this->totalinscritoequipe = $totalinscritoequipe;
	}
	public function getvalor() {
		return $this->valor;
	}
	public function setvalor($valor) {
		$this->valor = $valor;
	}
	public function getvalorporextenso() {
		return $this->valorporextenso;
	}
	public function setvalorporextenso($valorporextenso) {
		$this->valorporextenso = $valorporextenso;
	}
	public function getvalorpaypal() {
		return $this->valorpaypal;
	}
	public function setvalorpaypal($valorpaypal) {
		$this->valorpaypal = $valorpaypal;
	}
	public function getemailpaypal() {
		return $this->emailpaypal;
	}
	public function setemailpaypal($emailpaypal) {
		$this->emailpaypal = $emailpaypal;
	}
	public function getmostrarespera() {
		return $this->mostrarespera;
	}
	public function setmostrarespera($mostrarespera) {
		$this->mostrarespera = $mostrarespera;
	}
	public function getmsglistaespera() {
		return $this->msglistaespera;
	}
	public function setmsglistaespera($msglistaespera) {
		$this->msglistaespera = $msglistaespera;
	}
	public function getlistainscrito() {
		return $this->listainscrito;
	}
	public function setlistainscrito($listainscrito) {
		$this->listainscrito = $listainscrito;
	}
	public function getmsgaguardandopagamento() {
		return $this->msgaguardandopagamento;
	}
	public function setmsgaguardandopagamento($msgaguardandopagamento) {
		$this->msgaguardandopagamento = $msgaguardandopagamento;
	}
	public function getmsgatualizadosucesso() {
		return $this->msgatualizadosucesso;
	}
	public function setmsgatualizadosucesso($msgatualizadosucesso) {
		$this->msgatualizadosucesso = $msgatualizadosucesso;
	}
	public function getmsgsucesso() {
		return $this->msgsucesso;
	}
	public function setmsgsucesso($msgsucesso) {
		$this->msgsucesso = $msgsucesso;
	}
	public function getmsgsucessoequipe() {
		return $this->msgsucessoequipe;
	}
	public function setmsgsucessoequipe($msgsucessoequipe) {
		$this->msgsucessoequipe = $msgsucessoequipe;
	}


	public function gettipoevento(){
		return $this->tipoevento;
	}

	public function settipoevento($tipoevento){
		$this->tipoevento = $tipoevento;
		return $this;
	}

	public function getadicionarcentavos(){
		return $this->adicionarcentavos;
	}

	public function setadicionarcentavos($adicionarcentavos){
		$this->adicionarcentavos = $adicionarcentavos;
		return $this;
	}

}

?>