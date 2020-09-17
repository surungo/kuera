<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class PilotoBateriaBean extends AbstractBean {
	private $id;
	private $piloto;
	private $bateria;
	private $gridlargada;
	private $presente;
	private $posicao;
	private $posicaokart;
	private $kart;
	private $tempo;
	private $volta;
	private $na;
	private $peso;
	private $pesoextra;
	private $pregridlargada;
	private $posicaooficial;
	private $kartlargada;
	private $penalizacao;
	private $cartaoamarelo;
	private $convidado;
	private $informacao;
	private $observacao;
	private $donovolta;
	public function PilotoBateriaBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function getpiloto() {
		return $this->piloto;
	}
	public function setpiloto($piloto) {
		$this->piloto = $piloto;
	}
	public function getbateria() {
		return $this->bateria;
	}
	public function setbateria($bateria) {
		$this->bateria = $bateria;
	}
	public function getgridlargada() {
		return $this->gridlargada;
	}
	public function setgridlargada($gridlargada) {
		$this->gridlargada = $gridlargada;
	}
	public function getpresente() {
		return $this->presente;
	}
	public function setpresente($presente) {
		$this->presente = $presente;
	}
	public function getposicao() {
		return $this->posicao;
	}
	public function setposicao($posicao) {
		$this->posicao = $posicao;
	}
		
	public function getposicaokart() {
		return $this->posicaokart;
	}

	public function setposicaokart($posicaokart) {
		$this->posicaokart = $posicaokart;
	}

	public function getkart() {
		return $this->kart;
	}
	public function setkart($kart) {
		$this->kart = $kart;
	}
	public function gettempo() {
		return $this->tempo;
	}
	public function settempo($tempo) {
		$this->tempo = $tempo;
	}
	public function getvolta() {
		return $this->volta;
	}
	public function setvolta($volta) {
		$this->volta = $volta;
	}
	public function getna() {
		return $this->na;
	}
	public function setna($na) {
		$this->na = $na;
	}
	public function getpeso() {
		return $this->peso;
	}
	public function setpeso($peso) {
		$this->peso = $peso;
	}
	public function getpesoextra() {
		return $this->pesoextra;
	}
	public function setpesoextra($pesoextra) {
		$this->pesoextra = $pesoextra;
	}
	public function getpregridlargada() {
		return $this->pregridlargada;
	}
	public function setpregridlargada($pregridlargada) {
		$this->pregridlargada = $pregridlargada;
	}
	public function getposicaooficial() {
		return $this->posicaooficial;
	}
	public function setposicaooficial($posicaooficial) {
		$this->posicaooficial = $posicaooficial;
	}
	public function getkartlargada() {
		return $this->kartlargada;
	}
	public function setkartlargada($kartlargada) {
		$this->kartlargada = $kartlargada;
	}
	public function getpenalizacao() {
		return $this->penalizacao;
	}
	public function setpenalizacao($penalizacao) {
		$this->penalizacao = $penalizacao;
	}
	public function getcartaoamarelo() {
		return $this->cartaoamarelo;
	}
	public function setcartaoamarelo($cartaoamarelo) {
		$this->cartaoamarelo = $cartaoamarelo;
	}
	public function getconvidado() {
		return $this->convidado;
	}
	public function setconvidado($convidado) {
		$this->convidado = $convidado;
	}
	public function getinformacao() {
		return $this->informacao;
	}
	public function setinformacao($informacao) {
		$this->informacao = $informacao;
	}
	public function getobservacao() {
		return $this->observacao;
	}
	public function setobservacao($observacao) {
		$this->observacao = $observacao;
	}
	public function getdonovolta() {
		return $this->donovolta;
	}
	public function setdonovolta($donovolta) {
		$this->donovolta = $donovolta;
	}
}
?>

