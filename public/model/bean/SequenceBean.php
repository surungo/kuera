<?php
include_once PATHPUBBEAN . '/AbstractBean.php';
class SequenceBean extends AbstractBean {
	private $id;
	private $tabela;
	public function SequenceBean() {
	}
	public function getid() {
		return $this->id;
	}
	public function setid($id) {
		$this->id = $id;
	}
	public function gettabela() {
		return $this->tabela;
	}
	public function settabela($tabela) {
		$this->tabela = $tabela;
	}
}
?>