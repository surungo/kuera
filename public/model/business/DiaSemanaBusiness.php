<?php
include_once PATHPUBBEAN . '/DiaSemanaBean.php';
class DiaSemanaBusiness {
	private $cltDiaSemana;
	public function __construct() {
		$nomes = array (
				"Segunda",
				"Terça",
				"Quarta",
				"Quinta",
				"Sexta",
				"Sábado",
				"Domingo" 
		);
		
		$diax = 60 * 60 * 24;
		$timex = mktime ( 0, 0, 0, 1, 4, 1970 );
		$tempo = 0;
		
		for($i = 1; $i < 8; $i ++) {
			$tempo = $timex + ($diax * $i);
			$this->cltDiaSemana [$i] = new DiaSemanaBean ( date ( "N", $tempo ), $nomes [$i - 1], date ( 'Y-m-d H:i:s', $tempo ) );
		}
	}
	public function findAll() {
		return $this->cltDiaSemana;
	}
	public function findById($id) {
		$diaSemanaBean = new DiaSemanaBean ( '', '', '' );
		$diaSemanaBean = $this->cltDiaSemana [$id];
		return $diaSemanaBean;
	}
}
?>