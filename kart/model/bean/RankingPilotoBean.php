<?php
include_once PATHAPP . '/mvc/public/model/bean/AbstractBean.php';
class RankingPilotoBean extends AbstractBean {
	private $id;
	private $piloto;
	private $ranking;
	private $cltRankingPilotoBateria;
	private $posicao;
	private $pontuacao;
	private $desempate;
	public function RankingPilotoBean() {
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
	public function getranking() {
		return $this->ranking;
	}
	public function setranking($ranking) {
		$this->ranking = $ranking;
	}
	public function getcltRankingPilotoBateria() {
		return $this->cltRankingPilotoBateria;
	}
	public function setcltRankingPilotoBateria($cltRankingPilotoBateria) {
		$this->cltRankingPilotoBateria = $cltRankingPilotoBateria;
	}
	public function getposicao() {
		return $this->posicao;
	}
	public function setposicao($posicao) {
		$this->posicao = $posicao;
	}
	public function getpontuacao() {
		return $this->pontuacao;
	}
	public function setpontuacao($pontuacao) {
		$this->pontuacao = $pontuacao;
	}
	public function getdesempate() {
		return $this->desempate;
	}
	public function setdesempate($desempate) {
		$this->desempate = $desempate;
	}
	
	/* Essa é a função estática de comparação */
	static function cmp_obj($a, $b) {
		$al = strtolower ( $a->posicao );
		$bl = strtolower ( $b->posicao );
		if ($al == $bl) {
			return 0;
		}
		return ($al > $bl) ? + 1 : - 1;
	}
}
?>

