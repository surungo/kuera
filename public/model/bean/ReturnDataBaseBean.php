<?php
include_once PATHPUBBEAN . "/AbstractBean.php";
class ReturnDataBaseBean extends AbstractBean {
	private $resposta;
	private $mensagem;
	private $sucesso;
	private $qta;
	private $choice;
	public function ReturnDataBaseBean() {
	}
	public function getresposta() {
		return $this->resposta;
	}
	public function setresposta($resposta) {
		$this->resposta = $resposta;
	}
	public function getmensagem() {
		return $this->mensagem;
	}
	public function setmensagem($mensagem) {
		$this->mensagem = $mensagem;
	}
	public function getsucesso() {
		return $this->sucesso;
	}
	public function setsucesso($sucesso) {
		$this->sucesso = $sucesso;
	}
	public function getchoice() {
		return $this->choice;
	}
	public function setchoice($choice) {
		$this->choice = $choice;
	}
	public function getqta() {
		return $this->qta;
	}
	public function setqta($qta) {
		$this->qta = $qta;
	}
}
?>